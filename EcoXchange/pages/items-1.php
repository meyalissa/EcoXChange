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

            <div class="nav-title"><h3>Items</h3></div>
            <div class="nav-desc">These are the items that we accept:</div>
            <div class="in-content">
                <div class="grid-content">
                    <!---item 1-->
                    <div class="item">
                        <div class="content">
                            <div class="img"><img src="../images/cardboard.png" alt=""></div>
                            <div class="title">Cardboard</div>
                            <div class="price">RM 0.25/KG</div>
                            <div class="box"></div>
                        </div>
                    </div>
                    <!---item 2-->
                    <div class="item">
                        <div class="content">
                            <div class="img"><img src="../images/newpaper.png" alt=""></div>
                            <div class="title">Old News Paper</div>
                            <div class="price">RM 0.20/KG</div>
                            <div class="box"></div>
                        </div>
                    </div>
                    <!---item 3-->
                    <div class="item">
                        <div class="content">
                            <div class="img"><img src="../images/bnw paper.png" alt=""></div>
                            <div class="title">Black & White Paper</div>
                            <div class="price">RM 0.35/KG</div>
                            <div class="box"></div>
                        </div>
                     </div>
                    <!---item 4-->
                    <div class="item">
                        <div class="content">
                            <div class="img"><img src="../images/glass bottle.png" alt=""></div>
                            <div class="title">Glass</div>
                            <div class="price">RM 0.40/KG</div>
                            <div class="box"></div>
                        </div>
                    </div>
                    <!---item 5-->
                    <div class="item">
                        <div class="content">
                            <div class="img"><img src="../images/plasticBot.png" alt=""></div>
                            <div class="title">Plastic Bottle</div>
                            <div class="price">RM 0.40/KG</div>
                            <div class="box"></div>
                        </div>
                     </div>
                    <!---item 6-->
                   
                    <div class="item">
                        <div class="content">
                            <div class="img"><img src="../images/alCan.png" alt=""></div>
                            <div class="title">Aluminium Can</div>
                            <div class="price">RM 3.00/KG</div>
                            <div class="box"></div>
                        </div>
                     </div>
                    <!---item 7-->
                    <div class="item">
                        <div class="content">
                            <div class="img"><img src="../images/tin.png" alt=""></div>
                            <div class="title">Tin</div>
                            <div class="price">RM 0.45/KG</div>
                            <div class="box"></div>
                        </div>
                    </div>
                    <!---item 8-->
                    
                    <div class="item">
                        <div class="content">
                            <div class="img"><img src="../images/usedOil.png" alt=""></div>
                            <div class="title">Used Cooking Oil</div>
                            <div class="price">RM 3.00/KG</div>
                            <div class="box"></div>
                        </div>
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