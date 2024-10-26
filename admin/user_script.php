<?php
// Database connection
include "cfg/db_conn.php";

// Approve action
if (isset($_POST['approve'])) {
    $userID = $_POST['userID'];
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email_address = $_POST['email_address']; // Add this line
    $password = $_POST['password']; // Add this line

    // Insert into database
    $insert_sql = "INSERT INTO user_account (username, first_name, last_name, email_address, password) VALUES ('$username', '$first_name', '$last_name', '$email_address', '$password')";
    $remove_sql = "DELETE FROM temp_user_account WHERE userID='$userID'";

    if ($db->query($insert_sql) === TRUE && $db->query($remove_sql) == TRUE) {
        echo "Record approved successfully";
    } else {
        echo "Error: " . $db->error;
    }
}

// Reject action
if (isset($_POST['reject'])) {
    $userID = $_POST['userID'];

    // Delete from database
    $remove_sql = "DELETE FROM temp_user_account WHERE userID='$userID'";

    if ($db->query($remove_sql) == TRUE) {
        echo "Record rejected successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
}

$db->close();
?>
