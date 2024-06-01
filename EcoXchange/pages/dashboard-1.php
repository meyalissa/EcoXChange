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
    <title>EcoXchange | Dashboard</title>
    <!-- ===== BOX ICONS ===== -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="../style/dashboard-1.css">
    <link rel="stylesheet" href="../style/alert.css">
</head>

<body>
<?php
      if(isset($_GET['action'])) {
        if($_GET['action'] == 'loginsuccess') {
        echo '
          <div class="alert_wrapper active1">
            <div class="alert_backdrop"></div>
            <div class="alert_inner">
                <div class="alert_item alert_success">

                    <div class="icon data_icon">
                      <i class="bx bxs-check-circle" ></i>
                    </div>

                    <div class="data">
                      <p class="title"><span>Success:</span>
                        User action success
                      </p>
                      <p class="sub">You have successfully Log In.</p>
                    </div>
                    
                    <div class="icon close">
                      <i class="bx bx-x" ></i>
                    </div>

                </div>
            </div>
          </div>
          ';
        }
      }
    ?>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <?php include('sidebar-1.php'); ?>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <?php include('header.php'); ?>
        <!-- ======================= Cards ================== -->
        <div class="cardBox">
            <?php
                include("../includes/dbconn.php");
                $sql = "SELECT 
                        (SELECT COUNT(*) FROM customer) as total_members,
                        (SELECT SUM(total_amount) FROM collection_record) as rewards,
                        (SELECT COUNT(*) FROM collection_record) as total_collection_record";
                $query = mysqli_query($dbconn, $sql);
                if ($query) {
                    $data = mysqli_fetch_assoc($query);
                } else {
                    $data = [
                        'total_members' => 0,
                        'total_amount' => 0,
                        'total_collection_record' => 0
                    ];
                }
            ?>

            <div class="card">
                <div>
                    <div class="numbers"><?php echo $data['total_members']; ?></div>
                    <div class="cardName">Members</div>
                </div>
                <div class="iconBx">
                    <ion-icon name="people-outline"></ion-icon>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="numbers"><?php echo $data['total_collection_record']; ?></div>
                    <div class="cardName">Waste Collected</div>
                </div>
                <div class="iconBx">
                    <ion-icon name="cart-outline"></ion-icon>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="numbers"><?php echo $data['rewards']; ?></div>
                    <div class="cardName">Rewards (RM)</div>
                </div>
                <div class="iconBx">
                    <ion-icon name="cash-outline"></ion-icon>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="numbers">8</div>
                    <div class="cardName">Recycle Centre</div>
                </div>
                <div class="iconBx">
                    <ion-icon name="outlet-outline"></ion-icon>
                </div>
            </div>
        </div>
            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Recent Booking</h2>

                        <a href="VehicleBooking.php" class="btn">View All</a>
                      
                    </div>
                    <?php
                        include("../includes/dbconn.php");
                        $sql = "SELECT * FROM booking";
                        $query = mysqli_query($dbconn, $sql);
                        $num_rows = mysqli_num_rows($query);
                        if($num_rows == 0){
                            echo "No item found";
                        } else {
                            echo '<table class="table">';
                            echo "<thead>";
                            echo"<tr>";
                            echo"<td>Book Id</td>";
                            echo"<td>Pickup Date</td>";
                            echo"<td>Pickup Time</td>";
                            echo"<td>Book Status</td>";
                            echo"</tr>";
                            echo "</thead>";


                            while($row = mysqli_fetch_array($query)){ 
                                echo "<tbody>";
                                echo"<tr>";
                                echo"<td>".$row["book_ID"]."</td>";
                                echo"<td>".$row["pickup_date"]."</td>";
                                echo"<td>".$row["pickup_time"]."</td>";

                                echo"<td> <button id=btnstat class='"; 
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

                                    //Change format of the status
                                    if($row["book_status"] == 'success') {
                                        echo 'Success';
                                    } elseif ($row["book_status"] == 'pending'){
                                        echo 'Pending';
                                    } elseif ($row["book_status"] == 'inProgress'){
                                        echo 'In Progress';
                                    } else {
                                        echo 'Cancel';
                                    }    
                                    echo "</button></td>";   
                                echo"</tr>";
                                echo "</tbody>";
                            }
                            echo '</table>';
                    
                        } 
                    ?>
                </div>

                <!-- ================= List members  ================ -->
                <div >
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>Members</h2>
                    </div>
                    <table>
                    <?php
                    include("../includes/dbconn.php");
                    $sql = "SELECT * FROM customer";
                    $query = mysqli_query($dbconn, $sql);
                    $num_rows = mysqli_num_rows($query);
                    if ($num_rows > 0) {
                        while ($row = mysqli_fetch_array($query)) {
                            echo '<tr>';
                            echo '<td width="30px">';
                            echo '<div class="imgBx"><img src="' . $row["cust_pict"] . '" alt=""></div>';
                            echo '</td>';
                            echo '<td>';
                            echo '<h4>' . $row["cust_username"] . '</h4>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="2">No members found</td></tr>';
                    }
                    ?>
                    </table>
                </div>
                </div >
            </div>

    <!-- =========== Scripts =========  -->
    <script src="../js/main.js"></script>
    <script src="../js/alert-notification.js"></script>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
