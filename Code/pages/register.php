<?php
// pages/register.php

// 1. Include database connection file
include('../config/config.php');

// 2. Query the database to get all group names
$groups_result = $conn->query("SELECT group_name FROM groups ORDER BY group_name ASC");

// Check for query errors (for debugging)
if (!$groups_result) {
    die("Error fetching groups: " . $conn->error);
}

// Start session to check for any messages (optional, but good practice)
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <!-- Display success/error messages if coming from register_user.php -->
    <?php if (isset($_GET['error'])): ?>
        <p class="error">⚠️ Registration failed! 
        <?php 
        $error = htmlspecialchars($_GET['error']);
        if ($error == 'emptyfields') echo "Please fill in all fields.";
        elseif ($error == 'usertaken') echo "That username is already taken.";
        else echo "An unknown error occurred.";
        ?>
        </p>
    <?php endif; ?>

    <form action="../actions/register_user.php" method="POST" class="login-form">
        <h2 class="form-head">Register</h2>
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Username" required>
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" required>
        
        <label for="group_name">Select Group</label>
        <select name="group_name" required>
            <option value="">Select Group</option>
            
            <?php 
            // 3. Loop through the results and create an <option> for each group
            if ($groups_result->num_rows > 0) {
                while($row = $groups_result->fetch_assoc()) {
                    $group_name = htmlspecialchars($row['group_name']);
                    // The value and displayed text are the group name
                    echo "<option value=\"$group_name\">$group_name</option>";
                }
            } else {
                echo "<option value=\"\" disabled>No groups found in database</option>";
            }
            ?>
        </select>
        <button type="submit">Register</button>
        <div class="mt-3">
             <a href="login.php" class="text-link">Already have an account? Log In</a>
        </div>
    </form>
</body>
</html>
<?php
// Close database connection
$conn->close();
?>