<?php
session_start();
// Include your database connection file if not already included
include('../includes/dbconn.php');

// Check if the form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data
    if (empty($_POST['selected_address']) || empty($_POST['vehicle']) || empty($_POST['pickup']) || empty($_FILES['file']['name']) || empty($_POST['cust_ID'])) {
        header("Location: ../pages/dashboard-2.php?action=emptyinput");
        exit();
    }

    $addr_id = $_POST['selected_address'];
    $vehicle = $_POST['vehicle'];
    $pickup = $_POST['pickup'];
    $file = $_FILES['file'];
    $cust_ID = $_POST['cust_ID'];

    // File upload handling
    $target_dir = "../filepdf/";
    $target_file = $target_dir . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check file size and type
    if ($file["size"] > 5000000) { // 5MB max
        header("Location: ../pages/dashboard-2.php?action=filetoolarge");
        exit();
    }
    
    if ($imageFileType != "pdf") {
        header("Location: ../pages/dashboard-2.php?action=invalidfiletype");
        exit();
    }

    // Move uploaded file to target directory
    if (!move_uploaded_file($file["tmp_name"], $target_file)) {
        header("Location: ../pages/dashboard-2.php?action=uploaderror");
        exit();
    }

    // Generate book_ID
    $result = mysqli_query($dbconn, "SELECT MAX(book_ID) AS max_id FROM booking");
    $row = mysqli_fetch_assoc($result);
    $max_id = $row['max_id'];
    $book_ID = $max_id ? 'B' . str_pad((int) substr($max_id, 1) + 1, 3, '0', STR_PAD_LEFT) : 'B001';

    // Insert data into the database using prepared statement
    $sql = "INSERT INTO booking (book_ID, vehicle_type, pickup_date, pickup_time, deposit_receipt, deposit_status, book_status, address_ID, cust_ID) 
            VALUES (?, ?, CURDATE(), ?, ?, 'pending', 'pending', ?, ?)";

    $stmt = mysqli_prepare($dbconn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssss", $book_ID, $vehicle, $pickup, $target_file, $addr_id, $cust_ID);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../pages/dashboard-2.php?action=booksuccessful");
    } else {
        header("Location: ../pages/dashboard-2.php?action=dberror");
    }

    // Close the prepared statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($dbconn);

    exit();
} else {
    echo "Invalid request method";
}
?>
