<?php
include("dbconn.php");

// Update staff passwords
$sql_staff = "SELECT staff_id, staff_password FROM staff";
$result_staff = mysqli_query($dbconn, $sql_staff);

while ($row = mysqli_fetch_assoc($result_staff)) {
    $hashedPassword = password_hash($row['staff_password'], PASSWORD_DEFAULT);
    $update_sql = "UPDATE staff SET staff_password = '$hashedPassword' WHERE staff_id = '" . $row['staff_id'] . "'";
    mysqli_query($dbconn, $update_sql) or die("Error updating staff password: " . mysqli_error($dbconn));
}

// Update customer passwords
$sql_customer = "SELECT cust_id, cust_password FROM customer";
$result_customer = mysqli_query($dbconn, $sql_customer);

while ($row = mysqli_fetch_assoc($result_customer)) {
    $hashedPassword = password_hash($row['cust_password'], PASSWORD_DEFAULT);
    $update_sql = "UPDATE customer SET cust_password = '$hashedPassword' WHERE cust_id = '" . $row['cust_id'] . "'";
    mysqli_query($dbconn, $update_sql) or die("Error updating customer password: " . mysqli_error($dbconn));
}

mysqli_close($dbconn);
?>
