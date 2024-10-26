<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Approval</title>
    <link rel="stylesheet" href="design/admin.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        // $(document).ready(function(){
        //     $(".hamburger").click(function(){
        //         $(".wrapper").toggleClass("active")
        //     })
        // });

        $(document).ready(function(){
            $(".hamburger").click(function(){
			  $(".wrapper").toggleClass("active")
			});
            
            $(".approve_btn").click(function(){
                var userID = $(this).closest("tr").find(".userID").text();
                var username = $(this).closest("tr").find(".username").text();
                var first_name = $(this).closest("tr").find(".first_name").text();
                var last_name = $(this).closest("tr").find(".last_name").text();
                var email_address = $(this).closest("tr").find(".email_address").text();
                var password = $(this).closest("tr").find(".password").text();

                $.ajax({
                    type: 'POST',
                    url: 'user_script.php',
                    data: {
                        'approve': true,
                        'userID': userID,
                        'username': username,
                        'first_name': first_name,
                        'last_name': last_name,
                        'email_address': email_address,
                        'password': password
                    },
                    success: function(response) {
                        alert(response);
                    }
                });

                $(this).parent().parent().remove();
            });

            $(".reject_btn").click(function(){
                var userID = $(this).closest("tr").find(".userID").text();

                $.ajax({
                    type: 'POST',
                    url: 'user_script.php',
                    data: {
                        'reject': true,
                        'userID': userID
                    },
                    success: function(response) {
                        alert(response);
                    }
                });

                $(this).closest("tr").remove();
            });
        });
    </script>
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
                        <a href="animal.php">
                            <span class="icon"><i class="fas fa-file-invoice"></i></span>
                            <span class="list">Animal Submissions</span>
                        </a>
                    </li>
                    <li>
                        <a href="user.php" class="active">
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

        <div class="user_approval_container">
            <div class="item_wrap">
                <div class="item">
                    <h2>User Approval and Deletion</h2>
                    <div class="scrollable-table">
                        <table id="userTable">
                            <thead>
                                <tr>
                                    <th><h3>User ID</h3></th>
                                    <th><h3>Username</h3></th>
                                    <th><h3>First Name</h3></th>
                                    <th><h3>Last Name</h3></th>
                                    <th><h3>Email</h3></th>
                                    <th><h3>Password</h3></th>
                                    <th><h3>Actions</h3></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include "cfg/db_conn.php";
                                    $sql = "SELECT * FROM temp_user_account ORDER BY userID DESC";
                                    $res = mysqli_query($db, $sql);

                                    if (mysqli_num_rows($res) > 0) {
                                        while ($row = mysqli_fetch_assoc($res)) { ?>

                                        <div class="alb">
                                            <tr>
                                                <td class="userID"><?=$row["userID"]?></td>
                                                <td class="username"><?=$row["username"]?></td>
                                                <td class="first_name"><?=$row["first_name"]?> </td>
                                                <td class="last_name"><?=$row["last_name"]?> </td>
                                                <td class="email_address"><?=$row["email_address"]?> </td>
                                                <td class="password"><?=$row["password"]?> </td>
                                                <td>
                                                    <button class="approve_btn">Approve</button>
                                                    <button class="reject_btn">Reject</button>
                                                </td>
                                            </tr>
                                        </div>

                                <?php }}?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

</div>

</body>
</html>
