<?php
// Include database connection and fetch user data
include('../includes/dbconn.php');
include('../includes/fetchUserData.php');

$sql = "SELECT * FROM customer c JOIN bank_details b ON c.bank_id = b.bank_id HAVING c.cust_ID = ?";
$stmt = mysqli_prepare($dbconn, $sql);
mysqli_stmt_bind_param($stmt, 's', $id);
mysqli_stmt_execute($stmt);
$query = mysqli_stmt_get_result($stmt);
$row = mysqli_num_rows($query);

if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);

    $bankname = $row["bank_name"];
    $bankacc = $row["bank_acc_no"];
    $bankfullname = $row["bank_full_name"];
} else {
    // Handle case when no results are returned
    echo "No data found for the given customer ID.";
}
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
            
            case 'addnewaddress':
                $message = 'You have successfully added a new address.';
                $title = 'Success';
                $icon = 'bxs-check-circle';
                $alert_class = 'alert_success';
                break;
            case 'updatebank':
                $message = 'You have successfully updated your bank details.';
                $title = 'Success';
                $icon = 'bxs-check-circle';
                $alert_class = 'alert_success';
                break;
            case 'updateaddress':
                $message = 'You have successfully updated your address.';
                $title = 'Success';
                $icon = 'bxs-check-circle';
                $alert_class = 'alert_success';
                break;
            case 'deleteaddress':
                $message = 'You have successfully deleted your address.';
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
        <?php include('sidebar-2.php'); ?>
        <!-- ========================= Main ==================== -->
        <div class="main">
            <?php include('header.php'); ?>
            <div class="content">
                <div class="nav-title"><h3>Profile</h3></div>
                <div class="details">
                    <div class="column1">
                    <form action="../includes/process.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="updateProfile">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current-picture" value= "<?php echo $image; ?>">
                        
                        <div class="profile">
                            <label for="profile-picture" class="avatar">
                                <img src="<?php echo $image ?>" alt="Avatar" class="avatar" id="avatar">
                                <span class="change-text">Tap to change</span>
                            </label>
                            <div id="upload">
                                <input type="file" id="profile-picture" name="profile-picture" value= "<?php echo $image?>" accept="image/* " hidden>
                            </div>
                        </div>
                        <div class="bankdata">
                            <div class="topbarprof">
                                <div class="nav-title"><h4>Bank Details</h4></div>
                                <div><a href="editBank.php?bank_id=<?php echo htmlspecialchars($row['bank_id'], ENT_QUOTES, 'UTF-8'); ?>" class="linkEdit"><i class='bx bxs-edit'></i></a></div>
                            </div>
                            <table>
                                <tr>
                                    <td class="labelb">Bank Name:</td>
                                    <td class="info" id="bank-name"><?php echo $bankname ?></td>
                                </tr>
                                <tr>
                                    <td class="labelb">Account No:</td>
                                    <td class="info" id="bank-acc-no"><?php echo $bankacc ?></td>
                                </tr>
                                <tr>
                                    <td class="labelb">Full Name:</td>
                                    <td class="info" id="bank-full-name"><?php echo $bankfullname ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- +++++++++++++++++++PROFILE DETAILS+++++++++++++++++++-->
                        <div class="userdata">
                            <div class="nav-title"><h4>User Details</h4></div>
                            
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

                        <!-- +++++++++++++++++++ADDRESS DETAILS+++++++++++++++++++--> 
                        <div class="addrdata">
                            <div class="nav-title"><h4>My Address</h4></div>
                            
                            <?php
                                 // Fetch addresses from the database based on user ID
                                 $sql_address = "SELECT * FROM address WHERE cust_ID = '$id'";
                                 $query_address = mysqli_query($dbconn, $sql_address) or die("Error fetching addresses: " . mysqli_error($dbconn));
                                 if (mysqli_num_rows($query_address) > 0) {
                                    while ($row = mysqli_fetch_assoc($query_address)) {
                                        $addr_id = "{$row['address_ID']}";
                                        $addr_name= "{$row['Name']}";
                                        $addr_contact = "{$row['Contact']}";
                                        $full_address = "{$row['street_name']}, {$row['city']}, {$row['state']} {$row['postcode']}";
                            ?>
                                        <div class="inpbox addr">
                                            <div class="txtAddress">
                                                <div class="topbarprof">
                                                    <h4 class="pic"> <?php echo $addr_name ?> | <?php echo $addr_contact ?></h4>
                                                    <div><a href="editAddr.php?addr_ID=<?php echo htmlspecialchars($addr_id, ENT_QUOTES, 'UTF-8'); ?>" class="linkEdit"><i class='bx bxs-edit'></i></a></div>
                                                </div>
                                              <p class="address"> <?php echo $full_address ?><p>
                                            </div>
                                        </div>
                                        
                            <?php
                                    }
                                } else {
                                    echo "<p>No addresses found</p>";
                                }
                            ?>       
                                        
                            <a href="addAddr.php" class="btnAdd">
                                <i class='bx bx-plus-circle'></i>
                                <p>Add New Address</p>
                            </a>
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
