<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <!-- Page Title -->
    <title>Travelafric | Package Booking</title>
    
    <?php require 'template/head.html'; ?>
    <link rel="stylesheet" href="res/components/intTel/css/intlTelInput.css">
</head>
<body>
    
    <div id="page-wrapper">
        <?php require 'template/nav.php'; ?>
        <?php 
            $pack = find_by_id('tours',Input::get('id'));
        ?>
        <div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title">Packages Booking</h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="#">HOME</a></li>
                    <li class="active">Packages Booking</li>
                </ul>
            </div>
        </div>
        <section id="content" class="gray-area">
            <div class="container">
                <div class="row">
                    <div id="main" class="col-sm-8 col-md-9">
                        <div class="booking-section travelo-box">
                            <form class="cruise-booking-form" method="post" action="add-to-cart.php?service=package">
                                <input type="hidden" name="subtotal" id="subtotal" value="<?php echo $pack->price; ?>">
                                <input type="hidden" name="id" value="<?php echo $pack->id; ?>">
                                <input type="hidden" name="sup_email" value="<?php echo $pack->sup_email; ?>">
                                <input type="hidden" name="sup_name" value="<?php echo $pack->sup_name;; ?>">
                                <input type="hidden" name="image" value="cctech-admin/<?php echo $pack->image; ?>">
                                <input type="hidden" name="title" value="<?php echo $pack->title; ?>">
                                <input type="hidden" name="ser_country" value="<?php echo $pack->city.', '.$pack->country; ?>">

                                <div class="person-information">
                                    <h2>Your Personal Information</h2>
                                    <div class="row">
                                        <div class="form-group col-sm-6 col-md-5">
                                            <label>first name</label>
                                            <input type="text" class="input-text full-width" name="fname" placeholder="" />
                                        </div>
                                        <div class="form-group col-sm-6 col-md-5">
                                            <label>last name</label>
                                            <input type="text" class="input-text full-width" name="lname" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6 col-md-5">
                                            <label>email address</label>
                                            <input type="email" class="input-text full-width" name="email" placeholder="" />
                                        </div>
                                        <div class="form-group col-sm-6 col-md-5">
                                            <label>Phone number</label>
                                            <input type="tel" class="input-text full-width" name="phone" placeholder="" />
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6 col-md-5">
                                            <label>Country</label>
                                            <input type="text" name="country" class="input-text full-width">
                                        </div>
                                        <div class="form-group col-sm-6 col-md-5">
                                            <label>City/Town</label>
                                            <input type="text" name="city" class="input-text full-width">
                                        </div>    
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6 col-md-5">
                                            <label>Poatal/Zip code</label>
                                            <input type="text" name="zip" class="input-text full-width">
                                        </div>

                                        <div class="form-group col-sm-6 col-md-5">
                                            <label>Home Address</label>
                                            <input type="text" class="input-text full-width" name="addr" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6 col-md-5">
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <label>Gender</label>
                                                    <div>
                                                        <label class="radio radio-inline radio-square">
                                                            <input type="radio" name="gender" checked="checked" value="male">Male
                                                        </label>
                                                        <label class="radio radio-inline radio-square">
                                                            <input type="radio" name="gender" value="female">Female
                                                        </label>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-5">
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <label>No. of Adults</label>
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
                                                <div class="col-xs-6">
                                                    <label>No. of Child</label>
                                                    <div class="selector full-width">
                                                        <select name="kids" id="kids" onchange="incrPrice()">
                                                            <option value="0">00</option>
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
                                        </div>
                                    </div>
                                    <div class="form-group"><button type="submit" font-size="100%">ADD TO CART</button></div>
                                </div>

                                <hr/>
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

                    <div class="sidebar col-sm-4 col-md-3">
                        <div class="booking-details travelo-box">
                            <h4>Booking Details</h4>
                            <article class="image-box cruise listing-style1">
                                <figure class="clearfix">
                                    <a title="" href="cruise-detailed.html" class="hover-effect middle-block"><img class="middle-item" alt="" src="cctech-admin/<?php echo $pack->image; ?>"></a>
                                    <div class="travel-title">
                                        <h5 class="box-title"><?php echo $pack->title; ?><small><?php echo $pack->city;?></small></h5>
                                        <!-- <a href="cruise-list-view.html" class="button">CHANGE</a> -->
                                    </div>
                                </figure>
                                <div class="details">
                                    <div class="feedback">
                                        <div data-placement="bottom" data-toggle="tooltip" title="4 stars" class="five-stars-container"><span style="width: 80%;" class="five-stars"></span></div>
                                        <span class="review">270 reviews</span>
                                    </div>
                                    <div class="constant-column-3 timing clearfix">
                                        <!--Program to response as found below-->
                                        <div class="check-in">
                                            <label>Destination </label><br>
                                            <span><?php echo $pack->city;?><br /></span>
                                        </div>
                                        <div class="duration text-center">
                                            <i class="soap-icon-clock"></i>
                                            <span><?php echo $pack->duration;?> Nights</span>
                                        </div>
                                        <div class="check-out">
                                            <label>Type </label><br>
                                            <span><?php echo $pack->type;?><br /></span>
                                        </div>
                                    </div>
                                    
                                </div>
                            </article>
                            
                            <h4>Summary</h4>
                            <dl class="other-details">
                                <!--program responses to respond accordingly-->
                                <dt class="feature">Type:</dt><dd class="value"><?php echo $pack->title; ?>r</dd>
                                <dt class="feature">Duration:</dt><dd class="value"><?php echo $pack->duration;?> Nights</dd>
                                <dt class="feature">Adult:</dt><dd class="value" id="a_price">$<?php echo $pack->price;?></dd>
                                <dt class="feature">Child:</dt><dd class="value" id="k_price">$0</dd>
                                <dt class="total-price">Total Price</dt><dd class="total-price-value" id="total">$<?php echo $pack->price;?></dd>
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

    <?php include 'template/js-loader.html'; ?>
    <script src="res/components/intTel/js/intlTelInput.js"></script>
    <script type="text/javascript">
        function incrPrice() {
            var adult_price = <?php echo $pack->price ?>;
            var kids_price = <?php echo $pack->infant_price ?>;
            var adultNos = document.getElementById('adult').value;
            var kidNos   = document.getElementById('kids').value;
            var total = parseInt(adult_price*adultNos) + parseInt(kids_price*kidNos) ;
            document.getElementById('total').innerHTML = '$'+total;
            document.getElementById('subtotal').value=total;
            document.getElementById('a_price').innerHTML = '$'+parseInt(adult_price*adultNos);
            document.getElementById('k_price').innerHTML = '$'+parseInt(kids_price*kidNos);
        }

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
    </script>
</body>
</html>

