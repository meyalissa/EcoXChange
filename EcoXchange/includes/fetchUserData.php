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
$id = $user["staff_id"] ?? $user["cust_ID"];
$name = $user["staff_username"] ?? $user["cust_username"];
$image = $user["staff_pict"] ?? $user["cust_pict"];


?>
