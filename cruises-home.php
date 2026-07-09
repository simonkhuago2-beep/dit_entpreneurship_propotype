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
</head>
<body>
<div id="page-wrapper">
        <?php include 'template/nav.php'; ?>
        
        <!--work on slider and slider image-->
        <div id="slideshow">
            <div class="fullwidthbanner-container" style="position:relativ;">
                <div class="revolution-slider rev_slider" style=" overflow: hidden;">
                    <ul style=" ">    <!-- SLIDE  -->
                        <!-- Slide1 -->
                        <li data-transition="zoomin" data-slotamount="7" data-masterspeed="1500">
                            <!-- MAIN IMAGE -->
                            <img src="res/images/slide-01.jpg" alt="" >
                        </li>
                        <!-- Slide2 -->
                        <li data-transition="zoomout" data-slotamount="7" data-masterspeed="1500">
                            <!-- MAIN IMAGE -->
                            <img src="res/images/slide-02.jpg" alt="">
                        </li>
                        
                        <!-- Slide3 -->
                        <li data-transition="slidedown" data-slotamount="7" data-masterspeed="1500">
                            <!-- MAIN IMAGE -->
                            <img src="res/images/slide-03.jpg" alt="">
                        </li>
                    </ul>
                </div>
            </div>
            <!-- ads box -->
            
        </div>
    
        <section id="content">
            <div class="search-box-wrapper">
                <div class="search-box container">
                    <ul class="search-tabs clearfix">
                        <li class="active"><a href="#hotels-tab" data-toggle="tab">HOTELS</a></li>
                        <li><a href="#cars-tab" data-toggle="tab">Transfers</a></li>
                        <li><a href="#cruises-tab" data-toggle="tab">Sightseeing</a></li>
                        <!--<li><a href="#packages-tab" data-toggle="tab">Packages</a></li>
                        <li><a href="#events-tab" data-toggle="tab">Events</a></li> -->
                    </ul>
                    <div class="visible-mobile">
                        <ul id="mobile-search-tabs" class="search-tabs clearfix">
                            <li class="active"><a href="#hotels-tab">HOTELS</a></li>
                            <li><a href="#cars-tab">TRANSFERS</a></li>
                            <li><a href="#cruises-tab">SIGHTSEEING</a></li>
                            <!-- <li><a href="#packages-tab">PACKAGES</a></li> -->
                        </ul>
                    </div>
                    
                    <div class="search-tab-content">
                        <!-- hotel -->
                        <div class="tab-pane fade active in" id="hotels-tab">
                            <form action="hotel-list-view.php" method="GET">
                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-3">
                                        <h4 class="title">Where</h4>
                                        <label>Your Destination</label>
                                        <input type="text" name="country" id="hotelAutoCompleteCountry" class="input-text full-width" placeholder="Enter Country">
                                        <div id="autocomplete-container" style=""></div>
                                        <!-- <div class="selector">
                                            <select name="country" required="required" class="full-width">
                                                <option value="">Any</option>
                                                <?php $countries = list_countries(); foreach($countries->results() as $key => $value): ?>
                                                    <option value="<?php echo $value->country ?>"><?php echo $value->country ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div> -->
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
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="4">5</option>
                                                        <option value="4">6</option>
                                                        <option value="4">7</option>
                                                        <option value="4">8</option>
                                                        <option value="4">9</option>
                                                    </select><span class="custom-select full-width">1</span>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <label>Adults</label>
                                                <div class="selector">
                                                    <select class="full-width" name="adult">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="4">5</option>
                                                        <option value="4">6</option>
                                                        <option value="4">7</option>
                                                        <option value="4">8</option>
                                                    </select><span class="custom-select full-width">1</span>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <label>Kids</label>
                                                <div class="selector">
                                                    <select class="full-width" name="infant">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                    </select><span class="custom-select full-width">0</span>
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
                        <!-- /hotel -->
                        
                        
                        <!-- transfer -->
                        <div class="tab-pane fade" id="cars-tab">
                            <form action="car-list-view.php" method="get" id="frmCar">
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
                                                <select name="city" class="full-width" id="transfer_city" required="required">
                                                    <option>Select</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <h4 class="title">&nbsp;</h4>
                                        <div class="form-group">
                                            <label>Pick Up Type </label>
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
                                                        <input type="text" name="date_to" class="input-text full-width" required placeholder="Duration (days)" />
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
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="4">5</option>
                                                        <option value="4">6</option>
                                                        <option value="4">7</option>
                                                        <option value="4">8</option>
                                                        <option value="4">9</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-3">
                                                <label>Kids</label>
                                                <div class="selector">
                                                    <select class="full-width" name="kids">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="4">5</option>
                                                        <option value="4">6</option>
                                                        <option value="4">7</option>
                                                        <option value="4">8</option>
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
                        <!-- /transfer -->

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

                        
                        
                    </div>
                </div>
            </div>

            
            <div class="container section">
                <h2>Explore Our Excursions and Vacation Packages</h2>
                <div class="row image-box style10">
                    <?php 
                        $excur = DB::getInstance()->query("SELECT * FROM excursion WHERE status = 1 ORDER BY id DESC LIMIT 4");
                            if($excur->count()){
                                foreach ($excur->results() as $key => $excu) {
                    ?>
                    <div class="col-sms-6 col-sm-6 col-md-3">
                        <!--1st line-link to excursions; 2nd Line-link to tours-->
                        <article class="box">
                            <figure class="animated" data-animation-type="fadeInDown" data-animation-duration="2">
                                <a href="cruise-detailed.php?id=<?php echo $excu->id.'&date='.$today.'&kids=1'; ?>" title="" class="hover-effect">
                                    <img src="<?php echo 'cctech-admin/'.$excu->image; ?>" alt="" style='height:160px ' />
                                </a>
                            </figure>
                            <div class="details">
                                <a href="cruise-detailed.php?id=<?php echo $excu->id.'&date='.$today.'&kids=1'; ?>" class="button btn-mini">See Details</a>
                                <h4 class="box-title" style="text-transform:capitalize!important;"><?php echo substr($excu->title,0,15);?>..</h4>
                            </div>
                        </article>
                    </div>
                    <?php } }?>

                    <?php 
                        $tours = DB::getInstance()->query("SELECT * FROM tours WHERE status = 1 ORDER BY id DESC LIMIT 4");
                            if($tours->count()){
                                foreach ($tours->results() as $key => $tor) {
                    ?>
                    <div class="col-sms-6 col-sm-6 col-md-3">
                        <!--1st line-link to excursions; 2nd Line-link to tours-->
                        <article class="box">
                            <figure class="animated" data-animation-type="fadeInDown" data-animation-duration="2">
                                <a href="package-detailed.php?id=<?php echo $tor->id; ?>" title="" class="hover-effect">
                                    <img src="<?php echo 'cctech-admin/'.$tor->image; ?>" alt="" style='height:160px ' />
                                </a>
                            </figure>
                            <div class="details">
                                <a href="package-detailed.php?id=<?php echo $tor->id; ?>" class="button btn-mini">See Details</a>
                                <h4 class="box-title" style="text-transform:capitalize!important;"><?php echo substr($tor->title,0,15)?>..</h4>
                            </div>
                        </article>
                    </div>
                    <?php } }?>

                    
                </div>
            </div>

            <div class="global-map-area section parallax" data-stellar-background-ratio="0.5">
                <div class="container description">
                    <div class="col-sm-6 col-md-3">
                        <div class="icon-box style6 animated" data-animation-type="slideInLeft" data-animation-delay="0">
                            <i class="soap-icon-friends"></i>
                            <div class="description">
                                <h4 class="box-title">B2B/B2C</h4>
                                <p>Designed to serve travel agencies and the walk-in user. Be sure to receive deals and special packages whether you are B2B or B2C.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="icon-box style6 animated" data-animation-type="slideInDown" data-animation-delay="0.6">
                            <i class="soap-icon-pickanddrop"></i>
                            <div class="description">
                                <h4 class="box-title">One-Stop-Shop</h4>
                                <p>No need to be booking from several sites for the same journey. Book all services on one platform and be assure of a well-coordinated services delivery.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="icon-box style6 animated" data-animation-type="slideInDown" data-animation-delay="0.9">
                            <i class="soap-icon-insurance"></i>
                            <div class="description">
                                <h4 class="box-title">Cheaper Rates</h4>
                                <p>Get cheaper and discounted rates as well as the best deals on all services. </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="icon-box style6 animated"  data-animation-type="slideInRight" data-animation-delay="1.2">
                            <i class="soap-icon-guideline"></i>
                            <div class="description">
                                <h4 class="box-title">Secured Payment</h4>
                                <p>Secured Payment using Visa, Master Card, Bank Transfer, Debit Card.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <?php include 'template/footer.php'; ?>
    </div>
    
    <?php include 'template/js-loader.html'; ?>
    <script src="res/js/jquery.autocomplete.min.js"></script>
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

            /*-----------country autocomplete--------*/
            var countries = { AD:"Andorra",A2:"Andorra Test",AE:"United Arab Emirates",AF:"Afghanistan",AG:"Antigua and Barbuda",AI:"Anguilla",AL:"Albania",AM:"Armenia",AN:"Netherlands Antilles",AO:"Angola",AQ:"Antarctica",AR:"Argentina",AS:"American Samoa",AT:"Austria",AU:"Australia",AW:"Aruba",AX:"Åland Islands",AZ:"Azerbaijan",BA:"Bosnia and Herzegovina",BB:"Barbados",BD:"Bangladesh",BE:"Belgium",BF:"Burkina Faso",BG:"Bulgaria",BH:"Bahrain",BI:"Burundi",BJ:"Benin",BL:"Saint Barthélemy",BM:"Bermuda",BN:"Brunei",BO:"Bolivia",BQ:"British Antarctic Territory",BR:"Brazil",BS:"Bahamas",BT:"Bhutan",BV:"Bouvet Island",BW:"Botswana",BY:"Belarus",BZ:"Belize",CA:"Canada",CC:"Cocos [Keeling] Islands",CD:"Congo - Kinshasa",CF:"Central African Republic",CG:"Congo - Brazzaville",CH:"Switzerland",CI:"Côte d’Ivoire",CK:"Cook Islands",CL:"Chile",CM:"Cameroon",CN:"China",CO:"Colombia",CR:"Costa Rica",CS:"Serbia and Montenegro",CT:"Canton and Enderbury Islands",CU:"Cuba",CV:"Cape Verde",CX:"Christmas Island",CY:"Cyprus",CZ:"Czech Republic",DD:"East Germany",DE:"Germany",DJ:"Djibouti",DK:"Denmark",DM:"Dominica",DO:"Dominican Republic",DZ:"Algeria",EC:"Ecuador",EE:"Estonia",EG:"Egypt",EH:"Western Sahara",ER:"Eritrea",ES:"Spain",ET:"Ethiopia",FI:"Finland",FJ:"Fiji",FK:"Falkland Islands",FM:"Micronesia",FO:"Faroe Islands",FQ:"French Southern and Antarctic Territories",FR:"France",FX:"Metropolitan France",GA:"Gabon",GB:"United Kingdom",GD:"Grenada",GE:"Georgia",GF:"French Guiana",GG:"Guernsey",GH:"Ghana",GI:"Gibraltar",GL:"Greenland",GM:"Gambia",GN:"Guinea",GP:"Guadeloupe",GQ:"Equatorial Guinea",GR:"Greece",GS:"South Georgia and the South Sandwich Islands",GT:"Guatemala",GU:"Guam",GW:"Guinea-Bissau",GY:"Guyana",HK:"Hong Kong SAR China",HM:"Heard Island and McDonald Islands",HN:"Honduras",HR:"Croatia",HT:"Haiti",HU:"Hungary",ID:"Indonesia",IE:"Ireland",IL:"Israel",IM:"Isle of Man",IN:"India",IO:"British Indian Ocean Territory",IQ:"Iraq",IR:"Iran",IS:"Iceland",IT:"Italy",JE:"Jersey",JM:"Jamaica",JO:"Jordan",JP:"Japan",JT:"Johnston Island",KE:"Kenya",KG:"Kyrgyzstan",KH:"Cambodia",KI:"Kiribati",KM:"Comoros",KN:"Saint Kitts and Nevis",KP:"North Korea",KR:"South Korea",KW:"Kuwait",KY:"Cayman Islands",KZ:"Kazakhstan",LA:"Laos",LB:"Lebanon",LC:"Saint Lucia",LI:"Liechtenstein",LK:"Sri Lanka",LR:"Liberia",LS:"Lesotho",LT:"Lithuania",LU:"Luxembourg",LV:"Latvia",LY:"Libya",MA:"Morocco",MC:"Monaco",MD:"Moldova",ME:"Montenegro",MF:"Saint Martin",MG:"Madagascar",MH:"Marshall Islands",MI:"Midway Islands",MK:"Macedonia",ML:"Mali",MM:"Myanmar [Burma]",MN:"Mongolia",MO:"Macau SAR China",MP:"Northern Mariana Islands",MQ:"Martinique",MR:"Mauritania",MS:"Montserrat",MT:"Malta",MU:"Mauritius",MV:"Maldives",MW:"Malawi",MX:"Mexico",MY:"Malaysia",MZ:"Mozambique",NA:"Namibia",NC:"New Caledonia",NE:"Niger",NF:"Norfolk Island",NG:"Nigeria",NI:"Nicaragua",NL:"Netherlands",NO:"Norway",NP:"Nepal",NQ:"Dronning Maud Land",NR:"Nauru",NT:"Neutral Zone",NU:"Niue",NZ:"New Zealand",OM:"Oman",PA:"Panama",PC:"Pacific Islands Trust Territory",PE:"Peru",PF:"French Polynesia",PG:"Papua New Guinea",PH:"Philippines",PK:"Pakistan",PL:"Poland",PM:"Saint Pierre and Miquelon",PN:"Pitcairn Islands",PR:"Puerto Rico",PS:"Palestinian Territories",PT:"Portugal",PU:"U.S. Miscellaneous Pacific Islands",PW:"Palau",PY:"Paraguay",PZ:"Panama Canal Zone",QA:"Qatar",RE:"Réunion",RO:"Romania",RS:"Serbia",RU:"Russia",RW:"Rwanda",SA:"Saudi Arabia",SB:"Solomon Islands",SC:"Seychelles",SD:"Sudan",SE:"Sweden",SG:"Singapore",SH:"Saint Helena",SI:"Slovenia",SJ:"Svalbard and Jan Mayen",SK:"Slovakia",SL:"Sierra Leone",SM:"San Marino",SN:"Senegal",SO:"Somalia",SR:"Suriname",ST:"São Tomé and Príncipe",SU:"Union of Soviet Socialist Republics",SV:"El Salvador",SY:"Syria",SZ:"Swaziland",TC:"Turks and Caicos Islands",TD:"Chad",TF:"French Southern Territories",TG:"Togo",TH:"Thailand",TJ:"Tajikistan",TK:"Tokelau",TL:"Timor-Leste",TM:"Turkmenistan",TN:"Tunisia",TO:"Tonga",TR:"Turkey",TT:"Trinidad and Tobago",TV:"Tuvalu",TW:"Taiwan",TZ:"Tanzania",UA:"Ukraine",UG:"Uganda",UM:"U.S. Minor Outlying Islands",US:"United States",UY:"Uruguay",UZ:"Uzbekistan",VA:"Vatican City",VC:"Saint Vincent and the Grenadines",VD:"North Vietnam",VE:"Venezuela",VG:"British Virgin Islands",VI:"U.S. Virgin Islands",VN:"Vietnam",VU:"Vanuatu",WF:"Wallis and Futuna",WK:"Wake Island",WS:"Samoa",YD:"People's Democratic Republic of Yemen",YE:"Yemen",YT:"Mayotte",ZA:"South Africa",ZM:"Zambia",ZW:"Zimbabwe",ZZ:"Unknown or Invalid Region" };
            var countriesArray = tjq.map(countries, function(value, key) {return {value: value,data: key}; });            
                  
            // initialize autocomplete with custom appendTo
            tjq('#hotelAutoCompleteCountry').autocomplete({
                lookup: countriesArray,appendTo: '#autocomplete-container'
            });

        });
        
        
    </script>
</body>
</html>

