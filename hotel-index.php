<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
   <!-- Page Title -->
    <title>Travelafric.com</title>
    <?php include 'template/head.html'; ?>    
</head>
<body>
    
    <div id="page-wrapper">
        <?php include 'template/nav.php'; ?>
        <?php 
            $today = date('m/d/Y');$date = new DateTime($today); $tomrw = $date->add(new DateInterval('P1D'))->format('m/d/Y');
        ?>
        <div id="slideshow">
            <div class="fullwidthbanner-container">
                <div class="revolution-slider rev_slider" style="height: 150; overflow: hidden;">
                    <ul>    <!-- SLIDE  -->
                        <!-- Slide1 -->
                        <li data-transition="zoomin" data-slotamount="7" data-masterspeed="1500">
                            <!-- MAIN IMAGE -->
                            <img src="res/images/hotel-slider-1.jpg" alt="">
                        </li>
                        
                        <!-- Slide2 -->
                        <li data-transition="zoomout" data-slotamount="7" data-masterspeed="1500">
                            <!-- MAIN IMAGE -->
                            <img src="res/images/hotel-slider-2.jpg" alt="">
                        </li>
                        
                        <!-- Slide3 -->
                        <li data-transition="slidedown" data-slotamount="7" data-masterspeed="1500">
                            <!-- MAIN IMAGE -->
                            <img src="res/images/hotel-slider-3.jpg" alt="">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <section id="content">
            <div class="search-box-wrapper">
                <div class="search-box container">
                    <ul class="search-tabs clearfix">
                        <li class="active"><a href="#hotels-tab" data-toggle="tab">HOTELS</a></li>
                        <li><a href="#cars-tab" data-toggle="tab">Transfers</a></li>
                        <li><a href="#cruises-tab" data-toggle="tab">Sightseeing</a></li>
                        <li><a href="#packages-tab" data-toggle="tab">Packages</a></li>
                        <li><a href="#events-tab" data-toggle="tab">Events</a></li>
                    </ul>
                    <div class="visible-mobile">
                        <ul id="mobile-search-tabs" class="search-tabs clearfix">
                            <li class="active"><a href="#hotels-tab">HOTELS</a></li>
                            <li><a href="#cars-tab">TRANSFERS</a></li>
                            <li><a href="#cruises-tab">SIGHTSEEING</a></li>
                            <li><a href="#packages-tab">PACKAGES</a></li>
                            <li><a href="#events-tab">EVENTS</a></li>
                            </ul>
                    </div>
                    
                    <div class="search-tab-content">
                        <!-- hotel -->
                        <div class="tab-pane fade active in" id="hotels-tab">
                            <form action="hotel-list-view.php" method="post">
                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-3">
                                        <h4 class="title">Where</h4>
                                        <label>Your Destination</label>
                                        <div class="selector">
                                        <select name="country" required="required" class="full-width">
                                            <option value="">Any</option>
                                            <?php $countries = list_countries(); foreach($countries->results() as $key => $value): ?>
                                                <option value="<?php echo $value->country ?>"><?php echo $value->country ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-sm-6 col-md-4">
                                        <h4 class="title">When</h4>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <label>Check In</label>
                                                <div class="datepicker-wrap">
                                                    <input type="text" name="in-date" id="in-date" class="input-text full-width" placeholder="mm/dd/yy" required />
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <label>Check Out</label>
                                                <div class="datepicker-wrap">
                                                    <input type="text" name="out-date" id="out-date" class="input-text full-width" placeholder="mm/dd/yy" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-sm-6 col-md-3">
                                        <h4 class="title">Who</h4>
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>Rooms</label>
                                                <div class="selector">
                                                    <select class="full-width" name="room-qty">
                                                        <option value="1">01</option>
                                                        <option value="2">02</option>
                                                        <option value="3">03</option>
                                                        <option value="4">04</option>
                                                    </select><span class="custom-select full-width">01</span>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <label>Adults</label>
                                                <div class="selector">
                                                    <select class="full-width" name="adult">
                                                        <option value="1">01</option>
                                                        <option value="2">02</option>
                                                        <option value="3">03</option>
                                                        <option value="4">04</option>
                                                    </select><span class="custom-select full-width">01</span>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <label>Kids</label>
                                                <div class="selector">
                                                    <select class="full-width" name="infant">
                                                        <option value="0">00</option>
                                                        <option value="1">01</option>
                                                        <option value="2">02</option>
                                                        <option value="3">03</option>
                                                        <option value="4">04</option>
                                                    </select><span class="custom-select full-width">00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-sm-6 col-md-2 fixheight">
                                        <label class="hidden-xs">&nbsp;</label>
                                        <!--Program Search Now-->
                                        <button type="submit" class="full-width icon-check animated bounce" data-animation-type="bounce" data-animation-duration="1" style="animation-duration: 1s; visibility: visible;">SEARCH NOW</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- hotel -->
                        <div class="tab-pane fade" id="flights-tab">
                            <form action="flight-list-view.html" method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4 class="title">Where</h4>
                                        <div class="form-group">
                                            <label>Leaving From</label>
                                            <input type="text" class="input-text full-width" placeholder="city, distirct or specific airpot" />
                                        </div>
                                        <div class="form-group">
                                            <label>Going To</label>
                                            <input type="text" class="input-text full-width" placeholder="city, distirct or specific airpot" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <h4 class="title">When</h4>
                                        <label>Departing On</label>
                                        <div class="form-group row">
                                            <div class="col-xs-6">
                                                <div class="datepicker-wrap">
                                                    <input type="text" name="date_from" class="input-text full-width" placeholder="mm/dd/yy" />
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="selector">
                                                    <select class="full-width">
                                                        <option value="1">anytime</option>
                                                        <option value="2">morning</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <label>Arriving On</label>
                                        <div class="form-group row">
                                            <div class="col-xs-6">
                                                <div class="datepicker-wrap">
                                                    <input type="text" name="date_to" class="input-text full-width" placeholder="mm/dd/yy" />
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="selector">
                                                    <select class="full-width">
                                                        <option value="1">anytime</option>
                                                        <option value="2">morning</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <h4 class="title">Who</h4>
                                        <div class="form-group row">
                                            <div class="col-xs-3">
                                                <label>Adults</label>
                                                <div class="selector">
                                                    <select class="full-width">
                                                        <option value="1">01</option>
                                                        <option value="2">02</option>
                                                        <option value="3">03</option>
                                                        <option value="4">04</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-3">
                                                <label>Kids</label>
                                                <div class="selector">
                                                    <select class="full-width">
                                                        <option value="1">01</option>
                                                        <option value="2">02</option>
                                                        <option value="3">03</option>
                                                        <option value="4">04</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <label>Promo Code</label>
                                                <input type="text" class="input-text full-width" placeholder="type here" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xs-3">
                                                <label>Infants</label>
                                                <div class="selector">
                                                    <select class="full-width">
                                                        <option value="1">01</option>
                                                        <option value="2">02</option>
                                                        <option value="3">03</option>
                                                        <option value="4">04</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 pull-right">
                                                <label>&nbsp;</label>
                                                <button class="full-width icon-check">SERACH NOW</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <div class="tab-pane fade" id="flight-and-hotel-tab">
                            <form action="flight-list-view.html" method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4 class="title">Where</h4>
                                        <div class="form-group">
                                            <label>Leaving From</label>
                                            <input type="text" class="input-text full-width" placeholder="city, distirct or specific airpot" />
                                        </div>
                                        <div class="form-group">
                                            <label>Going To</label>
                                            <input type="text" class="input-text full-width" placeholder="city, distirct or specific airpot" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <h4 class="title">When</h4>
                                        <label>Departing On</label>
                                        <div class="form-group row">
                                            <div class="col-xs-6">
                                                <div class="datepicker-wrap">
                                                    <input type="text" name="date_from" class="input-text full-width" placeholder="mm/dd/yy" />
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="selector">
                                                    <select class="full-width">
                                                        <option value="1">anytime</option>
                                                        <option value="2">morning</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <label>Arriving On</label>
                                        <div class="form-group row">
                                            <div class="col-xs-6">
                                                <div class="datepicker-wrap">
                                                    <input type="text" name="date_to" class="input-text full-width" placeholder="mm/dd/yy" />
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="selector">
                                                    <select class="full-width">
                                                        <option value="1">anytime</option>
                                                        <option value="2">morning</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <h4 class="title">Who</h4>
                                        <div class="form-group row">
                                            <div class="col-xs-3">
                                                <label>Adults</label>
                                                <div class="selector">
                                                    <select class="full-width">
                                                        <option value="1">01</option>
                                                        <option value="2">02</option>
                                                        <option value="3">03</option>
                                                        <option value="4">04</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-3">
                                                <label>Kids</label>
                                                <div class="selector">
                                                    <select class="full-width">
                                                        <option value="1">01</option>
                                                        <option value="2">02</option>
                                                        <option value="3">03</option>
                                                        <option value="4">04</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <label>Promo Code</label>
                                                <input type="text" class="input-text full-width" placeholder="type here" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xs-3">
                                                <label>Rooms</label>
                                                <div class="selector">
                                                    <select class="full-width">
                                                        <option value="1">01</option>
                                                        <option value="2">02</option>
                                                        <option value="3">03</option>
                                                        <option value="4">04</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 pull-right">
                                                <label>&nbsp;</label>
                                                <button class="full-width icon-check">SERACH NOW</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <!-- transfer -->
                        <div class="tab-pane fade" id="cars-tab">
                            <form action="car-list-view.php" method="post" id="frmCar">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4 class="title">&nbsp;</h4>
                                        <div class="form-group">
                                            <label>Country</label>
                                            <div class="selector">
                                            <select name="country" onchange="listTransCities(this.value)" required="required" class="full-width">
                                                <option value="">Select</option>
                                                <?php $countriesEx = DB::getInstance()->query("SELECT DISTINCT country FROM transfers ORDER BY country ASC"); 
                                                    foreach($countriesEx->results() as $key => $ex): ?>
                                                    <option value="<?php echo $ex->country ?>"><?php echo $ex->country ?></option>
                                                <?php endforeach ?>
                                           </select>
                                           </div>
                                        </div>
                                        <div class="form-group" >
                                            <label>City</label>
                                            <div class="selector">
                                                <select name="city" class="full-width" id="transfer_city"  required="required">
                                                    <option>Select</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <h4 class="title">&nbsp;</h4>
                                        <div class="form-group">
                                            <label>Pick Up Type</label>
                                            <div class="row">
                                                
                                                <div class="col-xs-6">
                                                    <div class="selector">
                                                        <select class="full-width" name="pick_up">
                                                            <option value="0">Select</option>
                                                            <?php $point_pick = DB::getInstance()->query("SELECT DISTINCT pick_up FROM transfers "); 
                                                                    foreach($point_pick->results() as $key => $value): ?>
                                                                    <option value="<?php echo $value->pick_up ?>"><?php echo $value->pick_up ?></option>
                                                                <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-xs-6">
                                                    <div class="datepicker-wrap">
                                                        <input type="text" name="date_from" class="input-text full-width" placeholder="mm/dd/yy" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Drop-Off Type</label>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="selector">
                                                        <select class="full-width" name="drop_off">
                                                            <option value="0">Select</option>
                                                            <?php $point_pick = DB::getInstance()->query("SELECT DISTINCT drop_off FROM transfers "); 
                                                                foreach($point_pick->results() as $key => $value): ?>
                                                                <option value="<?php echo $value->drop_off ?>"><?php echo $value->drop_off ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="">
                                                        <input type="text" name="date_to" class="input-text full-width" placeholder="Duration (days)" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <h4 class="title">&nbsp;</h4>
                                        <div class="form-group row">
                                            <div class="col-xs-3">
                                                <label>Adults</label>
                                                <div class="selector">
                                                    <select class="full-width" name="adult">
                                                        <option value="1">01</option>
                                                        <option value="2">02</option>
                                                        <option value="3">03</option>
                                                        <option value="4">04</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-3">
                                                <label>Kids</label>
                                                <div class="selector">
                                                    <select class="full-width" name="kids">
                                                        <option value="">00</option>
                                                        <option value="1">01</option>
                                                        <option value="2">02</option>
                                                        <option value="3">03</option>
                                                        <option value="4">04</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <label>Promo Code</label>
                                                <input type="text" class="input-text full-width" placeholder="type here" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xs-6">
                                                <label>Car Type</label>
                                                <div class="selector">
                                                    <select class="full-width" name="car">
                                                        <option value="">select a car type</option>
                                                        <!--function car selector-->
                                                        <option value="economy">Economy</option>
                                                        <option value="compact">Compact</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <label>&nbsp;</label>
                                                <button class="full-width icon-check">SERACH NOW</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- transfer -->
                        <!-- sightseing -->
                        <div class="tab-pane fade" id="cruises-tab">
                            <form action="cruise-list-view.php" method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4 class="title">Where</h4>
                                        <div class="form-group">
                                            <label>Destination</label>
                                            <div class="selector">
                                                <select class="full-width" name="country" required="required" >
                                                    <option value="">Select</option>
                                                    <?php $seeing = $conn->query("SELECT DISTINCT country FROM excursion ORDER BY country ASC");
                                                        if($seeing->count()){foreach ($seeing->results() as $key => $sight) {
                                                    ?>
                                                    <option value="<?php echo $sight->country ?>"><?php echo $sight->country ?></option>
                                                    <?php } } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <h4 class="title">When</h4>
                                        <div class="form-group row">
                                            <div class="col-xs-6">
                                                <label>Departure Date</label>
                                                <div class="datepicker-wrap">
                                                    <input type="text" name="date_on" class="input-text full-width" placeholder="mm/dd/yy" required="required" />
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <label>Children</label>
                                                <div class="selector">
                                                    <select class="full-width" name="kids">
                                                        <option value="1"> Allowed</option>
                                                        <option value="0">Not Allowed</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <h4 class="title">Which</h4>
                                        <div class="form-group row">
                                            <div class="col-xs-6">
                                                <label>Type</label>
                                                <div class="selector">
                                                    <select class="full-width" required="required" name="type">
                                                        <?php $typeEx = DB::getInstance()->query("SELECT DISTINCT type FROM excursion"); 
                                                            foreach($typeEx->results() as $key => $t): ?>
                                                            <option value="<?php echo $t->type ?>"><?php echo $t->type ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <label>&nbsp;</label>
                                                <button class="icon-check full-width" type="submit">SEARCH NOW</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /sightseeing -->
                        <!-- packages -->
                        <div class="tab-pane fade" id="packages-tab">
                            <form action="packages.php" method="post">
                                <div class="row"><br>
                                    <h4> Welcome to a world of exciting tours across Africa</h4>
                                    <h5>Book from Private and Group Tour Packages, Vacations, Honeymoon, Family and Individual Vacations. Packages are either all inclusive or semi-ackage</h5>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-xs-12">
                                                <a href="packages.php"><button class="icon-check full-width">EXPORE OUR PACKAGES NOW</button></a>
                                            </div>
                                            <!-- <div class="col-xs-6"> -->
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /packages -->

                        <div class="tab-pane fade" id="events-tab">
                            <form action="events-block%20view.html" method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4 class="title">When</h4>
                                        <div class="form-group">
                                            <label>Destination</label>
                                            <input type="text" class="input-text full-width" placeholder="enter a destination or hotel name" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <h4 class="title">When</h4>
                                        <div class="form-group row">
                                            <div class="col-xs-6">
                                                <label>Departure Date</label>
                                                <div class="datepicker-wrap">
                                                    <input type="text" class="input-text full-width" placeholder="mm/dd/yy" />
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <label>Children</label>
                                                <div class="selector">
                                                    <select class="full-width">
                                                        <!--Insert Value for Children Alowed-->
                                                        <option value="">Any</option>
                                                        <option value="1"> Allowed</option>
                                                        <option value="2">Not Allowed</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <h4 class="title">Which</h4>
                                        <div class="form-group row">
                                            <div class="col-xs-6">
                                                <label>Type</label>
                                                <div class="selector">
                                                    <select class="full-width">
                                                        <!--Insert Value for Excursion Tpye-->
                                                        <option value="">select Type</option>
                                                        <option value="1">select type </option>
                                                        <option value="2">select type Nights</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <label>&nbsp;</label>
                                                <button class="icon-check full-width">SEARCH NOW</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>   
                        
                    </div>
                </div>
            </div>
            
            <div class="section">
                <div class="container">
                    <h2>Recommended Hotels</h2>
                    <div class="block image-carousel style2 flexslider" data-animation="slide" data-item-width="270" data-item-margin="30">
                        <ul class="slides image-box listing-style2">
                            <?php 
                                $buffer = DB::getInstance()->query("SELECT * FROM clients WHERE groups = 4 AND verified = 1 ORDER BY RAND() LIMIT 5");
                                    if($buffer->count()){
                                        foreach ($buffer->results() as $key => $htl) {
                                            $image = DB::getInstance()->query("SELECT * FROM media WHERE hid = $htl->id LIMIT 1");
                                            if($image->count()){
                                                foreach ($image->results() as $key => $img) {$path = 'hotels/'.$img->path;}    
                                            }else{$path = 'http://placehold.it/270x160';}
                            ?>  
                            <li>
                                <article class="box">
                                    <figure>
                                        <a href="ajax/slideshow-popup.html" class="hover-effect popup-gallery"><img src="<?php echo $path ?>" alt="" style="height:172px"  /></a>
                                    </figure>
                                    <div class="details">
                                        <a title="View all" href="hotel-detailed.php?hotel=<?php echo $htl->id.'&from='.$today.'&to='.$tomrw.'&adult=1&infant=1&room=1';?>" class="pull-right button uppercase">select</a>
                                        <h4 class="box-title"><?php echo $htl->company_name;?></h4>
                                        <label class="price-wrapper">
                                            <span class="price-per-unit"><?php echo '$'.avag_roomPrice($htl->id); ?></span>avg/night
                                        </label>
                                    </div>
                                </article>
                            </li>
                            <?php } }?>
                            
                        </ul>
                    </div>
                    
                    <div class="block row">
                        <div class="col-md-6">
                            <h2>Hot Hotel Details</h2>
                            <div class="tab-container style1 box">
                                <ul class="tabs">
                                    <li class="active"><a href="#hot-hotel-popular" data-toggle="tab">Popular</a></li>
                                    <li><a href="#hot-hotel-lasvegas" data-toggle="tab">Las Vegas</a></li>
                                    <li><a href="#hot-hotel-miami" data-toggle="tab">Miami</a></li>
                                    <li><a href="#hot-hotel-sanfrancisco" data-toggle="tab">San Francisco</a></li>
                                    <li><a href="#hot-hotel-hongkong" data-toggle="tab">Hong Kong</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="hot-hotel-popular">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <a href="#" class="badge-container"><span class="badge-content">save 23%</span><img class="full-width" src="http://placehold.it/63x63" alt="" width="63" height="63" /></a>
                                            </div>
                                            <div class="col-xs-8">
                                                <h5 class="box-title">Warwick Hotel<small>New york, usa</small></h5>
                                                <p class="no-margin">Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massa idporta nequetiam.</p>
                                            </div>
                                            <div class="col-xs-2">
                                                <span class="price"><small>avg/night</small>$115</span>
                                                <br /><br />
                                                <a class="button green-bg pull-right" href="hotel-detailed.html">SELECT</a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <a href="#" class="badge-container"><span class="badge-content">save 23%</span><img class="full-width" src="http://placehold.it/63x63" alt="" width="63" height="63" /></a>
                                            </div>
                                            <div class="col-xs-8">
                                                <h5 class="box-title">Warwick Hotel<small>New york, usa</small></h5>
                                                <p class="no-margin">Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massa idporta nequetiam.</p>
                                            </div>
                                            <div class="col-xs-2">
                                                <span class="price"><small>avg/night</small>$115</span>
                                                <br /><br />
                                                <a class="button green-bg pull-right" href="hotel-detailed.html">SELECT</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="hot-hotel-lasvegas">
                                        
                                    </div>
                                    <div class="tab-pane fade" id="hot-hotel-miami">
                                        
                                    </div>
                                    <div class="tab-pane fade" id="hot-hotel-sanfrancisco">
                                        
                                    </div>
                                    <div class="tab-pane fade" id="hot-hotel-hongkong">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h2>What Travelers Say?</h2>
                            <div class="testimonial style1 box">
                                <ul class="slides ">
                                    <li>
                                        <p class="description">This is the 3rd time I’ve used Travelafric.com and telling you the truth their services are always reliable and it only takes few minutes to plan and finalize your entire trip using their extremely fast website and up to date listings. I’m super excited about my next trip to Paris.</p>
                                        <div class="author clearfix">
                                            <a href="#"><img src="http://placehold.it/270x270" alt="" width="74" height="74" /></a>
                                            <h5 class="name">Jessica Brown<small>guest</small></h5>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="description">This is the 3rd time I’ve used Travelo website and telling you the truth their services are always realiable and it only takes few minutes to plan and finalize your entire trip using their extremely fast website and up to date listings. I’m super excited about my next trip to Paris.</p>
                                        <div class="author clearfix">
                                            <a href="#"><img src="http://placehold.it/270x270" alt="" width="74" height="74" /></a>
                                            <h5 class="name">Lisa Kimberly<small>guest</small></h5>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="description">This is the 3rd time I’ve used Travelo website and telling you the truth their services are always realiable and it only takes few minutes to plan and finalize your entire trip using their extremely fast website and up to date listings. I’m super excited about my next trip to Paris.</p>
                                        <div class="author clearfix">
                                            <a href="#"><img src="http://placehold.it/270x270" alt="" width="74" height="74" /></a>
                                            <h5 class="name">Jessica Brown<small>guest</small></h5>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <h2>Travelers Choice of Hotels</h2>
                    <div class="image-carousel style2 flexslider" data-animation="slide" data-item-width="270" data-item-margin="30">
                        <ul class="slides image-box hotel listing-style1">
                            <?php 
                                $buffer2 = DB::getInstance()->query("SELECT * FROM clients WHERE groups = 4 AND verified = 1 ORDER BY RAND() LIMIT 5");
                                    if($buffer2->count()){
                                        foreach ($buffer2->results() as $key => $htl2) {
                                            $image2 = DB::getInstance()->query("SELECT * FROM media WHERE hid = $htl2->id LIMIT 1");
                                            if($image2->count()){
                                                foreach ($image2->results() as $key => $img2) {$path2 = 'hotels/'.$img2->path;}    
                                            }else{$path2 = 'http://placehold.it/270x160';}
                            ?>  
                            <li>
                                <article class="box">
                                    <figure>
                                        <a href="ajax/slideshow-popup.html" class="hover-effect popup-gallery"><img alt="" src="<?php echo $path2 ?>" style="height:172px; "></a>
                                    </figure>
                                    <div class="details">
                                        <span class="price">
                                            <small>avg/night</small>
                                            <?php echo '$'.lowest_roomPrice($htl2->id); ?>
                                        </span>
                                        <h4 class="box-title"><?php echo $htl2->company_name ?><small><?php echo $htl2->city.' '.$htl2->country ?></small></h4>
                                        <div class="feedback">
                                            <div data-placement="bottom" data-toggle="tooltip" class="five-stars-container" title="4 stars"><span style="width: 80%;" class="five-stars"></span></div>
                                            <span class="review"><?php echo num_reviews($htl2->id); ?> reviews</span>
                                        </div>
                                        <?php $jsonH = json_decode($htl2->company_details); ?>
                                        <p class="description"><?php echo substr($jsonH->descp, 0, 130);  ?>...</p>
                                        <div class="action">
                                            <a class="button btn-small" href="hotel-detailed.php?hotel=<?php echo $htl2->id.'&from='.$today.'&to='.$tomrw.'&adult=1&infant=1&room=1';?>">SELECT</a>
                                            <a class="button btn-small yellow popup-map" href="#" data-box="48.856614, 2.352222">VIEW ON MAP</a>
                                        </div>
                                    </div>
                                </article>
                            </li>
                            <?php } }?>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="global-map-area promo-box no-margin parallax" data-stellar-background-ratio="0.5">
                <div class="container">
                    <div class="content-section description pull-right col-sm-9">
                        <div class="table-wrapper hidden-table-sm">
                            <div class="table-cell">
                                <h2 class="m-title animated" data-animation-type="fadeInDown">
                                    Tell us where you would like to go.<br /><em>12,000+ Hotel and Resorts Available!</em>
                                </h2>
                            </div>
                            <div class="table-cell action-section col-md-4 no-float">
                                <form action="hotel-list-view.html" method="post">
                                    <div class="row">
                                        <div class="col-xs-6 col-md-12">
                                            <input type="text" class="input-text input-large full-width" value="" placeholder="Enter destination or hotel name" />
                                        </div>
                                        <div class="col-xs-6 col-md-12">
                                            <button class="full-width btn-large animated" data-animation-type="fadeInUp" data-animation-delay="1">search hotels</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="image-container col-sm-4">
                        <img src="res/images/342x258.jpg" alt="" width="342" height="258" class="animated" data-animation-type="fadeInUp" data-animation-duration="2" />
                    </div>
                </div>
            </div>
        </section>
        
        <?php include 'template/footer.php'; ?>
    </div>
    
    <!-- Javascript -->
     <?php include 'template/js-loader.html'; ?>
    
    <script type="text/javascript">
        tjq(document).ready(function() {
            tjq('.revolution-slider').revolution(
            {
                sliderType:"standard",
				sliderLayout:"auto",
				dottedOverlay:"none",
				delay:9000,
				navigation: {
					keyboardNavigation:"off",
					keyboard_direction: "horizontal",
					mouseScrollNavigation:"off",
					mouseScrollReverse:"default",
					onHoverStop:"on",
					touch:{
						touchenabled:"on",
						swipe_threshold: 75,
						swipe_min_touches: 1,
						swipe_direction: "horizontal",
						drag_block_vertical: false
					}
					,
					arrows: {
						style:"default",
						enable:true,
						hide_onmobile:false,
						hide_onleave:false,
						tmp:'',
						left: {
							h_align:"left",
							v_align:"center",
							h_offset:20,
							v_offset:0
						},
						right: {
							h_align:"right",
							v_align:"center",
							h_offset:20,
							v_offset:0
						}
					}
				},
				visibilityLevels:[1240,1024,778,480],
				gridwidth:1170,
				gridheight:410,
				lazyType:"none",
				shadow:0,
				spinner:"spinner4",
				stopLoop:"off",
				stopAfterLoops:-1,
				stopAtSlide:-1,
				shuffle:"off",
				autoHeight:"off",
				hideThumbsOnMobile:"off",
				hideSliderAtLimit:0,
				hideCaptionAtLimit:0,
				hideAllCaptionAtLilmit:0,
				debugMode:false,
				fallbacks: {
					simplifyAll:"off",
					nextSlideOnWindowFocus:"off",
					disableFocusListener:false,
				}
            });
        });
    </script>
</body>
</html>

