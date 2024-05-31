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
    if(isset($_POST['update']) && $_POST['update'] === 'updateItem'){

        $item_ID = $_POST['itemid'];
        $item_name = $_POST['itemname'];
        $item_price = $_POST['itemprice'];
        $item_pict = '';

        // Check if a new picture is uploaded
        if(isset($_FILES['itempict']) && $_FILES['itempict']['error'] == 0){
            $target_dir = "../images/items/"; // Specify your upload directory
            $target_file = $target_dir . basename($_FILES["itempict"]["name"]);
            if(move_uploaded_file($_FILES["itempict"]["tmp_name"], $target_file)){
                // New picture uploaded successfully
                $item_pict = $target_file;
            } else {
                // Error uploading new picture
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            // No new picture uploaded, use the existing picture path from the database
            $sqlSel = "SELECT item_pict FROM item WHERE item_ID = '$item_ID'";
            $querySel = mysqli_query($dbconn, $sqlSel) or die("Error: " . mysqli_error($dbconn));
            $rowSel = mysqli_fetch_assoc($querySel);
            $item_pict = $rowSel['item_pict'];
        }

        // Perform the update
        $sqlUpdate = "UPDATE item SET item_name = '$item_name', item_price = '$item_price', item_pict = '$item_pict' WHERE item_ID = '$item_ID'";
        if(mysqli_query($dbconn, $sqlUpdate)) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($dbconn);
        }
    }
    else  ##If the delete button is clicked
    {
         
        $item_ID = $_POST['itemid'];
        ## execute SQL DELETE command 
        $sqlDelete = "DELETE FROM item WHERE item_ID = '$item_ID'";
        
        mysqli_query($dbconn, $sqlDelete) or die ("Error: " . mysqli_error($dbconn));
    }    
    header("Location: ../pages/items-1.php");
    exit();
}

function updateBank($dbconn) {
    if(isset($_POST['action']) && $_POST['action'] === 'updateBank'){
        $bank_ID = $_POST['bank_id'];

        $bank_name = $_POST['bank_name'];
        $accno = $_POST['bank_acc_no'];
        $fullname = $_POST['bank_full_name'];
    
        $sqlUpdate = "UPDATE bank_details SET bank_name = '$bank_name', bank_acc_no = '$accno', bank_full_name = '$fullname' WHERE bank_ID = '$bank_ID'";
        mysqli_query($dbconn, $sqlUpdate) or die ("Error: " . mysqli_error($dbconn));
    }
    header("Location: ../pages/profile-2.php");
    exit();
}

function updateAddress($dbconn) {
    if(isset($_POST['update']) && $_POST['update'] === 'updateAddress'){
        
        $addrID= $_POST['addr_id']; 
        $addrname= $_POST['addrname'];
		$addrcontact= $_POST['addrcontact']; 
		$houseno= $_POST['houseno'];
        $strname= $_POST['strname'];
        $city= $_POST['city'];
        $state= $_POST['state'];
        $postcode= $_POST['postcode'];

        $sqlUpdate = "UPDATE address SET Name = '$addrname', contact = '$addrcontact' , house_no = '$houseno', street_name = '$strname', city = '$city', state = '$state', postcode = '$postcode' WHERE address_ID = '$addrID'";
        mysqli_query($dbconn, $sqlUpdate) or die ("Error: " . mysqli_error($dbconn));

    }
    else  ##If the delete button is clicked
    {
         
        $addrID= $_POST['addr_id']; 
        ## execute SQL DELETE command 
        $sqlDelete = "DELETE FROM address WHERE address_ID = '$addrID'";
        
        mysqli_query($dbconn, $sqlDelete) or die ("Error: " . mysqli_error($dbconn));
    }    
    header("Location: ../pages/profile-2.php");
    exit();
}


function updateProfile($dbconn) {
    if(isset($_POST['action']) && $_POST['action'] === 'updateProfile'){

        $id = $_POST['id'];
        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $nophone = $_POST['nophone'];
        $addemail = $_POST['addemail'];
    
        if (substr($id, 0, 1) === 'C') {
            $sqlUpdate = "UPDATE CUSTOMER SET cust_username = '$username', cust_first_name = '$firstname', 
            cust_last_name = '$lastname', cust_contact_no = '$nophone', cust_email = '$addemail' WHERE cust_ID = '$id'";
        } else
            $sqlUpdate = "UPDATE STAFF SET staff_username = '$username', staff_first_name = '$firstname', 
            staff_last_name = '$lastname', staff_contact_no = '$nophone', staff_email = '$addemail' WHERE staff_ID = '$id'";
        
        mysqli_query($dbconn, $sqlUpdate) or die ("Error: " . mysqli_error($dbconn));
    }
    if (substr($id, 0, 1) === 'C') {
        header("Location: ../pages/profile-2.php");
        exit();
    } else
        header("Location: ../pages/profile-1.php");
        exit();
    
    
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
        case 'updateItem':
            updateItem($dbconn);
            break;
        case 'updateBank':
            updateBank($dbconn);
            break;
        
        case 'updateAddress':
            updateAddress($dbconn);

        case 'updateProfile':
            updateProfile($dbconn);
            break;
        default:

            echo "Invalid action.";
            break;
    }
}
?>