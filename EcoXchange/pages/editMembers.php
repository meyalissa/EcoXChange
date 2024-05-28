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
    <link rel="stylesheet" href="../style/SidebarUser.css">

    <!-- ======= Full width Table, Table color, Prev&Next Button ====== -->
    <style>


</style>
 <!-- ======= Full width Table ====== -->
</head>
<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <?php include('sidebar-1.php'); ?>

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
                <div clas="nav-title"><h3>Members</h3></div>

                <!-- Codes Here: Members -->
                <?php
include('../includes/dbconn.php');

$cust_ID = $_REQUEST['cust_ID'];

$stmt = mysqli_prepare($dbconn, "SELECT * FROM members WHERE cust_ID = ?");
mysqli_stmt_bind_param($stmt, "s", $cust_ID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_num_rows($result);

if ($row == 0) {
    echo "No record found";
} else {
    $r = mysqli_fetch_assoc($result);
    $cust_ID = $r['cust_ID'];
    $cust_username = $r['cust_username'];
    $cust_password = $r['cust_password'];
    $cust_first_name = $r['cust_first_name'];
    $cust_last_name = $r['cust_last_name'];
    $cust_contact_no = $r['cust_contact_no'];
    $cust_email = $r['cust_email'];
    $cust_pict = $r['cust_pict'];
    $bank_id = $r['bank_id'];
}

mysqli_stmt_close($stmt);
mysqli_close($dbconn);
?>

                <form action="memUpDel.php" method="post">
	            <table >
		          <tr>
			        <th colspan=3>Member Detail Information</th>	
		          </tr>
		          <tr>
			        <td>Customer ID</td>
			        <td>:</td>
			        <td><input type="text" name="cust_ID" value="<?php echo $cust_ID; ?>"></td>
		          </tr>
		          <tr>
			        <td>Username</td>
			        <td>:</td>
			        <td><input type="text" name="cust_username" value="<?php echo $cust_username; ?>"></td>
		          </tr>
		          <tr>
			         <td>Password</td>
			         <td>:</td>
			         <td><input type="text" name="cust_password" value="<?php echo $cust_password; ?>"></td>
		          </tr>
		          <tr>
			         <td>First Name</td>
			         <td>:</td>
			         <td><input type="text" name="cust_first_name" value="<?php echo $cust_first_name; ?>"></td>
		          </tr>
                  <tr>
			         <td>Last Name</td>
			         <td>:</td>
			         <td><input type="text" name="cust_last_name" value="<?php echo $cust_last_name; ?>"></td>
		          </tr>
		          <tr>
			         <td>Contact No</td>
			         <td>:</td>
			         <td><input type="text" name="cust_contact_no" value="<?php echo $cust_contact_no; ?>"></td>
		          </tr>
		          <tr>
                  <tr>
			         <td>Email</td>
			         <td>:</td>
			         <td><input type="text" name="cust_email" value="<?php echo $cust_email; ?>"></td>
		          </tr>
		          <tr>
			         <td>Picture</td>
			         <td>:</td>
			         <td><input type="text" name="cust_pict" value="<?php echo $cust_pict; ?>"></td>
		          </tr>
		          <tr>
			         <td>Bank ID</td>
			         <td>:</td>
			         <td><input type="text" name="bank_id" value="<?php echo $bank_id; ?>"></td>
		          </tr>
		          <tr>

			<td colspan=3>

			<form action="memUpDel.php" method="post">
            <input type="hidden" name="operation" value="update">
            <button type="submit">Update</button>

            <input type="hidden" name="operation" value="delete">
            <button type="submit">Delete</button>
            </form>

			</td>
		</tr>
	</table>
</form>




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