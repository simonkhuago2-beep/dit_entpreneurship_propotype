<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Travelafric.com</title>
    <?php require 'template/head.html'; ?>
</head>
<body class="soap-login-page style1 body-blank">
    <div id="page-wrapper" class="wrapper-blank">
        <?php include "cctech-admin/core/init.php"; ?>
        <section id="content">
            <div class="container">
                <div id="main">
                    <h1 class="logo block">
                        <a href="index.php" title="Travelafric - home">
                            <img src="res/images/logo3.png" alt="Travelafric.com" />
                        </a>
                    </h1>
                    <div class="text-center yellow-color box" style="font-size: 4em; font-weight: 300; line-height: 1em;">Welcome!</div>
                    <p class="light-blue-color block" style="font-size: 1.3333em;">Please login to your account.</p>
                    <div class="col-sm-8 col-md-6 col-lg-5 no-float no-padding center-block">
                        <!-- <div class="alert alert-info">
                            Error: First name, Last name, Email fields are required<br>Error: Invalid email address <span class="close"></span>
                        </div> -->
                        <?php
                            if(Input::exists()){
                                $client = new Client();
                                $remember = Input::get('remember') ;
                                $isActive = find_by_email('clients',Input::get('username-login') );
                                $email = Input::get('username-login');
                                if($isActive->activate == 1){
                                    $login = $client->login(Input::get('username-login'), Input::get('password-login'), $remember);
                                    if($login){
                                        $date = make_date();
                                        DB::getInstance()->query("UPDATE clients SET last_login='$date' WHERE email='$email' LIMIT 1 ");
                                        if ($client->data()->groups == 4) {Redirect::to('hotels/home.php');}
                                        elseif ($client->data()->groups == 2) {Redirect::to('dashboard.php'); }
                                    }else{ 
                                      Session::flash('failed', 'Authentication Failed.');
                                      Redirect::to('login.php');
                                    }
                                }elseif($isActive->activate == 0){
                                    Session::flash('inactive', 'Your account is not active.<br> Please contact System Administrator');
                                    Redirect::to('login.php');
                                }
                            }
                        ?>
                        <?php
                            if(Session::exists('failed')){ ?>
                            <div class="alert alert-danger"> Failed! <?php echo Session::flash("failed")?> <span class="close"></span></div>
                        <?php } 
                            if(Session::exists('inactive')){ ?>
                            <div class="alert alert-info">Inactive! <?php echo Session::flash("inactive")?> <span class="close"></span></div>
                        <?php } 
                            if(Session::exists('msg')){ ?>
                            <div class="alert alert-notice"> <!-- Heads up!  --><?php echo Session::flash("msg")?> <span class="close"></span></div>
                        <?php } ?>
                        <form class="login-form" action="" method="post">
                            <div class="form-group">
                                <input type="email" name="username-login" class="input-text input-large full-width" placeholder="enter your email or username">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password-login" class="input-text input-large full-width" placeholder="enter your password">
                            </div>
                            <div class="form-group">
                                <label class="checkbox">
                                    <input type="checkbox" value="" name="remember">remember my details
                                </label>
                            </div>
                            <button type="submit" class="btn-large full-width sky-blue1">LOGIN TO YOUR ACCOUNT</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <footer id="footer">
            <div class="footer-wrapper">
                <div class="container">
                    <nav id="main-menu" role="navigation" class="inline-block hidden-mobile">
                        <ul class="menu">
                            <li class="menu-item-has-children">
							<a href="index.php" title="Homepage">Home</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="hotel-index.php" title="Book Room">Hotels</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="index.php#cars-tab" title="Book Transfers">Transfers</a>
                            <li class="menu-item-has-children">
                                <a href="index.php#cruises-tab" title="Book Sightseeing Package">Sightseeing</a>
                            <li class="menu-item-has-children">
                                <a href="index.php#packages-tab" title="Book Vacation/Tour">Packages</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="events-list.php" title="Book Event Tickets">Events</a>
                            <li class="menu-item-has-children">
                                <a href="index.php" title="Deals and Promos">Deals</a>
							</li>    
                        </ul>
                    </nav>
                    <div class="copyright">
                        <p>&copy; 2016 Travelafric.com</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Javascript -->
    <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.noconflict.js"></script>
    <script type="text/javascript" src="js/modernizr.2.7.1.min.js"></script>
    <script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.placeholder.js"></script>
    <script type="text/javascript" src="js/jquery-ui.1.10.4.min.js"></script>
    
    <!-- Twitter Bootstrap -->
    <script type="text/javascript" src="js/bootstrap.js"></script>
    
    <script type="text/javascript">
        var enableChaser = 0;
    </script>
    <!-- parallax -->
    <script type="text/javascript" src="js/jquery.stellar.min.js"></script>
    
    <!-- waypoint -->
    <script type="text/javascript" src="js/waypoints.min.js"></script>

    <!-- load page Javascript -->
    <script type="text/javascript" src="js/theme-scripts.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
    
</body>
</html>

