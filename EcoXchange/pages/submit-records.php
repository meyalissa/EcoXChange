<?php
    include('../includes/dbconn.php');

    // Retrieve the form data
    $collect_ID = $_POST['collect_ID'];
    $collect_weight = $_POST['collect_weight'];
    $total_amount = $_POST['total_amount'];
    $collect_date = $_POST['collect_date'];
    $collect_time = $_POST['collect_time'];
    $reward_status = $_POST['reward_status'];
    $book_ID = $_POST['book_ID'];
    $item_ID = $_POST['item_ID'];
    $staff_ID = $_POST['staff_ID'];

    // Prepare the SQL query using prepared statements
    $sql = "INSERT INTO collection_record (collect_ID, collect_weight, total_amount, collect_date, collect_time, reward_status, book_ID, item_ID, staff_ID) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($dbconn, $sql);

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "sssssssss", 
                           $collect_ID, $collect_weight, $total_amount, 
                           $collect_date, $collect_time, $reward_status, 
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
?>