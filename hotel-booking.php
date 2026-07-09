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
            $hotel_id = Input::get('hotel'); $room_id=Input::get('room');
            $roomQty = Input::get('roomqty'); $adult = Input::get('adult');$infant = Input::get('infant'); 
            $dateIn = Input::get('from');$dateOut = Input::get('to'); 
            $in = new DateTime($dateIn); $out = new DateTime($dateOut);
            $interval = date_diff($in, $out)->format('%a');
            $nights = $interval<= 0 ? 1 : $interval;
            $hotel = find_by_id('clients',$hotel_id);
            $room = find_by_id('rooms',$room_id);

            $jsonHotel = json_decode($hotel->company_details);

            $isPromo = find_promo($room_id);
            if(empty($isPromo->status)){
                if($client->isLoggedIn()){
                    if($client->data()->groups == 2){ $subtotal = $room->agent_price*$nights*$roomQty;  } 
                }else{ $subtotal = $room->price*$nights*$roomQty;  }
            }else{
                if($client->isLoggedIn()){
                    if($client->data()->groups == 2){$subtotal = $room->agent_price*$nights*$roomQty - ( ($isPromo->rate/100)*$room->agent_price*$nights*$roomQty); } 
                    else{ $subtotal = $room->price*$nights*$roomQty - ( ($isPromo->rate/100)*$room->price*$nights*$roomQty );  }
                }else{ $subtotal = $room->price*$nights*$roomQty - ( ($isPromo->rate/100)*$room->price*$nights*$roomQty );  }
            }    
        ?>    
        <div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title">Hotel Booking</h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="#">HOME</a></li>
                    <li class="active">Hotel Booking</li>
                </ul>
            </div>
        </div>
        <section id="content" class="gray-area">
            <div class="container">
                <div class="row">
                    
                    <div id="main" class="col-sms-6 col-sm-8 col-md-9">
                        <div class="booking-section travelo-box">
                            <form class="booking-form" method="post" action="add-to-cart.php?service=hotel" onsubmi="return false;">
                                <input type="hidden" name="subtotal" value="<?php echo $subtotal; ?>">
                                <input type="hidden" name="hotel-id" value="<?php echo $hotel_id; ?>">
                                <input type="hidden" name="room-id" value="<?php echo $room_id; ?>">
                                <input type="hidden" name="image" value="hotels/<?php echo $room->imgOne; ?>">
                                <input type="hidden" name="checkin" value="<?php echo $dateIn; ?>">
                                <input type="hidden" name="checkout" value="<?php echo $dateOut; ?>">
                                <input type="hidden" name="duration" value="<?php echo $nights; ?>">
                                <input type="hidden" name="adult" value="<?php echo $adult; ?>">
                                <input type="hidden" name="kids" value="<?php echo $infant; ?>">
                                <input type="hidden" name="roomqty" value="<?php echo $roomQty; ?>">
                                <input type="hidden" name="sup_email" value="<?php echo $jsonHotel->email; ?>">
                                <input type="hidden" name="sup_name" value="<?php echo $hotel->company_name; ?>">
                                <input type="hidden" name="title" value="<?php echo $room->name; ?>">
                                <input type="hidden" name="ser_country" value="<?php echo $hotel->city.', '.$hotel->country; ?>">
                                <div class="person-information">
                                    <h2>Your Personal Information</h2>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>first name</label>
                                            <input type="text" name="fname" class="input-text full-width" value="" required="" />
                                        </div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>last name</label>
                                            <input type="text" name="lname" class="input-text full-width" value="" required="" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>email address</label>
                                            <input type="email" name="email" class="input-text full-width" value="" required="" />
                                        </div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>Verify E-mail Address</label>
                                            <input type="email" name="vemail" class="input-text full-width" value="" required="" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <!-- <div class="col-sm-6 col-md-5">
                                            <label>Country code</label>
                                            <div class="selector">
                                                <select name="country_code" class="full-width">
                                                    <option value="uk">United Kingdom (+44)</option>
                                                    <option value="us">United States (+1)</option>
                                                </select>
                                            </div>
                                        </div> -->
                                        <div class="col-sm-6 col-md-5">
                                            <label>Phone number</label>
                                            <input type="tel" name="phone" class="input-text full-width" value="" required="" />
                                        </div>
                                    </div>
                                    <!-- <button font-size="100%">ADD TO CART</button>  -->
                                    <button type="submit" name="" class="">Add to Cart</button> 
                                    <!-- <a href="#" class="red-color">Proceed to Payment Gatway. Payment will be made via Slydepay</a> -->
                                    <!-- onclick link to slydepay for payment and return to "hotel-payment confirm" page -->
                                    </div>
                                <hr />
                                <!-- <h2>Payment &amp; Privacy Policy</h2>
                                <p>Praesent dolor lectus, rutrum sit amet risus vitae, imperdiet cursus neque.</p>
                                    
                                <hr>
                                <div class="card-information">
                                    <p>For Reservation, provide your Card Information as Quarantee<br><a class="red-color">Your Card only serves as guarantee for the booking.</a> No deduction shall be done until Payment is Authorized</p>
                                    <h2>Your Card Information</h2>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>Credit Card Type</label>
                                            <div class="selector">
                                                <select name="card_type" class="full-width">
                                                    <option>select a card</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>Card holder name</label>
                                            <input type="text" name="card_holder_name" class="input-text full-width" value="" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>Card number</label>
                                            <input type="text" name="card_number" class="input-text full-width" value="" placeholder="" />
                                        </div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>Card identification number</label>
                                            <input type="text" name="card_id_number" class="input-text full-width" value="" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>Expiration Date</label>
                                            <div class="constant-column-2">
                                                <div class="selector">
                                                    <select name="exp_date_m" class="full-width">
                                                        <option>month</option>
                                                    </select>
                                                </div>
                                                <div class="selector">
                                                    <select name="exp_date_y" class="full-width">
                                                        <option>year</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-md-2">
                                            <label>billing zip code</label>
                                            <input type="text" name="zipcode" class="input-text full-width" value="" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="term"> By continuing, you agree to the <a href="#"><span class="skin-color">Terms and Conditions</span></a>.
                                        </label>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="promo_offer" value="1"> I want to receive <span class="skin-color">Travelafric.com</span> promotional offers in the future
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-sm-6 col-md-5">
                                        <a href="hotel-reservation%20confirm.html"><button type="button" class="full-width btn-large" href=hotel-thankyou.html button type="button">CONFIRM RESERVATION</button></a>       
                                    </div>
                                </div> -->
                            </form>
                            
                            <div>
                                <h2>Payment Policy</h2>
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
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar col-sms-6 col-sm-4 col-md-3">
                        <div class="booking-details travelo-box">
                            <h4>Booking Details</h4>
                            <article class="image-box hotel listing-style1">
                                <figure class="clearfix">
                                    <?php 
                                        $getImage = $conn->query("SELECT path FROM media WHERE hid = $hotel->id LIMIT 1");
                                        foreach ($getImage->results() as $key => $img):
                                    ?>
                                    <a href="#hotel-detailed.php" class="hover-effect middle-block"><img class="middle-item" alt="" src="hotels/<?php echo $img->path;?>"></a>
                                    <?php endforeach;?>
                                    <div class="travel-title">
                                        <h5 class="box-title"><?php echo $hotel->company_name; ?><small><?php echo $hotel->city.', '.$hotel->country; ?></small></h5>
                                        <!-- <a href="hotel-index.php" class="button">CHANGE</a> -->
                                    </div>
                                </figure>
                                <div class="details">
                                    <div class="feedback">
                                        <div data-placement="bottom" data-toggle="tooltip" class="five-stars-container" title="4 stars"><span style="width: 80%;" class="five-stars"></span></div>
                                        <span class="review"><?php echo num_reviews($hotel->id); ?>  reviews</span>
                                    </div>
                                    <div class="constant-column-3 timing clearfix">
                                        <div class="check-in">
                                            <label>Check in</label>
                                            <span><?php echo get_date_two($dateIn); ?><!-- <br />11 AM --></span>
                                        </div>
                                        <div class="duration text-center">
                                            <i class="soap-icon-clock"></i>
                                            <span><?php echo $nights; ?> Nights</span>
                                        </div>
                                        <div class="check-out">
                                            <label>Check out</label>
                                            <span><?php echo get_date_two($dateOut); ?><!-- <br />2 PM --></span>
                                        </div>
                                    </div>
                                    <div class="guest">
                                        <small class="uppercase"><?php echo $roomQty.' '.$room->name.'room for '; ?> <span class="skin-color"><?php echo $adult; ?> Persons</span></small>
                                    </div>
                                </div>
                            </article>
                            
                            <h4>Other Details</h4>
                            <dl class="other-details">
                                <dt class="feature">room Type:</dt><dd class="value"><?php echo $room->name; ?></dd>
                                <dt class="feature">per Room price:</dt><dd class="value">$<?php echo $subtotal/$nights; ?></dd>
                                <dt class="feature"><?php echo $nights;?> night Stay:</dt><dd class="value"><?php echo '$'.$subtotal; ?></dd>
                                <!-- <dt class="feature">taxes and fees:</dt><dd class="value">$10</dd> -->
                                <dt class="total-price">Total Price</dt><dd class="total-price-value"><?php echo '$'.$subtotal; ?></dd>
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
                    $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
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

