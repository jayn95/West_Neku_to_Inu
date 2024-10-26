<?php
// Include the database connection file
include "cfg/db_conn.php";

// Reject action
if (isset($_POST['reject'])) {
    $petID = $_POST['petID'];

    // Delete from database
    $remove_sql = "DELETE FROM animalprofiles WHERE petID='$petID'";

    if ($db->query($remove_sql) == TRUE) {
        echo "Record rejected successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
    exit();
}

// Add New Profile
// Get form data
$name = $_POST['name'];
$breed = $_POST['breed'];
$description = $_POST['description'];
$profilePic = $_FILES['profile_pic']['name'];

// Upload profile picture
$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file);
$image_url = $target_file;

// Insert data into database
$sql = "INSERT INTO animalprofiles (name, breed, description, image_url)
        VALUES ('$name', '$breed', '$description', '$image_url')";

if ($db->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}

$db->close();
?>
