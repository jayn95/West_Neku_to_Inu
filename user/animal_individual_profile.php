<!-- animal_pic_react.php -->
<?php
include "header.php";
include "../cfg/db_conn.php";

// Function to get initial like count for a petID
function getInitialLikeCount($db, $petID) {
    $sql = "SELECT COUNT(*) as totalLikes FROM reactions WHERE petID = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('i', $petID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['totalLikes'];
}

// Check if petID is provided in the URL
if(isset($_GET['petID'])) {
    // Sanitize the input to prevent SQL injection
    $petID = mysqli_real_escape_string($db, $_GET['petID']);
    
    // Query to fetch detailed information of the particular animal
    $sql = "SELECT * FROM animalprofiles WHERE petID = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('i', $petID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if the query was successful
    if($result && $result->num_rows > 0) {
        // Fetch the data
        $row = $result->fetch_assoc();
        // Get initial like count
        $initialLikeCount = getInitialLikeCount($db, $petID);
        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Animal Details</title>
            <link rel="stylesheet" href="../design/design.css">
            <link rel="stylesheet" href="../design/animal_profile.css">
            <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
            rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Hind+Vadodara:wght@300;400;500;600;700&family=Lora:ital,wght@0,400..700;1,400..700&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
            <style>
                .back-to-forum {
                    position: fixed;
                    top: 80px;
                    left: 280px;
                    z-index: 999;
                    cursor: pointer;
                    transition: left 0.3s ease;
                    width: 80px;
                    height: 80px;
                }
                .back-to-forum img{
                    width: 100%;
                    height: auto;
                }

                .back-to-forum:hover {
                    width: 6%;
                }
            </style>
        </head>
        <body>
            <a href="animal_view_profile.php" class="back-to-forum">
                <img src="assets/arrow_btn.png">
            </a>
            <div class="whole">
            <div class="animalDetails">
                <h2>Animal Details</h2>
                <div class="animalProfile">
                    <div class="animalImage">
                        <div class="image-container">
                            <img src="<?=$row["image_url"]?>" alt="Animal Image">
                            <div class="heart-btn" data-petid="<?=$petID?>">
                                <div class="content">
                                    <span class="heart"></span>
                                    <span class="text">Like</span>
                                    <span class="numb" id="LikeCount">
                                        <?=$initialLikeCount?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="animalInfo">
                        <h3><strong>Name:</strong> <?=$row["name"]?></h3>
                        <p><strong>Breed:</strong> <?=$row["breed"]?></p>
                        <p><strong>Description:</strong> <?=$row["description"]?></p>
                    </div>
                </div>
            </div>
            </div>

            <script>
                $(document).ready(function() {
                    // Click event for heart react button
                    $('.heart-btn').on('click', function() {
                        var petID = $(this).data('petid');
                        var userID = <?php echo isset($_SESSION['userID']) ? $_SESSION['userID'] : 'null'; ?>;
                        var likeCount = parseInt($('#LikeCount').text());
                        var liked = $(this).hasClass('heart-active'); // Check if the button is already liked

                        $.ajax({
                            type: 'POST',
                            url: 'like_handler.php',
                            data: { userID: userID, petID: petID, liked: !liked },
                            success: function(response) {
                                if(response === 'liked') {
                                    // If the button was not liked, add the like
                                    if (!liked) {
                                        $(this).addClass("heart-active");
                                        $('#LikeCount').text(likeCount + 1);
                                    }
                                } else if(response === 'unliked') {
                                    // If the button was liked, remove the like
                                    if (liked) {
                                        $(this).removeClass("heart-active");
                                        $('#LikeCount').text(likeCount - 1);
                                    }
                                }
                            }.bind(this), // Ensure the proper context for 'this'
                            error: function(xhr, status, error) {
                                // Handle errors if any
                                console.error(xhr.responseText);
                            }
                        });
                    });

                    // Toggle classes for heart animation
                    $('.content').on('click', function() {
                        $(this).toggleClass("heart-active");
                        $('.text, .numb, .heart').toggleClass("heart-active");
                    });
                });
            </script>
        </body>
        </html>
        <?php
    } else {
        // No animal found with the provided petID
        echo "Animal not found!";
    }
} else {
    // petID is not provided in the URL
    echo "Invalid request!";
}
?>