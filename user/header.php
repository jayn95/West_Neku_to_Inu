<?php 
session_start();
include "../cfg/db_conn.php";

// Check if user is logged in
if (isset($_SESSION['username'])) {
    // Retrieve user's information from the database
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM user_account WHERE username = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../design/header_design.css">
        <link rel="stylsheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudfare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <header class="header">
            <img src="assets/HOUSE.gif">
            <nav class="navbar">
                <a href="src.php">Home</a>
                <a href="animal_view_profile.php">Animals</a>
                <a href="forumpage.php">Forum</a>
                <?php if (isset($_SESSION['username'])) { ?>
                    <a href="logout.php"><i class="fa fa-sign_out"></i>Logout</a>
                <?php } else { ?>
                    <a id="login" href="user_login.php"><i class="fa fa-sign-in"></i>Login</a>
                <?php } ?>
            </nav>
        </header>