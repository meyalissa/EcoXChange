<?php
// Include database connection and fetch user data
include('../includes/dbconn.php');
include('../includes/fetchUserData.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoXchange | Profile</title>
    <!-- ===== BOX ICONS ===== -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="../style/profile-2.css">
    <link rel="stylesheet" href="../style/profile-1.css">
    
    
   
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <?php include('sidebar-1.php'); ?>
        <!-- ========================= Main ==================== -->
        <div class="main">
            <?php include('header.php'); ?>
            <div class="content">
                <div clas="nav-title"><h3>Profile</h3></div>
                <div class="details">
                    <div class="column1">
                        <div class="profile">
                            <label for="profile-picture" class="avatar">
                                <img src="<?php echo $image?>" alt="Avatar" class="avatar">
                                <span class="change-text">Tap to change</span>
                            </label>
                            <input type="file" id="profile-picture" accept="image/*" hidden>
                        </div>
                        
                    </div>

                    <!-- +++++++++++++++++++PROFILE DETAILS<+++++++++++++++++++-->
                        <div class=userdata>
                            <div clas="nav-title"><h4>User Details</h4></div>
                            <form action="../includes/process.php" method="post">
                            <input type="hidden" name="action" value="updateProfile">

                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" id="uname" name="username" value="<?php echo $name ?>">

                            <label for="uname">Username</label>
                            <input type="text" id="uname" name="username" value="<?php echo $name ?>" disabled>

                            <label for="fname">First Name</label>
                            <input type="text" id="fname" name="firstname" <?php if($first == "") {echo 'placeholder="Enter First Name"';} else {echo 'value="' . $first . '"';} ?>>

                            <label for="lname">Last Name</label>
                            <input type="text" id="lname" name="lastname" <?php if($last == "") {echo 'placeholder="Enter Last Name"';} else {echo 'value="' . $last . '"';} ?>>

                            <label for="nphone">Phone</label>
                            <input type="text" id="nphone" name="nophone" <?php if($contact == "") {echo 'placeholder="Enter Phone Number"';} else {echo 'value="' . $contact . '"';} ?>>
                            <label for="aemail">Email</label>
                            <input type="text" id="aemail" name="addemail" value="<?php echo $email ?>">
                        </div>
                        <div>
                        </div>
                        <div>
                        </div>
                        <div class="inp">
                            <input type="submit" value="Update">
                        </div>
                        
                    </form>
                  </div>
              </div>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="../js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
