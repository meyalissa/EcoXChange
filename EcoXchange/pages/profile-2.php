<?php

// Include database connection and fetch user data
include('../includes/dbconn.php');
include('../includes/fetchUserData.php');

// // Access address data from session
// $address = $_SESSION['address'] ?? null;

// // Check if address data exists
// if ($address) {
//     // Fetch data from the address array or set it manually
//     $address_ID = $address["address_ID"];
//     $add_name = $address["Name"];
//     $add_contact = $address["Contact"];
//     $house_no = $address["house_no"];
//     $street_name = $address["street_name"];
//     $city = $address["city"];
//     $postcode = $address["postcode"];
//     $state = $address["state"];

//     // Concatenate the address components into a single variable
//     $full_address = "$add_name, $add_contact\n$house_no, $street_name, $city, $state $postcode";
// } else {
//     // Handle case when address data is not available
//     $full_address = "Address data not found";
// }
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
                
                <!-- !!!!!!!!!!CODES HERE!!!!!!!! -->

                <!-- +++++++++++++++++++PROFILE PIC<+++++++++++++++++++--> 
                <div class="row">
                  <div class="column1">                    
                    <div class="profile">
                      <label for="profile-picture" class="avatar">
                        <img src="../images/avatar.png" alt="Avatar" class="avatar">
                         <span class="change-text">Tap to change</span>
                      </label>
                      <input type="file" id="profile-picture" accept="image/*" hidden>
                    </div>
                  </div>
                  

                <!-- +++++++++++++++++++PROFILE DETAILS<+++++++++++++++++++--> 
                  
                  <div class="column">
                    <form action="/action_page.php">
                      <label for="uname">Username</label>
                      <input type="text" id="uname" name="username" value="<?php echo $name ?>">

                      <label for="fname">First Name</label>
                      <input type="text" id="fname" name="firstname" <?php if($first == "") {echo 'placeholder="Enter First Name"';} else {echo 'value="' . $first . '"';} ?>>

                      <label for="lname">Last Name</label>
                      <input type="text" id="lname" name="lastname" <?php if($last == "") {echo 'placeholder="Enter Last Name"';} else {echo 'value="' . $last . '"';} ?>>
                      
                      <label for="nphone">Phone</label>
                      <input type="text" id="nphone" name="nophone" <?php if($contact == "") {echo 'placeholder="Enter Phone Number"';} else {echo 'value="' . $contact . '"';} ?>>
                      <label for="aemail">Email</label>
                      <input type="text" id="aemail" name="addemail" value="<?php echo $email ?>">
                      

                      </div>
                      <div class = "column1">
                      <label for="address"> My Address</label>
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
                                        <h4 class="pic"> <?php echo $addr_name ?> | <?php echo $addr_contact ?></h3>
                                        <p class="address"> <?php echo $full_address ?><p>
                                      </div>

                                  </div>
                      <?php
                                }
                            } else {
                                echo "<p>No addresses found</p>";
                        }
                            ?>       
                      <input type="submit" value="Submit">
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
