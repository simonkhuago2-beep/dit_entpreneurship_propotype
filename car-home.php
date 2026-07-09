<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <!-- Page Title -->
    <title>Travelafric.com</title>
   <?php require 'template/head.html'; ?>
</head>
<body>
    
    <body>
    <div id="page-wrapper">
        <?php require 'template/nav.php'; ?>
        <div id="slideshow">
            <div class="fullwidthbanner-container">
                <div class="revolution-slider rev_slider" style="height: 150; overflow: hidden;">
                    <ul>    <!-- SLIDE  -->
                        <!-- Slide1 -->
                        <li data-transition="zoomin" data-slotamount="7" data-masterspeed="1500">
                            <!-- MAIN IMAGE -->
                            <img src="res/images/transfer-slider1.png" alt="">
                        </li>
                        
                        <!-- Slide2 -->
                        <li data-transition="zoomout" data-slotamount="7" data-masterspeed="1500">
                            <!-- MAIN IMAGE -->
                            <img src="res/images/transfer-slider2.jpg" alt="">
                        </li>
                        
                        <!-- Slide3 -->
                        <li data-transition="slidedown" data-slotamount="7" data-masterspeed="1500">
                            <!-- MAIN IMAGE -->
                            <img src="res/images/transfer-slider3.jpg" alt="">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
         <section id="content">
            <div class="search-box-wrapper">
                <div class="search-box container">
                    <ul class="search-tabs clearfix">
                        <!--<li class="active"><a href="#hotels-tab" data-toggle="tab">HOTELS</a></li>-->
                        <li <li class="active"><a href="#cars-tab">Transfers</a></li>
                        <li><a href="#cruises-tab">Sightseeing</a></li>
                        <li><a href="#packages-tab">Packages</a></li>
                        <!--<li><a href="#events-tab" data-toggle="tab">Events</a></li> -->
                    </ul>
                    <div class="visible-mobile">
                        <ul id="mobile-search-tabs" class="search-tabs clearfix">
                            <!--<li class="active"><a href="#hotels-tab">HOTELS</a></li>-->
                            <li><a href="#cars-tab">TRANSFERS</a></li>
                            <li><a href="#cruises-tab">SIGHTSEEING</a></li>
                            <li><a href="#packages-tab">PACKAGES</a></li>
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
                                                        <input type="text" name="date_to" required class="input-text full-width" placeholder="Duration (days)" />
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
            
            <div class="section gray-area text-left">
                <div class="container">
                    <div class="block">
                        <div class="row image-box style10">
                            <div class="col-md-4">
                                <article class="box">
                                    <figure class="animated" data-animatiFon-type="fadeInRight">
                                        <a class="hover-effect" title="" href="car-list-view.html"><img width="370" style="height:132px; " alt="" src="res/images/guaranteed-safety.jpg"></a>
                                    </figure>
                                    <div class="details">
                                        <a href="car-list-view.html" class="button">MORE</a>
                                        <h4 class="box-title"> Guaranteed Safety<br></h4>
                                    </div>
                                </article>
                            </div>
                            <div class="col-md-4">
                                <article class="box">
                                    <figure class="animated" data-animation-type="fadeInRight" data-animation-delay="0.3">
                                        <a class="hover-effect" title="" href="car-list-view.html"><img width="370" style="height:132px; " alt="" src="res/images/guranteed-service.jpg"></a>
                                    </figure>
                                    <div class="details">
                                        <a href="car-list-view.html" class="button">MORE</a>
                                        <h4 class="box-title">Guaranteed Service<br></h4>
                                    </div>
                                </article>
                            </div>
                            <div class="col-md-4">
                                <article class="box">
                                    <figure class="animated" data-animation-type="fadeInRight" data-animation-delay="0.6">
                                        <a class="hover-effect" title="" href="car-list-view.html"><img width="370" style="height:132px; " alt="" src="res/images/guranteed-deal.jpg"></a>
                                    </figure>
                                    <div class="details">
                                        <a href="car-list-view.html" class="button">MORE</a>
                                        <h4 class="box-title">Guaranteed Deal</h4>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                    <h2>Top Hire Cars</h2>
                    <div class="block image-carousel style2 flexslider" data-animation="slide" data-item-width="270" data-item-margin="30">
                        <ul class="slides image-box style1">
                            <?php
                                $tops = $conn->query("SELECT * FROM transfers ORDER BY RAND() LIMIT 8");
                                if($tops->count()){foreach ($tops->results() as $key => $top) {
                            ?>
                            <li>
                                <article class="box">
                                    <figure>
                                        <a class="hover-effect" title="" href="car-detailed.php"><img alt="" src="cctech-admin/<?php echo $top->images;?>" style="height:160px "></a>
                                    </figure>
                                    <div class="details">
                                        <span class="price"><small>FROM</small><?php echo '$'.$top->price;?></span>
                                        <h4 class="box-title"><?php echo $top->vehicle;?><small>Per Day</small></h4>
                                    </div>
                                </article>
                            </li>
                            <?php } }
                                    
                            ?>        
                        </ul>
                    </div>
                    
                    <div class="block row">
                        <div class="col-md-4">
                            <h2>Car Rental Deals</h2>
                            <div class="travelo-box image-box style13">
                                <div class="box">
                                    <figure>
                                        <img width="63" height="59" alt="" src="http://placehold.it/63x59">
                                    </figure>
                                    <div class="action">
                                        <span class="price"><small>per 3 day</small>$35</span>
                                    </div>
                                    <div class="details">
                                        <h4 class="box-title"><a href="#">Intermediate<small>Renault grand scenic</small></a></h4>
                                        <span class="time skin-color"><i class="soap-icon-clock"></i>24 hours remaining</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="box">
                                    <figure>
                                        <img width="63" height="59" alt="" src="http://placehold.it/63x59">
                                    </figure>
                                    <div class="action">
                                        <span class="price"><small>per 2 day</small>$26</span>
                                    </div>
                                    <div class="details">
                                        <h4 class="box-title"><a href="#">Luxury Elite<small>bmw 5 series</small></a></h4>
                                        <span class="time skin-color"><i class="soap-icon-clock"></i>38 minutes remaining</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="box">
                                    <figure>
                                        <img width="63" height="59" alt="" src="http://placehold.it/63x59">
                                    </figure>
                                    <div class="action">
                                        <span class="price"><small>per day</small>$49</span>
                                    </div>
                                    <div class="details">
                                        <h4 class="box-title"><a href="#">Economy Car<small>vokswagen polo</small></a></h4>
                                        <span class="time skin-color"><i class="soap-icon-clock"></i>24 hours remaining</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h2>Why Book with us?</h2>
                            <div class="travelo-box book-with-us-box">
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
                        <div class="col-md-4">
                            <h2>Explore More</h2>
                            <div class="travelo-box explore-more image-box style5 clearfix">
                                <div class="icon-box intro">
                                    <i class="soap-icon-recommend circle"></i>
                                    <h5 class="box-title"><small>Recommended for you!</small>Car Packages Starting at $35.99</h5>
                                </div>
                                <article class="box animated" data-animation-type="fadeIn" data-animation-delay="0">
                                    <figure>
                                        <a title="" href="car-detailed.html"><img width="183" style="height:120px" alt="" src="res/images/explore-1.jpg"></a>
                                        <figcaption>
                                            <h6 class="caption-title">Elite</h6>
                                            <span>Fiat 500</span>
                                        </figcaption>
                                    </figure>
                                </article>
                                <article class="box animated" data-animation-type="fadeIn" data-animation-delay="0.3">
                                    <figure>
                                        <a title="" href="car-detailed.html"><img width="183" style="height:120px" alt="" src="res/images/explore-2.jpg"></a>
                                        <figcaption>
                                            <h6 class="caption-title">Mini</h6>
                                            <span>BMW 5 S</span>
                                        </figcaption>
                                    </figure>
                                </article>
                                <article class="box animated" data-animation-type="fadeIn" data-animation-delay="0.6">
                                    <figure>
                                        <a title="" href="car-detailed.html"><img width="183" style="height:120px" alt="" src="res/images/explore-3.jpg"></a>
                                        <figcaption>
                                            <h6 class="caption-title">luxury</h6>
                                            <span>BMW 7 s</span>
                                        </figcaption>
                                    </figure>
                                </article>
                                <article class="box animated" data-animation-type="fadeIn" data-animation-delay="0.9">
                                    <figure>
                                        <a title="" href="car-detailed.html"><img width="183" style="height:120px" alt="" src="res/images/explore-4.jpg"></a>
                                        <figcaption>
                                            <h6 class="caption-title">Elite</h6>
                                            <span>Holden 6</span>
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="global-map-area promo-box no-margin parallax" data-stellar-background-ratio="0.5">
                <div class="container">
                    <div class="table-wrapper hidden-table-sm">
                        <div class="content-section description pull-right col-sm-9">
                            <div class="table-wrapper hidden-table-sm">
                                <div class="table-cell">
                                    <h2 class="m-title">
                                        Tell us where you would like to go.<br /><em>3,000+ TRANSFER AND CAR RENTAL OPTIONS AVAILABLE!</em>
                                    </h2>
                                </div>
                                <div class="table-cell action-section col-md-4 no-float">
                                    <form method="post" action="car-list-view.html">
                                        <div class="row">
                                            <div class="col-xs-6 col-md-12">
                                                <input type="text" class="input-text input-large full-width" value="" placeholder="Enter destination or hotel name" />
                                            </div>
                                            <div class="col-xs-6 col-md-12">
                                                <button class="full-width btn-large">search options</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="image-container col-sm-4">
                            <img width="292" height="269" alt="" src="res/images/292x270.jpg" class="animated" data-animation-type="fadeInUp">
                        </div>
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

