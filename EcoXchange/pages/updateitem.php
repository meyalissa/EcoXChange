<?php
##include db connection file 
include("../includes/dbconn.php");

##If the update button is clicked 
if(isset($_POST['update'])){
	
	##	capture values from HTML form 
	$item_ID = $_POST['itemid'];
    $item_name = $_POST['itemname'];
    $item_price = $_POST['itemprice'];
	
	
	## apply sql statement to verify the specified info first
	$sqlSel = "SELECT * FROM item WHERE item_ID= '$item_ID'";
	$querySel = mysqli_query($dbconn, $sqlSel) or die ("Error: " . mysqli_error($dbconn));
	$rowSel = mysqli_num_rows($querySel);

	if($rowSel == 0){
	echo "Record is existed";
	}
	else{
	## execute SQL UPDATE command 
	$sqlUpdate = "UPDATE item SET item_name = '$item_name', item_price = '$item_price' WHERE item_ID = '$item_ID'";

	mysqli_query($dbconn, $sqlUpdate) or die ("Error: " . mysqli_error($dbconn));
	
	/* display a message */
	#echo $sqlUpdate;
	// echo "<center>Data has been updated </center><br>";
	
	}
    header("Location: ../pages/items-1.php");
    exit();
}

?>