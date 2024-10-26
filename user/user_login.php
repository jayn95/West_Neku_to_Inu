<?php

session_start();
$username = $err_msg = "";

include "../cfg/db_conn.php";

if (isset($_POST['user_login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT * from user_account where username = ? and password = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $row['username'];
            $_SESSION['image_prof'] = $row['image_prof'];
            header("location:src.php");
            exit; // Add exit to prevent further execution
        } else {
            $err_msg = "Invalid username/password";
        }
    } else {
        $err_msg = "Some error occurred";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../design/design.css">
    <link rel="stylesheet" href="../design/user_login_design.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hind+Vadodara:wght@300;400;500;600;700&family=Lora:ital,wght@0,400..700;1,400..700&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- ADMIN LOGIN -->
    <div class="container">
        <div class="header">
            <h2>User Login</h2>
        </div>
        <?php if (!empty($err_msg)): ?>
            <div class="error"><?php echo $err_msg; ?></div>
        <?php endif; ?>
        <form method="post" action="user_login.php">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your Username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your Password" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn" name="user_login">Login</button>
            </div>
            <p>Don't have an account? <a href="user_signup.php">Create Account</a>.</p>
        </form>
        </div>
    </div>
</body>
</html>