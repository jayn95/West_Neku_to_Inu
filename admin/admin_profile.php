<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="design/admin.css">
  <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script>
    $(document).ready(function(){
        $(".hamburger").click(function(){
            $(".wrapper").toggleClass("active")
        });

        $("#profile_image").change(function(){
            readURL(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.profile_picture').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    });
</script>
<style>
  #profile_form button[type="submit"] {
    padding: 3px 10px;
    margin: 5px;
    border-radius: 20px;
    cursor: pointer;
    background-color: #fff; 
    color: #0C359E;
    }

  #profile_form button[type="submit"]:hover {
    background-color: #d8e2ff;
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
                    <a href="animal.php">
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

        <div class="admin_profile_container">
            <!-- Content for admin profile container -->
            <form id="profile_form" method="post" action="admin_profile_script.php" enctype="multipart/form-data">
                <div class="profile_left">
                    <img class="profile_picture" src="#" alt="Profile Picture">
                    <label for="profile_image" class="upload_label"><h2>Change Profile Picture</h2></label>
                    <input type="file" id="profile_image" name="profile_image"> <!-- Added name attribute -->
                </div>
                <div class="profile_right">
                    <div class="form-group">
                        <label for="first_name"><h2>First Name:</h2></label>
                        <input type="text" id="first_name" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name"><h2>Last Name:</h2></label>
                        <input type="text" id="last_name" name="last_name" required>
                    </div>
                    <div class="form-group">
                        <label for="username"><h2>Username:</h2></label>
                        <input type="text" id="username" name="username" required> <!-- Changed type to text -->
                    </div>
                    <div class="form-group">
                        <label for="password"><h2>Password:</h2></label>
                        <input type="password" id="password" name="password" required>
                    </div>
                </div>
                <button type="submit">Save</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
