<?php include "cctech-admin/core/init.php"; 
error_reporting(0);
    $conn = DB::getInstance();
    $client = new Client();
    $_SESSION['cart']= isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    $cartItems = 0; foreach ($_SESSION['cart'] as $item) {$cartItems ++;}
?>

<header id="header" class="navbar-static-top">
            <div class="topnav hidden-xs">
                <div class="container">
                    <ul class="quick-menu pull-left">
                        <li><a href="dashboard">MY ACCOUNT</a> </li>
                        <li class="ribbon">
                            <a href="#">English</a>
                            <ul class="menu mini">
                                <li class="active"><a href="#" title="English">English</a></li>
                            </ul>
                        </li>
                    </ul>
                    
                    <ul class="quick-menu pull-right">
                        <li><a href="cart" class="button yellow btn-small"><i class="fa fa-shopping-cart"></i> <?php echo $cartItems; ?></a></li>
                        <?php if($_SESSION['isLoggedin'] ) { ?>
                        <li><a href="logout">LOGOUT</a></li>
                        <?php }else{?>
                        <li><a href="dashboard">LOGIN</a></li>
                        <?php } ?>
                        <li><a href="signup">SIGNUP</a></li>
                        
                        <li class="ribbon currency menu-color-skin">
                            <a href="#">Currency</a>
                            <ul class="menu mini">
                                <li><a href="#" data-currency="USD" title="US Dollar" onclick="changeCurrency('USD')">US Dollar</a></li>
                                <li><a href="#" data-currency="EUR" title="Euro" onclick="changeCurrency('EUR')">Euro</a></li>
                                <li><a href="#" data-currency="GBP" title="British Pound" onclick="changeCurrency('NGNGBP')">British Pound</a></li>
                                <li><a href="#" data-currency="ZAR" title="South African Rand" onclick="changeCurrency('ZAR')">South Afrcan Rand</a></li>
                            </ul>
                        </li>
                        <li><a href="retrieve-booking">Retrieve Booking</a></li>
                        <li><a href="retrieve-booking"><i class='soap-icon-user'></i></a></li>
                    </ul>
                </div>
            </div>
            
            <div class="main-header">
                <a href="#mobile-menu-01" data-toggle="collapse" class="mobile-menu-toggle collapsed">
                    <i class="fa fa-bars"></i>
                </a>

                <div class="container">
                <style>
                .mobile-logo { display: none; }
                .desktop-logo { display: block; }
                
                @media (max-width: 768px) {
                  .mobile-logo { display: block; }
                  .desktop-logo { display: none; }
                  
                  /* Fix: Moves "TravelAfric.com" text higher up */
                  .logo-text-mobile {
                    position: absolute; 
                    top: 50% !important; 
                    left: 50%; 
                    transform: translate(-50%, -50%); 
                    z-index: 1; 
                    font-family: 'Montserrat', sans-serif; 
                    margin: 0;
                    white-space: nowrap;
                  }
                }

                /* UPDATED CLOSE BUTTON: Black by default, Blue on hover */
                .mobile-menu-close {
                    position: absolute;
                    top: 15px;
                    right: 15px;
                    background: transparent !important; 
                    border: none;
                    font-size: 30px; 
                    font-weight: bold;
                    cursor: pointer;
                    color: #000000 !important; /* Black color */
                    z-index: 9999;
                    padding: 5px;
                    line-height: 0.5;
                    display: none !important;
                    transition: color 0.2s ease;
                }
                
                .mobile-menu-close:hover {
                    color: #007bff !important; /* Blue color on hover */
                    text-decoration: none;
                }

                #mobile-menu-01.in .mobile-menu-close {
                    display: block !important;
                }

                .mobile-menu-toggle:not(.collapsed) {
                    display: none !important;
                }
                </style>
                
                    <h1 class="logo navbar-brand">
                        <a href="https://www.travelafric.com" title="Travelafric.com-Home">
                            <img src="res/images/travlogo.png" height="50" width="156" alt="Main Logo" class="mobile-logo" style="z-index: 1; vertical-align: middle;">
                            <img src="res/images/logo3.png" height="50" width="156" alt="Secondary Logo" class="desktop-logo" style="z-index: 1; vertical-align: middle;">
                            <p class="mobile-logo logo-text-mobile">TravelAfric.com</p>
                        </a>
                    </h1>
                
                <nav id="main-menu" role="navigation">
                    <ul class="menu">
                        <li class="menu-item-has-children"><a href="https://www.travelafric.com" title="Homepage">Home</a></li>
                        <li class="menu-item-has-children"><a href="hotel-index" title="Book Room">Accommodation</a></li>
                        <li class="menu-item-has-children"><a href="car-home" title="Book Transfers">Rentals/Transfers</a></li>
                        <li class="menu-item-has-children"><a href="cruise-home" title="Book Sightseeing Package">Day Trips</a></li>
                        <li class="menu-item-has-children"><a href="tour-home" title="Book Vacation/Tour">All-Inclusive Tours</a></li>
                        <li class="menu-item-has-children"><a href="events-list" title="Book Sightseeing Package">Events</a></li>
                        <li class="menu-item-has-children"><a href="tour-guide-list-view" title="Book a Tour Guide">Tour Guide</a></li>
                        <li class="menu-item-has-children"><a href="travel-guide" title="Get Travel Advice">Travel Guide</a>
                            <ul>
                                <li><a href="travel-guide">Country-Guide</a></li>
                                <li><a href="things-to-do-options">Things To Do</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                </div>

                <nav id="mobile-menu-01" class="mobile-menu collapse">
                    <button class="mobile-menu-close" onclick="closeMobileMenu()">&times;</button>
                    
                    <ul id="mobile-primary-menu" class="menu"></ul>
                    
                    <ul class="mobile-topnav container">
                        <li><a href="dashboard">MY ACCOUNT</a></li>
                        <li><a href="login">LOGIN</a></li>
                        <li><a href="signup">SIGNUP</a></li>
                        <li class="ribbon currency menu-color-skin">
                            <a href="#">USD</a>
                            <ul class="menu mini">
                                <li><a href="#" title="AUD">AUD</a></li>
                                <li><a href="#" title="BRL">EUR</a></li>
                                <li class="active"><a href="#" title="USD">USD</a></li>
                            </ul>
                        </li>
                        <li><a href="cart" class="button yellow btn-small"><i class="fa fa-shopping-cart"></i> <?php echo $cartItems; ?></a></li>
                    </ul>
                </nav>
            </div>
            
            <div class="main-header">
                <nav id="mobile-menu-02" class="mobile-menu" style="font-size:20px">
                    <ul id="mobile-primary-menu" class="menu"></ul>
                    <ul class="mobile-topnav container scrollable-menu" style="background-color:#F0FFFF">
                            <li class="menu-item-has-children">
                                <a href="hotel-index" title="Book Room" style="color: #0000CC;"><i class="soap-icon-hotel-1 circle" style="margin-right:10px"></i>Accommdation</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="car-home" title="Book Transfers" style="color: #0000CC;"> <i class="soap-icon-car-1 circle" style="margin-right:10px"></i>Transfers/Rent-A-Car</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="cruise-home" title="Book Sightseeing Package" style="color: #0000CC;"><i class="soap-icon-beach circle" style="margin-right:10px"></i>Day Trips</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="tour-home" title="Book Vacation/Tour" style="color: #0000CC;"><i class="soap-icon-trunk-1 circle" style="margin-right:10px"></i>Complete Packages</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="tour-guide-list-view" title="Book a Tour Guide" style="color: #0000CC;"><i class="soap-icon-man-3 circle" style="margin-right:10px"></i>Tour Guide</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="travel-guide" title="Get Travel Advice" style="color: #0000CC;"><i class="soap-icon-locations circle" style="margin-right:10px"></i>Travel Guide</a>
                            </li>
                    </ul>
                </nav>
            </div>
        </header>

<?php include "ai_assist/widget.php";?>

<script>
function closeMobileMenu() {
    $('#mobile-menu-01').collapse('hide');
}
$(document).ready(function() {
    $(document).on('keyup', function(e) {
        if (e.key === 'Escape' || e.keyCode === 27) {
            $('#mobile-menu-01').collapse('hide');
        }
    });
});
</script>