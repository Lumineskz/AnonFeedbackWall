<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Optional: Protect header so it's only shown to logged-in users
if (!isset($_SESSION['username'])) {
    header("Location: ../pages/login.php");
    exit();
}
?>

<header class="main-header">
    <div class="header-left">
        <span class="username">👤 <?= htmlspecialchars($_SESSION['username']); ?></span>
    </div>
    <div class="header-right">
        <a href="../pages/logout.php" class="logout-btn">Log Out</a>
    </div>
</header>
