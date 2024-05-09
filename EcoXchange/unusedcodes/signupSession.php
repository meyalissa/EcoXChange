<?php
session_start();
## include db connection file 
include("dbconn.php");
if(isset($_POST["submit"])) {

  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confpassword = $_POST["password2"];

  // if(pwdMatch($password, $confpassword) !== false) {
  //   header("location: ../pages/signup?error=passwordsdontmatch");
  //   exit();
  // }
  // if(usernameExists($conn, $username, $email) !== false) {
  //   header("location: ../php/signup?error=usernametaken");
  //   exit();
  // }

  createUser($dbconn, $username, $email, $password);
}
// else {
//   header("location: ../pages/signup.php");
//   exit();
// }

function createUser($dbconn, $username, $email, $password) {
  $sql = "INSERT INTO customer (cust_username, cust_password, cust_email) 
  VALUES (?,?,?);";
  $stmt = mysqli_stmt_init($dbconn);

  if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../pages/signup?error=stmtfailed");
    exit();
  }

  // $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $password);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("location: ../pages/signup?error=none");
  exit();
}

function pwdMatch($pwd, $pwdRepeat) {
  $result = false;
  if($pwd !== $pwdRepeat) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function usernameExists($conn, $username, $email) {
  $sql = "SELECT * FROM customer WHERE cust_username = ? OR cust_email = ?;";
  $stmt = mysqli_stmt_init($dbconn);

  if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../pages/signup?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $username, $email);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  }
  else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}
