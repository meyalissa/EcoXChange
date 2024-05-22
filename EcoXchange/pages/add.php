<?php
include('../includes/dbconn.php');

if (isset($_POST['add'])) {
    $item_ID = $_POST['itemid'];
    $item_name = $_POST['itemname'];
    $item_price = $_POST['itemprice'];
    $item_pict = '';

    // Handle file upload if a file is provided
    if (isset($_FILES['itempict']) && $_FILES['itempict']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/"; // Specify your upload directory
        $target_file = $target_dir . basename($_FILES["itempict"]["name"]);
        if (move_uploaded_file($_FILES["itempict"]["tmp_pict"], $target_file)) {
            $item_pict = $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $sqlInsert = "INSERT INTO item (item_ID, item_name, item_price, item_pict) VALUES ('$item_ID', '$item_name', '$item_price', '$item_pict')";
    mysqli_query($dbconn, $sqlInsert) or die ("Error: " . mysqli_error($dbconn));
	 echo "The  information have been recorded in the DB";
    echo "<br><a href='../pages/items-1.php'>Item page</a>";
}
?>