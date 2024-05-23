<?php
include('../includes/dbconn.php');

if(isset($_POST['update'])){
    $item_ID = $_POST['itemid'];
    $item_name = $_POST['itemname'];
    $item_price = $_POST['itemprice'];
    $item_pict = '';

    // Handle file upload if a new file is provided
    if(isset($_FILES['itempict']) && $_FILES['itempict']['error'] == 0){
        $target_dir = "uploads/"; // Specify your upload directory
        $target_file = $target_dir . basename($_FILES["itempict"]["name"]);
        if(move_uploaded_file($_FILES["itempict"]["tmp_name"], $target_file)){
            $item_pict = $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        // If no new file is uploaded, use the existing file path from the database
        $sqlSel = "SELECT item_pict FROM item WHERE item_ID = '$item_ID'";
        $querySel = mysqli_query($dbconn, $sqlSel) or die("Error: " . mysqli_error($dbconn));
        $rowSel = mysqli_fetch_assoc($querySel);
        $item_pict = $rowSel['item_pict'];
    }

    // Perform the update
    $sqlUpdate = "UPDATE item SET item_name = '$item_name', item_price = '$item_price', item_pict = '$item_pict' WHERE item_ID = '$item_ID'";
    mysqli_query($dbconn, $sqlUpdate) or die ("Error: " . mysqli_error($dbconn));
	echo "<center>Data has been updated </center><br>";
}

echo "<a href='../pages/items-1.php'>Main page</a>";
?>