<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anonymous Feedback Wall</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1 class="header-msg">Anonymous Feedback Wall</h1>
        <p class="description-msg">Share your thoughts freely — no logins, just honesty.</p>

        <!-- Feedback Form -->
        <form action="../actions/submit_feedback.php" method="POST" class="feedback-form">
            <label class="checkbox-wrapper">
                <input type="checkbox" name="anonymous" checked value="1"/>
                <div class="checkmark">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path
                        d="M20 6L9 17L4 12"
                        stroke-width="3"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    ></path>
                    </svg>
                </div>
                <span class="label">Post as Anon</span>
            </label>
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
    <script src="assets/js/main.js"></script>
</body>
</html>
