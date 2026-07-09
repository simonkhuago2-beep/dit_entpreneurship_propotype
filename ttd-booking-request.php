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
        <?php require 'template/nav.php'; ?>

        <div class="page-title-container">
                <div class="container">
                    <div class="page-title pull-left">
                        <h2 class="entry-title">Booking Request</h2>
                    </div>
                    <ul class="breadcrumbs pull-right">
                        <li><a href="index.php">HOME</a></li>
                        <li class="active">Booking Request</li>
                    </ul>
                </div>
        </div>
        <section id="content">
            <div class="container">
                <div class="row">
                    <div id="main" class="col-sm-8 col-md-9">
                        <div class="travelo-box booking-section">
                            <form class="booking-form">
                                <div class="person-information">
                                    <h2>Contact Details</h2>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>first name</label>
                                            <input type="text" class="input-text full-width" value="" placeholder="" />
                                        </div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>last name</label>
                                            <input type="text" class="input-text full-width" value="" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>email address</label>
                                            <input type="text" class="input-text full-width" value="" placeholder="" />
                                        </div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>Verify E-mail Address</label>
                                            <input type="text" class="input-text full-width" value="" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>Country code</label>
                                            <div class="selector">
                                                <select class="full-width">
                                                    <option>United Kingdom (+44)</option>
                                                    <option>United States (+1)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>Phone number</label>
                                            <input type="text" class="input-text full-width" value="" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div class="group-details">
                                    <h2>Request Details</h2>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>Reason for booking 1</label>
                                            <input type="text" class="input-text full-width" value="" placeholder="" />
                                        </div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>Reason for booking 2 (optional)</label>
                                            <input type="text" class="input-text full-width" value="" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="booking-type">
                                    <h2>What do you need to Book?</h2>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>Booking type</label>
                                            <div class="selector">
                                                <select class="full-width">
                                                    <option>Flights + Hotel</option>
                                                    <option>Hotel + Excursion</option>
                                                    <option>Hotel Only</option>
                                                    <option>Excursion Only</option>
                                                    <option>Hotel + Transfer + Excursion</option>
                                                    <option>Hotel + Transfer + Excursion + Ticket</option>
                                                    <option>All Inclusive Tour Package</option>
                                                </select>
                                                
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>Duration of Stay</label>
                                            <div class="selector">
                                                <select class="full-width">
                                                    <option>1 Nights</option>
                                                    <option>2 Nights</option>
                                                    <option>3 Nights</option>
                                                    <option>4 Nights</option>
                                                    <option>5 Nights</option>
                                                    <option>6 Nights</option>
                                                    <option>7 Nights</option>
                                                    <option>Other</option>
                                                </select>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>Departure Date</label>
                                            <div class="datepicker-wrap">
                                                <input type="text" name="date_from" class="input-text full-width" placeholder="mm/dd/yy" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>Return Date</label>
                                            <div class="datepicker-wrap">
                                                <input type="text" name="date_to" class="input-text full-width" placeholder="mm/dd/yy" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="booking-hotel">
                                    <h2>Hotel</h2>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>Destination</label>
                                            <input type="text" class="input-text full-width" value="" placeholder="enter a destination" />
                                        </div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>Name of specific hotel</label>
                                            <input type="text" class="input-text full-width" value="" placeholder="enter hotel name" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-xs-12 col-md-5">
                                            <label>Board Basis</label>
                                            <div class="selector">
                                                <select class="full-width">
                                                    <option>Room only</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-5 constant-column-3">
                                            <div>
                                                <label>Room type</label>
                                                <div class="selector">
                                                    <select class="full-width">
                                                        <option>single</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div>
                                                <label>Adults</label>
                                                <div class="selector">
                                                    <select class="full-width">
                                                        <option>02</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div>
                                                <label>KIDS</label>
                                                <div class="selector">
                                                    <select class="full-width">
                                                        <option>01</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <a href="#" class="button btn-medium sky-blue1 uppercase">Add more rooms</a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span>(Minimum of 4 rooms or 13 flight passengers)</span>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-10">
                                            <label>additional information</label>
                                            <textarea class="full-width" rows="10" placeholder="Please provide any additional information regarding your hotel requirements."></textarea>
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
                                        <button type="submit" class="full-width btn-large">CONFIRM BOOKING</button>
                                    </div>
                                </div>
                                <hr />
                            </form>
                        </div>
                    </div>
                    <div class="sidebar col-sm-4 col-md-3">
                    <div class="travelo-box contact-box">
                            <h4>Need Travelafric Help?</h4>
                            <p>We would be more than happy to help you. Our team advisor are 24/7 at your service to help you.</p>
                            <address class="contact-details">
                                <span class="contact-phone"><i class="soap-icon-phone"></i> 233-247-943-218</span>
                                <br>
                                <a class="contact-email" href="#">info@travelafric.com</a>
                            </address>
                        </div>
                        <div class="travelo-box">
                            <h4 class="box-title">Similar Listings</h4>
                            <div class="image-box style14">
                                <article class="box">
                                    <figure><a href="#" title=""><img width="63" height="59" src="http://placehold.it/63x59" alt=""></a></figure>
                                    <div class="details">
                                        <h5 class="box-title"><a href="#">Plaza Tour Eiffel</a></h5>
                                        <label class="price-wrapper"><span class="price-per-unit">$170</span>avg/night</label>
                                    </div>
                                </article>
                                <article class="box">
                                    <figure><a href="#" title=""><img width="63" height="59" src="http://placehold.it/63x59" alt=""></a></figure>
                                    <div class="details">
                                        <h5 class="box-title"><a href="#">Ocean Park Tour</a></h5>
                                        <label class="price-wrapper"><span class="price-per-unit">$620</span>avg/night</label>
                                    </div>
                                </article>
                                <article class="box">
                                    <figure><a href="#" title=""><img width="63" height="59" src="http://placehold.it/63x59" alt=""></a></figure>
                                    <div class="details">
                                        <h5 class="box-title"><a href="#">Dream World Trip</a></h5>
                                        <label class="price-wrapper"><span class="price-per-unit">$322</span>avg/night</label>
                                    </div>
                                </article>
                            </div>
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
    </div> 

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


    
</body>