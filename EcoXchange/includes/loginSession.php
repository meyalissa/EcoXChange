<?php
session_start();
## include db connection file 
include("dbconn.php");

if(isset($_POST['Submit'])){
    ## capture values from HTML form 
    $username = mysqli_real_escape_string($dbconn, $_POST['username']);
    $password = mysqli_real_escape_string($dbconn, $_POST['password']);
    
    include("functions.php");

    //Check if empty
    if(emptyInputLogin($username, $password) !== false) {
        header("location: ../pages/login.php?error=emptyinput");
        exit();
      }
    
    

    ## execute SQL command to check if the user is an administrator
    $sql_admin = "SELECT * FROM staff WHERE staff_username= '$username' AND staff_password= '$password' ";
    $query_admin = mysqli_query($dbconn, $sql_admin) or die("Error: " . mysqli_error($dbconn));
    $rows_admin = mysqli_num_rows($query_admin);
    
    ## check if the user is an administrator
    if($rows_admin > 0){
        ## set the session’s username as administrator
        $_SESSION['username'] = $username;
		$_SESSION['role'] = "Staff";
        ## directly open the page for menuAdmin 
        header("location: ../pages/dashboard-1.php?action=loginsuccess");
        exit(); // Ensure that no further code is executed
    }
    
    ## If the user is not an admin, check if the user is a customer
    else {
        ## execute SQL command to check if the user is a customer
        $sql_customer = "SELECT * FROM customer WHERE cust_username= '$username' AND cust_password= '$password'";
        $query_customer = mysqli_query($dbconn, $sql_customer) or die("Error: " . mysqli_error($dbconn));
        $rows_customer = mysqli_num_rows($query_customer);
        // //Compare hashed password with input password
        // $pwdHashed = $rows_customer["cust_password"];
        // $checkPwd = password_verify($pwd, $pwdHashed);
        // if($checkPwd === false) {
        // header("location: ../pages/login.php?error=invalidpassword");
        // exit();
    
      
        ## check if the user is a customer
        if($rows_customer > 0){
            ## set the session’s username as customer
            $_SESSION['username'] = $username;
			$_SESSION['role'] = "Customer";
            ## directly open the page for menuCustomer 
            header("location: ../pages/dashboard-2.php?action=loginsuccess");
            exit(); // Ensure that no further code is executed
        }
    }
    
    ## If neither admin nor customer, display error message

    header("location: ../pages/login.php?error=invalidusernameorpwd");
    exit();
    
}

mysqli_close($dbconn); //close connection
?>
