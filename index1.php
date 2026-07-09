<?php ob_start(); ?>
<!DOCTYPE html>
<html> 
<head>
    <!-- Page Title -->
    <title>Travelafric.com</title>
    <?php include 'template/head.html'; ?>    
    <style type="text/css">
        .autocomplete-suggestions{background:#fff;padding:1px;overflow:hidden;border:1px #ccc solid;   }
        .autocomplete-suggestion{padding:5px 10px; }
        .autocomplete-suggestion:hover{background:#f1f1f1;cursor:pointer;  }
        
    </style>
     <!-- Theme Styles -->
     <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Main Style -->
    <link id="main-style" rel="stylesheet" href="css/style.css">
    <!-- Responsive Styles -->
    <link rel="stylesheet" href="css/responsive.css">
</head>
<body>
<body class="coming-soon-page style1 body-blank">
    <div id="page-wrapper" class="wrapper-blank">
        <div class="wrapper">
            <section id="content">
                <div class="container">
                    <div id="main">
                        <h1 class="logo navbar-brand">
                            <a href="index.php" title="Travelafric.com-Home">
                                <img src="res/images/logo3.png" height="50" width="156" alt=""/>
                            </a>
                        </h1>
                        <div class="text-center yellow-color box" style="font-size: 4em; font-weight: 300; line-height: 1em;">We’ll be <i>live</i> soon!</div>
                        <p class="light-blue-color block" style="font-size: 1.3333em;">We are currently getting on portal ready for you!</p>
                        <div class="col-sm-8 col-md-6 col-lg-5 no-float no-padding center-block">
                            <ul class="clock block clearfix">
                                <li>
                                    <span class="remaining-days">07</span>
                                    <label>Days</label>
                                </li>
                                <li class="sep">:</li>
                                <li>
                                    <span class="remaining-hours">12</span>
                                    <label>hours</label>
                                </li>
                                <li class="sep">:</li>
                                <li>
                                    <span class="remaining-minutes">60</span>
                                    <label>minutes</label>
                                </li>
                                <li class="sep">:</li>
                                <li>
                                    <span class="remaining-seconds">60</span>
                                    <label>seconds</label>
                                </li>
                            </ul>
                            <form class="block">
                                <div class="with-icon email-notify input-large full-width">
                                    <input type="text" class="input-text full-width input-large" placeholder="enter your email to get notified">
                                    <button class="icon"><i class="soap-icon-check"></i></button>
                                </div>
                            </form>
                            <ul class="social-icons clearfix inline-block box">
                                <li><a href="#" title="Twitter" data-toggle="tooltip"><i class="soap-icon-twitter"></i></a></li>
                                <li><a href="#" title="GooglePlus" data-toggle="tooltip"><i class="soap-icon-googleplus"></i></a></li>
                                <li><a href="#" title="Facebook" data-toggle="tooltip"><i class="soap-icon-facebook"></i></a></li>
                                <li><a href="#" title="Linkedin" data-toggle="tooltip"><i class="soap-icon-linkedin"></i></a></li>
                                <li><a href="#" title="Vimeo" data-toggle="tooltip"><i class="soap-icon-vimeo"></i></a></li>
                                <li><a href="#" title="Dribble" data-toggle="tooltip"><i class="soap-icon-dribble"></i></a></li>
                                <li><a href="#" title="Flickr" data-toggle="tooltip"><i class="soap-icon-flickr"></i></a></li>
                            </ul>
                            <div class="copyright">
                                <p>&copy; 2024 Travelafric</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
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
    
    <!-- parallax -->
    <script type="text/javascript" src="js/jquery.stellar.min.js"></script>
    
    <!-- waypoint -->
    <script type="text/javascript" src="js/waypoints.min.js"></script>

    <!-- load page Javascript -->
    <script type="text/javascript" src="js/theme-scripts.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>

    <script type="text/javascript">
        function cacluateLaunchTime() {
            var launchDateStr = "2024/10/01 00:00:00"; // timezone must be UTC + 0
            var launchDate = new Date(launchDateStr);
            launchDate.setTime( launchDate.getTime() - launchDate.getTimezoneOffset()*60*1000 );
            
            var currentDate = new Date();
            var diff = new Date(launchDate.getTime() - currentDate.getTime());
            
            if (diff > 0) {
                var milliseconds, seconds, minutes, hours, days;
                diff = Math.abs(diff);
                diff = (diff - (milliseconds = diff % 1000)) / 1000;
                diff = (diff - (seconds = diff % 60)) / 60;
                diff = (diff - (minutes = diff % 60)) / 60;
                days = (diff - (hours = diff % 24)) / 24;
                tjq(".clock .remaining-days").html((days + "").lpad("0", 2));
                tjq(".clock .remaining-hours").html((hours + "").lpad("0", 2));
                tjq(".clock .remaining-minutes").html((minutes + "").lpad("0", 2));
                tjq(".clock .remaining-seconds").html((seconds + "").lpad("0", 2));
            }
        }
        var calcLaunchTimeInterval = setInterval(cacluateLaunchTime, 1000);
    </script>
</body>
</body>
</html>

