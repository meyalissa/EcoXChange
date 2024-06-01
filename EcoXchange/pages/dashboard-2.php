<?php
include('../includes/fetchUserData.php'); 

// Access address data from session
$address = $_SESSION['address'] ?? null;

// Check if address data exists
if ($address) {
    $address_ID = $address["address_ID"];
    $add_name = $address["Name"];
    $add_contact = $address["Contact"];
    $house_no = $address["house_no"];
    $street_name = $address["street_name"];
    $city = $address["city"];
    $postcode = $address["postcode"];
    $state = $address["state"];
    $full_address = "$add_name, $add_contact\n$house_no, $street_name, $city, $state $postcode";
} else {
    $full_address = "Address data not found";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoXchange | Dashboard</title>
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../style/SidebarUser.css">
    <link rel="stylesheet" href="../style/dashboard.css">
    <link rel="stylesheet" href="../style/alert.css">
</head>
<body>
<?php
      if(isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'loginsuccess':
                $message = 'You have successfully logged in.';
                $title = 'Success';
                $icon = 'bxs-check-circle';
                $alert_class = 'alert_success';
                break;
            case 'emptyinput':
                $message = 'Please fill out all required fields.';
                $title = 'Error';
                $icon = 'bxs-error';
                $alert_class = 'alert_error';
                break;
            case 'filetoolarge':
                $message = 'Sorry, your file is too large.';
                $title = 'Error';
                $icon = 'bxs-error';
                $alert_class = 'alert_error';
                break;
            case 'invalidfiletype':
                $message = 'Sorry, only PDF files are allowed.';
                $title = 'Error';
                $icon = 'bxs-error';
                $alert_class = 'alert_error';
                break;
            case 'uploaderror':
                $message = 'Sorry, there was an error uploading your file.';
                $title = 'Error';
                $icon = 'bxs-error';
                $alert_class = 'alert_error';
                break;
            case 'dberror':
                $message = 'Database error occurred.';
                $title = 'Error';
                $icon = 'bxs-error';
                $alert_class = 'alert_error';
                break;
            case 'booksuccessful':
                $message = 'You have successfully booked a vehicle.';
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
        
            <!-- ============== Content ============== -->
            <div class="content">
                <div class="nav-title"><h3>Dashboard</h3></div>
                <div class="in-content">
                    <?php
                    include("../includes/dbconn.php");
                    $sql = "SELECT 
                                SUM(rewards) AS total_rewards,
                                SUM(bottle) AS total_bottle,
                                SUM(alCan) AS total_aluminum_can,
                                SUM(usedOil) AS total_used_oil
                            FROM (
                                SELECT 
                                    b.book_ID,
                                    SUM(CASE WHEN cr.item_id = 'I004' THEN cr.collect_weight ELSE 0 END) AS bottle,
                                    SUM(CASE WHEN cr.item_id = 'I005' THEN cr.collect_weight ELSE 0 END) AS alCan,
                                    SUM(CASE WHEN cr.item_id = 'I008' THEN cr.collect_weight ELSE 0 END) AS usedOil,
                                    SUM(cr.total_amount) AS rewards
                                FROM 
                                    booking b
                                    JOIN collection_record cr ON b.book_ID = cr.book_ID
                                WHERE 
                                    b.cust_ID = ? AND cr.reward_status='success'
                                GROUP BY 
                                    b.book_ID
                            ) AS subquery";
                    $stmt = mysqli_prepare($dbconn, $sql);
                    if ($stmt === false) {
                        die('MySQL prepare error: ' . mysqli_error($dbconn));
                    }
                    mysqli_stmt_bind_param($stmt, "s", $id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if (!$result) {
                        die('Error fetching data: ' . mysqli_error($dbconn));
                    }
                    $data = mysqli_fetch_assoc($result);
                    mysqli_stmt_close($stmt);
                    mysqli_close($dbconn);
                    ?>
                    <div class="row1">
                        <div class="box1">
                            <p class="topic">Total Rewards</p>
                            <h2 class="values"><?php echo $data['total_rewards']; ?></h2>
                            <p class="unit">RM</p>
                        </div>
                    </div>
                    <div class="row2">
                        <div class="box1">
                            <p class="topic">Bottle</p>
                            <h2 class="values"><?php echo $data['total_bottle']; ?></h2>
                            <p class="unit">KG</p>
                        </div>
                        <div class="box1">
                            <p class="topic">Aluminium Can</p>
                            <h2 class="values"><?php echo $data['total_aluminum_can']; ?></h2>
                            <p class="unit">KG</p>
                        </div>
                        <div class="box1">
                            <p class="topic">Used Cooking Oil</p>
                            <h2 class="values"><?php echo $data['total_used_oil']; ?></h2>
                            <p class="unit">KG</p>
                        </div>
                    </div>
                    <div class="row3">
                        <button type="button" id="btnRecycle" class="btnRecycle">Recycle More</button>
                    </div> 
                </div>
                 <!-- +++++++++++++++ BOOKING FORM +++++++++++++++ -->
                <div class="booking-popup" id="booking-popup">
                    <div class="box-popup">
                        <div class="top-form">
                            <div class="close-popup" data-popup="#booking-popup">X</div>
                        </div>
                        <div class="bookingform">
                            <form action="submit_booking.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="cust_ID" value="<?php echo $id; ?>">
                                <table border="0">
                                    <tr>
                                        <th colspan="3"><h2>Book vehicle to recycle</h2></th>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <div class="lbladdrs">
                                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                <span class="booklabel">Pick Up Address</span>
                                            </div>
                                            <div class="inpbox addr">
                                                <div class="txtAddress"><?php echo nl2br($full_address); ?></div>
                                                <button type="button" id="btnChangeAdd" class="btnChangeAdd">Change</button>
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
                            
                        </div>
                    </div>
                </div>
                 <!-- +++++++++++++++ CHANGE ADDRESS +++++++++++++++ -->
                <div class="changadr-popup" id="changadr-popup">
                    <div class="box-popup">
                        <div class="top-form">
                            <div class="close-popup" data-popup="#changadr-popup">X</div>
                        </div>
                        <div class="addrcb">
                            <h2>My Address</h2>
                            <hr class="adrdivision">
                            <table border="0" >
                    
                                <?php
                                    include("../includes/dbconn.php");
                                    $sql = "SELECT * FROM address WHERE cust_ID='$id'";
                                    $result = mysqli_query($dbconn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)) {
                                            $addr_ID = $row["address_ID"];
                                            $addr_name = $row["Name"];
                                            $addr_contact = $row["Contact"];
                                            $full_address = "$addr_name, $addr_contact\n$house_no, $street_name, $city, $state $postcode";
                                ?>
                                         <!-- LOOP -->
                                         <tr>
                                            <td>
                                                        
                                                <input type="radio" name="selected_address" value="<?php echo $addr_ID ?>">
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
                                            <!-- LOOP END-->
                                            <?php
                                        }
                                    } else {
                                        echo "<p>No addresses found</p>";
                                }
                                        ?>
                                  </table>
                                  <button type = "button" class = "btnChange" id="btnChange">Change Address</button>

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
                                                    
                                                                        
                                                    <input class="inpfile" type="file" id="file" name="file" accept="image/*,.pdf" />
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
                                            <input type="checkbox" id="agreement1" name="agreement1" value="Agree1" required>
                                            <label class="agree" for="agreement1"> I agree that the receipt uploaded is true</label><br>
                                            <input type="checkbox" id="agreement2" name="agreement2" value="Agree2" required>
                                            <label class="agree" for="agreement2"> I agree that if I cancel my booking, I will not receive my deposit</label><br>
                                        </td>
                                    </tr>
                                                        
                                </table>
                                    <div class="low-form">
                                        <div class="btnGroup">
                                            <button type = "button" id="btnCancel" class="btn">Cancel</button>
                                            <input type="submit" name="submit" value="Submit" class="btn" id="btnSubmit">
                                        </div>
                                    </div>  
                            </div>
                            </form>                        
                        </div>
                    </div>
                </div>
             </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="../js/main.js"></script>  
    <script  type="text/javascript">

        $(function () {
            console.log("jQuery is loaded and the document is ready.");
            
            // Show booking popup on button click
            $("#btnRecycle").on("click", function() {
                console.log("Recycle More button clicked.");
                $("#booking-popup").css("display", "flex");
            });

            // Close popup on close button click
            $(".close-popup").on("click", function() {
                console.log("Close button clicked.");
                $($(this).data("popup")).hide();
            });

            $("#btnChangeAdd").on("click", function() {
                console.log("Change Address button clicked.");
                $("#changadr-popup").css("display", "flex");
            });

            $('#btnCont').click(function() {
                $('#payment-popup').fadeIn().css("display", "flex");
            });

            $('#btnCancel').click(function() {
                $('#payment-popup').fadeOut();
                $('#booking-popup').fadeOut();
            });
    
            // Function to handle changing the address
            $('#btnChange').click(function () {
                // Fetch the selected address
                var selectedAddress = $('input[name="selected_address"]:checked').val();
                // AJAX request to fetch the address details based on the selected address ID
                $.ajax({
                    url: 'fetch_address.php',
                    type: 'POST',
                    data: { address_id: selectedAddress },
                    success: function (response) {
                        // Update the content of the txtAddress div with the new address information
                        $('.txtAddress').html(response);
                        
                        // Close the "Change Address" popup
                        $('#changadr-popup').fadeOut();
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
    

            $(document).ready(function() {
                $('input[type="file"]').val('');
                $('input[type="text"]').val('');
                $('select').prop('selectedIndex', 0);
            });
            $(document).ready(function() {
                // Set the first radio button for selected_address as checked
                $('input[name="selected_address"]:first').prop('checked', true);
            });
        });
    </script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="../js/alert-notification.js"></script>
</body>

</html>
<?php
// Close the database connection after all queries are done
mysqli_close($dbconn);
?>

    