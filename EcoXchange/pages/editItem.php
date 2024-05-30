<?php
include('../includes/dbconn.php');

	
	$itemID= $_REQUEST['item_ID'];
	$sql= "SELECT * FROM item WHERE item_ID= '$itemID'";
	$query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error());
	$row = mysqli_num_rows($query);
	
	if($row == 0){
		echo "No record found";
	}
	else{ 
		$r = mysqli_fetch_assoc($query);
		$item_ID= $r['item_ID']; 
        $item_name= $r['item_name'];
		$item_price= $r['item_price']; 
		$item_pict= $r['item_pict'];
      
	}
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/form.css">
    <title>Edit Item</title>
</head>
<body>
    <div class="Container">
        <form action="../includes/process.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="updateItem">

            <input type="hidden" name="itemid" value="<?php echo $item_ID; ?>">
            <h2>Item Detail</h2>
            <div class="content">
                <div class="input-box">
                    <label for="itemid">Item Id</label>
                    <input type="text" name="itemid" value="<?php echo $item_ID; ?>" disabled>
                </div>
                <div class="input-box">
                    <!-- <label for="itemid">Item Id</label> -->
                    <!-- <input type="text" name="itemid" value="<?php echo $item_ID; ?>" disabled> -->
                </div>
                <div class="input-box">
                    <label for="itemname">Item Name</label>
                    <input type="text" name="itemname" value="<?php echo $item_name; ?>">
                </div>
                <div class="input-box">
                    <label for="itemprice">Item Price</label>
                    <input type="text" name="itemprice" value="<?php echo $item_price; ?>">
                </div>
                <div class="input-box">
                    <label for="currentitempict">Current Item Picture</label>
                    <img style="width:20%;" src="<?php echo $item_pict; ?>" alt="" width="200">
                    <input type="hidden" name="currentitempict" value="<?php echo $item_pict; ?>" readonly>
                </div>
                <div class="input-box">
                    <label for="itempict">New Item Picture</label>
                    <input type="file" name="itempict">
                </div>
                <div class="button-add">
                    <input type="submit" value="Update">
                    <input type="submit" value="Delete">
                </div>
            </div>
        </form>
    </div>
</body>
</html>
