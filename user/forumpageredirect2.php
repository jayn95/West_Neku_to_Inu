<?php   
// Include the database connection file
include "../cfg/db_conn.php";
include "header.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Retrieve form data
    $comment = $_POST['comment'];
    $content_id = $_GET['content_id']; // Get content ID from URL parameter

    // Retrieve user ID based on username
    // This assumes you have a session variable storing the username
    $username = $_SESSION['username']; // Adjust this line according to your session variable name
    
    // Query to fetch user_id based on username
    $query = "SELECT userID FROM user_account WHERE username = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $user_id = $row['userID'];
    
    // File upload handling for comment image (if needed)
    // Similar to the file upload process for the forum post
    
    // Insert comment into database
    $sql = "INSERT INTO forum_comments (userID, comment, content_id) VALUES (?, ?, ?)";
    
    // Prepare the SQL statement
    $stmt = $db->prepare($sql);
    
    // Check if the statement is prepared successfully
    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("ssi", $user_id, $comment, $content_id);
        if ($stmt->execute()) {
            // If the insertion is successful, redirect back to the forum page
            header("Location: forumpageredirect2.php?content_id=$content_id");
            exit();
        } else {
            // If an error occurs, set the 'error' parameter in the URL and redirect back to the form page
            header("Location: forumpageredirect2.php?content_id=$content_id&error=Failed to submit comment.");
            exit();
        }
    } else {
        // Handle error if statement preparation fails
        echo "Error: " . $db->error;
    }
}
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Forums</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Hind+Vadodara:wght@300;400;500;600;700&family=Lora:ital,wght@0,400..700;1,400..700&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

        <style>  
            body {
                background: rgb(227,211,255);
                background: linear-gradient(90deg, rgba(227,211,255,1) 0%, rgba(248,247,244,1) 100%); 
            }
            .container {
                max-width: 700px;
                margin: 100px auto;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 5px;
                background-color: #8E7AB5;
            }

            .date-created{
                font-size: 10px;
                color: #000;
            }
            .admin-info {
                color: #000;
            }

            .pic-container {
                margin-bottom: 10px; 
                text-align: center; 
            }

            .pic-container img {
                max-width: 100%; /* Ensures the image doesn't exceed the width of its container */
                max-height: 400px; /* Set a fixed height for the image */
                width: auto; /* Ensures the image maintains its aspect ratio */
                height: auto; /* Ensures the image maintains its aspect ratio */
                object-fit: cover; /* Scales the image while preserving its aspect ratio and cropping to fill its container */
                border-radius: 5px;
                margin:10px;
            }
            .post {
                max-width: 600px;
                margin: 20px auto;
                padding: 20px;
                border-radius: 5px;
                background-color: #fff;
            }


            .post h2{
                font-size: 25px;
                font-family: 'Quicksand';
            }

            .profile-info {
                display: flex;
                align-items: center;
            }

            .post p {
                padding-top: 5px;
                font-size: 16px;
                font-family: 'Hind Vadodara';
            }

            .comment-title {
                margin-bottom: 3px;
                font-family: 'Quicksand';
                color: #fff;
            }

            .comment p{
                padding: 5px;
                font-size: 14px;
                color: #fff;
                font-family: 'Hind Vadodara';
            }

            #comment{
                width: 480px;
            }

            .comment-section{
                padding-top: 1em;
            }

            .btn{
                display: block;
                width: 100%;
                height: 30px;
                background-color: #8E7AB5;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                margin: 10px;
            }

           .comment-form{ 
                max-width: 100%;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 5px;
                background-color: #f9f9f9;

           }

           .form-group {
                margin-left: -10px;
                margin-right: 10px;
           }
           .post h3, p{
                color: #000;
                font-family: 'Quicksand';
           }
           .back-to-forum {
                position: fixed;
                left: 230px;
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
        <a href="forumpage.php" class="back-to-forum">
            <img src="assets/arrow_btn.png">
        </a>
        <div class ="container">
            <div class ="post">
                <?php if(isset($_GET['content_id'])) {
                
                $content_id = $_GET['content_id'];

                // Prepare an SQL statement to select all posts from the forum_subject table
                $sql_forum = "SELECT sub.*, ua.*
                        FROM forum_subject AS sub
                        JOIN user_account AS ua ON sub.userID = ua.userID
                        WHERE sub.content_id = $content_id";
                $result_forum = $db->query($sql_forum);
            
                if ($result_forum->num_rows > 0) {
                $row = $result_forum->fetch_assoc();
                ?>
                <div class="post">
                    <div class="admin-info">
                        <div class="date-created">
                            <?php echo date("M d, Y", strtotime($row["date_created"])); ?>
                        </div>
                        <div class="admin-name">
                            <?php echo $row["username"]; ?>
                        </div>
                </div>
                    <h3><?php echo $row["title"]; ?></h3>
                    <p><?php echo $row["fcontent"]; ?></p>
                    <div class="pic-container">
                        <img src="../uploads/<?=$row["picture"]?>" alt="Post Image">
                    </div>
                </div>
                <?php
            } else {
                echo "Post not found.";
            }
        } else {
            echo "Content ID not provided.";
        }?>
            </div>
            <div class="comment-section">
                <div class="comment-title">
                    <h4>Comments</h4>
                </div>
                    <div id="comments-container">
                        <?php
                            // Retrieve comments for a specific content_id
                        $sql_comments = "SELECT fc.*, ua.username
                            FROM forum_comments AS fc
                            JOIN user_account AS ua ON fc.userID = ua.userID
                            WHERE fc.content_id = $content_id";
                        $result_comments = $db->query($sql_comments);

                        // Check if there are any comments
                        if ($result_comments->num_rows > 0) {
                        // Output comments
                            while ($row_comment = $result_comments->fetch_assoc()) {
                            // Display username and comment content
                                echo "<div class='comment'>";
                                echo "<p><strong>" . $row_comment['username'] . "</strong>: " . $row_comment['comment'] . "</p>";
                                // You can display other comment details such as date_created, comment_img, etc. here
                                echo "</div>";
                            }
                        } else {
                            // No comments found
                            echo "No comments yet.";
                        }
                        ?>
                    </div>
                    <div class="comment-form">
                        <form id="comment-form" method="POST" action="forumpageredirect2.php?content_id=<?php echo $_GET['content_id']; ?>">
                            <label for="comment">Add your comment:</label>
                            <input type="text" id="comment" name="comment" placeholder="Write a comment... ">
                            <div class="form-group">
                                <button type="submit" class="btn" name="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </body>
</html>