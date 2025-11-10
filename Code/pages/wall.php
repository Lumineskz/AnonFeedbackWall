<?php
// includes/auth.php already starts the session and checks login status
include('../includes/auth.php'); 
include('../config/config.php'); 

$group = $_SESSION['group_name'];

// --- FIX: Secure Query using Prepared Statements ---
// 1. Prepare the SQL statement
$sql = "SELECT username, message, timestamp FROM feedback WHERE group_name = ? ORDER BY timestamp DESC";
$stmt = $conn->prepare($sql);

// Check if the statement preparation failed
if (!$stmt) {
    // Handle error (e.g., redirect or display a generic error)
    die("Database query preparation failed: " . $conn->error);
}

// 2. Bind the group_name parameter ('s' for string)
$stmt->bind_param("s", $group);

// 3. Execute the statement
$stmt->execute();

// 4. Get the result set
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FIX: Added correct title, linked style sheet -->
    <title><?= htmlspecialchars($group) ?> Feedback Wall</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="wall-page">
    
    <?php include('../includes/header.php'); ?>
    
    <!-- WRAP the content in the .container class and add margin-top to clear the fixed header -->
     
        <h1 class="header-msg">Welcome to the <?= htmlspecialchars($group) ?> Feedback Wall</h1>
        <p class="description-msg">This is the centralized feedback for your group.</p>
<div class="wall-container">
    <h2 class="wall-head">Latest Feedback</h2><br>
        <div class="wall-feed">
          
          
          <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="post">
                    <!-- Username with strong tag for emphasis -->
                    <strong><?= htmlspecialchars($row['username']) ?></strong>
                    <!-- Feedback message -->
                    <p class="post-message"><?= htmlspecialchars($row['message']) ?></p>
                    <!-- Timestamp -->
                    <small class="post-timestamp"><?= $row['timestamp'] ?></small>
                </div>
            <?php endwhile; ?>
          <?php else: ?>
            <!-- Message if no feedback is found -->
            <p class="info-msg">No feedback posted yet for the <?= htmlspecialchars($group) ?> group.</p>
          <?php endif; ?>
        </div>
    </div>
</body>
</html>
<?php
// FIX: Close the statement and connection outside the HTML body
$stmt->close();
$conn->close();
?>