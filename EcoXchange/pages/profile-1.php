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
    <link rel="stylesheet" href="../style/alert.css">
    
   
</head>

<body>
<?php
if(isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'updateprofile':
                $message = 'You have successfully updated your profile.';
                $title = 'Success';
                $icon = 'bxs-check-circle';
                $alert_class = 'alert_success';
                break;
            default:
                $message = 'Unknown action.';
                $title = 'Error';
                $icon = 'bxs-error';
                $alert_class = 'alert_error';
        }
        echo '
          <div class="alert_wrapper active1">
            <div class="alert_backdrop"></div>
            <div class="alert_inner">
                <div class="alert_item '.$alert_class.'">
                    <div class="icon data_icon">
                      <i class="bx '.$icon.'" ></i>
                    </div>
                    <div class="data">
                      <p class="title"><span>'.$title.':</span>
                        User action result
                      </p>
                      <p class="sub">'.$message.'</p>
                    </div>
                    <div class="icon close">
                      <i class="bx bx-x" ></i>
                    </div>
                </div>
            </div>
          </div>
        ';
      }
    ?>
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
                    <form action="../includes/process.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="updateProfile">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current-picture" value= "<?php echo $image; ?>">

                        <div class="profile">
                                <label for="profile-picture" class="avatar">
                                    <img src="<?php echo $image; ?>" alt="Avatar" class="avatar" id="avatar">
                                    <span class="change-text">Tap to change</span>
                                </label>
                                <div id="upload">
                                    <input type="file" id="profile-picture" name="profile-picture" file="../images/avatar.png" accept="image/*" hidden>
                                </div>
                            </div>
                        
                    </div>

                    <!-- +++++++++++++++++++PROFILE DETAILS<+++++++++++++++++++-->
                        <div class=userdata>
                            <div clas="nav-title"><h4>User Details</h4></div>
                            
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
    <script src="../js/alert-notification.js"></script>
    <script type="text/javascript">
      document.getElementById("profile-picture").onchange = function(){
        const [file] = this.files;
        if (file) {
            document.getElementById("avatar").src = URL.createObjectURL(file); // Preview new image
        }
      }
    </script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
