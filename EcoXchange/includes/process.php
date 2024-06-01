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
    $sqlInsert = "INSERT INTO address VALUES ('$address_ID', '$addrname', '$addrcontact', '$houseno', '$strname', '$city','$postcode', '$state',  '$id')";
    mysqli_query($dbconn, $sqlInsert) or die ("Error: " . mysqli_error($dbconn));

    header("Location: ../pages/profile-2.php?action=addnewaddress");
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
    
    header("Location: ../pages/items-1.php?action=additem");
    exit();
}


//Update Items
function updateItem($dbconn) {
    if(isset($_POST['submit_action']) && $_POST['submit_action'] === 'Update'){

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
            header("Location: ../pages/items-1.php?action=updateitem");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($dbconn);
        }
    }
    else if (isset($_POST['submit_action']) && $_POST['submit_action'] === 'Delete')
    {
         
        $item_ID = $_POST['itemid'];
        ## execute SQL DELETE command 
        $sqlDelete = "DELETE FROM item WHERE item_ID = '$item_ID'";
        
        mysqli_query($dbconn, $sqlDelete) or die ("Error: " . mysqli_error($dbconn));
        header("Location: ../pages/items-1.php?action=deleteitem");
        exit();
    
    }    
    
}

// Function to Update an Bank Details
function updateBank($dbconn) {
    if(isset($_POST['action']) && $_POST['action'] === 'updateBank'){
        $bank_ID = $_POST['bank_id'];

        $bank_name = $_POST['bank_name'];
        $accno = $_POST['bank_acc_no'];
        $fullname = $_POST['bank_full_name'];
    
        $sqlUpdate = "UPDATE bank_details SET bank_name = '$bank_name', bank_acc_no = '$accno', bank_full_name = '$fullname' WHERE bank_ID = '$bank_ID'";
        mysqli_query($dbconn, $sqlUpdate) or die ("Error: " . mysqli_error($dbconn));
    }
    header("Location: ../pages/profile-2.php?action=updatebank");
    exit();
}

function updateAddress($dbconn) {
    if(isset($_POST['submit_action']) && $_POST['submit_action'] === 'Update'){
        $addrID = $_POST['addr_id']; 
        $addrname = $_POST['addrname'];
        $addrcontact = $_POST['addrcontact']; 
        $houseno = $_POST['houseno'];
        $strname = $_POST['strname'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $postcode = $_POST['postcode'];

        $sqlUpdate = "UPDATE address SET Name = ?, contact = ?, house_no = ?, street_name = ?, city = ?, state = ?, postcode = ? WHERE address_ID = ?";
        $stmt = $dbconn->prepare($sqlUpdate);
        $stmt->bind_param("ssssssss", $addrname, $addrcontact, $houseno, $strname, $city, $state, $postcode, $addrID);
        $stmt->execute();

        header("Location: ../pages/profile-2.php?action=updateaddress");
        exit();
    
    } else if (isset($_POST['submit_action']) && $_POST['submit_action'] === 'Delete'){
        $addrID = $_POST['addr_id']; 

        $sqlDelete = "DELETE FROM address WHERE address_ID = ?";
        $stmt = $dbconn->prepare($sqlDelete);
        $stmt->bind_param("s", $addrID);
        $stmt->execute();

        header("Location: ../pages/profile-2.php?action=deleteaddress");
        exit();
    }
}


function updateProfile($dbconn) {
    if(isset($_POST['action']) && $_POST['action'] === 'updateProfile') {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $nophone = $_POST['nophone'];
        $addemail = $_POST['addemail'];
        // $picture = $_FILES['profile-picture']

        // Check if a new profile picture is uploaded
        if (isset($_FILES['profile-picture']) && $_FILES['profile-picture']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../images/profile-pict/';
            $uploadFile = $uploadDir . basename($id . '.jpg'); // Save the file as <id>.jpg

            // Check if the directory exists, if not, create it
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            // Move the uploaded file to the target directory
            if (!move_uploaded_file($_FILES['profile-picture']['tmp_name'], $uploadFile)) {
                header("Location: ../pages/profile-2.php?action=error");
            }
        }
        
        if (substr($id, 0, 1) === 'C') {
            $sqlUpdate = "UPDATE CUSTOMER SET cust_username = ?, cust_first_name = ?, cust_last_name = ?, cust_contact_no = ?, cust_email = ?, cust_pict =? WHERE cust_ID = ?";
        } else {
            $sqlUpdate = "UPDATE STAFF SET staff_username = ?, staff_first_name = ?, staff_last_name = ?, staff_contact_no = ?, staff_email = ?, staff_pict = ? WHERE staff_ID = ?";
        }

        $stmt = mysqli_prepare($dbconn, $sqlUpdate);
        mysqli_stmt_bind_param($stmt, 'sssssss', $username, $firstname, $lastname, $nophone, $addemail,$uploadFile, $id);
        mysqli_stmt_execute($stmt) or die ("Error: " . mysqli_error($dbconn));

        if (substr($id, 0, 1) === 'C') {
            header("Location: ../pages/profile-2.php?action=updateprofile");
        } else {
            header("Location: ../pages/profile-1.php?action=updateprofile");
        }
        exit();
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
        case 'updateItem':
            updateItem($dbconn);
            break;
        case 'updateBank':
            updateBank($dbconn);
            break;
        
        case 'updateAddress':
            updateAddress($dbconn);
            break;

        case 'updateProfile':
            updateProfile($dbconn);
            break;

        default:

            echo "Invalid action.";
            break;
    }
}
?>


