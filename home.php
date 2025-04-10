<?php
session_start();
include("lngscldatabase.php"); // Ensure this connects to your database

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

// Get logged-in user data
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE user = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "❌ User not found!";
    exit;
}

// Fetch profile picture path
$profilePic = !empty($user['profile_pic']) ? $user['profile_pic'] : 'default.jpg';
$profilePicPath = "uploads/profile_pics/" . htmlspecialchars($profilePic);

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Language School</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Welcome, <?php echo htmlspecialchars($user['user']); ?>!</h2>
            
            <!-- Debugging: Display profile picture path -->
            <p>Debug: Profile Pic Path - <?php echo $profilePicPath; ?></p>

            <!-- Display profile picture -->
            <div>
                <img src="<?php echo $profilePicPath . '?' . time(); ?>" 
                     alt="Profile Picture" width="150" height="150">
            </div>
            
            <!-- Link to upload a new profile picture -->
            <div>
                <a href="profile_pic_change.php">Upload New Profile Picture</a>
            </div>
            
            <p>Username: <?php echo htmlspecialchars($user['user']); ?></p>
            <p>担任の先生: <?php echo htmlspecialchars($user['担任の先生']); ?></p>
            <p>未学費: <?php echo htmlspecialchars($user['user']); ?></p>
        </div>

        <div class="main-content">
            <h2>Dashboard</h2>
            <div class="nav">
                <a href="assignments.php">📚 Assignments</a>
                <a href="lectures.php">🎥 Lectures</a>
                <a href="notes.php">📝 Notes</a>
                <a href="info.php">👤 My Info</a>
                <a href="ask_teacher.php">❓ Ask for Teacher</a>
            </div>

            <a href="logout.php" class="logout-btn">🚪 Logout</a>
        </div>
    </div>
</body>
</html>
