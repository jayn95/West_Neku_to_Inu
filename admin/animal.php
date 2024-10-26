<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submission Approval</title>
    <link rel="stylesheet" href="design/admin.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".hamburger").click(function(){
			  $(".wrapper").toggleClass("active")
			});

            $(".approve_btn").click(function(){
                var petID = $(this).closest("tr").find(".petID").text();
                var name = $(this).closest("tr").find(".name").text();
                var breed = $(this).closest("tr").find(".breed").text();
                var description = $(this).closest("tr").find(".description").text();
                var image_url = $(this).closest("tr").find("img").attr("src");

                $.ajax({
                    type: 'POST',
                    url: 'process_submission.php',
                    data: {
                        'approve': true,
                        'petID': petID,
                        'name': name,
                        'breed': breed,
                        'description': description,
                        'image_url': image_url
                    },
                    success: function(response) {
                        alert(response);
                    }
                });

                $(this).parent().parent().remove();
            });

            $(".reject_btn").click(function(){
                var petID = $(this).closest("tr").find(".petID").text();

                $.ajax({
                    type: 'POST',
                    url: 'process_submission.php',
                    data: {
                        'reject': true,
                        'petID': petID
                    },
                    success: function(response) {
                        alert(response);
                    }
                });

                $(this).closest("tr").remove();
            });
        });
    </script>

    <style>
        #animalTable img {
            max-width: 100px;
            max-height: 100px;
            display: block;
            margin: 0 auto; 
        }

        /* CSS to center content inside table cells */
        #animalTable td {
            text-align: center;
            vertical-align: middle; 
        }
    </style>

</head>
<body>

<div class="wrapper">

    <div class="wrapper">
        <div class="top_navbar">
            <div class="logo">
                <a href="#">West Neko to Inu</a>
            </div>
            <div class="top_menu">
                <div class="right_info">
                    <div class="icon_wrap">
                        <div class="icon">
                            <i class="fas fa-bell"></i>
                        </div>
                    </div>
                    <div class="icon_wrap dropdown">
                      <div class="icon" id="dropdownMenu">
                          <i class="fas fa-cog"></i>
                      </div>
                      <div class="dropdown-content">
                          <a href="admin_profile.php">View Profile</a>
                          <a href="logout.php">Log Out</a>
                      </div>
                  </div>
                </div>
            </div>
        </div>

    <div class="main_body">

    <div class="sidebar_menu">
            <div class="inner__sidebar_menu">
                
                <ul>
                  <li>
                    <a href="animal.php" class="active">
                        <span class="icon"><i class="fas fa-file-invoice"></i></span>
                        <span class="list">Animal Submissions</span>
                    </a>
                  <li>
                    <a href="user.php">
                      <span class="icon"><i class="fas fa-duotone fa-users"></i></span>
                      <span class="list">User Approval</span>
                    </a>
                  </li>
                  <li>
                    <a href="profile.php">
                      <span class="icon"><i class="fas fa-solid fa-paw"></i></span>
                      <span class="list">Animal Profiles</span>
                    </a>
                  </li>
                </ul>

                <div class="hamburger">
                    <div class="inner_hamburger">
                        <span class="arrow">
                            <i class="fas fa-long-arrow-alt-left"></i>
                            <i class="fas fa-long-arrow-alt-right"></i>
                        </span>
                    </div>
                </div>

            </div>
        </div>

        <div class="animal_container">
            <div class="item_wrap">
                <div class="item">
                    <h2>Animal Submissions</h2>
                    <div class="scrollable-table">
                        <table id="animalTable">
                            <thead>
                                <tr>
                                <th><h3>Animal ID</h3></th>
                                <th><h3>Animal Type</h3></th>
                                <th><h3>Animal Name</h3></th>
                                <th><h3>Description</h3></th>
                                <th><h3>Photo</h3></th>
                                <th><h3>Actions</h3></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include "cfg/db_conn.php";
                                    $sql = "SELECT * FROM temp_animal_submissions ORDER BY petID DESC";
                                    $res = mysqli_query($db, $sql);

                                    if (mysqli_num_rows($res) > 0) {
                                        while ($row = mysqli_fetch_assoc($res)) { ?>

                                        <div class="alb">
                                            <tr>
                                            <td class="petID"><?=$row["petID"]?></td>
                                            <td class="breed"><?=$row["breed"]?></td>
                                            <td class="name"><?=$row["name"]?> </td>
                                            <td class="description"><?=$row["description"]?> </td>
                                            <td><img src="../uploads/<?=$row["image_url"]?>"></td>
                                            <td>
                                                <button class="approve_btn">Approve</button>
                                                <button class="reject_btn">Reject</button>
                                            </td>
                                            </tr>
                                        </div>

                                <?php  } }?>
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>