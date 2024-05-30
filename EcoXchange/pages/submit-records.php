<?php
include('../includes/dbconn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Generate address ID
    $result = mysqli_query($dbconn, "SELECT MAX(collect_ID) AS max_id FROM collection_record");
    $row = mysqli_fetch_assoc($result);
    $max_id = $row['max_id'];

    if ($max_id) {
        $num = (int) substr($max_id, 2);
        $num++;
        $collect_ID = 'CR' . str_pad($num, 3, '0', STR_PAD_LEFT);
    } else {
        $collect_ID = 'CR001';
    }

    // Retrieve the form data
    $collect_weight = $_POST['collect_weight'];
    $item_ID = $_POST['item_ID'];
    $book_ID = $_POST['book_ID'];
    $staff_ID = $_POST['staff_ID'];

    // Fetch item price from the database
    $sql = "SELECT item_price FROM item WHERE item_ID = ?";
    $stmt = mysqli_prepare($dbconn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $item_ID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $item = mysqli_fetch_assoc($result);
    $item_price = $item['item_price'];

    // Calculate the total amount
    $total_amount = $item_price * $collect_weight;

    // Prepare the SQL query using prepared statements
    $sql = "INSERT INTO collection_record (collect_ID, collect_weight, total_amount, collect_date, collect_time, reward_status, book_ID, item_ID, staff_ID) 
            VALUES (?, ?, ?, CURDATE(), CURTIME(), 'Pending', ?, ?, ?)";
    $stmt = mysqli_prepare($dbconn, $sql);

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "ssdsss", 
                           $collect_ID, $collect_weight, $total_amount,
                           $book_ID, $item_ID, $staff_ID);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../pages/records.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($dbconn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($dbconn);
?>
