<?php
session_start();
## include db connection file 
include("dbconn.php");

if(isset($_POST['Submit'])){
	## capture values from HTML form 
	$username = $_POST['username'];
	$password = $_POST['password'];
	## verify if the values of username and password are correct
	if($username == "meyalissa" && $password == "mel123"){
		 ## set the session’s username as administrator
		$_SESSION['username'] = "Administrator";
		 ## directly call / open the page for menuAdmin 
		 header("Location: ../pages/dashboard-1.php");
	}
	
	##If the user is not an admin, then , call find the user’s information
	else{ 
	
	## execute SQL command 
		$sql= "SELECT * FROM customer WHERE cust_username= '$username' 
				AND cust_password= '$password'";
		echo $sql;
	
		$query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
		$row = mysqli_num_rows($query);
		##to verify the user’s information exist in the db
		if($row == 0){  ##if the user’s record is not exist
			echo "Invalid Username/Password. Click here to <a href='../pages/login.php'>login</a>.";
		}else{##if the user’s record is not exist
			 ##retrieve the user’s infor detail 
			$r = mysqli_fetch_assoc($query);
			 ##ser the session name with the current user’s info
			$_SESSION['username'] = $r['username'];
			
			 ##directly open the page menu 
			 header("Location: dashboard-2.php");
		}
	}
}
mysqli_close($dbconn); //close connection
?>
