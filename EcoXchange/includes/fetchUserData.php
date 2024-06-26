<?php
session_start();

// Include database connection
include("dbconn.php");

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../pages/Login.php");
    exit();
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];

// Fetch user data based on role
if ($role === 'Staff') {
    $sql = "SELECT * FROM staff WHERE staff_username = '$username'";
} elseif ($role === 'Customer') {
    $sql = "SELECT * FROM customer WHERE cust_username = '$username'";
} else {
    header("Location: ../pages/Login.php");
    exit();
}

$query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
$user = mysqli_fetch_assoc($query);

// Set common variables
$id = $user["staff_ID"] ?? $user["cust_ID"];
$name = $user["staff_username"] ?? $user["cust_username"];
$first = $user["staff_first_name"] ?? $user["cust_first_name"]; 
$last = $user["staff_last_name"] ?? $user["cust_last_name"]; 
$contact = $user["staff_contact_no"] ?? $user["cust_contact_no"]; 
$email = $user["staff_email"] ?? $user["cust_email"]; 
$image = $user["staff_pict"] ?? $user["cust_pict"];

// Fetch address data based on user ID
$sql_address = "SELECT * FROM address WHERE cust_ID = '$id'";
$query_address = mysqli_query($dbconn, $sql_address) or die("Error fetching address: " . mysqli_error($dbconn));
$address = mysqli_fetch_assoc($query_address);

// Set address data to session variable for access in other files
$_SESSION['address'] = $address;

?>
