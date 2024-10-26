<?php
// Database connection
include "cfg/db_conn.php";

// Approve action
if (isset($_POST['approve'])) {
    $petID = $_POST['petID'];
    $name = $_POST['name'];
    $breed = $_POST['breed'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];

    // Insert into database
    $insert_sql = "INSERT INTO animalprofiles (name, breed, description, image_url) VALUES ('$name', '$breed', '$description', '$image_url')";
    $remove_sql = "DELETE FROM temp_animal_submissions WHERE petID='$petID'";

    if ($db->query($insert_sql) === TRUE && $db->query($remove_sql) == TRUE) {
        echo "Record approved successfully";
    } else {
        echo "Error: " . $db->error;
    }
}

// Reject action
if (isset($_POST['reject'])) {
    $petID = $_POST['petID'];

    // Delete from database
    $remove_sql = "DELETE FROM temp_animal_submissions WHERE petID='$petID'";

    if ($db->query($remove_sql) == TRUE) {
        echo "Record rejected successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
}

$db->close();
?>
