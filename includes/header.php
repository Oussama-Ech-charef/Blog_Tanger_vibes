<?php 
 


 // start session if needed
 if (session_status() === PHP_SESSION_NONE) {

    session_start();

 }


?>

<header class="site_header">


        <div class="header_nav_desctop">
                    <!-- logo  -->
                    <a href="../pages/index.php" class="logo">
                        <div class="logo_icon"><i class="fa-solid fa-compass"></i></div> 
                        <span class="logo_text">Tangier <span class="text2">Vibes</span></span>     
                    </a>

                     <!-- links  desctope-->

                    <ul class="nav_links desktop">
                        <li><a href="../pages/index.php" class="nav_link">Home</a></li>
                        <li><a href="../pages/explor.php" class="nav_link">Explore</a></li>
                    </ul>

                   <!-- search desktop -->
                    <div class="search_desctop">
                        <form action="#" class="search_desctop_form">
                            <i class="fa-solid fa-magnifying-glass search_icon"></i>
                            <input type="text" placeholder="Search places...">
                        </form>

                    </div>

                    
                    <!-- auth links -->
                    <div class="auth_actions_desctop">


                            <?php if (isset($_SESSION['id_user'])): ?>

                            <div class="dashboard_logout">
                                <a href="../pages/dashboard.php" class="dashboard">Dashboard</a>
                                <a href="../pages/logout.php" class="logout">Logout</a>
                            </div>
                            <?php else: ?>

                            <div class="login_register">
                                <a href="../pages/login.php" class="login_link">Login</a>
                                <a href="../pages/register.php" class="register_link ">Register</a>
                            </div>

                            <?php endif; ?>
                    </div>
                        <!-- menu open  -->
                    <div class="menu">
                        <button class="menu_btn" id="menu_btn">
                            <i class="fa-solid fa-bars"></i>
                        </button>
                    </div>
                        


        </div>
        <!-- mobile menu -->
        <div class="header_nav_mobile">

                    <!-- close menu  -->
                    <div class="mobile_menu_header">
                        <button class="close_menu" id="close_menu" aria-label="Fermer le menu">
                                    <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>




                    <!-- search mobile -->
                    <div class="search_mobile">
                        <form action="#" class="search_mobile_form">
                            <i class="fa-solid fa-magnifying-glass search_icon"></i>
                            <input type="text" placeholder="Search places...">
                        </form>

                    </div>

                    

                     <!-- links mobile -->

                    <ul class="nav_links mobil">
                        <li><a href="../pages/index.php" class="nav_link">Home</a></li>
                        <li><a href="../pages/explor.php" class="nav_link">Explore</a></li>
                    </ul>





                    <!-- auth links mobile -->
                    <div class="auth_actions_mobil">
                            <?php if (isset($_SESSION['id_user'])): ?>

                            <div class="dashboard_logout">
                                <a href="../pages/dashboard.php" class="dashboard">Dashboard</a>
                                <a href="../pages/logout.php" class="logout">Logout</a>
                            </div>
                            <?php else: ?>


                            <div class="login_register">
                                <a href="../pages/login.php" class="login_link">Login</a>
                                <a href="../pages/register.php" class="register_link ">Register</a>
                            </div>
                            <?php endif; ?>
                           
                    </div>


                    


        </div>

        



</header>
