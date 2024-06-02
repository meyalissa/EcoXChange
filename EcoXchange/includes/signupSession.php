<?php
session_start();
// Include the database connection file
include("dbconn.php");

if (isset($_POST["submit"])) {
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confpassword = $_POST["password2"];
  $defaultpict = "../images/profile_pict/default.png";

  include("functions.php");
  //ERROR MESSAGE
  if(emptyInputSignup($email, $username, $password, $confpassword) !== false) {
    header("location: ../pages/signup.php?error=emptyinput");
    exit();
  }
  if(invalidUid($username) !== false) {
    header("location: ../pages/signup.php?error=invalidusername");
    exit();
  }
  if(invalidEmail($email) !== false) {
    header("location: ../pages/signup.php?error=invalidemail");
    exit();
  }
  if(pwdMatch($password, $confpassword) !== false) {
    header("location: ../pages/signup.php?error=passwordsdontmatch");
    exit();
  }
  if(uidExists($dbconn, $username, $email) !== false) {
    header("location: ../pages/signup.php?error=usernametaken");
    exit();
  }


  //Generate Customer ID
  $result = mysqli_query($dbconn, "SELECT MAX(Cust_ID) AS max_id FROM customer");
  $row = mysqli_fetch_assoc($result);
  $max_id = $row['max_id'];

  if ($max_id) {
      $num = (int) substr($max_id, 1);
      $num++;
      $Cust_ID = 'C' . str_pad($num, 3, '0', STR_PAD_LEFT);
  } else {
      $Cust_ID = 'C001';
  }

  
  // Create a new bank entry and get the bank ID
  $bank = createBank($dbconn);

  // Create the user with the generated bank ID
  createUser($dbconn, $Cust_ID, $username, $email, $password, $defaultpict, $bank);
}

function createUser($dbconn, $Cust_ID, $username, $email, $password, $defaultpict, $bank) {
  $sql = "INSERT INTO customer (cust_ID, cust_username, cust_password, cust_email, cust_pict, bank_ID) 
          VALUES (?,?,?,?,?,?);";
  
  $stmt = mysqli_stmt_init($dbconn);

  if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../pages/signup?error=stmtfailed");
    exit();
  }

  $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "ssssss", $Cust_ID, $username, $hashedPwd, $email, $defaultpict, $bank);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("location: ../pages/login.php?error=none");
  exit();
}

function createBank($dbconn) {
  // Generate BANK ID
  $result = mysqli_query($dbconn, "SELECT MAX(bank_id) AS max_id FROM bank_details");
  $row = mysqli_fetch_assoc($result);
  $max_id = $row['max_id'];

  if ($max_id) {
    $num = (int) substr($max_id, 2); // Extract numeric part of the bank_id
    $num++;
    $bank = 'B1' . str_pad($num, 2, '0', STR_PAD_LEFT);
  } else {
    $bank = 'B101';
  }

  // Insert new bank entry
  $sql = "INSERT INTO bank_details (bank_id) VALUES ('$bank')";
  if (mysqli_query($dbconn, $sql)) {
    return $bank; // Return the generated bank ID
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($dbconn);
    return null;
  }
}
?>
