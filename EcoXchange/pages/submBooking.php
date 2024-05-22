<?php
	
	include('../includes/dbconn.php');
	
	$address = $_REQUEST['txtAddress'];
	$vehicle = $_REQUEST['vehicle'];
	$pickup = $_REQUEST['pickup'];
	$avatar = $_REQUEST['avatar'];
	
	
	$sqlInsert = "INSERT INTO booking VALUES
	('" . $address . "','" . $vehicle . "',
	 '" . $pickup . "','" . $avatar . "')";
	 
	 mysqli_query($dbconn, $sqlInsert) or die ("Error: " . mysqli_error($dbconn));
	 echo $sqlInsert;
	 echo "<br>";
	 echo "The following information have been recorded in the DB";
	 echo "<br>Park Code : " .$address;
	 echo "<br>Park Name : " .$vehicle;
	 echo "<br>Park City : " .$pickup;
	 echo "<br>Park Country : " .$avatar;
	echo"<br><a href='viewData.php'>Main page</a>";
?>