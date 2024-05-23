<?php
session_start();

// Include database connection
include('../includes/dbconn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $address = $_POST['txtAddress'];
    $vehicle = $_POST['vehicle'];
    $pickup = $_POST['pickup'];
    $avatar = $_FILES['avatar'];
    $cust_ID = $_POST['cust_ID'];

    // =============================File upload handling=============================
    $target_dir = "../filepdf/";
    $target_file = $target_dir . basename($avatar["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($avatar["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($avatar["size"] > 5000000) { // 5MB max
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
        if (move_uploaded_file($avatar["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars(basename($avatar["name"])) . " has been uploaded.";
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
    // Insert data into the database
    $sqlInsert = "INSERT INTO booking (book_ID, address_ID, vehicle_type, pickup_time, deposit_receipt, cust_ID) VALUES
     ('$book_ID', '$address', '$vehicle', '$pickup', '$target_file', '$cust_ID')";
    if (mysqli_query($dbconn, $sqlInsert)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sqlInsert . "<br>" . mysqli_error($dbconn);
    }

    echo "<br>";
    echo "The following information has been recorded in the DB";
    echo "<br>Book ID: " . $book_ID;
    echo "<br>Pick Up Address: " . $address;
    echo "<br>Type of Vehicle: " . $vehicle;
    echo "<br>Pick Up Time: " . $pickup;
    echo "<br>Deposit Receipt: " . $target_file;
    echo "<br><a href='viewData.php'>Main page</a>";
}
?>
