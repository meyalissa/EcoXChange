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
    <link rel="stylesheet" href="../style/alert.css">
    
    
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
                                echo"<td>Item Price per KG</td>";
                                echo"<td>Item Picture</td>";
                                echo"<td>Action</td>";
                                echo"</tr>";
                                echo "</thead>";


                                while($row = mysqli_fetch_array($query)){ 
                                    echo "<tbody>";
                                        echo"<tr>";
                                            echo"<td>".$row["item_ID"]."</td>";
                                            echo"<td>".$row["item_name"]."</td>";
                                            echo"<td>".$row["item_price"]."</td>";
                                            echo '<td><img src="' . $row['item_pict'] . '" alt=""></td>';
                                            // echo '<td>
                                            //     <form class="edit-form" action="edit.php" method="GET">
                                            //         <input type="hidden" name="item_ID" value="' . $row["item_ID"] . '">
                                            //         <button type="button" class="btnedit" data-item-id="' . $row["item_ID"] . '">Edit</button>
                                            //     </form>
                                            // </td>';
                                            echo"<td><a href='editItem.php?item_ID=".$row["item_ID"]."'><i class='bx bxs-edit'></a></td>";
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
    <?php
      if(isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'additem':
                $message = 'You have successfully add an item.';
                $title = 'Success';
                $icon = 'bxs-check-circle';
                $alert_class = 'alert_success';
                break;
            case 'updateitem':
                $message = 'You have successfully update an item.';
                $title = 'Success';
                $icon = 'bxs-check-circle';
                $alert_class = 'alert_success';
                break;
            case 'deleteitem':
                $message = 'You have successfully delete an item.';
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

    <!-- =========== Scripts =========  -->
    <script src="../js/main.js"></script>
    <script src="../js/alert-notification.js"></script>
    
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>

