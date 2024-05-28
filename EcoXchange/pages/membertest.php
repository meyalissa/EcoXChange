
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
    <link rel="stylesheet" href="../style/members.css">

    <!-- ======= Full width Table, Table color, Prev&Next Button ====== -->
    <style>
    /* table {
    border-collapse: collapse;
    width: 100%;
    border: 10px solid white;
    }

    th, td {
    padding: 10px;
    display: table-cell;
    vertical-align: middle;
    border: 2px solid white;
    }

    th {
    background-color:#EDD9C5; 
    }    

    td {
    background-color: #F6EDDB;
    } */

    a {
    text-decoration: none;
    display: inline-block;
    padding: 2px 4px;
    }

    a:hover {
    background-color: #ddd;
    color: black;
    }

    .previous {
    background-color: #f1f1f1;
    color: black;
    }

    .next {
    background-color: #C2A487;
    color: white;
    }

    .round {
    border-radius: 50%;
    }

    .topnav-right {
    float: right;
    }

</style>
 <!-- ======= Full width Table ====== -->
</head>
<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <?php include('sidebar-1.php'); ?>
        
        <!-- ========================= Main ==================== -->
        <div class="main">
            <?php include('header.php'); ?>
            <div class="content">
                <div clas="nav-title"><h3>Members</h3></div>
                
                <!-- Codes Here: Members -->
                <?php
                  include('../includes/dbconn.php');
                  $sql="select * from customer";
                  $query=mysqli_query($dbconn,$sql) or die ("Error: " .mysqli_error());
                  $row=mysqli_num_rows($query);
                
                  if($row == 0){
                    echo "No record found"; }

                  else{
                    echo"<table border=1>";
                    echo"<tr>";
                    echo"<th>Customer ID</th>";
                    echo"<th>Username</th>";
                    echo"<th>Password</th>";
                    echo"<th>First Name</th>";
                    echo"<th>Last Name</th>";
                    echo"<th>Contact No</th>";
                    echo"<th>Email</th>";
                    echo"<th>Picture</th>";
                    echo"<th>Bank ID</th>";
                    echo"<th>Options</th>"; }
                  
                  while($row = mysqli_fetch_array($query)){
                    echo"<tr>";
                    echo"<td>".$row["cust_ID"]."</td>";
                    echo"<td>".$row["cust_username"]."</td>";
                    echo"<td>".$row["cust_password"]."</td>";
                    echo"<td>".$row["cust_first_name"]."</td>";
                    echo"<td>".$row["cust_last_name"]."</td>";
                    echo"<td>".$row["cust_contact_no"]."</td>";
                    echo"<td>".$row["cust_email"]."</td>";
                    echo"<td>".$row["cust_pict"]."</td>";
                    echo"<td>".$row["bank_id"]."</td>"; 
                    echo"<td><a href='editMembers.php?cust_ID=".$row["cust_ID"]."'>Edit</a></td>";
				    echo"</tr>";
                }

                    echo"</table>";
                ?>
                <!--Button Previous & Next-->
                <div class="topnav-right">
                   <a href="#" class="previous">&laquo; Previous</a>
                   <a href="#" class="next">Next &raquo;</a>
                 </div>
                
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery Library -->
    <script src="../js/main.js"></script>
    <script src="../js/searchbar.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Function to handle closing popups
            $('.close-popup').click(function() {
                var popupId = $(this).data('popup');
                $(popupId).fadeOut();
            });

            // Function to open bank details popups
            $('.btnBank').click(function() {
                $('#bank-name').text($(this).data('bank-name'));
                $('#bank-acc-no').text($(this).data('bank-acc-no'));
                $('#bank-full-name').text($(this).data('bank-full-name'));
                $('#bank-popup').fadeIn().css("display", "flex");
            });
        });
    </script>   

>>>>>>> main
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>

