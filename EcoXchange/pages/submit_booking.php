<?php
// Include your database connection file if not already included
include('../includes/dbconn.php');
include('../includes/fetchUserData.php'); // Include user data fetching script

// Check if the form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Start session if not started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Get the form data
    $address = mysqli_real_escape_string($dbconn, $_POST['address'] ?? '');
    $vehicle = mysqli_real_escape_string($dbconn, $_POST['vehicle'] ?? '');
    $pickup = mysqli_real_escape_string($dbconn, $_POST['pickup'] ?? '');

    // Handle file upload
    $targetDir = "../filepdf/"; // Directory where uploaded files will be stored
    $targetFile = $targetDir . basename($_FILES["receipt"]["name"]); // Path of the uploaded file on the server
    $uploadOk = 1; // Flag to check if file upload is successful
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION)); // Get the file extension

    // Check if file is a valid image file
    $check = getimagesize($_FILES["receipt"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["receipt"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["receipt"]["tmp_name"], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES["receipt"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Generate the booking ID
    $sql_count = "SELECT COUNT(*) as total FROM booking";
    $result_count = mysqli_query($dbconn, $sql_count);
    $row_count = mysqli_fetch_assoc($result_count);
    $last_id = $row_count['total'] + 1;
    $booking_id = 'B' . sprintf("%03d", $last_id);

    // Insert the data into the database
    $sql = "INSERT INTO booking (book_ID, vehicle_type, pickup_date, pickup_time, deposit_receipt, deposit_status, book_status, address_ID, cust_ID) 
            VALUES (?, ?, CURDATE(), ?, ?, 'Pending', 'Pending', ?, ?)";
    $stmt = mysqli_prepare($dbconn, $sql);
    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ssssss", $booking_id, $vehicle, $pickup, $targetFile, $address, $_SESSION['id']);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Booking submitted successfully with ID: " . $booking_id;
        } else {
            echo "Error: " . mysqli_error($dbconn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($dbconn);
    }
} else {
    echo "Invalid request method";
}

// Close the database connection after all queries are done
mysqli_close($dbconn);
?>
