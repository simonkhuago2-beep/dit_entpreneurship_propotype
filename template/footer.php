<footer id="footer">
    <style>
/* Cookie Banner Styles */
.cookie-banner {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: #304d55;
    color: #fff;
    padding: 15px;
    text-align: center;
    z-index: 9999;
    display: none; /* Hidden by default */
}

.cookie-banner .cookie-content {
    max-width: 1000px;
    margin: 0 auto;
}

.cookie-banner .cookie-buttons {
    display: flex;
    justify-content: center; /* Center buttons horizontally */
    gap: 20px; /* Add space between the buttons */
    margin-top: 10px;
}

.cookie-banner .cookie-button {
    background-color: #ff660;
    color: white;
    border: none;
    padding: 0px 20px;
    cursor: pointer;
    border-radius: 5px;
    font-size: 14px;
}

.cookie-banner .cookie-button:hover {
    background-color: #e55b00;
}

.cookie-banner a {
    color: #ffcc00;
    text-decoration: none;
}

.cookie-banner a:hover {
    text-decoration: underline;
}


    </style>,
    <!-- Cookie consent banner -->
<div id="cookie-banner" class="cookie-banner">
    <div class="cookie-content">
        <p>Your trust is important to us and Travelafric.com values your privacy. We use cookies to enhance your experience, personalise content and ads, provide social media features and to analyse our traffic. 
        We also share information about your use of our site with our social media, advertising and analytics partners. We also use cookies to remember your website preferences. By continuing to visit this site, you agree to our use of cookies. 
        <a href="/privacy-policy">Learn more</a>.</p>
        <div class="cookie-buttons">
            <button id="accept-cookies" class="cookie-button">Accept</button>
            <button id="decline-cookies" class="cookie-button">Decline</button>
        </div>
    </div>
</div>
<script>
    // Check if the user has already accepted or declined cookies
if (!localStorage.getItem('cookieConsent')) {
    document.getElementById('cookie-banner').style.display = 'block'; // Show banner
}

// Accept cookie consent
document.getElementById('accept-cookies').addEventListener('click', function() {
    localStorage.setItem('cookieConsent', 'accepted');
    document.getElementById('cookie-banner').style.display = 'none'; // Hide banner
});

// Decline cookie consent
document.getElementById('decline-cookies').addEventListener('click', function() {
    localStorage.setItem('cookieConsent', 'declined');
    document.getElementById('cookie-banner').style.display = 'none'; // Hide banner
});

