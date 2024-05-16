<?php
session_start();
## include db connection file 
include("dbconn.php");

if(isset($_POST['Submit'])){
	## capture values from HTML form 
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	## execute SQL command to check if the user is an administrator
	$sql_admin = "SELECT * FROM staff WHERE staff_username= '$username' AND staff_password= '$password'";
	$query_admin = mysqli_query($dbconn, $sql_admin) or die("Error: " . mysqli_error($dbconn));
	$rows_admin = mysqli_num_rows($query_admin);
	
	## check if the user is an administrator
	if($rows_admin > 0){
		## set the session’s username as administrator
		$_SESSION['username'] = "Administrator";
		## directly open the page for menuAdmin 
		header("Location: ../pages/dashboard-1.php");
		exit(); // Ensure that no further code is executed
	}
	
	## If the user is not an admin, check if the user is a customer
	else {
		## execute SQL command to check if the user is a customer
		$sql_customer = "SELECT * FROM customer WHERE cust_username= '$username' AND cust_password= '$password'";
		$query_customer = mysqli_query($dbconn, $sql_customer) or die("Error: " . mysqli_error($dbconn));
		$rows_customer = mysqli_num_rows($query_customer);
		
		## check if the user is a customer
		if($rows_customer > 0){
			## set the session’s username as customer
			$_SESSION['cust_username'] = $username;
			## directly open the page for menuCustomer 
			header("Location: ../pages/dashboard-2.php");
			exit(); // Ensure that no further code is executed
		}
	}
	
	## If neither admin nor customer, display error message
	// echo "Invalid Username/Password. Click here to <a href='../pages/login.php'>login</a>.";
	// exit(); // Ensure that no further code is executed
	header("Location: ../pages/Login.php");
}

mysqli_close($dbconn); //close connection
?>