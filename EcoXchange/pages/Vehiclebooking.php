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
    <title>EcoXchange | Items</title>
    <!-- ===== BOX ICONS ===== -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="../style/booking-1.css">
</head>
<body>
    
    <!-- =============== Navigation ================ -->
    <div class="container">
        <?php include('sidebar-1.php'); ?>
        <!-- ========================= Main ==================== -->
        <div class="main">
            <?php include('header.php'); ?>
            <div class="content">
                 <!-- !!!!!!!!!!CODES HERE!!!!!!!! -->
                <div class="details">
                    <div class="itemlist">
                        <div class="tableHeader">
                            <h2>Vehicle Booking</h2>
                            <div class="searchbar">
                                <label>
                                <input type="text" name="" id="search-member" placeholder="search" onkeyup="searchmember()">
                                <ion-icon name="search-outline"></ion-icon>
                                </label>
                            </div>
                        </div>
                        <?php
                            include("../includes/dbconn.php");
                            $sql = "SELECT * FROM booking k JOIN customer c ON k.cust_ID = c.cust_ID
                                    ORDER BY k.book_ID DESC;";
                            $query = mysqli_query($dbconn, $sql);
                            $num_rows = mysqli_num_rows($query);
                            if($num_rows == 0){
                                echo "No Booking Record";
                            } else {
                                echo '<table class="table1">';
                                echo "<thead>";
                                echo"<tr>";
                                echo"<td>Booking ID</td>";
                                echo"<td>Vehicle Type</td>";
                                echo"<td>Booking Date</td>";
                                echo"<td>Pickup Time</td>";
                                echo"<td>Deposit Receipt</td>";
                                echo"<td>Deposit Status</td>";
                                echo"<td>Book Status</td>";
                                echo"<td>Address</td>";
                                echo"<td>Username</td>";
                                echo"</tr>";
                                echo "</thead>";


                                while($row = mysqli_fetch_array($query)){ 
                                    echo "<tbody>";
                                        echo"<tr>";
                                            echo"<td>".$row["book_ID"]."</td>";
                                            echo"<td>".$row["vehicle_type"]."</td>";
                                            echo"<td>".$row["pickup_date"]."</td>";
                                            echo"<td>".$row["pickup_time"]."</td>";
                                            echo '<td> ';
                                                $file_extension = pathinfo($row['deposit_receipt'], PATHINFO_EXTENSION);
                                                if (strtolower($file_extension) === 'pdf') {
                                                    echo '<a style="color: black;" href="' . $row['deposit_receipt'] . '">View PDF</a>';
                                                } else {
                                                    echo '<img src="' . $row['deposit_receipt'] . '" alt="">';
                                                }
                                            echo '</td>';
                                        
                                            echo"<td><button class='"; 
                                                echo $row["deposit_status"] == 'success' ? "success" : "pending";
                                            echo "'>";
                                            if($row["deposit_status"] == 'success') {
                                                echo '<a href="depositstatus.php?book_ID='.$row["book_ID"].'&deposit_status=pending">Approved</a>';
                                            } else {
                                                echo '<a href="depositstatus.php?book_ID='.$row["book_ID"].'&deposit_status=success">Pending</a>';
                                            }                                             
                                            echo "</button></td>";

                                            echo"<td><button class='"; 
                                                //class name to change colour
                                                if($row["book_status"] == 'success') {
                                                    echo "success";
                                                } elseif ($row["book_status"] == 'pending'){
                                                    echo "pending";
                                                } elseif ($row["book_status"] == 'inProgress'){
                                                    echo "inProgress";
                                                } else {
                                                    echo "cancel";
                                                }
                                                echo "'>";
                                                
                                                //change status in database if click
                                                if($row["book_status"] == 'success') {
                                                    echo '<a href="bookstatus.php?book_ID='.$row["book_ID"].'&book_status=cancel">Success</a>';
                                                } elseif ($row["book_status"] == 'pending'){
                                                    echo '<a href="bookstatus.php?book_ID='.$row["book_ID"].'&book_status=inProgress">Pending</a>';
                                                } elseif ($row["book_status"] == 'inProgress'){
                                                    echo '<a href="bookstatus.php?book_ID='.$row["book_ID"].'&book_status=success">In Progress</a>';
                                                } else {
                                                    echo '<a href="bookstatus.php?book_ID='.$row["book_ID"].'&book_status=pending">Cancel</a>';
                                                }     

                                                echo "</button></td>";        //                                     
                                            
                                            echo '<td><a href="?address_id='.$row["address_ID"].'" class="btnAddr">Show</a></td>';
                                            echo"<td>".$row["cust_username"]."</td>";
                                        echo"</tr>";
                                    echo "</tbody>";
                                }
                                echo '</table>';
                            
                            } 
                        ?>
                    </div>
                </div>
                <!-- +++++++++++++++ ADDRESS DETAILS +++++++++++++++ -->
                <?php
                if (isset($_GET['address_id'])) {
                    // Sanitize the input to prevent SQL injection
                    $address_id = mysqli_real_escape_string($dbconn, $_GET['address_id']);

                    // Fetch the address details from the database based on the provided address ID
                    $sql = "SELECT * FROM address WHERE address_ID = '$address_id'";
                    $result = mysqli_query($dbconn, $sql);

                    // Check if the query was successful
                    if ($result && mysqli_num_rows($result) > 0) {
                        // Fetch the address details as an associative array
                        $row = mysqli_fetch_assoc($result);

                        // Construct the full address string
                        $full_address = $row['Name'] . ", " . $row['Contact'] . "<br>" .
                                        $row['house_no'] . ", " . $row['street_name'] . ", " .
                                        $row['city'] . ", " . $row['state'] . " " . $row['postcode'];

                        echo '
                        <div class="addr-popup" id="addr-popup" style="display: flex;">
                            <div class="box-popup">
                                <div class="top-form">
                                    <h2>Address Details</h2>
                                    <div class="close-popup" onclick="closePopup()">
                                        X
                                    </div>
                                </div>
                                <div class="addrdt">
                                    <hr>
                                    <div class="addr-info">
                                        <h3 class="pic">' . $row['Name'] . ' | ' . $row['Contact'] . '</h3>
                                        <p class="address">' . $full_address . '<p>
                                    </div>
                                </div>
                            </div>  
                        </div>';
                    } else {
                        echo "<p>Error fetching address details.</p>";
                    }
                }
                ?>
            </div>
        </div>
    </div>


    <!-- =========== Scripts =========  -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/searchbar.js"></script>
    <script type="text/javascript">
        function closePopup() {
            document.getElementById('addr-popup').style.display = 'none';
        }
    </script>   
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
