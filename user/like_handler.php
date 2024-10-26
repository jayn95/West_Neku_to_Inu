<?php
session_start();
include "../cfg/db_conn.php";

// Check if the request is sent via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if petID and liked status are provided in the POST data
    if(isset($_POST['petID']) && isset($_POST['liked'])) {
        // Sanitize the input to prevent SQL injection
        $petID = mysqli_real_escape_string($db, $_POST['petID']);
        $liked = ($_POST['liked'] == 'true') ? 1 : 0; // Convert string 'true' or 'false' to boolean
        
        // Retrieve userID from session
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $sql = "SELECT userID FROM user_account WHERE username = ?";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $userRow = $result->fetch_assoc();
            
            if ($userRow) {
                $userID = $userRow['userID'];
                
                // Check if the user has already reacted to this petID
                $sql = "SELECT * FROM reactions WHERE userID = $userID AND petID = $petID";
                $result = mysqli_query($db, $sql);

                if(mysqli_num_rows($result) > 0) {
                    // User has already reacted, update the existing reaction
                    $row = mysqli_fetch_assoc($result);
                    $reactionID = $row['reactionID'];

                    if($liked) {
                        // User liked the animal, update the reaction
                        $sql_update = "UPDATE reactions SET liked = 1 WHERE reactionID = $reactionID";
                        mysqli_query($db, $sql_update);
                        echo 'liked';
                    } else {
                        // User unliked the animal, delete the reaction
                        $sql_delete = "DELETE FROM reactions WHERE reactionID = $reactionID";
                        mysqli_query($db, $sql_delete);
                        echo 'unliked';
                    }
                } else {
                    // User has not reacted yet, insert a new reaction
                    if($liked) {
                        // User liked the animal, insert a new reaction
                        $sql_insert = "INSERT INTO reactions (userID, petID, liked, reacted_at) VALUES ($userID, $petID, 1, NOW())";
                        mysqli_query($db, $sql_insert);
                        echo 'liked';
                    } else {
                        // User unliked the animal, there's nothing to do
                        echo 'unliked';
                    }
                }
            } else {
                // Handle case where userID is not found
                echo 'error';
            }
        } else {
            // User not logged in, handle accordingly
            echo 'error';
        }
    } else {
        // Invalid request, petID or liked status not provided
        echo 'error';
    }
} else {
    // Invalid request method
    echo 'error';
}
?>
