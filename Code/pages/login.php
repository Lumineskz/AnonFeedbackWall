<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php
    // CRITICAL: Start session to read error/success parameters from URL
    session_start();

    // Display registration success message from register_user.php
    if (isset($_GET['registration']) && $_GET['registration'] == 'success'): ?>
        <p class="success">✅ Registration successful! Please log in.</p>
    <?php 
    // Display error messages from login_user.php
    elseif (isset($_GET['error'])): ?>
        <p class="error">⚠️ Login failed! <br>
        <?php 
        $error = htmlspecialchars($_GET['error']);
        if ($error == 'emptyfields') echo "Please enter both username and password.<br>";
        // Added the db_prepare_fail error for debugging
        elseif ($error == 'db_prepare_fail') echo "Database configuration or query failed. Check config/config.php.<br>";
        elseif ($error == 'invalidcredentials') echo "Incorrect username or password.<br>";
        else echo "An unknown error occurred.<br>";
        ?>
        </p>
    <?php endif; ?>

    <form action="../actions/login_user.php" method="POST" class="login-form">
        <h2 class="form-head">Log In</h2>
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Username" required>
        <label for="">Password</label>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>