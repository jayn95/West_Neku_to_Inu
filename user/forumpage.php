<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Forums</title>
        <link rel="stylesheet" href="../design/design.css">
        <link rel="stylesheet" href="../design/style.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Hind+Vadodara:wght@300;400;500;600;700&family=Lora:ital,wght@0,400..700;1,400..700&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

        <style>
            body {
                background: rgb(227,211,255);
                background: linear-gradient(90deg, rgba(227,211,255,1) 0%, rgba(248,247,244,1) 100%); 
                color: #000;
            }
            /* Title of the post */
            .post h3 {
                margin-top: 10px;
                font-family: 'Quicksand';
                color: #000;
            }

            .pic-container {
                margin-bottom: 10px; 
                text-align: center; 
            }

            .pic-container img {
                display: inline-block; 
                width: 300px; 
                max-height: 300px; 
                object-fit: cover; 
                border-radius: 10px; 
                margin: 20px;
                overflow: hidden;
                border: 3px solid #fff;
            }
        
            .container {
                background-color: #8E7AB5;;
                max-width: 700px;
                margin: 100px auto;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            /* Container for all posts */
            .posts-container {
                display: flex; /* Use flexbox */
                flex-direction: column; /* Arrange items vertically */
                align-items: center; /* Center items horizontally */
                margin-top: 20px; /* Add some top margin */
            }

            /* Container for each post */
            .post {
                max-width: 600px;
                margin: 20px auto;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 5px;
                background-color: #fff;
            }

            .profile-info {
                display: flex;
                align-items: center;
                color: #000;
            }
            
            .forumbtn {
                background-color: #8E7AB5;
                border-radius: 100px;
                color: #fff;
                /* box-shadow: rgba(44, 187, 99, .2) 0 -25px 18px -14px inset,rgba(44, 187, 99, .15) 0 1px 2px,rgba(44, 187, 99, .15) 0 2px 4px,rgba(44, 187, 99, .15) 0 4px 8px,rgba(44, 187, 99, .15) 0 8px 16px,rgba(44, 187, 99, .15) 0 16px 32px; */
                cursor: pointer;
                display: inline-block;
                padding: 7px 20px;
                text-align: center;
                text-decoration: none;
                transition: all 250ms;
                border: 0;
                font-size: 16px;
                user-select: none;
                -webkit-user-select: none;
                touch-action: manipulation;
                position: fixed;
                bottom: 20px;
                right: 20px;
            }
    
            .forumbtn:hover {
                /* box-shadow: rgba(44,187,99,.35) 0 -25px 18px -14px inset,rgba(44,187,99,.25) 0 1px 2px,rgba(44,187,99,.25) 0 2px 4px,rgba(44,187,99,.25) 0 4px 8px,rgba(44,187,99,.25) 0 8px 16px,rgba(44,187,99,.25) 0 16px 32px; */
                transform: scale(1.05);
            }

            .view_button{
                display: block;
                width: 100%;
                padding: 10px;
                background-color: #E493B3;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                text-align:center;
            }
            .date-created {
                font-size: 10px;
                color: #000;
            }

            .admin-info {
                color: #000;
            }

            p {
                color: #000;
            }
        </style>
        
    </head>
    <body>
        <?php 
            error_reporting(E_ERROR | E_PARSE); // Report only errors and parse errors
            ini_set('display_errors', 0); // Do not display errors
            include "header.php"; 
        ?>
            <div class ="container">
        <?php
        // Prepare an SQL statement to select all posts from the forum_subject table
        $sql_forum = "SELECT sub.*, ua.*
                        FROM forum_subject AS sub
                        JOIN user_account AS ua ON sub.userID = ua.userID";
        $result_forum = $db->query($sql_forum);

        if ($result_forum->num_rows > 0) {
            while($row = $result_forum->fetch_assoc()) {
                ?> 
                <div class="post">
                        <div class="admin-info">
                            <div class="date-created">
                                <?php echo date("M d, Y", strtotime($row["date_created"])); ?>
                            </div>
                            <div class="admin-name">
                                <?php echo $row["username"]; ?>
                            </div>
                            <h3><?php echo $row["title"]; ?></h3>
                            
                        </div>
                    <p><?php echo $row["fcontent"]; ?></p>
                    <div class="pic-container">
                        <img src="../uploads/<?=$row["picture"]?>" alt="Post Image">
                    </div>
                    <a href="forumpageredirect2.php?content_id=<?php echo $row['content_id']; ?>" class="view_button">View Comments</a>
                </div>
                <?php
            }
        } else {
            echo "No posts found.";
        }
        $db->close();
        ?>
        </div>
        <button onclick="location.href = 'forumshtml.php';" id="add_forum" class="forumbtn" role="button">Add Forum</button>
    </body>
</html>