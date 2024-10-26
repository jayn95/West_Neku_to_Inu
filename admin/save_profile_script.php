<?php
include "cfg/db_conn.php";

// Check if form is submitted and profile image is uploaded
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['profile_pic'])) {
    // Get form data
    $petID = $_POST['petID'];
    $name = $_POST['name'];
    $breed = $_POST['breed'];
    $description = $_POST['description'];
    
    // Upload profile picture
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
    
    // Check if file upload is successful
    if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
        $image_url = $target_file;

        // Update data in the database
        $modify_sql = "UPDATE animalprofiles
                      SET name = '$name',
                          breed = '$breed',
                          description = '$description',
                          image_url = '$image_url'
                      WHERE petID = '$petID'";

        if ($db->query($modify_sql) === TRUE) {
            echo "Record modified successfully";
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
