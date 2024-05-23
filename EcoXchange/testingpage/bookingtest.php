<?php

include('../includes/fetchUserData.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<form action="booksystem.php" method="post" enctype="multipart/form-data">
  <!-- Add hidden field for cust_ID -->
  <input type="hidden" name="cust_ID" value="<?php echo $id; ?>">

  <table border="0">
    <tr>
      <th colspan="3">
        <h2>Book vehicle to recycle</h2>
      </th>
    </tr>
    <tr>
      <td colspan="3">
        <div class="lbladdrs">
          <i class="fa fa-map-marker" aria-hidden="true"></i>
          <span class="booklabel">Pick Up Address</span>
        </div>
        <div class="inpbox addr">
          <input type="text" name="txtAddress" class="txtAddress" placeholder="Name_Phone_Home" required>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="lbladdrs">
          <span class="booklabel">Type of Vehicles</span>
        </div>
        <select name="vehicle" class="inpbox" required>
          <option value="Motorcycle">Motorcycle</option>
          <option value="Car">Car</option>
          <option value="Truck">Lorry</option>
        </select>
      </td>
      <td rowspan="2"></td>
      <td rowspan="2">
        <button type="submit" class="btnCont" id="btnCont">Continue</button>
      </td>
    </tr>
    <tr>
      <td>
        <div class="lbladdrs">
          <span class="booklabel">Pick Up Time</span>
        </div>
        <select name="pickup" class="inpbox" required>
          <option value="Immediately">Immediately</option>
          <option value="30m">Pickup in 30 minutes</option>
          <option value="1h">Pickup in 1 hour</option>
        </select>
      </td>
    </tr>
  </table>

  <h2>Pay Deposit</h2>
  <table border="0">
    <tr>
      <td>
        <div class="paymentbox">
          <label for="avatar">Prove of payment</label>
          <div class="inpbox">
            <input class="inpfile" type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" required>
            <i class="fa fa-download" aria-hidden="true"></i>
          </div>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <p>The deposit will be refunded with rewards after the items are successfully collected</p>
      </td>
    </tr>
    <tr>
      <td>
        <input type="checkbox" id="agreement1" name="agreement1" value="Agree1" required>
        <label class="agree" for="agreement1">I agree that the receipt uploaded is true</label><br>
        <input type="checkbox" id="agreement2" name="agreement2" value="Agree2" required>
        <label class="agree" for="agreement2">I agree that if I cancel my booking, I will not receive my deposit</label><br>
      </td>
    </tr>
    <tr>
      <td>
        <input type="submit" name="submit" value="Submit" class="btn" id="btnSubmit">
      </td>
    </tr>
  </table>
</form>
</body>
</html>
