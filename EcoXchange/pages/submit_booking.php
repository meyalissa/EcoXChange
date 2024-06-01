<?php
session_start();
include('../includes/dbconn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (empty($_POST['vehicle']) || empty($_POST['pickup']) || empty($_FILES['file']['name']) || empty($_POST['cust_ID'])) {
        die("Please fill out all required fields.");
    }

    // Collect and sanitize form data
    $addr_id = $_POST['selected_address'];
    $vehicle = $_POST['vehicle'];
    $pickup = $_POST['pickup'];
    $file = $_FILES['file'];
    $cust_ID = $_POST['cust_ID'];

    // Handle file upload
    $target_dir = "../filepdf/";
    $target_file = $target_dir . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check file size
    if ($file["size"] > 5000000) { // 5MB max
        die("Sorry, your file is too large.");
    }

    // Allow certain file formats
    if ($imageFileType != "pdf" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "jpg") {
        die("Sorry, only PDF, PNG, JPEG, and JPG files are allowed.");
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

    // Prepare and bind
    $stmt = mysqli_prepare($dbconn, "INSERT INTO booking (book_ID, vehicle_type, pickup_date, pickup_time, deposit_receipt, deposit_status, book_status, address_ID, cust_ID) VALUES (?, ?, CURDATE(), ?, ?, 'Pending', 'Pending', ?, ?)");
    if (!$stmt) {
        die("MySQL prepare error: " . mysqli_error($dbconn));
    }
    mysqli_stmt_bind_param($stmt, "ssssss", $book_ID, $vehicle, $pickup, $target_file, $addr_id, $cust_ID);

    // Execute statement
    if (mysqli_stmt_execute($stmt)) {
        echo "New record created successfully";
        header("Location: ../pages/dashboard-2.php?action=booksuccessful");
        exit();
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($dbconn);
} else {
    echo "Invalid request method";
}
?>
