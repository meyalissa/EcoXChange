<?php
session_start();
// Include your database connection file if not already included
include('../includes/dbconn.php');

// Check if the form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $addr_id = $_POST['selected_address'];
    // $address = $_POST['txtAddress'];
    $vehicle = $_POST['vehicle'];
    $pickup = $_POST['pickup'];
    $file = $_FILES['file'];
    $cust_ID = $_POST['cust_ID'];

    // =============================File upload handling=============================
    $target_dir = "../filepdf/";
    $target_file = $target_dir . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($file["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($file["size"] > 5000000) { // 5MB max
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars(basename($file["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
   
    // =============================Generate book_ID=============================
    $result = mysqli_query($dbconn, "SELECT MAX(book_ID) AS max_id FROM booking");
    $row = mysqli_fetch_assoc($result);
    $max_id = $row['max_id'];

    if ($max_id) {
        $num = (int) substr($max_id, 1); // Extract numeric part of the ID
        $num++;
        $book_ID = 'B' . str_pad($num, 3, '0', STR_PAD_LEFT); // Increment and format ID
    } else {
        $book_ID = 'B001'; // Default to B001 if no records are found
    }

    // =============================DATABASE=============================
    // Insert the data into the database
    $sql = "INSERT INTO booking (book_ID, vehicle_type, pickup_date, pickup_time, deposit_receipt, deposit_status, book_status, address_ID, cust_ID) 
            VALUES ('$book_ID','$vehicle', CURDATE(), '$pickup','$target_file', 'Pending', 'Pending', '$addr_id', '$cust_ID')";
    
    
    if (mysqli_query($dbconn, $sql)) {
        echo "New record created successfully";
        
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($dbconn);
    }

    
} else {
    echo "Invalid request method";
}
header("Location: ../pages/dashboard-2.php");
location.reload();

// Close the database connection after all queries are done
mysqli_close($dbconn);
?>
