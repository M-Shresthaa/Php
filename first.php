<?php
include("header.html");
include("lngscldatabase.php");

session_start(); // Start the session at the beginning

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim(filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS));
    $password = trim(filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS));

    if (empty($username) || empty($password)) {
        $error_message = "⚠️ Missing username or password!";
    } else {
        if (isset($_POST["login"])) {
            // LOGIN PROCESS
            $sql = "SELECT password FROM users WHERE user = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                mysqli_stmt_bind_result($stmt, $hashedPassword);
                mysqli_stmt_fetch($stmt);
                mysqli_stmt_close($stmt);

                if (password_verify($password, $hashedPassword)) {
                    $_SESSION['username'] = $username;
                    header("Location: home.php"); // Redirect to welcome page
                    exit;
                } else {
                    $error_message = "❌ Incorrect password! Please try again.";
                }
            } else {
                $error_message = "❌ User not found! Please register first.";
            }
        } elseif (isset($_POST["register"])) {
            // REGISTRATION PROCESS
            $sql = "SELECT user FROM users WHERE user = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                $error_message = "⚠️ Username already exists! Try a different one.";
            } else {
                mysqli_stmt_close($stmt);
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $insert_sql = "INSERT INTO users (user, password) VALUES (?, ?)";
                $stmt = mysqli_prepare($conn, $insert_sql);
                mysqli_stmt_bind_param($stmt, "ss", $username, $hash);

                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['username'] = $username;
                    header("Location: welcome.php");
                    exit;
                } else {
                    $error_message = "❌ Error registering user.";
                }
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login or Register</title>
</head>
<body>
<section class="main_log" id="main_log">
    <form action="" method="post">
        <label for="username">Enter Username:</label><br>
        <input type="text" name="username" id="username" required><br>
        
        <label for="password">Enter Password:</label><br>
        <input type="password" name="password" id="password" required><br>
        
        <input type="submit" name="login" value="Login">
        <input type="submit" name="register" value="Register">
    </form>

    <!-- Display error messages if any -->
    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>
</section>
</body>
</html>
