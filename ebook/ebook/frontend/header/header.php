<?php

session_start();
error_reporting(0);
?>


<style>
    html,body{
        overflow-x: hidden;
    }
</style>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<div class="site-wrapper" id="top">
    <div class="site-header header-2 mb--20 d-none d-lg-block">
        <div class="header-middle pt--10 pb--10">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3">
                        <a href="./index.php" class="site-brand">
                            <h3><i class="fa fa-book" aria-hidden="true"></i> BookTopia</h3>
                            <!-- <img src="image/logo.png" alt=""> -->
                        </a>
                    </div>
                    <div class="col-lg-5">
                        <div class="header-search-block">
                            <br>
                            <form action="./index.php" method="GET">
                                <?php

                                $search = "";
                                if (isset($_GET['search'])) {
                                    $search = $_REQUEST['search'];
                                }


                                ?>
                                <input type="text" name="search" value="<?php echo $search; ?>" placeholder="Search entire store here">
                                <button style="margin-top:25px;" class="search_btn">Search</button>
                                                                
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-4" style="float:right;">
                        <div class="main-navigation flex-lg-right">
                            <ul class="main-menu menu-right main-menu--white li-last-0">
                                
                                <li class="menu-item">
                                    <a href="./top-books.php" class="text-success">TOP</a>
                                </li>

                                <?php

                                if (isset($_SESSION['user_id'])) {

                                ?>

                                    <li class="menu-item">
                                        <a href="./favorite-books.php" class="text-success">FAV</a>                                        
                                    </li>

                                    <li class="menu-item">
                                        <a href="./dashboard/" class="text-success">Dashboard</a>
                                    </li>

                                    <li class="menu-item">
                                        <a href="./logout.php" class="text-danger">Logout</a>
                                    </li>

                                <?php


                                } else {




                                ?>


                                    <li class="menu-item">
                                        <a href="./login.php" class="text-success">Login</a>
                                    </li>

                                    <li class="menu-item">
                                        <a href="./register.php" class="text-success">Register</a>
                                    </li>



                                <?php

                                }

                                ?>



                                <!--                                    
                                    <li class="menu-item">
                                        <a href="contact.html" class="text-success">Contact</a>
                                    </li> -->
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="site-mobile-menu">
        <header class="mobile-header d-block d-lg-none pt--10 pb-md--10">
            <div class="container">
                <div class="row align-items-sm-end align-items-center">
                    <div class="col-md-4 col-7">
                        <a href="index.html" class="site-brand">
                            <img src="image/logo.png" alt="">
                        </a>
                    </div>

                    <div class="col-md-3 col-5  order-md-3 text-right">
                        <div class="mobile-header-btns header-top-widget">
                            <ul class="header-links">
                                <li class="sin-link">
                                    <a href="cart.html" class="cart-link link-icon"><i class="ion-bag"></i></a>
                                </li>
                                <li class="sin-link">
                                    <a href="javascript:" class="link-icon hamburgur-icon off-canvas-btn"><i class="ion-navicon"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!--Off Canvas Navigation Start-->
        <aside class="off-canvas-wrapper">
            <div class="btn-close-off-canvas">
                <i class="ion-android-close"></i>
            </div>
            <div class="off-canvas-inner">
                <!-- search box start -->
                <div class="search-box offcanvas">
                    <form>
                        <input type="text" placeholder="Search Here">
                        <button class="search-btn"><i class="ion-ios-search-strong"></i></button>
                    </form>
                </div>
                <!-- search box end -->
                <!-- mobile menu start -->
                <div class="mobile-navigation">
                    <!-- mobile menu navigation start -->
                    <nav class="off-canvas-nav">
                        <ul class="mobile-menu main-mobile-menu">
                            <li class="menu-item-has-children">
                                <a href="#">Home</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">TOP Books</a>
                            </li>


                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                    </nav>

                </div>

                <div class="off-canvas-bottom">
                    <div class="contact-list mb--10">
                        <a href="#" class="sin-contact"><i class="fas fa-mobile-alt"></i>(12345) 78790220</a>
                        <a href="#" class="sin-contact"><i class="fas fa-envelope"></i>examle@handart.com</a>
                    </div>
                    <div class="off-canvas-social">
                        <a href="#" class="single-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="single-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="single-icon"><i class="fas fa-rss"></i></a>
                        <a href="#" class="single-icon"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="single-icon"><i class="fab fa-google-plus-g"></i></a>
                        <a href="#" class="single-icon"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </aside>
    </div>

</div>