<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign In</title>
        <link rel="stylesheet" href="../design/design.css">
        <link rel="stylesheet" href="../design/user_login_design.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Hind+Vadodara:wght@300;400;500;600;700&family=Lora:ital,wght@0,400..700;1,400..700&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
        <style>
            .user-container {
                margin-top: 100px;
            }
        </style>
    </head>
    <body>
        <!-- USER SIGN IN -->
        <div class="container">
            <div class="header">
                <h2>Sign In</h2>
            </div>
            <br>
            <?php if (isset($_GET['error'])): ?>
                <p><?php echo $_GET['error']; ?></p>
            <?php endif ?>
            <form method="post"
                action="user_server.php"
                enctype="multipart/form-data">
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" required><br><br>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" required><br><br>
                    <label for="email_address">Email Address:</label>
                    <input type="text" id="email_address" name="email_address" required><br><br>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required><br><br>
                    <label for="password">Password:</label>
                    <input type="text" id="password" name="password" required><br><br>
                    <input type="submit" name="submit" value="Sign In"> 
                    <p>Already have an account? <a href="user_login.php">Login here</a>.</p>
                </div>
            </form>
        </div>
    </body>
</html>