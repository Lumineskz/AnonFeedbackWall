<?php
// Replace 'YOUR_ADMIN_PASSWORD_HERE' with the actual password you want.
$password = 'admin123'; 

// PASSWORD_DEFAULT uses the strongest algorithm (currently bcrypt)
$hash = password_hash($password, PASSWORD_DEFAULT); 
echo $hash . "\n";
?>