<?php
session_start();
// Include your database connection file if not already included
include('../includes/dbconn.php');

// Check if the form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data
    if (empty($_POST['selected_address']) || empty($_POST['vehicle']) || empty($_POST['pickup']) || empty($_FILES['file']['name']) || empty($_POST['cust_ID'])) {
        die("Please fill out all required fields.");
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
        die("Sorry, your file is too large.");
    }
    // Update allowed file formats as needed
    if ($imageFileType != "pdf") {
        die("Sorry, only PDF files are allowed.");
    }

    // Move uploaded file to target directory
    if (!move_uploaded_file($file["tmp_name"], $target_file)) {
        die("Sorry, there was an error uploading your file.");
    }

    // Generate book_ID
    $result = mysqli_query($dbconn, "SELECT MAX(book_ID) AS max_id FROM booking");
    $row = mysqli_fetch_assoc($result);
    $max_id = $row['max_id'];
    $book_ID = $max_id ? 'B' . str_pad((int) substr($max_id, 1) + 1, 3, '0', STR_PAD_LEFT) : 'B001';

    // Insert data into the database using prepared statement
    $sql = "INSERT INTO booking (book_ID, vehicle_type, pickup_date, pickup_time, deposit_receipt, deposit_status, book_status, address_ID, cust_ID) 
            VALUES (?, ?, CURDATE(), ?, ?, 'Pending', 'Pending', ?, ?)";

    $stmt = mysqli_prepare($dbconn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssss", $book_ID, $vehicle, $pickup, $target_file, $addr_id, $cust_ID);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . mysqli_error($dbconn);
    }

    // Close the prepared statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($dbconn);

    // Redirect after successful submission
    header("Location: ../pages/dashboard-2.php");
    exit();
} else {
    echo "Invalid request method";
}
?>
