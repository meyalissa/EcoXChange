<?php
// Include database connection and fetch user data
include('../includes/dbconn.php');
include('../includes/fetchUserData.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/form.css">
    <title>Edit Item</title>
</head>
<body>
    <div class="Container">
        <form action="../includes/process.php" method="post">
            <input type="hidden" name="action" value="addAddress">
            <input type="hidden" name="cust_ID" value="<?php echo $id; ?>">
            <h2>Add Address</h2>
            <div class="content">
                <div class="input-box">
                    <label for="addrname">Person In Charge</label>
                    <input type="text" name="addrname" placeholder="Enter Name">
                </div>
                <div class="input-box">
                    <label for="addrcontact">Contact</label>
                    <input type="text" name="addrcontact" placeholder="Enter Contact Number">
                </div>
                <div class="input-box">
                    <label for="houseno">House No</label>
                    <input type="text" name="houseno" placeholder="Enter House Number">
                </div>
                <div class="input-box">
                    <label for="strname">Street Name</label>
                    <input type="text" name="strname" placeholder="Enter Street Name">
                </div>
                <div class="input-box">
                    <label for="city">City</label>
                    <input type="text" name="city" placeholder="Enter City">
                </div>
                <div class="input-box">
                    <label for="state">State</label>
                    <input type="text" name="state" placeholder="Enter State">
                </div>
                <div class="input-box">
                    <label for="postcode">PostCode</label>
                    <input type="text" name="postcode" placeholder="Enter Postcode">
                </div>
                <div class="input-box">
                    <label for="country">Country</label>
                    <input type="text" name="Country" value="Malaysia" disabled>
                </div>

                <div class="button-add">
                    <button>Add Address</button>
                </div>
            </div>
         </form>
    </div>
</body>
</html>