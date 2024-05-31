<?php
include('../includes/dbconn.php');

	
	$addrID= $_REQUEST['addr_ID'];
	$sql= "SELECT * FROM address WHERE address_ID= '$addrID'";
	$query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error());
	$row = mysqli_num_rows($query);
	
	if($row == 0){
		echo "No record found";
	}
	else{ 
		$r = mysqli_fetch_assoc($query);
		$addrID= $r['address_ID']; 
        $addrname= $r['Name'];
		$addrcontact= $r['Contact']; 
		$houseno= $r['house_no'];
        $strname= $r['street_name'];
        $city= $r['city'];
        $state= $r['state'];
        $postcode= $r['postcode'];
      
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/form.css">
    <title>Edit Address</title>
</head>
<body>
    <div class="Container">
    <form action="../includes/process.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="updateAddress">
            
            <input type="hidden" name="addr_id" value="<?php echo $addrID; ?>">
            
            <h2>Edit Address Detail</h2>
            <div class="content">
                <div class="input-box">
                    <label for="addr_id">Address ID</label>
                    <input type="text" name="addr_id" value="<?php echo $addrID; ?>" disabled>
                </div>
                <div class="input-box">
                    
                </div>
                <div class="input-box">
                    <label for="addrname">Person In Charge</label>
                    <input type="text" name="addrname" value="<?php echo $addrname; ?>">
                </div>
                <div class="input-box">
                    <label for="addrcontact">Contact</label>
                    <input type="text" name="addrcontact" value="<?php echo $addrcontact; ?>">
                </div>
                <div class="input-box">
                    <label for="houseno">House No</label>
                    <input type="text" name="houseno" value="<?php echo $houseno; ?>">
                </div>
                <div class="input-box">
                    <label for="strname">Street Name</label>
                    <input type="text" name="strname" value="<?php echo $strname; ?>">
                </div>
                <div class="input-box">
                    <label for="city">City</label>
                    <input type="text" name="city" value="<?php echo $city; ?>">
                </div>
                <div class="input-box">
                    <label for="state">State</label>
                    <input type="text" name="state" value="<?php echo $state; ?>">
                </div>
                <div class="input-box">
                    <label for="postcode">PostCode</label>
                    <input type="text" name="postcode" value="<?php echo $postcode; ?>">
                </div>
                <div class="input-box">
                    <label for="country">Country</label>
                    <input type="text" name="Country" value="Malaysia" disabled>
                </div>

                <!----Insert Button --->
                <div class="button-add">
                    <input type="submit" name="submit_action" value="Update">
                    <input type="submit" name="submit_action" value="Delete">
                </div>
            </div>
         </form>
    </div>
</body>
</html>