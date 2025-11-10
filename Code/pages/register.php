<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    
</head>
<body>
    <form action="../actions/register_user.php" method="POST" class="login-form">
        <h2 class="form-head">Register</h2>
        <label for="Username">Username</label>
        <input type="text" name="username" placeholder="Username" required>
        <label for="Password">Password</label>
        <input type="password" name="password" placeholder="Password" required>
        <select name="group_name" required>
            <option value="">Select Group</option>
            <option value="BCSIT">BCSIT</option>
            <option value="BBA">BBA</option>
            <option value="BCA">BCA</option>
        </select>
        <button type="submit">Register</button>
    </form>
</body>
</html>