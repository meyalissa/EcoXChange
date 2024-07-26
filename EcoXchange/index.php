<!-- Title : EcoXchange : Waste Collection and Recycling system 
     Date : 6/4/2024
     Programmer : Melissa Sofia sdsds

     Page : HOME PAGE
     
    
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExcoXchange</title>
    <!-- ++++++++ CSS ++++++++-->
    <link rel="stylesheet" href="style/style.css">
    <!-- ++++++++ ICONS ++++++++-->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="images/logo.png" />
    
</head>
<body>
    <header>
        <div class="header-left">
            <div class="logo">
                <img src="images/logo.png" class="nav_img_logo" alt="">
            </div>
            <nav>
                <ul>
                    <li>
                        <a href="index.php" class="active">Home</a>
                    </li>
                    <li>
                        <a href="#about">About</a>
                    </li>
                    <li>
                      <a href="#team">Our Team</a>
                    </li>
                    <li>
                        <a href="#faq">FAQ</a>
                    </li>
                </ul>
                <div class="login-signup">
                    <a href="pages/Login.php">Log In</a>  
                    <a href="pages/signup.php">Sign Up</a>
                </div>
            </nav>
        </div>
        <div class="header-right">
            <div class="login-signup">
                <a href="pages/Login.php">Log In</a>  
                <a href="pages/signup.php">Sign Up</a>
            </div>
            <!-- Navigation Icon -->
            <div class="hamburger">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </header>
    <!-- ++++++++ GREETING PAGE ++++++++-->
    <section class="home" id="home">
        <div class="home-container">
         <!-- /* LEFT SIDE */ -->
          <div class="home-text">
            <span class="home-greet"> Hello, Welcome To</span>
            <a href=""><img src="images/EcoXchange.png" class="EcoXchange"/></a>
            <span class="home-system">Waste Collection &<br> Recycling System</br></span>
            <a href="pages/Login.php" class="button-gs">Get Started</a>
          </div>
        </div>
        <!-- /* RIGHT SIDE */ -->
        <div class="home-img">
          <img src="images/homeimg.png" alt="" class="greenimg">
        </div>
      </section>

      <!-- ++++++++ ABOUT PAGE ++++++++-->
      <section class="about" id="about">
        <div class="about-container">
            <div class="about-img">
              <img src="images/scdpageimg.png" alt="" class="secondimg">
            </div>
            <div class="about-text">
                <span class="home-system">Get Paid To Recycle!</span>
                <br>
                <span class="home-greet"> We offer FREE pickup from your address and pay you upon collection. Wasted items trade-in & recycling made easy & rewarding.</span>
                <a href="pages/Login.php" class="button-gs">I want to recycle</a>
            </div>
        </div>
      </section>
      <!-- ++++++++ OURTEAM ++++++++-->
      <section class="team" id="team">
            <div class="team-container">
                <span class="home-system">Our Team</span>
                <div class="row">
                    <div class="team-col">
                        <img src="images/Melissa.png" alt="" class="profileImg" />
                        <h3 class="role">Team Leader</h3>
                        <p class="name">Melissa Sofia Binti Shahran</p>
                    </div>
                    <div class="team-col">
                        <img src="images/Irdina.png" alt="" class="profileImg" />
                        <h3 class="role">Database Designer</h3>
                        <p class="name">Nur Irdina Iman Binti Abd. Ghafar</p>
                    </div>
                    <div class="team-col">
                        <img src="images/Farah.png" alt="" class="profileImg" />
                        <h3 class="role">Front-End Developer</h3>
                        <p class="name">Farah Adibah Binti Mustafa Kafal</p>
                    </div>
                    <div class="team-col">
                        <img src="images/Syuhada.png" alt="" class="profileImg" />
                        <h3 class="role">Back-End Developer</h3>
                        <p class="name">Siti Nursyuhada Binti Mohamad Yusof</p>
                    </div>
                </div>
            </div>
        </section>
      <!-- ++++++++ FAQ ++++++++-->
      <section class="faq" id="faq">
        <div class="faq-container">
            <div class="faq-text">
                <h1 class=txttitle>Frequently Asked Question (FAQ)</h1>
                <div class="faq-text">
                    <div class="button-faq">
                        <img src="images/lampfaq.png" alt="" class="faq-lamp">
                        <span class="faq-text" > What is EcoXchange?</span>
                        <img src="images/scrolldown.png" alt="" class="faq-icon">
                        <i></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            EcoXchange is a system where consumers may recycle everything they want to without worrying about transportation because our runner will pick up the recyclables.  
                        </p>
                    </div>
                </div>
                <div class="faq-text">
                    <div class="button-faq">
                        <img src="images/lampfaq.png" alt="" class="faq-lamp">
                        <span class="faq-text" >Do we need to make any payments?</span>
                        <img src="images/scrolldown.png" alt="" class="faq-icon">
                        <i></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                             Yes, but only deposit RM10 when the runner arrives in front of your home. You can receive your RM10 back along with your recycling monetary rewards.
                        </p>
                    </div>
                </div>
                <div class="faq-text">
                    <div class="button-faq">
                        <img src="images/lampfaq.png" alt="" class="faq-lamp">
                        <span class="faq-text" >What type of waste does EcoXchange accept for recycling?</span>
                        <img src="images/scrolldown.png" alt="" class="faq-icon">
                        <i></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            EcoXchange recycles used oil, newspaper, and cardboard to promote sustainability and reduce waste.
                        </p>
                    </div>
                </div>
                <div class="faq-text">
                    <div class="button-faq">
                        <img src="images/lampfaq.png" alt="" class="faq-lamp">
                        <span class="faq-text" >Can I track the status of my waste?</span>
                        <img src="images/scrolldown.png" alt="" class="faq-icon">
                        <i></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            Certainly! Once our runner picks up your recyclable items, you can track their status, including pending, successfully delivered, or awaiting processing.
                        </p>
                    </div>
                </div>
            </div>
        </div>
      </section>

      <script>
       document.addEventListener("DOMContentLoaded", function() {
        var faqIcons = document.querySelectorAll(".faq .faq-icon");

        faqIcons.forEach(function(icon) {
        icon.addEventListener("click", function() {
            var answer = this.parentElement.nextElementSibling;
            answer.classList.toggle("active");
            });
        });
            });
      </script>
      


      <!-- ++++++++ FOOTER ++++++++-->
      <footer class="footer">
        <div class="footer-container">
          <div>
            <img src="images/uitmlogo.png" class="footer-img uitm"></img>
            <img src="images/logo-white-border.png" class="footer-img"></img>
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
    <script language="JavaScript">
        gsap.from('.greenimg', { opacity: 0, duration: 2, delay: .5, x: 60 })
        // gsap.from('.home-text', { opacity: 0, duration: 2, delay: .5, y: 25 });
        // gsap.from('.home-greet, .EcoXchange, .home-system, .button-gs', { opacity: 0, duration: 2, delay: 1, y: 25, ease: 'expo.out', stagger: .2 });
    </script>
</body>
</html>