</script>
            <div class="footer-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <h2>Discover</h2>
                            <ul class="discover triangle hover row">
                                <li class="col-xs-6"><a href="about-us">About Us</a></li>
                                <li class="col-xs-6"><a href="contact-us">Contact Us</a></li>
                                <!--<li class="col-xs-6"><a href="faq">FAQ</a></li>-->
                                <!--<li class="col-xs-6"><a href="#">Join Our Team</a>-->
                                <!--<li class="col-xs-6"><a href="#">Account Manager</a></li>-->
                                <!--<li class="col-xs-6"><a href="#">How We Work</a></li>-->
                                <li class="col-xs-6"><a href="terms">Payment & Refund</a></li>
                                <li class="col-xs-6"><a href="#">Privacy Policy</a></li>
                                <li class="col-xs-6"><a href="signup">Register Hotel</a></li>
                                <li class="col-xs-6"><a href="signup">Register Agency</a></li>
                                <!--<li class="col-xs-6"><a href="#">Deals</a></li>-->
                                <li class="col-xs-6"><a href="login_acc">Extranet</a></li>
                                <li class="col-xs-6"><a href="login_sup">Supplier Center</a></li>
                                <li class="col-xs-6"><a href="login_b2b">Agency Login</a></li>
                                <!--<li class="col-xs-6"><a href="#">Partners</a></li>-->
                                <!--<li class="col-xs-6"><a href="#">Partner With Us</a></li>-->
                                <li class="col-xs-6"><a href="retrieve-booking">Retrieve Booking</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <h2>Travel News</h2>
                            <ul class="travel-news">
                                <?php $randTour = DB::getInstance()->query("SELECT * FROM tours LIMIT 1"); 
                                    if($randTour->count()){ foreach ($randTour->results() as $key => $one) {
                                ?>
                                <li>
                                    <div class="thumb">
                                        <a href="packages">
                                            <img src="res/images/ab3.jpeg" alt="" width="63" height="63" />
                                        </a>
                                    </div>
                                    <div class="description">
                                        <h5 class="s-title"><a href="packages">Amazing Places</a></h5>
                                        <p>Join our Amazing Group Tour to <?php echo $one->country; ?> this Fall</p>
                                        <!-- <span class="date">25 Sep, 2013</span> -->
                                    </div>
                                </li>
                                <?php  }} ?>
                                <li>
                                    <div class="thumb">
                                        <a href="deals">
                                            <img src="res/images/ab4.jpeg" alt="" width="63" height="63" />
                                        </a>
                                    </div>
                                    <div class="description">
                                        <h5 class="s-title"><a href="deals">Best Deals</a></h5>
                                        <p>Recieve 20% Discounts of all bookings this Summmer</p>
                                        <!-- <span class="date">24 Sep, 2013</span> -->
                                    </div>
                                    
                                </li>
                                <!--<li>-->
                                <!--    <div class="thumb">-->
                                <!--        <a href="deals.php">-->
                                <!--            <img src="res/images/news02.png" alt="" width="63" height="63" />-->
                                <!--        </a>-->
                                <!--    </div>-->
                                <!--    <div class="description">-->
                                <!--        <h5 class="s-title"><a href="deals.php">Best Deals</a></h5>-->
                                <!--        <p>Recieve 20% Discounts of alll bookings this Summmer</p>-->
                                        <!-- <span class="date">24 Sep, 2013</span> -->
                                <!--    </div>-->
                                    
                                <!--</li>-->
                                <!--<li>-->
                                <!--    <div class="thumb">-->
                                <!--        <a href="deals.php">-->
                                <!--            <img src="res/images/news02.png" alt="" width="63" height="63" />-->
                                <!--        </a>-->
                                <!--    </div>-->
                                <!--    <div class="description">-->
                                <!--        <h5 class="s-title"><a href="deals.php">Best Deals</a></h5>-->
                                <!--        <p>Recieve 20% Discounts of alll bookings this Summmer</p>-->
                                        <!-- <span class="date">24 Sep, 2013</span> -->
                                <!--    </div>-->
                                    
                                <!--</li>-->
                            </ul>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <h2>Payment</h2>
                            <!-- <p>Sign up for our mailing list to get latest updates and offers.</p>
                            <br />
                            <form action="" method="post">
                                <div class="icon-check">
                                    <input type="text" class="input-text full-width" placeholder="your email" />
                                </div>
                                <p>Hit enter to send</p>
                            </form>
                            <br /> -->
                            <style>
                                /* Default styles for larger screens */
                                .payment-icons img {
                                    height: 70px;
                                    display: block;
                                    margin: 0 auto;
                                }
                            
                                /* For smaller screens, reduce the image size and display them inline */
                                @media (max-width: 576px) {
                                    .payment-icons {
                                        display: flex;
                                        flex-wrap: wrap;
                                        justify-content: center;
                                    }
                            
                                    .payment-icons img {
                                        height: 40px; /* Reduce size for mobile */
                                        margin: 5px;  /* Add space around images */
                                        display: inline-block;
                                    }
                                }
                            </style>
                            <div class="payment-icons">
                                <div class="col-sm-6"><img src="res/images/visa.jpg" class="img-responsive" alt="Visa" /></div>
                                <div class="col-sm-6"><img src="res/images/master.jpg" class="img-responsive" alt="MasterCard" /></div>
                                <div class="col-sm-6"><img src="res/images/paypal.jpg" class="img-responsive" alt="PayPal" /></div>
                                <div class="col-sm-6"><img src="res/images/pay-apple.jpg" class="img-responsive" alt="Apple Pay" /></div>
                                <div class="col-sm-6"><img src="res/images/wallet.jpg" class="img-responsive" alt="Wallet" /></div>
                                <!-- <div class="col-sm-6 "><img src="res/images/v-visa.png" class="img-responsive" style="height:70px" alt="" /> </div> -->
                                <!--<div class="col-sm-6 "><img src="res/images/visa.jpg" class="img-responsive" style="height:70px" alt="" /> </div>-->
                                <!--<div class="col-sm-6 "><img src="res/images/master.jpg" class="img-responsive" style="height:70px" alt="" /></div>-->
                                <!--<div class="col-sm-6 "><img src="res/images/slydepay.jpg" class="img-responsive" style="height:70px" alt="" /></div>-->
                                <!--<div class="col-sm-6 "><img src="res/images/mobile-money.jpg" class="img-responsive" style="height:70px " alt="" /></div>-->
                                <!--<br>-->
                            </div>

                           
                            
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <h2>About Travelafric.com</h2>
                            <p style="text-align:justify">www.travelafric.com is a one-stop-travel shop to book hotels, airport transfers, sightseeing and vacations packages, book tour guides and event tickets as well as rent cars within Africa. The portal allows travelers to seamlessly plan, book, and pay for all travel related services within Africa</p>
                            
                            <address class="contact-details">
                                <span class="contact-phone"><i class="soap-icon-phone"></i> (+44) 0786 824 3561</span><br>
                                <span class="contact-phone"><i class="soap-icon-phone"></i> (+233) 0303 971 259</span><br>
                                <span class="contact-phone"><i class="soap-icon-phone"></i> (+27) 073 073 4102</span>
                                
                                 
 
 
                                
                                <a href="#" class="contact-email">info@travelafric.com</a>
                            </address>
                            <ul class="social-icons clearfix">
                                <li class="twitter"><a title="twitter" href="https://x.com/travelafric" data-toggle="tooltip"><i class="soap-icon-twitter"></i></a></li>
                                <li class="googleplus"><a title="googleplus" href="#" data-toggle="tooltip"><i class="soap-icon-googleplus"></i></a></li>
                                <li class="facebook"><a title="facebook" href="https://www.facebook.com/profile.php?id=61563551701357" data-toggle="tooltip"><i class="soap-icon-facebook"></i></a></li>
                                <li class="linkedin"><a title="linkedin" href="#" data-toggle="tooltip"><i class="soap-icon-linkedin"></i></a></li>
                                <li class="vimeo"><a title="vimeo" href="#" data-toggle="tooltip"><i class="soap-icon-vimeo"></i></a></li>
                                <li class="youtube"><a title="youtube" href="#" data-toggle="tooltip"><i class="soap-icon-youtube"></i></a></li>
                                <li class="flickr"><a title="flickr" href="https://www.flickr.com/" data-toggle="tooltip"><i class="soap-icon-flickr"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom gray-area">
                <div class="container">
                    <div class="logo pull-left">
                        <a href="01Homepage" title="Travelafric - home">
                            <img src="res/images/logo3.png" height="50" width="156" alt="" />
                        </a>
                    </div>
                    <div class="pull-right">
                        <a id="back-to-top" href="#" class="animated" data-animation-type="bounce"><i class="soap-icon-longarrow-up circle"></i></a>
                    </div>
                    <div class="copyright pull-right">
                        <p>&copy; 2016 Travelafric.com</p>
                    </div>
                </div>
            </div>
        </footer>