<?php
$username = $err_msg = "";

include "cfg/db_conn.php";

if (isset($_POST['user_login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT * from adminaccount where username = ? and password_hash = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $row['username'];
            $_SESSION['image_prof'] = $row['image_prof'];
            header("location:animal.php");
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
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="design/design.css">
</head>
<body>
    <!-- ADMIN LOGIN -->
    <br>
    <br>
    <br>
    <div class="admin-container">
        <div class="admin-header">
            <h2>Admin Login</h2>
            <br>
        </div>
        <?php if (!empty($err_msg)): ?>
            <div class="error"><?php echo $err_msg; ?></div>
        <?php endif; ?>
        <form method="post" action="admin_login.php">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Enter your Username" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password">
            </div>
            <div class="form-group">
                <button type="submit" class="btn" name="user_login">Login</button>
            </div>
        </form>
    </div>

</body>
</html>
