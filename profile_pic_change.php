<?php
session_start();
include("lngscldatabase.php");  // Include your DB connection script

if (isset($_POST['upload'])) {
    // Check if a file was uploaded
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        // Get file details
        $fileTmpPath = $_FILES['profile_pic']['tmp_name'];
        $fileName = $_FILES['profile_pic']['name'];
        $fileSize = $_FILES['profile_pic']['size'];
        $fileType = $_FILES['profile_pic']['type'];

        // Set a unique name for the file (e.g., user ID or session ID + file extension)
        $userId = $_SESSION['username'];  // Assuming you're storing the username in session
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $newFileName = $userId . '.' . $fileExtension;

        // Directory to store profile pictures
        $uploadDir = 'uploads/profile_pics/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);  // Create the directory if it doesn't exist
        }

        // Set the path to save the uploaded file
        $destPath = $uploadDir . $newFileName;

        // Check if the file is an image (optional, for validation)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($fileType, $allowedTypes)) {
            echo "❌ Invalid file type. Only JPG, PNG, and GIF are allowed.";
            exit;
        }

        // Move the file to the destination folder
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            // Update the user's profile picture in the database
            $sql = "UPDATE users SET profile_pic = ? WHERE user = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ss", $newFileName, $userId);

            if (mysqli_stmt_execute($stmt)) {
                echo "✅ Profile picture uploaded successfully!";
                // Redirect back to the welcome page to show updated image
                header("Location: home.php");
                exit();
            } else {
                echo "❌ Error updating the database.";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "❌ Error uploading the file.";
        }
    } else {
        echo "❌ No file uploaded or there was an error.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Profile Picture</title>
</head>
<body>
    <h2>Upload a New Profile Picture</h2>
    <form action="profile_pic_change.php" method="POST" enctype="multipart/form-data">
        <label for="profile_pic">Choose a profile picture:</label>
        <input type="file" name="profile_pic" id="profile_pic" accept="image/*" required>
        <input type="submit" name="upload" value="Upload">
    </form>
</body>
</html>

