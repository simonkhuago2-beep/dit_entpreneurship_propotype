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
            //$pick = Input::get('pick_up'); $drop = Input::get('drop_off');
            $date_from =Input::get('date_from'); $date_to = $duration = Input::get('date_to');
            $adult = Input::get('adult'); $kids=Input::get('kids');
            $item = find_by_id('transfers',Input::get('id'));
            $in = new DateTime($date_from); /*$out = new DateTime($date_to);
            $interval = date_diff($in, $out)->format('%a');
            $duration=$interval<=0 ? 1 : $interval;*/
            $subtotal = $item->price*$duration;
        ?>
        <div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title">Car Booking</h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="#">HOME</a></li>
                    <li class="active">Car Booking</li>
                </ul>
            </div>
        </div>
        <section id="content" class="gray-area">
            <div class="container">
                <div class="row">
                    <div id="main" class="col-sms-6 col-sm-8 col-md-9">
                        <div class="booking-section travelo-box">
                            
                            <form class="booking-form" action="add-to-cart.php?service=transfer" method="post">
                                <input type="hidden" name="subtotal" id="subtot" value="<?php echo $subtotal; ?>">
                                <input type="hidden" name="adult" value="<?php echo $adult; ?>">
                                <input type="hidden" name="kids" value="<?php echo $kids; ?>">
                                <input type="hidden" name="sup_email" value="<?php echo $item->sup_email; ?>">
                                <input type="hidden" name="sup_name" value="<?php echo $item->sup_name;; ?>">
                                <input type="hidden" name="duration" value="<?php echo $duration; ?>">
                                <input type="hidden" name="image" value="cctech-admin/<?php echo $item->images; ?>">
                                <input type="hidden" name="id" value="<?php echo $item->id; ?>">
                                <input type="hidden" name="title" value="<?php echo $item->cat; ?>">
                                <input type="hidden" name="ser_country" value="<?php echo $item->city.', '.$item->country; ?>">
                                <input type="hidden" name="date_from" value="<?php echo $date_from; ?>">
                                <input type="hidden" name="date_to" value="<?php echo $date_to; ?>">
                                <div class="person-information">
                                    <h2>Your Personal Information</h2>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>first name</label>
                                            <input type="text" class="input-text full-width" name="fname" required="" />
                                        </div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>last name</label>
                                            <input type="text" class="input-text full-width" name="lname" required="" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>email address</label>
                                            <input type="email" class="input-text full-width" name="email" required="" />
                                        </div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>Verify E-mail Address</label>
                                            <input type="email" class="input-text full-width" name="vemail" required="" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>Phone number</label>
                                            <input type="tel" class="input-text full-width" name="phone" required="" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <!-- <div class="col-sm-6 col-md-5">
                                            <label>Country code</label>
                                            <div class="selector">
                                                <select class="full-width" name="code">
                                                    <option>United Kingdom (+44)</option>
                                                    <option>United States (+1)</option>
                                                </select>
                                            </div>
                                        </div> -->
                                        
                                        <div class="col-sm-6 col-md-5">
                                            <label>Pick Up Location</label>
                                            <input type="text" class="input-text full-width" name="pick_loc" required="" />
                                        </div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>Drop Off Location</label>
                                            <input type="text" class="input-text full-width" name="drop_loc" required="" />
                                        </div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>Pick Up Time</label>
                                            <input type="text" class="input-text full-width time" name="pick_time" required="" />
                                        </div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>Drop Off time (Return). </label>
                                            <input type="text" class="input-text full-width time" name="drop_time" required="" />
                                        </div>
                                         
                                        <br><br>
                                    
                                    </div>
                                    <hr>
                                    <h2>Arrival/Flight Information</h2>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>Airline Name</label>
                                            <div class="selector full-width">
                                                <select>
                                                    <option value="">Select...</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>Arriving Time</label>
                                            <input type="text" class="input-text full-width time">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <p><button type="submit" font-size="100%">ADD TO CART</button> </p>
                                    </div>
                                </div>
                                <hr />
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
                                        <li>We will not be able to refund any payment for no-shows or early check-out.</li>
                                    </ul>
                                </div>
                                    
                                <hr>
                                <!-- <div class="card-information ">
                                    <p>For Reservation, provide your Card Information as Quarantee<br><a class="red-color">Your Card only serves as guarantee for the booking.</a> No deduction shall be done until Payment is Authorized</p>
                                    <h2>Your Card Information</h2>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>Credit Card Type</label>
                                            <div class="selector">
                                                <select class="full-width">
                                                    <option>select a card</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>Card holder name</label>
                                            <input type="text" class="input-text full-width" value="" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>Card number</label>
                                            <input type="text" class="input-text full-width" value="" placeholder="" />
                                        </div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>Card identification number</label>
                                            <input type="text" class="input-text full-width" value="" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>Expiration Date</label>
                                            <div class="constant-column-2">
                                                <div class="selector">
                                                    <select class="full-width">
                                                        <option>month</option>
                                                    </select>
                                                </div>
                                                <div class="selector">
                                                    <select class="full-width">
                                                        <option>year</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-md-2">
                                            <label>billing zip code</label>
                                            <input type="text" class="input-text full-width" value="" placeholder="" />
                                        </div>
                                    </div>
                                </div> 
                                <hr>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> By continuing, you agree to the <a href="#"><span class="skin-color">Terms and Conditions</span></a>.
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 col-md-5">
                                        <a href="hotel-reservation%20confirm.html"><button type="button" class="full-width btn-large" href=car-reservation%20confirm.html button type="button">RESERVE BOOKING</button></a> 
                                    </div>
                                </div> -->
                            </form>
                        </div>
                    </div>
                    <div class="sidebar col-sms-6 col-sm-4 col-md-3">
                        <div class="booking-details travelo-box">
                            <h4>Booking Details</h4>
                            <article class="car-detail">
                                <figure class="clearfix">
                                    <a title="" href="car-detailed.html" class="middle-block"><img class="middle-item" alt="" src="cctech-admin/<?php echo $item->images;?>"></a>
                                    <div class="travel-title">
                                        <h5 class="box-title"><?php echo $item->vehicle;?><small>Economy car</small></h5>
                                        <a href="/#cars-tab" class="button">CHANGE</a>
                                    </div>
                                </figure>
                                <div class="details">
                                    <div class="icon-box style11 full-width">
                                        <div class="icon-wrapper">
                                            <i class="soap-icon-departure"></i>
                                        </div>
                                        <dl class="details">
                                            <dt class="skin-color">Date</dt>
                                            <dd><?php echo get_date_two($date_from)/*.' to '.get_date_two($date_to)*/ ;?></dd>
                                        </dl>
                                    </div>
                                   
                                       
                                    <div class="icon-box style11 full-width">
                                        <div class="icon-wrapper">
                                            <i class="soap-icon-departure"></i>
                                        </div>
                                        <dl class="details">
                                            <dt class="skin-color">Transfer Type</dt>
                                            <dd><?php echo $item->pick_up.' to '.$item->drop_off;?></dd>
                                        </dl>
                                    </div>
                                </div>
                            </article>
                            
                            <h4>Other Details</h4>
                            <dl class="other-details">
                                <dt class="feature">Vehicle Type:</dt><dd class="value"><?php echo $item->vehicle_type;?></dd>
                                <dt class="feature">Vehicle:</dt><dd class="value"><?php echo $item->vehicle;?></dd>
                                <dt class="feature">Max Pax</dt><dd class="value"><?php echo $item->persons;?></dd>
                                <dt class="feature">Return Trip</dt><dd class="value"><input type="checkbox" name="return_trip" id="return_trip"></dd>
                                <dt class="total-price">Total Price</dt><dd class="total-price-value"><?php echo '$'.$subtotal;?></dd>
                            </dl>
                        </div>
                        
                        <div class="travelo-box contact-box">
                            <h4>Need Travelafric Help?</h4>
                            <p>We would be more than happy to help you. Our Account Manager are 24/7 at your service to help you.</p>
                            <address class="contact-details">
                                <span class="contact-phone"><i class="soap-icon-phone"></i> +233-247-94-3218</span>
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
    <!-- Input Mask Plugin Js -->
    <script src="res/components/jquery-inputmask/jquery.inputmask.bundle.js"></script>

    
    <script type="text/javascript">
        (function($){
            $('#return_trip').on('click',function(){
                $currentSubtotal = <?php echo $subtotal ?>;
                if ($('#return_trip').is(':checked')) {
                    $newprice = parseInt($currentSubtotal*2);
                    $('.total-price-value').html('$'+$newprice);
                    $('#subtotal').val($newprice);
                    //console.log($newprice);
                }else{
                    $('.total-price-value').html('$'+$currentSubtotal);
                    $('#subtotal').val($currentSubtotal);
                }
            });

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

            $('.time').inputmask('hh:mm', { placeholder: '__:__ _m', alias: 'time', hourFormat: '24' });


        })(jQuery); 
    </script>
</body>
</html>

