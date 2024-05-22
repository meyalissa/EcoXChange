<?php

include('../includes/fetchUserData.php'); 

// Access address data from session
$address = $_SESSION['address'] ?? null;

// Check if address data exists
if ($address) {
    // Fetch data from the address array or set it manually
    $address_ID = $address["address_ID"];
    $add_name = $address["Name"];
    $add_contact = $address["Contact"];
    $house_no = $address["house_no"];
    $street_name = $address["street_name"];
    $city = $address["city"];
    $postcode = $address["postcode"];
    $state = $address["state"];

    // Concatenate the address components into a single variable
    $full_address = "$add_name, $add_contact\n$house_no, $street_name, $city, $state $postcode";
} else {
    // Handle case when address data is not available
    $full_address = "Address data not found";
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoXchange | Dashboard</Em></title>
  <!-- ===== BOX ICONS ===== -->
  <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- ======= Styles ====== -->
  <link rel="stylesheet" href="../style/SidebarUser.css">
  <link rel="stylesheet" href="../style/dashboard.css">

</head>

<body>
    <!-- testing User Info later delete -->
    <!-- Hi, <?php echo $name; ?> -->
    <!-- =============== Navigation ================ -->
    <div class="container">
        <?php include('sidebar-2.php'); ?>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <?php include('header.php'); ?>

            <!-- ============== Content ============== -->
            <div class="content">
                <div class="nav-title"><h3>Dashboard</h3></div>
                <!-- !!!!!!!!!!CODES HERE!!!!!!!! -->            
                <div class="in-content">
                    <div class="row1">
                        <div class="box1">
                            <p class="topic">Total Rewards</p>
                            <h2 class="values"> 0.00 </h2>
                            <p class="unit">RM</p>
                        </div>
                    </div>
                    <div class="row2">
                        <div class="box1">
                            <p class="topic">Bottle</p>
                            <h2 class="values"> 0 </h2>
                            <p class="unit">KG</p>
                        </div>
                        <div class="box1">
                            <p class="topic">Aluminium Can</p>
                            <h2 class="values"> 0 </h2>
                            <p class="unit">KG</p>
                        </div>
                        <div class="box1">
                            <p class="topic">Used Cooking Oil</p>
                            <h2 class="values"> 0 </h2>
                            <p class="unit">KG</p>
                        </div>
                    </div>
                    <div class="row3">
                        <button class="btnRecycle" id="btnRecycle">
                            Reycle More
                        </button>
<!-- +++++++++++++++ BOOKING FORM +++++++++++++++ -->
<div class="booking-popup" id="booking-popup">
    <div class="box-popup">
        <div class="top-form">
            <div class="close-popup" data-popup="#booking-popup">
                X
            </div>
        </div>
        <div class = "bookingform">
          
          <form action="#">
            
            <table border="0" >
                <tr>
                    <th colspan="3">
                        <h2>Book vehicle to recycle</h2>
                    </th>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="lbladdrs">
                            <i class="fa fa-map-marker" aria-hidden="true" ></i>
                            <span class="booklabel">Pick Up Address</span>
                        </div>
                        <div class="inpbox addr">
                            <!-- <div class="txtname"><?php echo $add_name ?></div> -->
                            <div class="txtAddress">
                            <?php echo nl2br($full_address) ?>
                            </div>
                            <button id="btnChangeAdd" class="btnChangeAdd">Change</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="lbladdrs">
                            <span class="booklabel">Type of Vehicles</span>
                        </div>
                        
                        <select name="vehicle" class="inpbox">
                            <option value="Motorcycle">Motorcycle</option>
                            <option value="Car">Car</option>
                            <option value="Truck">Lorry</option>
                        </select>
                          
                    </td>
                    <td rowspan ="2"><img src="../images/vehiclemotor.png" class="vehicleimg"></td>
                    <td rowspan ="2" >
                        <button type = "button" class = "btnCont" id="btnCont">Continue</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="lbladdrs">
                            <span class="booklabel">Pick Up Time</span>
                        </div>
                        
                        <select name="pickup" class="inpbox">
                            <option value="Immediately">Immediately</option>
                            <option value="30m">Pickup in 30 minutes</option>
                            <option value="1h">Pickup in 1 hour</option>
                        </select>
                    </td>
                </tr>
            </table>
          </form>

        </div>
    </div>
</div>
<!-- +++++++++++++++ CHANGE ADDRESS +++++++++++++++ -->
<div class="changadr-popup" id="changadr-popup">
    <div class="box-popup">
        <div class="top-form">
            <div class="close-popup" data-popup="#changadr-popup">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </div>
        </div>
        <div class = "addrcb">
            <h2>My Address</h2>
            <hr class="adrdivision">
            <form action="#">
              <table border="0" >
                    <?php
                        // Fetch addresses from the database based on user ID
                        $sql_address = "SELECT * FROM address WHERE cust_ID = '$id'";
                        $query_address = mysqli_query($dbconn, $sql_address) or die("Error fetching addresses: " . mysqli_error($dbconn));
                        if (mysqli_num_rows($query_address) > 0) {
                            while ($row = mysqli_fetch_assoc($query_address)) {
                                $addr_name= "{$row['Name']}";
                                $addr_contact = "{$row['Contact']}";
                                $full_address = "{$row['street_name']}, {$row['city']}, {$row['state']} {$row['postcode']}";
                        ?>
                    <!-- REPEAT -->
                    <tr>
                        <td>
                            <input type="checkbox" name="selected_address" value="<?php echo $row['address_ID']; ?>">
                        </td>
                        <td>
                            <div class="addr-info">
                                <h3 class="pic"> <?php echo $addr_name ?> | <?php echo $addr_contact ?></h3>
                                <p class="address"> <?php echo $full_address ?><p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <hr class="adrdivision">
                        </td>
                    </tr>
                    <!-- REPEAT END-->
                    <?php
                     }
                        } else {
                            echo "<p>No addresses found</p>";
                        }
                    ?>

              </table>
            </form>
            
            
            
            
        </div>
    </div>
</div>
<!-- +++++++++++++++ PAYMENT +++++++++++++++ -->
<div class="payment-popup" id="payment-popup">
    <div class="box-popup">
        <div class="top-form">
            <div class="close-popup" data-popup="#payment-popup">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </div>
        </div>
        <div class = "paymentform">
            <form action="#">
              <table border="0" >
                    <tr>
                        <th >
                            <h2>Pay Deposit</h2>
                        </th>
                        <td rowspan="4">
                            <img src="../images/Qrcode.png" class="paymentimg">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="paymentbox">
                               <label for="avatar">Prove of payment</label>
                               <div class="inpbox">
    
                                
                                <input class="inpfile" type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" />
                                <i class="fa fa-download" aria-hidden="true"></i>
                               </div>
                               
                            </div>
                        </td>
                        
                    </tr>
                    <tr>
                        <td>
                            <p>The deposit will receive with rewards after the items successfully collected</p>
                        </td>
                       
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="agreement1" name="agreement1" value="Agree1">
                            <label class="agree" for="agreement1"> I agree that the receipt uploaded is true</label><br>
                            <input type="checkbox" id="agreement2" name="agreement2" value="Agree2">
                            <label class="agree" for="agreement2"> I agree that if I cancel my booking, I will not receive my deposit</label><br>
                        </td>
                    </tr>
              </table>
            </form>
        </div>
        <div class="low-form">
            <div class="btnGroup">
                <button type = "button" id="btnCancel" class="btn">Cancel</button>
                <input type="submit" name="submit" value="Submit" class="btn" id="btnSubmit">
            </div>
        </div>
    </div>
</div>



</div> 
</div>
</div>
</div>
</div>

    <!-- =========== Scripts =========  -->
    <script src="../js/main.js"></script>
    <script type="text/javascript">
        $(function() {
            // Function to handle closing popups
            $('.close-popup').click(function() {
                var popupId = $(this).data('popup');
                $(popupId).fadeOut();
            });
    
            // Code for opening popups
            $('#btnRecycle').click(function() {
                $('#booking-popup').fadeIn().css("display", "flex");
            });
    
            $('#btnChangeAdd').click(function() {
                $('#changadr-popup').fadeIn().css("display", "flex");
            });
    
            $('#btnCont').click(function() {
                $('#payment-popup').fadeIn().css("display", "flex");
            });

            $('#btnCancel').click(function() {
                $('#payment-popup').fadeOut();
                $('#booking-popup').fadeOut();
          });
        });
    </script>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
<?php
// Close the database connection after all queries are done
mysqli_close($dbconn);
?>