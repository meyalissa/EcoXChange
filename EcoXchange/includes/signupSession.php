<?php
session_start();
## include db connection file 
include("dbconn.php");
if(isset($_POST["submit"])) {

  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confpassword = $_POST["password2"];

  createUser($dbconn, $username, $email, $password);
}

function createUser($dbconn, $username, $email, $password) {
  $sql = "INSERT INTO customer (cust_username, cust_password, cust_email) 
  VALUES ('$username','$password','$email');";
  
  if(mysqli_query($dbconn, $sql)) {
    echo "User created successfully.";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($dbconn);
  }
}

