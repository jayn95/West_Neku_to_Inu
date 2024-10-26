<?php 
include "../cfg/db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_SESSION['username'])) {

        echo "You must be logged in to access this page. Redirecting to the login page...";
        header('Refresh: 3; url=user_login.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Animal Profile</title>
        <link rel="stylesheet" href="../design/design.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Hind+Vadodara:wght@300;400;500;600;700&family=Lora:ital,wght@0,400..700;1,400..700&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Lora';
                background: rgb(227,211,255);
                background: linear-gradient(90deg, rgba(227,211,255,1) 0%, rgba(248,247,244,1) 100%); 
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            .container {
                background: #fff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                width: 100%;
                max-width: 400px;
                box-sizing: border-box;
            }

            .form-group h2 {
            
                margin: 0 auto;
                color: #313638;
                text-align: center;
                font-family: 'Quicksand';
            }

            .error {
                color: #e74c3c;
                text-align: center;
                margin-bottom: 20px;
            }

            .form-group {
                margin-bottom: 15px;
            }

            .form-group label {
                display: block;
                margin-bottom: 5px;
                color: #555;
            }

            .form-group input {
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 5px;
                box-sizing: border-box;
            }

            .btn {
                width: 100%;
                padding: 10px;
                background-color: #B784B7;
                border: none;
                color: white;
                border-radius: 5px;
                cursor: pointer;
            }

            .btn:hover {
                background-color: #8E7AB5;
            }

            .login-reference {
                text-align: center;
                margin-top: 20px;
            }

            .login-reference a {
                color: #8E7AB5; /* Green color for the link */
                text-decoration: none;
            }

            .login-reference a:hover {
                text-decoration: underline; /* Underline the link on hover */
            }
        </style>
    </head>
    <body>
        <!-- NAVIGATION BAR -->
        <?php include "header.php"; ?>

        <!-- ADD ANIMAL -->
        <div class="container">
            <?php if (isset($_GET['error'])): ?>
                <p><?php echo $_GET['error']; ?></p>
            <?php endif ?>
            <form method="post"
                action="add_animal.php"
                enctype="multipart/form-data">
                <div class="form-group">
                    <h2>Add Animal Profile</h2>
                    <br>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required><br><br>
                    <label for="breed">Breed:</label>
                    <input type="text" id="breed" name="breed" required><br><br>
                    <label for="description">Description:</label><br>
                    <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>
                    <label for="image_url">Upload Animal Image:</label>
                    <input type="file"name="image_url">
                    <input type="submit" name="submit" value="Add Profile"> 
                </div>
            </form>
        </div>
    </body>
</html>