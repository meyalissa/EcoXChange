<?php

// Include database connection and fetch user data
include('../includes/dbconn.php');
include('../includes/fetchUserData.php');

// Fetch items from the database
$sql = "SELECT * FROM item";
$query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
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
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Item</h2>
                        <a href="add-item.php" class="btn">Add Item</a>
                    </div>
                    <?php
                        include("../includes/dbconn.php");
                        $sql = "SELECT * FROM item";
                        $query = mysqli_query($dbconn, $sql);
                        $num_rows = mysqli_num_rows($query);
                        if($num_rows == 0){
                            echo "No item found";
                        } else {
                            echo '<table class="table1">';
                            echo "<thead>";
                            echo"<tr>";
                            echo"<td>Item Id</td>";
                            echo"<td>Item Name</td>";
                            echo"<td>Item Price</td>";
                            echo"<td>Item Picture</td>";
                            echo"<td>Edit</td>";
                            echo"</tr>";
                            echo "</thead>";


                            while($row = mysqli_fetch_array($query)){ 
                                echo "<tbody>";
                                echo"<tr>";
                                echo"<td>".$row["item_ID"]."</td>";
                                echo"<td>".$row["item_name"]."</td>";
                                echo"<td>".$row["item_price"]."</td>";
                                echo '<td><img src="' . $row['item_pict'] . '" alt=""></td>';
                                echo"<td><a href='edit.php?item_ID=".$row["item_ID"]."'>Edit</a></td>";
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

