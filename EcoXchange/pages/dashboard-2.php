<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoXchange | Dashboard</Em></title>
  <!-- ===== BOX ICONS ===== -->
  <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- ======= Styles ====== -->
  <link rel="stylesheet" href="../style/SidebarUser.css">
  <link rel="stylesheet" href="../style/dashboard.css">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li class = "comp-name">
                    <a href="#">
                        <span class="icon">
                            <img src="../images/logo-white-border.png" class="sidebar-logo" />
                        </span>
                        <span class="title">EcoXchange</span>
                    </a>
                </li>
             

                <li class="active" >
                    <a href="dashboard-2.html">
                        <span class="icon">
                            <i class='bx bx-history'></i>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="items-2.html">
                        <span class="icon">
                            <i class='bx bxl-spring-boot'></i>
                        </span>
                        <span class="title">Items</span>
                    </a>
                </li>

                <li>
                    <a href="calculator-2.html">
                        <span class="icon">
                            <i class='bx bxs-calculator'></i>
                        </span>
                        <span class="title">Calculator</span>
                    </a>
                </li>

                <li>
                    <a href="Profile">
                        <span class="icon">
                            <i class='bx bx-user-circle'></i>
                        </span>
                        <span class="title">Profile</span>
                    </a>
                </li>

                <li class="sign-out">
                    <a href="../includes/logout.inc.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                        
                    </label>
                </div>

                <div class="user">
                    <img src="../images/default-profile.png" alt="">
            
                </div>
            </div>
            <div class="content">
                <div clas="nav-title"><h3>Dashboard</h3></div>
                <!-- !!!!!!!!!!CODES HERE!!!!!!!! -->            
                <div class="in-content">
                    <div class="row1">
                        <div class="box1">
                            <p class="topic">Total Rewards</p>
                            <h2 class="values"> 0.00 </h2>
                            <p class="unit">RM</p>
                        </div>
                    </div>
                    <div class="row2">
                        <div class="box1">
                            <p class="topic">Bottle</p>
                            <h2 class="values"> 0 </h2>
                            <p class="unit">KG</p>
                        </div>
                        <div class="box1">
                            <p class="topic">Aluminium Can</p>
                            <h2 class="values"> 0 </h2>
                            <p class="unit">KG</p>
                        </div>
                        <div class="box1">
                            <p class="topic">Used Cooking Oil</p>
                            <h2 class="values"> 0 </h2>
                            <p class="unit">KG</p>
                        </div>
                    </div>
                    <div class="row3">
                        <button class="btnRecycle" id="btnRecycle">
                            Reycle More
                        </button>
<!-- +++++++++++++++ BOOKING FORM +++++++++++++++ -->
<div class="booking-popup" id="booking-popup">
    <div class="box-popup">
        <div class="top-form">
            <div class="close-popup" data-popup="#booking-popup">
                X
            </div>
        </div>
        <div class = "bookingform">
          
          <form action="#">
            <table border="0" >
                <tr>
                    <th colspan="3">
                        <h2>Book vehicle to recycle</h2>
                    </th>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="lbladdrs">
                            <i class="fa fa-map-marker" aria-hidden="true" ></i>
                            <span class="booklabel">Pick Up Address</span>
                        </div>
                        <div class="inpbox addr">
                            <div class="txtname"></div>
                            <div class="txtAddress">
                                
                            </div>
                            <button id="btnChangeAdd" class="btnChangeAdd">Change</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="lbladdrs">
                            <span class="booklabel">Type of Vehicles</span>
                        </div>
                        
                        <select name="vehicle" class="inpbox">
                            <option value="Motorcycle">Motorcycle</option>
                            <option value="Car">Car</option>
                            <option value="Truck">Lorry</option>
                        </select>
                          
                    </td>
                    <td rowspan ="2"><img src="../images/vehiclemotor.png" class="vehicleimg"></td>
                    <td rowspan ="2" >
                        <button type = "button" class = "btnCont" id="btnCont">Continue</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="lbladdrs">
                            <span class="booklabel">Pick Up Time</span>
                        </div>
                        
                        <select name="pickup" class="inpbox">
                            <option value="Immediately">Immediately</option>
                            <option value="30m">Pickup in 30 minutes</option>
                            <option value="1h">Pickup in 1 hour</option>
                        </select>
                    </td>
                </tr>
            </table>
          </form>

        </div>
    </div>
