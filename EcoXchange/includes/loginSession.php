<?php
session_start();
include("dbconn.php");

if (isset($_POST['Submit'])) {
    $username = mysqli_real_escape_string($dbconn, $_POST['username']);
    $password = mysqli_real_escape_string($dbconn, $_POST['password']);

    include("functions.php");

    if (emptyInputLogin($username, $password) !== false) {
        header("location: ../pages/login.php?error=emptyinput");
        exit();
    }

    // Check if the user is an administrator
    $sql_admin = "SELECT * FROM staff WHERE staff_username = '$username'";
    $query_admin = mysqli_query($dbconn, $sql_admin) or die("Error: " . mysqli_error($dbconn));
    $staff = mysqli_fetch_assoc($query_admin);

    if ($staff) {
        // Verify the password
        if (password_verify($password, $staff['staff_password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = "Staff";
            header("location: ../pages/dashboard-1.php?action=loginsuccess");
            exit();
        }
    }

    // Check if the user is a customer
    $sql_customer = "SELECT * FROM customer WHERE cust_username = '$username'";
    $query_customer = mysqli_query($dbconn, $sql_customer) or die("Error: " . mysqli_error($dbconn));
    $customer = mysqli_fetch_assoc($query_customer);

    if ($customer) {
        // Verify the password
        if (password_verify($password, $customer['cust_password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = "Customer";
            header("location: ../pages/dashboard-2.php?action=loginsuccess");
            exit();
        }
    }

    // If neither admin nor customer, display error message
    header("location: ../pages/login.php?error=invalidusernameorpwd");
    exit();
}

mysqli_close($dbconn); // close connection
?>
