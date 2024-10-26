<?php 
include "../cfg/db_conn.php";
include "header.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Animal Profiles</title>
        <!-- <link rel="stylesheet" href="../design/profiles.css"> -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Hind+Vadodara:wght@300;400;500;600;700&family=Lora:ital,wght@0,400..700;1,400..700&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
        <style>
            body {
            padding-top: 60px;
            background: rgb(227,211,255);
            background: linear-gradient(90deg, rgba(227,211,255,1) 0%, rgba(248,247,244,1) 100%); 
            }
            .profile-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center; /* Center the items horizontally */
            padding: 20px;
            }

            .profile-card {
            margin: 10px;
            padding: 15px;
            border: 1px solid #E493B3;
            border-radius: 10px;
            background-color: #FFF5E3;
            /* flex-basis: calc(33.333% - 40px);  */
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            text-decoration: none; /* Ensure no underline on links */
            box-sizing: border-box; /* Include padding and border in element's total width */
            }

            @media (min-width: 768px) {
                .profile-card {
                    flex-basis: calc(33.333% - 40px); /* Three cards per row on medium screens and above */
                }
            }

            .profile-card h2 {
            font-family: 'Lora';
            font-weight: 700;
            font-size: 30px;
            color: #313638;
            }

            .profile-card h3 {
            font-family: 'Hindi Vadodara';
            font-weight: 700;
            font-size: 20px;
            color: #ccc;
            }

            .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            }

            .profile-card img {
            display: block;
            width: 100%;
            /* height: 300px; */
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
            }

            .profile-card h2 {
            margin: 10px 0 5px;
            font-size: 20px;
            color: #333;
            }

            .profile-card h3 {
            margin: 0 0 10px;
            font-size: 16px;
            color: #666;
            }

            h2 {
            font-size: 45px;
            margin: 20px 0;
            text-align: center;
            font-family: 'Quicksand';
            font-weight: 700;
            color: #313638;
            }
            </style>
    </head>
    <body>        
        <h2>Pet Profiles</h2>
        <div class="profile-container">
            <?php
                $sql = "SELECT * FROM animalprofiles ORDER BY petID DESC";
                $res = mysqli_query($db, $sql);

                if ($res && mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) { ?>

                    <!-- DISPLAY ANIMAL PROFILES -->
                    <a href="animal_individual_profile.php?petID=<?= htmlspecialchars($row['petID']) ?>" class="profile-card">
                        <img src="<?= htmlspecialchars($row['image_url']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                        <h2><?= htmlspecialchars($row['name']) ?></h2>
                        <h3><?= htmlspecialchars($row['breed']) ?></h3>
                    </a>

            <?php  } 
                } else {
                    echo "<p>No profiles found.</p>";
                }
            ?>
        </div>
    </body>
</html>