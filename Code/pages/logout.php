<?php
// actions/logout.php

// 1. Start the session (REQUIRED to access session data and settings)
session_start();

// 2. Clear all session variables
// This removes the user's data (username, user_id, role, group_name) from the $_SESSION superglobal.
$_SESSION = array();

// Alternatively, use session_unset() which does the same thing:
// session_unset();

// 3. Destroy the session itself
// This deletes the session file/cookie data on the server.
session_destroy();

// 4. Redirect the user to the login or index page
// We redirect to login.php so the user must authenticate again.
header("Location: ../pages/login.php");
exit(); // Always call exit() after a header redirect
?>