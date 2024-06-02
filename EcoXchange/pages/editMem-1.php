<?php
include('../includes/dbconn.php');

	
	$cust_ID= $_REQUEST['cust_ID'];
    $sql = "SELECT * FROM customer c JOIN bank_details b ON c.bank_id = b.bank_id WHERE c.cust_ID = '$cust_ID'";;
	$query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error());
	$row = mysqli_num_rows($query);
	
	if($row == 0){
		echo "No record found";
	}
	else{ 
		$r = mysqli_fetch_assoc($query);
		$cust_ID= $r['cust_ID']; 
        $cust_username= $r['cust_username'];
		$cust_first_name= $r['cust_first_name'];
        $cust_last_name= $r['cust_last_name'];
        $cust_contact_no= $r['cust_contact_no'];
        $cust_email= $r['cust_email'];
	}
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/form.css">
    <title>Edit Customer Details</title>
</head>
<body>
    <div class="Container">
        <form action="../includes/process.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="updateCustomerDetail">

            <input type="hidden" name="cust_ID" value="<?php echo $cust_ID; ?>">
            <h2>Customer Detail</h2>
            <div class="content">
                <div class="input-box">
                    <label for="cust_ID">Customer ID</label>
                    <input type="text" name="cust_ID" value="<?php echo $cust_ID; ?>" disabled>
                </div>
                <div class="input-box">
                    <!-- <label for="cust_ID">Customer ID</label> -->
                    <!-- <input type="text" name="cust_ID" value="<?php echo $cust_ID; ?>" disabled> -->
                </div>               
                <div class="input-box">
                    <label for="cust_username">Username</label>
                    <input type="text" name="cust_username" value="<?php echo $cust_username; ?>" disabled>
                </div>
                <div class="input-box">
                    <!-- <label for="cust_username">Username</label> -->
                    <!-- <input type="text" name="cust_username" value="<?php echo $cust_username; ?>" disabled> -->
                </div>
                <div class="input-box">
                    <label for="cust_first_name">First Name</label>
                    <input type="text" name="cust_first_name" value="<?php echo $cust_first_name; ?>">
                </div>
                <div class="input-box">
                    <label for="cust_last_name">Last Name</label>
                    <input type="text" name="cust_last_name" value="<?php echo $cust_last_name; ?>">
                </div>
                <div class="input-box">
                    <label for="cust_contact_no">Contact</label>
                    <input type="text" name="cust_contact_no" value="<?php echo $cust_contact_no; ?>">
                </div>
                <div class="input-box">
                    <label for="cust_email">Email</label>
                    <input type="text" name="cust_email" value="<?php echo $cust_email; ?>">
                </div>
                
                <div class="button-add">
                    <input type="submit" name="submit_action" value="Update">
                    <input type="submit" name="submit_action" value="Delete">
                </div>
            </div>
        </form>
    </div>
</body>
</html>