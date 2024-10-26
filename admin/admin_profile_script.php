<?php
include "cfg/db_conn.php";

// Check if form is submitted and profile image is uploaded
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['profile_image'])) {
    // Get form data
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $password = $_POST['password'];
    
    // Upload profile picture
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
    
    // Check if file upload is successful
    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
        $image_url = $target_file;

        // Update data in the database
        $modify_sql = "UPDATE adminaccount
                      SET first_name = '$first_name',
                          last_name = '$last_name',
                          password = '$password',
                          pic_url = '$image_url'
                      WHERE username = '$username'";

        if ($db->query($modify_sql) === TRUE) {
            echo "<script>window.location.href = 'admin.php';</script>";
            exit(); // Stop further execution
        } 
        else {
            echo "Error: " . $modify_sql . "<br>" . $db->error;
        }
    } else {
        echo "Error uploading profile picture";
    }
} else {
    echo "Error: Profile image is missing or form not submitted properly";
}

// Close connection
$db->close();
?>
