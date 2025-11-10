<?php
// actions/register_user.php
session_start();
include('../config/config.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Retrieve and Sanitize Input Data
    $username = trim($conn->real_escape_string($_POST['username']));
    $password = $_POST['password'];
    $group_name = trim($conn->real_escape_string($_POST['group_name']));
    $role = 'user'; 

    // 2. Basic Input Validation
    if (empty($username) || empty($password) || empty($group_name)) {
        header("Location: ../pages/register.php?error=emptyfields");
        exit();
    }

    // 3. Check if the username already exists (SECURELY using Prepared Statements)
    $sql_check = "SELECT id FROM users WHERE username = ?";
    $stmt_check = $conn->prepare($sql_check);
    
    if (!$stmt_check) {
        header("Location: ../pages/register.php?error=db_prepare_fail");
        exit();
    }
    
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        header("Location: ../pages/register.php?error=usernametaken");
        $stmt_check->close();
        exit();
    }
    $stmt_check->close();

    // 4. Securely Hash the Password
    $hashed_pwd = password_hash($password, PASSWORD_DEFAULT); 
    
    // 5. Insert New User (SECURELY using Prepared Statements)
    $sql_insert = "INSERT INTO users (username, password, group_name, role) VALUES (?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    
    if (!$stmt_insert) {
        header("Location: ../pages/register.php?error=db_insert_prepare_fail");
        exit();
    }

    $stmt_insert->bind_param("ssss", $username, $hashed_pwd, $group_name, $role);

    if ($stmt_insert->execute()) {
        $stmt_insert->close();
        $conn->close();
        
        // Redirect to login page with a success message
        header("Location: ../pages/login.php?registration=success");
        exit();
    } else {
        header("Location: ../pages/register.php?error=db_insert_failed");
        $stmt_insert->close();
        $conn->close();
        exit();
    }

} else {
    // If someone tries to access this script directly without POST, redirect them to the form
    header("Location: ../pages/register.php");
    exit();
}
?>