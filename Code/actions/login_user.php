<?php
// actions/login_user.php

// 1. CRITICAL: Start the session before any output
session_start();

// 2. Include the database configuration (must exist in ../config/config.php)
include('../config/config.php');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 3. Retrieve and Sanitize Input
    $username = trim($_POST['username']);
    $password = $_POST['password']; // Do NOT sanitize the password before password_verify

    // 4. Basic Input Validation
    if (empty($username) || empty($password)) {
        header("Location: ../pages/login.php?error=emptyfields");
        exit();
    }

    // 5. Fetch User Data (Securely using Prepared Statements)
    // Fetch the password hash, group, and role needed for session creation
    $sql = "SELECT id, username, password, group_name, role FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);

    // Check for preparation error (e.g., table or column name typo)
    if (!$stmt) {
        header("Location: ../pages/login.php?error=db_prepare_fail");
        exit();
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // User found
        $user = $result->fetch_assoc();
        
        // 6. Verify Password (Checks raw password against stored hash)
        if (password_verify($password, $user['password'])) {
            
            // Login successful!
            
            // 7. Initialize Session Variables (CRITICAL for user state)
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['group_name'] = $user['group_name'];
            $_SESSION['role'] = $user['role']; 
            
            $stmt->close();
            $conn->close();
            
            // 8. Redirect to the Wall
            header("Location: ../pages/index.php");
            exit();

        } else {
            // Password incorrect
            header("Location: ../pages/login.php?error=invalidcredentials");
            $stmt->close();
            exit();
        }
    } else {
        // Username not found
        header("Location: ../pages/login.php?error=invalidcredentials");
        $stmt->close();
        exit();
    }

} else {
    // Direct access blocked
    header("Location: ../pages/login.php");
    exit();
}
?>