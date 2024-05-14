<!-- Title : EcoXchange : Waste Collection and Recycling system 
     Date : 6/4/2024
     Programmer : Melissa 

     Page : LOG IN PAGE

     
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExcoXchange</title>
    <!-- ++++++++ CSS ++++++++-->
    <link rel="stylesheet" href="../style/login.css">
    <!-- ++++++++ ICONS ++++++++-->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet"/>
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
                        <a href="../index.html" >Home</a>
                    </li>
                    <li>
                        <a href="../index.html">About</a>
                    </li>
                    <li>
                        <a href="../index.html">FAQ</a>
                    </li>
                    <li>
                        <a href="../pages/groupMembers.html">Developer</a>
                    </li>
                </ul>
                <div class="login-signup">
                    <a href="login.php" class="actives">LogIn</a>  
                    <a href="signup.php">SignUp</a>
                </div>
            </nav>
        </div>
        <div class="header-right">
            <div class="login-signup">
                <a href="login.php" class="actives">LogIn</a>  
                <a href="signup.php">SignUp</a>
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
                        
                        <form name="form" method="post" action="../includes/loginSession.php">
                            <h3>Log In</h3>
                            <div class="logbox">
                                <i class="fa fa-user" aria-hidden="true" ></i>
                                <div class="linebox"></div>
                                <input name="username" type="text" id="username" placeholder="Username" class="inputbox">
                               
                            </div>
                            
                            <div class="logbox" >
                                <i class="fa fa-lock" aria-hidden="true" ></i></i>
                                <div class="linebox"></div>
                                <input name="password" type="password" id="password" placeholder="Password" class="inputbox">
                                
                            </div>
                            
                            <input type="submit" name="Submit" value="Login" class="btnLogin">
                        </form>
                        <span >Not registered? <a href="signup.php" class="btnLink">Create an account</a></span>
                    </div>
                </div>
            </div>
        </div>
      </section>

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
    <script>
        hamburger = document.querySelector(".hamburger");
        nav = document.querySelector(".header-left nav");
        hamburger.onclick = function() {
            nav.classList.toggle("active");
        }
    </script>
</body>
</html>