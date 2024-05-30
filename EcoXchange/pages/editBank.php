<?php
include('../includes/dbconn.php');

	$bank_id= $_REQUEST['bank_id'];
	$sql= "SELECT * FROM bank_details WHERE bank_id= '$bank_id'";
	$query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error());
	$row = mysqli_num_rows($query);
	
	if($row == 0){
		echo "No record found";
	}
	else{ 
		$r = mysqli_fetch_assoc($query);
		$bank_id= $r['bank_id']; 
        $bank_name= $r['bank_name'];
		$bank_acc_no= $r['bank_acc_no']; 
		$bank_full_name= $r['bank_full_name'];
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/form.css">
    <title>Edit Bank</title>
 <!---------Style For Dropdown---------->
    <style>
       .dropdown{
        display: flex;
        flex-wrap: wrap;
        width: 50%;
        padding-bottom: 15px;}

       .dropdown label{
        width: 95%;
        color: black;
        margin: 5px 0;}

       .dropdown select{
        height: 40px;
        width: 95%;
        padding: 0 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        outline: none;}
    </style>
    <!--------Finish Style---------->
</head>
<body>
    <div class="Container">
        
        <form action="../includes/process.php" method="post" enctype="multipart/form-data">>
            <input type="hidden" name="action" value="updateBank">
            
            <input type="hidden" name="bank_id" value="<?php echo $bank_id; ?>">
            <h2>Bank Detail</h2>
            <div class="content">
                <div class="input-box">
                    <label for="bank_id">Bank Id</label>
                    <input type="text" name="bank_id" value="<?php echo $bank_id; ?>" disabled>
                </div>
                <div class="dropdown">
                    <label for="bank_name">Bank Name</label> <!----Bank Name in dropdown format---->
                        <select name="bank_name">
                           <option value="<?php echo $bank_name; ?>"><?php echo $bank_name; ?></option>
                           <option value="Bank Islam">Bank Islam</option>
                           <option value="Cimb Bank">Cimb Islam</option>
                           <option value="Hong Leong Bank">Hong Leong Bank</option>
                           <option value="Maybank">Maybank</option>
                           <option value="RHB Bank">RHB Bank</option>
                        </select>
                </div>
                <div class="input-box">
                    <label for="bank_acc_no">Account No</label>
                    <input type="text" name="bank_acc_no" value="<?php echo $bank_acc_no; ?>">
                </div>
                <div class="input-box">
                    <label for="bank_full_name">Full Name</label>
                    <input type="text" name="bank_full_name" value="<?php echo $bank_full_name; ?>">
                </div>
                <div class="button-add">
                    <input type="submit" value="Update">
                </div>
            </div>
         </form>
    </div>
</body>
</html>