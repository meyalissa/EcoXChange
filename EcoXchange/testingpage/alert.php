<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.alert {
  display: none; /* Initially hide the alert */
  padding: 20px;
  background-color: #f44336;
  color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>
</head>
<body>

<h2>Alert Messages</h2>

<p>Click the button below to show the alert message.</p>
<button onclick="showAlert()">Show Alert</button>

<div id="alertBox" class="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Danger!</strong> Indicates a dangerous or potentially negative action.
</div>

<script>
function showAlert() {
  document.getElementById("alertBox").style.display = "block"; // Show the alert
}
</script>

</body>
</html>
