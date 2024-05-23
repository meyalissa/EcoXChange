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
    <link rel="stylesheet" href="../style/items-1.css">
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
                            
                        </div>
                        <?php
                            include("../includes/dbconn.php");
                            $sql = "SELECT * FROM booking";
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
                                            echo '<td><img src="' . $row['deposit_receipt'] . '" alt=""></td>';
                                            echo"<td>".$row["deposit_status"]."</td>";
                                            echo"<td>".$row["book_status"]."</td>";
                                            // echo"<td>".$row[""]."</td>";
                                            // echo"<td>".$row["cust_email"]."</td>";
                                            
                                            // echo"<td><a href='edit.php?item_ID=".$row["item_ID"]."'>Edit</a></td>";
                                        echo"</tr>";
                                    echo "</tbody>";
                                }
                                echo '</table>';
                            
                            } 
                        ?>
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

