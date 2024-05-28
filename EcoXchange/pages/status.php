<?php 
    include('../includes/dbconn.php');
    
    $status = mysqli_real_escape_string($dbconn, $_GET['reward_status']);
    $id = mysqli_real_escape_string($dbconn, $_GET['collect_ID']);
    
    $updateQuery = "UPDATE collection_record SET reward_status='$status' WHERE collect_ID='$id'";
    mysqli_query($dbconn, $updateQuery);
    header('Location: records.php');
    exit;
?>