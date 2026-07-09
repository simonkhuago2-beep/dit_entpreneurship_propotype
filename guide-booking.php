<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <!-- Page Title -->
    <title>Travelafric.com</title>
    <?php require 'template/head.html'; ?>
    <link rel="stylesheet" href="res/components/intTel/css/intlTelInput.css">
</head>
<body>
    
    <div id="page-wrapper">
        <?php require 'template/nav.php'; ?>
        <?php 
            $event = find_by_id('events',Input::get('id'));
        ?>
        <div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title">Event Booking</h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="#">HOME</a></li>
                    <li><a href="#">EVENT</a></li>
                    <li class="active">Event Booking</li>
                </ul>
            </div>
        </div>
        <section id="content" class="gray-area">
            <div class="container">
                <div class="row">
                    
                    <div id="main" class="col-sms-6 col-sm-8 col-md-9">
                        <div class="booking-section travelo-box">
                            <form class="booking-form" method="post" action="add-to-cart.php?service=events" onsubmit="return fals;">
                                <input type="hidden" name="subtotal" id="subtotal" value="<?php echo $event->price; ?>">
                                <input type="hidden" name="id" value="<?php echo $event->id; ?>">
                                <input type="hidden" name="sup_email" value="<?php echo $event->sup_email; ?>">
                                <input type="hidden" name="sup_name" value="<?php echo $event->sup_name;; ?>">
                                <input type="hidden" name="image" value="cctech-admin/<?php echo $event->image; ?>">
                                <input type="hidden" name="title" value="<?php echo $event->title; ?>">
                                <input type="hidden" name="ser_country" value="<?php echo $event->loc.', '.$event->city; ?>">
                                
                                <div class="person-information">
                                    <h2>Your Personal Information</h2>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>first name</label>
                                            <input type="text" name="fname" class="input-text full-width" required="" placeholder="" />
                                        </div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>last name</label>
                                            <input type="text" name="lname" class="input-text full-width" required="" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>email address</label>
                                            <input type="email" name="email" class="input-text full-width" required="" placeholder="" />
                                        </div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>Verify E-mail Address</label>
                                            <input type="email" name="vemail" class="input-text full-width" required="" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>Home Address</label>
                                            <input type="email" name="email" class="input-text full-width" required="" placeholder="" />
                                        </div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>Phone number</label>
                                            <input type="tel" class="input-text full-width" name="phone" placeholder="" />
                                        </div>
                                    </div>

                                    <hr>
                                    <h2>Booking Request</h2>

                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>Guest Type</label>
                                            <div class="selector full-width">
                                                <select name="type" id="type" class="form-control">
                                                    <option value="Individual" restricted>Select Guest Type</option>    
                                                    <option value="Individual">Individual</option>
                                                    <option value="Group">Group</option>  
                                                </select>
                                            </div>
                                            
                                        </div>
                                        <div class="col-xs-6 col-md-5">
                                                    <label>No. of Adult</label>
                                                    <div class="selector full-width">
                                                        <select name="adult" id="adult" onchange="incrPrice()">
                                                            <option value="1">01</option>
                                                            <option value="2">02</option>
                                                            <option value="3">03</option>
                                                            <option value="4">04</option>
                                                            <option value="5">05</option>
                                                            <option value="6">06</option>
                                                            <option value="7">07</option>
                                                            <option value="8">08</option>
                                                            <option value="9">09</option>
                                                        </select>
                                                    </div>
                                        </div>
                                    </div>
                                    <div class="form-group"><button type="submit" font-size="100%">ADD TO CART</button></div>
                                </div>

                                <hr>
                                <h2>Payment &amp; Privacy Policy</h2>
                                <ul style="list-style:disc;margin-left:15px;font-size:14px;line-height:30px;   ">
                                    <li>The amount stated on your booking will be charged from your payment method</li>
                                    <li>Payment processing is handled on a secured server that encrypts your credit card information.</li>
                                    <li>Payment should reflect on your statement bearing the name “Travelafric.com”</li>
                                    <li>By clicking "Book Now" or “Add to Cart” , you agree you have read and accept our <a href="#" class="text-danger">Terms and Conditions</a> and <a href="#" class="text-danger">Privacy Policy</a> </li>
                                </ul>
                                <hr />
                                <h2>Cancellation</h2>
                                <ul style="list-style:disc;margin-left:15px;font-size:14px;line-height:30px;   ">
                                    <li>Unless otherwise specifically stated per the services being booked for, you can cancel for free three (3) Days before the start of your booked service</li>
                                    <li>If you change or cancel your booking within 48hurs before your booked service date (Greenwich Meridian Time), you will be charged for 50%  (including tax)</li>
                                    <li>We will not be able to refund any payment for no-shows or early check-out.</li>
                                </ul>
                                
                            </form>
                        </div>
                    </div>
                    <div class="sidebar col-sms-6 col-sm-4 col-md-3">
                        <div class="booking-details travelo-box">
                            <h4>Booking Details</h4>
                            <article class="image-box hotel listing-style1">
                                <figure class="clearfix">
                                    <a href="hotel-detailed.html" class="hover-effect middle-block"><img class="middle-item" width="270" height="160" alt="" src="cctech-admin/<?php echo $event->image; ?>"></a>
                                    <div class="travel-title">
                                        <h5 class="box-title"><?php echo $event->title; ?><small><?php echo $event->city; ?></small></h5>
                                        <a href="events-list.php" class="button">CHANGE</a>
                                    </div>
                                </figure>
                                <div class="details">
                                    <div class="constant-column-3 timing clearfix">
                                        <div class="check-in">
                                            <label>Date</label><br>
                                            <span><?php echo get_date_two($event->e_date); ?></span>
                                        </div>
                                        <div class="duration text-center">
                                            <i class="soap-icon-clock"></i>
                                            <span>2 Nights</span>
                                        </div>
                                        <div class="check-out">
                                            <label>Time</label>
                                            <span><br /><?php echo $event->e_time; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            
                            <h4>Other Details</h4>
                            <dl class="other-details">
                                
                                <dt class="feature">Adult:</dt><dd class="value">$<?php echo $event->price; ?></dd>
                                <!-- <dt class="feature">Child:</dt><dd class="value">$100</dd> -->
                                <dt class="total-price">Total Price</dt><dd class="total-price-value" id="total">$<?php echo $event->price; ?></dd>
                            </dl>
                        </div>
                        
                        <div class="travelo-box contact-box">
                            <h4>Need Travelafric Help?</h4>
                            <p>We would be more than happy to help you. Our Account Manager are 24/7 at your service to help you.</p>
                            <address class="contact-details">
                                <span class="contact-phone"><i class="soap-icon-phone"></i> +233-247-93-3218</span>
                                <br>
                                <a class="contact-email" href="#">info@travelafric.com</a>
                            </address>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <?php include 'template/footer.php'; ?>
    </div>

    <!-- Javascript -->
    <?php include 'template/js-loader.html'; ?>
    <script src="res/components/intTel/js/intlTelInput.js"></script>
    <script type="text/javascript">
        (function($){
            /*------------tel number only restriction----------------------*/
            $('input[type="tel"]').on('keypress',function(){
                var evt = $(this).val();
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57)){
                    return false;
                }
                return true;
            });
            
            /*-------------tele by country code-------------------------*/
            var mobile = $('input[type="tel"]').each(function(){})
            mobile.intlTelInput({
                geoIpLookup: function(callback) {
                    $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                      var countryCode = (resp && resp.country) ? resp.country : "";
                      callback(countryCode);
                    });
                },
                hiddenInput: "full_number",initialCountry: "auto",nationalMode: false,utilsScript: "res/components/intTel/js/utils.js"
            });
        })(jQuery); 
        function incrPrice() {
            var per_price = <?php echo $event->price ?>;
            //var kids_price = <?php //echo $event->infant_price ?>;
            var adultNos = document.getElementById('adult').value;
            //var kidNos   = document.getElementById('kids').value;
            var total = parseInt(per_price*adultNos) //+ parseInt(kids_price*kidNos) ;
            document.getElementById('total').innerHTML = '$'+total;
            document.getElementById('subtotal').value=total;
            //console.log(total);
        }
    </script>
</body>
</html>

