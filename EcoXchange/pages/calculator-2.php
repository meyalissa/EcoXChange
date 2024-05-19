
<?php

include 'dbconn.php';

function calculateSubtotal($itemName, $weight) {
    global $conn; 

    $sql = "SELECT item_price FROM item WHERE item_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $itemName);
    $stmt->execute();
    $stmt->bind_result($price);
    $stmt->fetch();
    $stmt->close();

    $subtotal = $price * $weight;

    return 'RM' . number_format($subtotal, 2);
}
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
        <div class="navigation">
            <ul>
                <li class = "comp-name">
                    <a href="#">
                        <span class="icon">
                            <img src="../images/logo-white-border.png" class="sidebar-logo" />
                        </span>
                        <span class="title">EcoXchange</span>
                    </a>
                </li>
             

                <li class="active" >
                    <a href="dashboard-2.php">
                        <span class="icon">
                            <i class='bx bx-history'></i>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="items-2.html">
                        <span class="icon">
                            <i class='bx bxl-spring-boot'></i>
                        </span>
                        <span class="title">Items</span>
                    </a>
                </li>

                <li>
                    <a href="calculator-2.html">
                        <span class="icon">
                            <i class='bx bxs-calculator'></i>
                        </span>
                        <span class="title">Calculator</span>
                    </a>
                </li>

                <li>
                    <a href="profile-2.html">
                        <span class="icon">
                            <i class='bx bx-user-circle'></i>
                        </span>
                        <span class="title">Profile</span>
                    </a>
                </li>

                <li class="sign-out">
                    <a href="../includes/logout.inc.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                        
                    </label>
                </div>

                <div class="user">
                    <img src="../images/default-profile.png" alt="">
            
                </div>
            </div>
            <div class="content">
                <div clas="nav-title"><h3>Dashboard</h3></div>
                <!-- !!!!!!!!!!CODES HERE!!!!!!!! -->
                <div class="top-content">
                        <div class="searchbar">
                            <label>
                                <input type="text" name="" id="search-item" placeholder="Item's name" onkeyup="search()">
                                <ion-icon name="search-outline"></ion-icon>
                                
                            </label>
                        </div>       
                </div>

                <div class="item-list" id="item-list">

                    <!---item 1-->
                    <div class="items">
                        <div class="items-content">
                            <div class="title">Cardboard</div>
                            <div class="items-incontent">
                                <div class="img"><img src="../images/cardboard.png" alt=""></div>
                                <div class="inpWeight">
                                    <div class="each-wlbl">
                                        <p class="txtcalc">Enter the weight:</p>
                                        <div class="inputbar">
                                            <label>
                                                <input type="text" id="weight-cardboard" placeholder="0.00">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="each-wlbl">
                                        <p class="txtcalc">Subtotal:</p>
                                        <div class="inputbar2">
                                            <label>
                                               <input type="text" id="subtotal-cardboard" value="<?php echo calculateSubtotal('Cardboard', $_POST['weight-cardboard']); ?>" readonly>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!---item 2-->
                    <div class="items">
                        <div class="items-content">
                            <div class="title">Old News Paper</div>
                            <div class="items-incontent">
                                <div class="img"><img src="../images/newpaper.png" alt=""></div>
                                <div>
                                    <p class="p1">Enter the weight:</p>
                                    <div class="inputbar">
                                        <label>
                                            <input type="text" id="weight-newspaper" placeholder="0.00">
                                        </label>
                                    </div>
                                    <p class="p2">Subtotal:</p>
                                    <div class="inputbar2">
                                        <label>
                                        <input type="text" id="subtotal-newspaper" value="<?php echo calculateSubtotal('Old News Paper', $_POST['weight-newspaper']); ?>" readonly>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                        
                    <div class="items">
                        <div class="items-content">
                            <div class="title">Black & White Paper</div>
                            <div class="items-incontent">
                                <div class="img"><img src="../images/bnw paper.png" alt=""></div>
                                <div>
                                    <p class="p1">Enter the weight:</p>
                                    <div class="inputbar">
                                        <label>
                                            <input type="text" id="weight-bnwpaper" placeholder="0.00">
                                        </label>
                                    </div>
                                    <p class="p2">Subtotal:</p>
                                    <div class="inputbar2">
                                        <label>
                                        <input type="text" id="subtotal-bnwpaper" value="<?php echo calculateSubtotal('Black & White Paper', $_POST['weight-bnwpaper']); ?>" readonly>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="items">
                        <div class="items-content">
                            <div class="title">Glass</div>
                            <div class="items-incontent">
                                <div class="img"><img src="../images/glass bottle.png" alt=""></div>
                                <div class="inpWeight">
                                    <p class="txtcalc">Enter the weight:</p>
                                    <div class="inputbar">
                                        <label>
                                            <input type="text" id="weight-glass" placeholder="0.00">
                                        </label>
                                    </div>
                                    <p class="txtcalc">Subtotal:</p>
                                    <div class="inputbar2">
                                        <label>
                                        <input type="text" id="subtotal-glass" value="<?php echo calculateSubtotal('Glass', $_POST['weight-glass']); ?>" readonly>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="items">
                        <div class="items-content">
                            <div class="title">Plastic Bottle</div>
                            <div class="items-incontent">
                                <div class="img"><img src="../images/plasticBot.png" alt=""></div>
                                <div>
                                    <p class="p1">Enter the weight:</p>
                                    <div class="inputbar">
                                        <label>
                                            <input type="text" id="weight-plasticbot" placeholder="0.00">
                                        </label>
                                    </div>
                                    <p class="p2">Subtotal:</p>
                                    <div class="inputbar2">
                                        <label>
                                        <input type="text" id="subtotal-plasticbot" value="<?php echo calculateSubtotal('Plastic Bottle', $_POST['weight-plasticbot']); ?>" readonly>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="items">
                        <div class="items-content">
                            <div class="title">Aluminium Can</div>
                            <div class="items-incontent">
                                <div class="img"><img src="../images/alCan.png" alt=""></div>
                                <div>
                                    <p class="p1">Enter the weight:</p>
                                    <div class="inputbar">
                                        <label>
                                            <input type="text" id="weight-alcan" placeholder="0.00">
                                        </label>
                                    </div>
                                    <p class="p2">Subtotal:</p>
                                    <div class="inputbar2">
                                        <label>
                                        <input type="text" id="subtotal-alcan" value="<?php echo calculateSubtotal('Aluminium Can', $_POST['weight-alcan']); ?>" readonly>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="items">
                        <div class="items-content">
                            <div class="title">Tin</div>
                            <div class="items-incontent">
                                <div class="img"><img src="../images/tin.png" alt=""></div>
                                <div>
                                    <p class="p1">Enter the weight:</p>
                                    <div class="inputbar">
                                        <label>
                                            <input type="text" id="weight-tin" placeholder="0.00">
                                        </label>
                                    </div>
                                    <p class="p2">Subtotal:</p>
                                    <div class="inputbar2">
                                        <label>
                                        <input type="text" id="subtotal-tin" value="<?php echo calculateSubtotal('Tin', $_POST['weight-tin']); ?>" readonly>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                                    

                    <div class="items">
                        <div class="items-content">
                            <div class="title">Used Cooking Oil</div>
                            <div class="items-incontent">
                                <div class="img"><img src="../images/usedOil.png" alt=""></div>
                                <div>
                                    <p class="p1">Enter the weight:</p>
                                    <div class="inputbar">
                                        <label>
                                            <input type="text" id="weight-usedoil" placeholder="0.00">
                                        </label>
                                    </div>
                                    <p class="p2">Subtotal:</p>
                                    <div class="inputbar2">
                                        <label>
                                        <input type="text" id="subtotal-usedoil" value="<?php echo calculateSubtotal('Used Cooking Oil', $_POST['weight-usedoil']); ?>" readonly>
                                        </label>
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
    <script src="../js/calculatorfunc.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
