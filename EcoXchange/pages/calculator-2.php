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
    <title>EcoXchange | Calculator</title>
    <!-- ===== BOX ICONS ===== -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="../style/calculator.css">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <?php include('sidebar-2.php'); ?>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <?php include('header.php'); ?>
            <div class="content">
                <div class="nav-title"><h3>Calculator</h3></div>
                <div class="top-content">
                    <div class="searchbar">
                        <label>
                            <input type="text" name="" id="search-item" placeholder="Item's name" onkeyup="searchcalc()">
                            <ion-icon name="search-outline"></ion-icon>
                        </label>
                    </div>       
                </div>

                <div class="item-list" id="item-list">
                    <!---item list-->
                    <?php
                    if(mysqli_num_rows($query) == 0){
                        echo "No item found";
                    } else {
                        while($row = mysqli_fetch_assoc($query)){ 
                    ?>
                    <div class="items">
                        <div class="items-content">
                            <div class="title"><?php echo $row['item_name']; ?></div>
                            <div class="items-incontent">
                                <div class="img"><img src="<?php echo $row['item_pict']; ?>" alt=""></div>
                                <div class="inpWeight">
                                    <div class="each-wlbl">
                                        <p class="txtcalc">Enter the weight:</p>
                                        <div class="inputbar">
                                            <label>
                                                <input type="number" id="weight-<?php echo $row['item_ID']; ?>" placeholder="0.00 KG" oninput="calculateSubtotal('<?php echo $row['item_ID']; ?>', <?php echo $row['item_price']; ?>)">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="each-wlbl">
                                        <p class="txtcalc">Subtotal:</p>
                                        <div class="inputbar2">
                                            <label> RM
                                               <input type="text" class="subtotal" id="subtotal-<?php echo $row['item_ID']; ?>" value="0.00" readonly>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        } 
                    } 
                    ?>
                </div>
                
                
            </div>
                <div class="bottom-content">

                    <div class="total-container">
                        <p class="txtcalc1">Total:</p>
                        <div class="inputbar3">
                            <label> RM
                                <input type="text" id="total" value="0.00" readonly>
                            </label>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="../js/main.js"></script>
    <script src="../js/calculatorfunc.js"></script>
    <script src="../js/searchbar.js"></script>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>