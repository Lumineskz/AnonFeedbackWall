<?php
// actions/submit_feedback.php
session_start();

// 1. Configuration and Initialization
include('../config/config.php');
// Include site header (if present). Use output buffering to avoid sending HTML before redirects

// Define where uploaded files will be stored (MUST exist and be writable by the web server)
$upload_dir = '../uploads/';

// Ensure the upload directory exists
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// 2. Check for form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_feedback'])) {
    
    // 3. Collect and Sanitize Input
    $message = trim($_POST['message']);
    // Anonymous is checked if it exists, otherwise use 'Anon' or a default username
    // Determine poster name: respect "Post Anonymously" checkbox, otherwise use logged-in username if available, fall back to 'Anon'
    $username = 'Anon';
    if (isset($_POST['anonymous']) && $_POST['anonymous'] == '1') {
        $username = 'Anonymous';
    } else {
        if (!empty($_SESSION['username'])) {
            $username = $_SESSION['username'];
        } elseif (!empty($_SESSION['user_id'])) {
            $user_id = (int)$_SESSION['user_id'];
            $sql_get_user = "SELECT username FROM users WHERE id = ? LIMIT 1";
            if ($stmtu = $conn->prepare($sql_get_user)) {
                $stmtu->bind_param("i", $user_id);
                if ($stmtu->execute()) {
                    $stmtu->bind_result($fetched_username);
                    if ($stmtu->fetch() && !empty($fetched_username)) {
                        $username = $fetched_username;
                    }
                } else {
                    error_log("DB Execute Error (get username): " . $stmtu->error);
                }
                $stmtu->close();
            } else {
                error_log("DB Prepare Error (get username): " . $conn->error);
            }
        }
    }
    $group_name = 'Public'; // Assuming the public wall has a 'Public' group for anonymous posts.
    
    // Check if a message is empty (image alone shouldn't count as valid feedback)
    if (empty($message) && (!isset($_FILES['image']) || $_FILES['image']['error'] == UPLOAD_ERR_NO_FILE)) {
        header("Location: ../pages/index.php?error=emptyfields");
        exit();
    }

    $image_path = NULL; // Default value for image path
    
    // --- 4. Handle Image Upload ---
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $file = $_FILES['image'];
        
        // Define allowed file types and size limits
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $max_file_size = 5 * 1024 * 1024; // 5MB

        // Validation checks
        if (!in_array($file['type'], $allowed_types)) {
            header("Location: ../pages/index.php?error=invalidfiletype");
            exit();
        }
        if ($file['size'] > $max_file_size) {
            header("Location: ../pages/index.php?error=filetoobig");
            exit();
        }
        
        // Generate a unique file name to prevent overwriting and security issues
        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $new_file_name = uniqid('feedback_', true) . '.' . $file_extension;
        $destination = $upload_dir . $new_file_name;
        
        // Move the uploaded file from the temporary location to the final destination
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            // Success: Set the path to be stored in the database
            $image_path = 'uploads/' . $new_file_name; 
        } else {
            // Failure to move file
            header("Location: ../pages/index.php?error=uploadfailed");
            exit();
        }
    }

    // --- 5. Insert Feedback into Database (Securely) ---
    // Make sure your 'feedback' table has columns: message, username, group_name, image_path, timestamp
    $sql = "INSERT INTO feedback (message, username, group_name, image_path) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        error_log("DB Prepare Error: " . $conn->error);
        header("Location: ../pages/index.php?error=dberror");
        exit();
    }

    // Determine the group name (since this is the index page, we assume 'Public' for anonymous posts)
    // NOTE: If you plan to use this action script for logged-in users, you'll need session checks here.
    // Determine group_name: try to load the logged-in user's group from DB, otherwise default to 'Public'
    $group_name = 'Public';

    if (isset($_SESSION['user_id']) || isset($_SESSION['username'])) {
        if (isset($_SESSION['user_id'])) {
            $user_id = (int)$_SESSION['user_id'];
            $sql_get_group = "SELECT group_name FROM users WHERE id = ? LIMIT 1";
            if ($stmt2 = $conn->prepare($sql_get_group)) {
                $stmt2->bind_param("i", $user_id);
                if ($stmt2->execute()) {
                    $stmt2->bind_result($fetched_group);
                    if ($stmt2->fetch() && !empty($fetched_group)) {
                        $group_name = $fetched_group;
                    }
                } else {
                    error_log("DB Execute Error (get group): " . $stmt2->error);
                }
                $stmt2->close();
            } else {
                error_log("DB Prepare Error (get group): " . $conn->error);
            }
        } elseif (isset($_SESSION['username'])) {
            $session_username = $_SESSION['username'];
            $sql_get_group = "SELECT group_name FROM users WHERE username = ? LIMIT 1";
            if ($stmt2 = $conn->prepare($sql_get_group)) {
                $stmt2->bind_param("s", $session_username);
                if ($stmt2->execute()) {
                    $stmt2->bind_result($fetched_group);
                    if ($stmt2->fetch() && !empty($fetched_group)) {
                        $group_name = $fetched_group;
                    }
                } else {
                    error_log("DB Execute Error (get group): " . $stmt2->error);
                }
                $stmt2->close();
            } else {
                error_log("DB Prepare Error (get group): " . $conn->error);
            }
        }
    }

    $stmt->bind_param("ssss", $message, $username, $group_name, $image_path);

    if ($stmt->execute()) {
        header("Location: ../pages/index.php?success=1");
    } else {
        error_log("DB Execute Error: " . $stmt->error);
        header("Location: ../pages/index.php?error=dberror");
    }

    $stmt->close();
    $conn->close();
    exit();

} else {
    // Not a POST request
    header("Location: ../pages/index.php");
    exit();
}
?>