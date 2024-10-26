<?php   
// Include the database connection file
include "../cfg/db_conn.php";   

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    session_start();
    // Retrieve form data
    $title = $_POST['name'];
    $content = $_POST['content'];
    
    // Retrieve user ID based on username
    // This assumes you have a session variable storing the username
    $username = $_SESSION['username'];// Adjust this line according to your session variable name
    
    // Query to fetch user_id based on username
    $query = "SELECT userID FROM user_account WHERE username = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $user_id = $row['userID'];
    
    // File upload handling
    $target_dir = "../uploads/"; // Directory where the file will be stored
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the file is not empty
    if (!empty($_FILES["fileToUpload"]["tmp_name"])) {
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 5000000) { // Corrected to 5MB
            $em = "Sorry, your file is too large.";
            header("Location: forumshtml.php?error=$em");
            $uploadOk = 0;
        }
        // Allow certain file formats
        $allowed_extensions = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowed_extensions)) {
            $em = "Sorry, invalid file format. Only JPG, JPEG, PNG, and GIF files are allowed.";
            header("Location: forumshtml.php?error=$em");
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // if everything is ok, try to upload file
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                // Insert into database
                $sql = "INSERT INTO forum_subject (title, fcontent, picture, userID) VALUES (?, ?, ?, ?)";
                
                // Prepare the SQL statement
                $stmt = $db->prepare($sql);
                
                // Check if the statement is prepared successfully
                if ($stmt) {
                    // Bind parameters and execute the statement
                    $stmt->bind_param("ssss", $title, $content, $target_file, $user_id);
                    if ($stmt->execute()) {
                        // If the insertion is successful, redirect to the forum page
                        header("Location: forumpage.php");
                        exit();
                    } else {
                        // If an error occurs, set the 'error' parameter in the URL and redirect back to the form page
                        header("Location: forumshtml.php?error=Failed to submit forum post.");
                        exit();
                    }
                } else {
                    // Handle error if statement preparation fails
                    echo "Error: " . $db->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No file was uploaded.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Forums</title>
        <link rel="stylesheet" href="../design/design.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Hind+Vadodara:wght@300;400;500;600;700&family=Lora:ital,wght@0,400..700;1,400..700&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
        <style>
            body {
                background: rgb(227,211,255);
                background: linear-gradient(90deg, rgba(227,211,255,1) 0%, rgba(248,247,244,1) 100%); 
            }
            body h2{
                margin: 1em;
                font-family: 'Quicksand';
            }
            .form-forum-container {
                margin-top: 100px;
            }
            .back-to-forum {
                position: fixed;
                left: 300px;
                z-index: 999;
                cursor: pointer;
                transition: left 0.3s ease;
                width: 80px;
                height: 80px;
            }
            .back-to-forum img{
                width: 100%;
                height: auto;
            }

            .back-to-forum:hover {
                width: 6%;
            }
        </style>
    </head>
    <body>
        <?php include "header.php" ?>
        <a href="forumpage.php" class="back-to-forum">
            <img src="assets/arrow_btn.png">
        </a>
        <div class="form-forum-container">
            <h2>Add New Forum</h2>
            <?php if (isset($_GET['error'])): ?>
                <p><?php echo $_GET['error']; ?></p>
            <?php endif ?>
            <form method="post"
                action="forumshtml.php"
                enctype="multipart/form-data">
                <label for="title">Title:</label>
                <input type="text" id="name" name="name" required><br><br>
                <label for="content">Content:</label>
                <textarea id="content" name="content" rows="4" cols="50" required></textarea><br><br>
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" name="submit" value="Submit"> 
            </form>
        </div>

    </body>
</html>