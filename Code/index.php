<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anonymous Feedback Wall</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1 class="header-msg">Anonymous Feedback Wall</h1>
        <p class="description-msg">Share your thoughts freely — no logins, just honesty.</p>

        <!-- Feedback Form -->
        <form action="" method="POST" class="feedback-form">
            <input type="text" class="name" placeholder="Username(Optional)" name="username">
            <textarea name="message" placeholder="Write your feedback here..." required></textarea>
            <button class="ui-btn" type="submit" name="submit_feedback">
                <span> Submit </span>
            </button>
        </form>

        <!-- Optional confirmation area -->
        <?php if(isset($_GET['success'])): ?>
            <p class="success">✅ Thank you! Your feedback was submitted.</p>
        <?php elseif(isset($_GET['error'])): ?>
            <p class="error">⚠️ Please enter a valid message.</p>
        <?php endif; ?>

        <a href="wall.php" class="view-wall-btn">View Feedback Wall →</a>
    </div>
    <script src="assets/js/sscript.js"></script>
</body>
</html>
