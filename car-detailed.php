<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <!-- Page Title -->
    <title>Travelafric.com</title>
    <?php require 'template/head.html'; ?>
    <style type="text/css">
        .policy p{margin-bottom:0px }
    </style>
</head>
<body>
     <div id="page-wrapper">
        <?php require 'template/nav.php'; ?>
        <?php 
            //$pick = Input::get('pick_up'); $drop = Input::get('drop_off');
            $date_from =Input::get('date_from'); $date_to =Input::get('date_to');
            $adult = Input::get('adult'); $kids=Input::get('kids');
            $item = find_by_id('transfers',Input::get('id'));
            //$country = $item->country; $city = $item->city;
        ?>
        <div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title">Car Detailed</h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="#">HOME</a></li>
                    <li class="active">Car Detailed</li>
                </ul>
            </div>
        </div>
        <section id="content" class="gray-area">
            <div class="container car-detail-page">
                <div class="row">
                    <div id="main" class="col-md-9">
                        <div class="featured-image box">
                            <img src="cctech-admin/<?php echo $item->images;?>" alt="" />
                        </div>
                        <div class="tab-container">
                            <ul class="tabs">
                                <li class="active">
                                    <a href="#car-details" data-toggle="tab">Car Details</a>
                                </li>
                                <li>
                                    <a href="#car-upgrade" data-toggle="tab">Book Your Car</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="car-details">
                                    <div class="intro box table-wrapper full-width hidden-table-sms">
                                        <div class="col-sm-4 table-cell travelo-box">
                                            <dl class="term-description">
                                                <dt>Rental Company:</dt><dd><?php echo $item->sup_name;?></dd>
                                                <dt>Car Type:</dt><dd>Economy</dd>
                                                <dt>Car name:</dt><dd><?php echo $item->vehicle;?></dd>
                                                <dt>Passenger:</dt><dd><?php echo Input::get('adult');?></dd>
                                                <dt>Baggage:</dt><dd>2</dd>
                                                <dt>total price:</dt><dd><?php echo '$'.$item->price*$date_to;?></dd>
                                            </dl>
                                        </div>
                                        <div class="col-sm-8 table-cell">
                                            <div class="detailed-features clearfix">
                                                <div class="col-md-6">
                                                    <h4 class="box-title">
                                                        Pick-up Type
                                                        <small><?php echo $item->pick_up;?></small>
                                                    </h4>
                                                    <div class="icon-box style11">
                                                        <div class="icon-wrapper">
                                                            <i class="soap-icon-departure"></i>
                                                        </div>
                                                        <dl class="details">
                                                            <dt class="skin-color">County</dt>
                                                            <dd><?php echo $item->country;?></dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <h4 class="box-title">
                                                        Drop-off Type
                                                        <small><?php echo $item->drop_off;?></small>
                                                    </h4>
                                                    <div class="icon-box style11">
                                                        <div class="icon-wrapper">
                                                            <i class="soap-icon-departure"></i>
                                                        </div>
                                                        <dl class="details">
                                                            <dt class="skin-color">City</dt>
                                                            <dd><?php echo $item->city;?></dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="car-features box">
                                        <div class="row add-clearfix">
                                            <div class="col-sms-6 col-sm-6 col-md-4">
                                                <span class="icon-box style2">
                                                    <i class="soap-icon-user circle"></i><?php echo $item->persons;?> Passengers
                                                </span>
                                            </div>
                                            <div class="col-sms-6 col-sm-6 col-md-4">
                                                <span class="icon-box style2">
                                                    <i class="soap-icon-suitcase circle"></i>2 Bags
                                                </span>
                                            </div>
                                            <div class="col-sms-6 col-sm-6 col-md-4">
                                                <span class="icon-box style2">
                                                    <i class="soap-icon-aircon circle"></i>air conditioning
                                                </span>
                                            </div>
                                            <div class="col-sms-6 col-sm-6 col-md-4">
                                                <span class="icon-box style2">
                                                    <i class="soap-icon-fmstereo circle"></i>Satellite Navigation
                                                </span>
                                            </div>
                                            <div class="col-sms-6 col-sm-6 col-md-4">
                                                <span class="icon-box style2">
                                                    <i class="soap-icon-fueltank circle"></i>Disel Vehicle
                                                </span>
                                            </div>
                                            <div class="col-sms-6 col-sm-6 col-md-4">
                                                <span class="icon-box style2">
                                                    <i class="soap-icon-automatic-transmission circle"></i>Automatic transmission
                                                </span>
                                            </div>
                                        </div>
                                        <h2>Transfer Policy</h2>
                                        <div class="policy"><?php echo $item->policy;?></div>
                                    <br />
                                    </div>
                                    <h2>Enhance your Rental</h2>
                                    <div class="intro box table-wrapper full-width hidden-table-sms">
                                        <div class="col-md-4 table-cell travelo-box protect-passengers">
                                            <div class="icon-box style12">
                                                <div class="icon-wrapper">
                                                    <i class="soap-icon-passenger circle"></i>
                                                </div>
                                                <h5 class="details title">Protect your smaller, lighter passengers</h5>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <label>Toddler Seat</label>
                                                    <div class="selector full-width">
                                                        <select>
                                                            <option value="1">1</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <label>Infant Seat</label>
                                                    <div class="selector full-width">
                                                        <select>
                                                            <option value="0">0</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 table-cell">
                                            <div class="car-damage travelo-box">
                                                <div class="pull-right logo">
                                                    <img src="http://placehold.it/270x160" alt="" />
                                                </div>
                                                <div class="icon-box box style12">
                                                    <div class="icon-wrapper">
                                                        <i class="soap-icon-car circle"></i>
                                                    </div>
                                                    <h5 class="details title">Add rental car damage protection</h5>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-8">
                                                        <label class="radio radio-inline">
                                                            <input type="radio" name="damage-protection">Yes, add Rental Car Damage Protection for the rental period for $18.00 USD. <a href="#" class="skin-color">Learn More</a>
                                                        </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <label class="radio radio-inline">
                                                            <input type="radio" name="damage-protection">No Thanks
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade in" id="car-upgrade">
                                    <h2>Payment Policy</h2>
                                    <p><?php echo $item->pay_policy; ?></p>
                                    <div class="car-list listing-style3 car">
                                        <article class="box">
                                            <figure class="col-xs-3">
                                                <span><img alt="" src="cctech-admin/<?php echo $item->images;?>"></span>
                                            </figure>
                                            <div class="details col-xs-9 clearfix">
                                                <div class="col-sm-8">
                                                    <div class="clearfix">
                                                        <h4 class="box-title">Economy Car<small><?php echo $item->vehicle;?></small></h4>
                                                        <div class="logo">
                                                            <img src="http://placehold.it/110x25" alt="" />
                                                        </div>
                                                    </div>
                                                    <div class="amenities">
                                                        <ul>
                                                            <li><i class="soap-icon-user circle"></i><?php echo $item->persons;?></li>
                                                            <li><i class="soap-icon-suitcase circle"></i>3</li>
                                                            <li><i class="soap-icon-aircon circle"></i>AC</li>
                                                            <li><i class="soap-icon-fueltank circle"></i>12</li>
                                                            <li><i class="soap-icon-fmstereo circle"></i>YES</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-sm-2 character">
                                                    <dl class="">
                                                        <dt class="skin-color">mileage</dt><dd><?php echo $item->mileage;?> miles</dd>
                                                        <!-- <dt class="skin-color">Pickup Time</dt><dd>5:45 pm</dd> -->
                                                        <dt class="skin-color">Location</dt><dd><?php echo $item->city.', '.$item->country;?></dd>
                                                    </dl>
                                                </div>
                                                <div class="action col-xs-6 col-sm-2">
                                                    <span class="price"><small>per day</small><?php echo '$'.$item->price;?></span>
                                                    <a href="car-booking.php?id=<?php echo $item->id.'&adult='.$adult.'&kids='.$kids.'&date_from='.$date_from.'&date_to='.$date_to ?>" class="button btn-small full-width">select</a>
                                                </div>
                                            </div>
                                        </article>                                  
                                    </div>
                                    <a href="car-booking.php?id=<?php echo $item->id.'&adult='.$adult.'&kids='.$kids.'&date_from='.$date_from.'&date_to='.$date_to ?>" class="button btn-large full-width">BOOK NOW</a><br><br>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar col-md-3">
                        <article class="detailed-logo">
                            <figure>
                                <img width="114" height="85" src="cctech-admin/<?php echo $item->images;?>" alt="">
                            </figure>
                            <div class="details">
                                <h2 class="box-title"><?php echo $item->vehicle;?><small>economy car</small></h2>
                                <span class="price clearfix">
                                    <small class="pull-left">per day</small>
                                    <span class="pull-right"><?php echo '$'.$item->price;?></span>
                                </span>
                                <div class="mile clearfix">
                                    <span class="skin-color">Mileage:</span>
                                    <span class="mileage pull-right"><?php echo $item->mileage;?> Miles</span>
                                </div>
                                <p class="description">All bookings require prepayment. Your credit card will be charge with the full amount at the time you make your reservation. All bookings can be cancelled no more than 2 hours prior to the scheduled pick-up time. Cancellations made less than 2 hours prior to pick-up are not refundable.</p>
                                <a class="button yellow full-width uppercase btn-small" href="car-booking.php?id=<?php echo $item->id.'&adult='.$adult.'&kids='.$kids.'&date_from='.$date_from.'&date_to='.$date_to ?>">add to cart</a>
                            </div>
                        </article>
                        <div class="travelo-box contact-box">
                            <h4>Need Travelafric Help?</h4>
                            <p>We would be more than happy to help you. Our Account Manager are 24/7 at your service to help you.</p>
                            <address class="contact-details">
                                <span class="contact-phone"><i class="soap-icon-phone"></i> (+233) 0303 971 259</span>
                                <br>
                                <a class="contact-email" href="#">info@travelafric.com</a>
                            </address>
                        </div>
                        <div class="travelo-box book-with-us-box">
                            <h4>Why Book with us?</h4>
                            <ul>
                                <li>
                                    <i class="soap-icon-hotel-1 circle"></i>
                                    <h5 class="title"><a href="#">African Focus</a></h5>
                                    <p>Direct Provider of Travel Products in Africa</p>
                                </li>
                                <li>
                                    <i class="soap-icon-savings circle"></i>
                                    <h5 class="title"><a href="#">Low Rate &amp; Quarantee</a></h5>
                                    <p>Cheaper Rate, Super Deals and Quaranteed Payment.</p>
                                </li>
                                <li>
                                    <i class="soap-icon-support circle"></i>
                                    <h5 class="title"><a href="#">After Sales Support</a></h5>
                                    <p>We care about your booking and follow through for Service Delivery</p>
                                </li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
        
        <?php include 'template/footer.php'; ?>
    </div>

    <!-- Javascript -->
    <?php include 'template/js-loader.html'; ?>
</body>
</html>

