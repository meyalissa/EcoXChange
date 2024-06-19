<!-- Title : EcoXchange : Waste Collection and Recycling system 
     Date : 6/4/2024
     Programmer : Melissa 

     Page : SIGN UP PAGE
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExcoXchange</title>
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <!-- ++++++++ CSS ++++++++-->
    <link rel="stylesheet" href="../style/signup.css">
    <link rel="stylesheet" href="../style/alert.css">

    <!-- ++++++++ ICONS ++++++++-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="../images/logo.png" />
    
</head>

<body>
    <header>
        <div class="header-left">
            <div class="logo">
                <img src="../images/logo.png" class="nav_img_logo" alt="">
            </div>
            <nav>
                <ul>
                    <li>
                        <a href="../index.php" >Home</a>
                    </li>
                    <li>
                        <a href="../index.php">About</a>
                    </li>
                    <li>
                      <a href="../index.php">Our Team</a>
                    </li>
                    <li>
                        <a href="../index.php">FAQ</a>
                    </li>
                </ul>
                <div class="login-signup">
                    <a href="login.php" >Log In</a>  
                    <a href="signup.php" class="actives">Sign Up</a>
                </div>
            </nav>
        </div>
        <div class="header-right">
            <div class="login-signup">
                <a href="login.php" >Log In</a>  
                <a href="signup.php" class="actives">Sign Up</a>
            </div>
            <!-- Navigation Icon -->
            <div class="hamburger">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </header>
    <!-- ++++++++ MAIN PAGE ++++++++-->
    <section class="main" id="main">
        <div class="main-container"></div>
            <div class="main-top">
                <h2>WELCOME!</h2>
                <p>To EcoXchange Waste Collection & Recycling System</p>
            </div>

            <div class="main-wrap">    
                <div class="main-left">
                    <div class="imglogin">
                        <img src="../images/imglogin.png" class="img">
                    </div>
                </div>
                <div class="main-right">
                    <div class="login-form">
                        
                        <form name="form" method="post" action="../includes/signupSession.php">
                            <h3>Sign Up</h3>
                            <div class="logbox">
                                <i class="fa fa-user" aria-hidden="true" ></i>
                                <div class="linebox"></div>
                                <input name="username" type="text" id="username" placeholder="Username" class="inputbox" required>
                               
                            </div>
                            
                            <div class="logbox" >
                                <i class="fa fa-envelope" aria-hidden="true" ></i></i>
                                <div class="linebox"></div>
                                <input name="email" type="email" id="email" placeholder="Email Address" class="inputbox" required>
                                
                            </div>

                             
                            <div class="logbox" >
                                <i class="fa fa-lock" aria-hidden="true" ></i></i>
                                <div class="linebox"></div>
                                <input name="password" type="password" id="password" placeholder="Create Password" class="inputbox password" required>
                                
                            </div>

                             
                            <div class="logbox" >
                                <i class="fa fa-lock" aria-hidden="true" ></i></i>
                                <div class="linebox"></div>
                                <input name="password2" type="password" id="password2" placeholder="Confirm Password" class="inputbox"required>
                                
                            </div>
                            
                            <input type="submit" name="submit" value="Sign Up" class="btnSignup">
                        </form>
                        <span >Already a member?<a href="login.php" class="btnLink"> Login</a></span>
                    </div>
                </div>
            </div>
        </div>
      </section>
      <?php

      if(isset($_GET["error"])) {
        if($_GET["error"] == "emptyinput") {
          echo '
          <div class="alert_wrapper active1">
          <div class="alert_backdrop"></div>
          <div class="alert_inner">
            <div class="alert_item alert_error">
              <div class="icon data_icon">
                <i class="bx bxs-x-circle"></i>
              </div>
              <div class="data">
                <p class="title"><span>Error:</span>
                  User action error
                </p>
                <p class="sub">Fill all the required fields!</p>
              </div>
              <div class="icon close">
                <i class="bx bx-x" ></i>
              </div>
            </div>
          </div>
        </div>
          ';
        }
        else if($_GET["error"] == "invalidusername"){
          echo '
          <div class="alert_wrapper active1">
          <div class="alert_backdrop"></div>
          <div class="alert_inner">
            <div class="alert_item alert_error">
              <div class="icon data_icon">
              <i class="bx bxs-x-circle" ></i>
              </div>
              <div class="data">
                <p class="title"><span>Error:</span>
                  User action error
                </p>
                <p class="sub">Invalid Username!</p>
              </div>
              <div class="icon close">
                <i class="bx bx-x" ></i>
              </div>
            </div>
          </div>
        </div>
          ';
        }
        else if($_GET["error"] == "invalidemail"){
          echo '
          <div class="alert_wrapper active1">
          <div class="alert_backdrop"></div>
          <div class="alert_inner">
            <div class="alert_item alert_error">
              <div class="icon data_icon">
              <i class="bx bxs-x-circle" ></i>
              </div>
              <div class="data">
                <p class="title"><span>Error:</span>
                  User action error
                </p>
                <p class="sub">Invalid Email!</p>
              </div>
              <div class="icon close">
                <i class="bx bx-x" ></i>
              </div>
            </div>
          </div>
        </div>
          ';
        }
        else if($_GET["error"] == "passwordsdontmatch"){
          echo '
          <div class="alert_wrapper active1">
          <div class="alert_backdrop"></div>
          <div class="alert_inner">
            <div class="alert_item alert_error">
              <div class="icon data_icon">
              <i class="bx bxs-x-circle" ></i>
              </div>
              <div class="data">
                <p class="title"><span>Error:</span>
                  User action error
                </p>
                <p class="sub">Password does not match!</p>
              </div>
              <div class="icon close">
                <i class="bx bx-x" ></i>
              </div>
            </div>
          </div>
        </div>
          ';
        }
        else if($_GET["error"] == "usernametaken"){
          echo '
          <div class="alert_wrapper active1">
          <div class="alert_backdrop"></div>
          <div class="alert_inner">
            <div class="alert_item alert_error">
              <div class="icon data_icon">
              <i class="bx bxs-x-circle" ></i>
              </div>
              <div class="data">
                <p class="title"><span>Error:</span>
                  User action error
                </p>
                <p class="sub">Ops sorry, but this username has already been taken!</p>
              </div>
              <div class="icon close">
                <i class="bx bx-x" ></i>
              </div>
            </div>
          </div>
        </div>
          ';
        }
        else if($_GET["error"] == "stmtfailed"){
          echo '
          <div class="alert_wrapper active1">
          <div class="alert_backdrop"></div>
          <div class="alert_inner">
            <div class="alert_item alert_error">
              <div class="icon data_icon">
              <i class="bx bxs-x-circle" ></i>
              </div>
              <div class="data">
                <p class="title"><span>Error:</span>
                  User action error
                </p>
                <p class="sub">Something when wrong. Try again!</p>
              </div>
              <div class="icon close">
                <i class="bx bx-x" ></i>
              </div>
            </div>
          </div>
        </div>
          ';
        }
        else if($_GET["error"] == "none"){
          echo '
          <div class="alert_wrapper active1">
          <div class="alert_backdrop"></div>
          <div class="alert_inner">
            <div class="alert_item alert_success">
              <div class="icon data_icon">
                <i class="bx bxs-check-circle" ></i>
              </div>
              <div class="data">
                <p class="title"><span>Success:</span>
                  User action success
                </p>
                <p class="sub">you have successfully Sign Up.</p>
              </div>
              <div class="icon close">
                <i class="bx bx-x" ></i>
              </div>
            </div>
          </div>
        </div>
          ';
        }
      }

      ?>
    <!-- ++++++++ FOOTER ++++++++-->
    <footer class="footer">
        <div class="footer-container">
          <div>
            <img src="../images/uitmlogo.png" class="footer-img uitm"></img>
            <img src="../images/logo-white-border.png" class="footer-img"></img>
          </div>
          
          <p class="footer-quotes">"Be a recycler, be a saver"</p>
  
          <p class="footer-slogan">&#169; ExoXChange. Reuse, Reduce, Recycle.</p>
        </div>
      </footer>

    <!-- ++++++++ JavaScript ++++++++-->
    <script>
        hamburger = document.querySelector(".hamburger");
        nav = document.querySelector(".header-left nav");
        hamburger.onclick = function() {
            nav.classList.toggle("active");
        }
    </script>
    <script src="../js/alert-notification.js"></script>
</body>
</html>