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
                            <h2>Collection Records</h2>
                        </div>
                        <?php
                            include("../includes/dbconn.php");
                            $sql = "SELECT * FROM collection_record r JOIN staff s ON r.staff_ID = s.staff_ID;";
                            $query = mysqli_query($dbconn, $sql);
                            $num_rows = mysqli_num_rows($query);
                            if($num_rows == 0){
                                echo "No item found";
                            } else {
                                echo '<table class="table1">';
                                echo "<thead>";
                                echo"<tr>";
                                echo"<td>Collect ID</td>";
                                echo"<td>Item Type</td>";
                                echo"<td>Weight</td>";
                                echo"<td>Total Rewards</td>";
                                echo"<td>Date Collected</td>";
                                echo"<td>Time Collected</td>";
                                echo"<td>Rewards Status</td>";
                                echo"<td>Book ID</td>";
                                echo"<td>PIC Staff</td>";
                                echo"</tr>";
                                echo "</thead>";


                                while($row = mysqli_fetch_array($query)){ 
                                    echo "<tbody>";
                                        echo"<tr>";
                                            echo"<td>".$row["collect_ID"]."</td>";
                                            echo"<td></td>";
                                            echo"<td>".$row["collect_weight"]."</td>";
                                            echo"<td>".$row["total_amount"]."</td>";
                                            echo"<td>".$row["collect_date"]."</td>";
                                            echo"<td>".$row["collect_time"]."</td>";
                                            echo"<td>".$row["reward_status"]."</td>";
                                            echo"<td>".$row["book_ID"]."</td>";
                                            echo"<td>".$row["staff_username"]."</td>";
                                            
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

