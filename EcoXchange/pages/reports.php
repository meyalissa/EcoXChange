<?php
session_start();

// Check if the user is logged in and if they are a staff member
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Staff') {
    header("Location: login.php");
    exit(); // Ensure that no further code is executed
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoXchange | Reports</title>
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../style/Reports.css">
</head>
<body>
    <!-- Your report content goes here -->
    <h1>Reports Page</h1>
</body>
</html>
