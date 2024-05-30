<?php
include('../includes/dbconn.php');

// Function to add an address
function addAddress($dbconn) {
    $addrname = $_REQUEST['addrname'];
    $addrcontact = $_REQUEST['addrcontact'];
    $houseno = $_REQUEST['houseno'];
    $strname = $_REQUEST['strname'];
    $city = $_REQUEST['city'];
    $state = $_REQUEST['state'];
    $postcode = $_REQUEST['postcode'];
    $id = $_REQUEST['cust_ID'];

    //Generate address ID
    $result = mysqli_query($dbconn, "SELECT MAX(address_ID) AS max_id FROM address");
    $row = mysqli_fetch_assoc($result);
    $max_id = $row['max_id'];

    if ($max_id) {
        $num = (int) substr($max_id, 1);
        $num++;
        $address_ID = 'A' . str_pad($num, 3, '0', STR_PAD_LEFT);
    } else {
        $address_ID = 'A001';
    }
    //Insert Data
    $sqlInsert = "INSERT INTO address VALUES ('$address_ID', '$addrname', '$addrcontact', '$houseno', '$strname', '$city', '$state', '$postcode', '$id')";
    mysqli_query($dbconn, $sqlInsert) or die ("Error: " . mysqli_error($dbconn));

    header("Location: ../pages/profile-2.php");
    exit();
}

// Function to add an item
function addItem($dbconn) {
    //Generate address ID
    $result = mysqli_query($dbconn, "SELECT MAX(item_ID) AS max_id FROM item");
    $row = mysqli_fetch_assoc($result);
    $max_id = $row['max_id'];

    if ($max_id) {
        $num = (int) substr($max_id, 1);
        $num++;
        $item_ID = 'I' . str_pad($num, 3, '0', STR_PAD_LEFT);
    } else {
        $item_ID = 'I001';
    }

    $item_name = $_POST['itemname'];
    $item_price = $_POST['itemprice'];
    $item_pict = '';

    if (isset($_FILES['itempict']) && $_FILES['itempict']['error'] == UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['itempict']['type'], $allowed_types)) {
            echo "Sorry, only JPG, PNG, and GIF files are allowed.";
            exit();
        }
        
        $target_dir = "../images/items/";
        $target_file = $target_dir . basename($_FILES["itempict"]["name"]);
        
        if (move_uploaded_file($_FILES["itempict"]["tmp_name"], $target_file)) {
            $item_pict = $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
    } else {
        echo "File upload error code: " . $_FILES['itempict']['error'];
        exit();
    }


    $sqlInsert = "INSERT INTO item VALUES ('$item_ID', '$item_name', '$item_price', '$item_pict')";
    
    mysqli_query($dbconn, $sqlInsert) or die ("Error: " . mysqli_error($dbconn));
    
    header("Location: ../pages/items-1.php");
    exit();
}


//Update Items
function updateItem($dbconn) {
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
	

    }
}



// Main processing logic
if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET") {
    $action = $_REQUEST['action'];

    switch ($action) {
        case 'addAddress':
            addAddress($dbconn);
            break;
        case 'addItem':
            addItem($dbconn);
            break;
        default:
            echo "Invalid action.";
            break;
    }
}
?>
