<?php
session_start();

if(isset($_SESSION['cust_username'])){
	// store session in var
	$username = $_SESSION['cust_username'];
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
        <?php include('sidebar-2.php'); ?>
        <!-- ========================= Main ==================== -->
        <div class="main">
            <?php include('header.php'); ?>
            <div class="content">
                <div clas="nav-title"><h3>Items</h3></div>
                <!-- !!!!!!!!!!CODES HERE!!!!!!!! -->
                <div class="nav-desc">These are the items that we accept:</div>
                <div class="in-content">
                    <div class="grid-content">
                        <!---item 1-->
                    <?php
                            include("../includes/dbconn.php");
                            $sql = "SELECT * FROM item";
                            $query = mysqli_query($dbconn, $sql);
                            $num_rows = mysqli_num_rows($query);
                            if($num_rows == 0){
                                echo "No item found";
                            } else {
                                while($row = mysqli_fetch_array($query)){
                        ?>
                        <div class="item">
                            <div class="content">
                                <div class="img"><img src="<?php echo $row['item_pict']; ?>" alt=""></div>
                                <div class="title"><?php echo $row['item_name']; ?></div>
                                <div class="price">RM<?php echo $row['item_price']; ?>/KG</div>
                                <div class="box"></div>
                            </div>
                        </div>
                        <?php 
                                } 
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
<?php 
}
?>