</div>
<!-- +++++++++++++++ CHANGE ADDRESS +++++++++++++++ -->
<div class="changadr-popup" id="changadr-popup">
    <div class="box-popup">
        <div class="top-form">
            <div class="close-popup" data-popup="#changadr-popup">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </div>
        </div>
        <div class = "addrcb">
            <h2>My Address</h2>
            <hr class="adrdivision">
            <form action="#">
              <table border="0" >
                    <!-- REPEAT -->
                    <tr>
                        <td>
                            <input type="checkbox" name="Address" value="Addr1">
                        </td>
                        <td>
                            <div class="addr-info">
                                <h3 class="pic"> Name | Phone Numb</h3>
                                <p class="address"> Home Numb, City, Country , PostCode<p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <hr class="adrdivision">
                        </td>
                    </tr>
                    <!-- REPEAT END-->
                    <!-- REPEAT -->
                    <tr>
                        <td>
                            <input type="checkbox" name="Address" value="Addr1">
                        </td>
                        <td>
                            <div class="addr-info">
                                <h3 class="pic"> Name | Phone Numb</h3>
                                <p class="address"> Home Numb, City, Country , PostCode<p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <hr class="adrdivision">
                        </td>
                    </tr>
                    <!-- REPEAT END-->
              </table>
            </form>
            
            
            
            
        </div>
    </div>
</div>
<!-- +++++++++++++++ PAYMENT +++++++++++++++ -->
<div class="payment-popup" id="payment-popup">
    <div class="box-popup">
        <div class="top-form">
            <div class="close-popup" data-popup="#payment-popup">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </div>
        </div>
        <div class = "paymentform">
            <form action="#">
              <table border="0" >
                    <tr>
                        <th >
                            <h2>Pay Deposit</h2>
                        </th>
                        <td rowspan="4">
                            <img src="../images/Qrcode.png" class="paymentimg">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="paymentbox">
                               <label for="avatar">Prove of payment</label>
                               <div class="inpbox">
    
                                
                                <input class="inpfile" type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" />
                                <i class="fa fa-download" aria-hidden="true"></i>
                               </div>
                               
                            </div>
                        </td>
                        
                    </tr>
                    <tr>
                        <td>
                            <p>The deposit will receive with rewards after the items successfully collected</p>
                        </td>
                       
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="agreement1" name="agreement1" value="Agree1">
                            <label class="agree" for="agreement1"> I agree that the receipt uploaded is true</label><br>
                            <input type="checkbox" id="agreement2" name="agreement2" value="Agree2">
                            <label class="agree" for="agreement2"> I agree that if I cancel my booking, I will not receive my deposit</label><br>
                        </td>
                    </tr>
              </table>
            </form>
        </div>
        <div class="low-form">
            <div class="btnGroup">
                <button type = "button" id="btnCancel" class="btn">Cancel</button>
                <input type="submit" name="submit" value="Submit" class="btn" id="btnSubmit">
            </div>
        </div>
    </div>
</div>



</div> 
</div>
</div>
</div>
</div>

    <!-- =========== Scripts =========  -->
    <script src="../js/main.js"></script>
    <script type="text/javascript">
        $(function() {
            // Function to handle closing popups
            $('.close-popup').click(function() {
                var popupId = $(this).data('popup');
                $(popupId).fadeOut();
            });
    
            // Code for opening popups
            $('#btnRecycle').click(function() {
                $('#booking-popup').fadeIn().css("display", "flex");
            });
    
            $('#btnChangeAdd').click(function() {
                $('#changadr-popup').fadeIn().css("display", "flex");
            });
    
            $('#btnCont').click(function() {
                $('#payment-popup').fadeIn().css("display", "flex");
            });

            $('#btnCancel').click(function() {
                $('#payment-popup').fadeOut();
                $('#booking-popup').fadeOut();
          });
        });
    </script>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>

