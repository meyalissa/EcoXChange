<?php
include('../includes/dbconn.php');

$collect_ID= $_REQUEST['collect_ID'];

$sqlDelete = "DELETE FROM collection_record WHERE collect_ID = '$collect_ID'";
        
        mysqli_query($dbconn, $sqlDelete) or die ("Error: " . mysqli_error($dbconn));
        header("Location: ../pages/records.php?action=deleterecord");
        exit();
?>