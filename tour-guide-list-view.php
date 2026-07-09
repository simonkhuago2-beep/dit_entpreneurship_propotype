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
                        <h2 class="entry-title">Tour Guide Results</h2>
                    </div>
                    <ul class="breadcrumbs pull-right">
                        <li><a href="index.php">HOME</a></li>
                        <li class="active">Tour Guide Results</li>
                    </ul>
                </div>
        </div>
        <section id="content">
            <div class="container">
                <div id="main">
                    <div class="row">
                        <div class="col-sm-4 col-md-3">

                            
                         
                            <h4 class="search-results-title"><i class="soap-icon-search"></i><b>1,984</b> results found.</h4>
                            <div class="toggle-container filters-container">
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#modify-search-panel" class="collapsed">Modify Search</a>
                                    </h4>
                                    <div id="modify-search-panel" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <form method="post">
                                                <div class="form-group">
                                                    <label>Country</label>
                                                    <input type="text" class="input-text full-width" placeholder="" value="city, district, or specific airpot" />
                                                </div>
                                                <div class="form-group">
                                                    <label>Special Interest</label>
                                                    <div class="datepicker-wrap">
                                                        <input type="text" name="date_from" class="input-text full-width" placeholder="mm/dd/yy" />
                                                    </div>
                                                </div>
                                               
                                                <br />
                                                <button class="btn-medium icon-check uppercase full-width">Search</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#price-filter" class="collapsed">Price</a>
                                    </h4>
                                    <div id="price-filter" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <div id="price-range"></div>
                                            <br />
                                            <span class="min-price-label pull-left"></span>
                                            <span class="max-price-label pull-right"></span>
                                            <div class="clearer"></div>
                                        </div><!-- end content -->
                                    </div>
                                </div>
                                
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#flight-times-filter" class="collapsed">Rating</a>
                                    </h4>
                                    <div id="flight-times-filter" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <div id="flight-times" class="slider-color-yellow"></div>
                                            <br />
                                            <span class="start-time-label pull-left"></span>
                                            <span class="end-time-label pull-right"></span>
                                            <div class="clearer"></div>
                                        </div><!-- end content -->
                                    </div>
                                </div>
                                
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#flight-stops-filter" class="collapsed">Availability</a>
                                    </h4>
                                    <div id="flight-stops-filter" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <ul class="check-square filters-option">
                                                <li><a href="#">1 Stop</a></li>
                                                <li><a href="#">2 Stops</a></li>
                                                <li class="active"><a href="#">3 Stops</a></li>
                                                <li><a href="#">MultiStops</a></li>
                                            </ul>
                                            <a class="button btn-mini">MORE</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#airlines-filter" class="collapsed">Special Interest</a>
                                    </h4>
                                    <div id="airlines-filter" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <ul class="check-square filters-option">
                                                <li><a href="#">Major Airline<small>($620)</small></a></li>
                                                <li><a href="#">United Airlines<small>($982)</small></a></li>
                                                <li class="active"><a href="#">delta airlines<small>($1,127)</small></a></li>
                                                <li><a href="#">Alitalia<small>($2,322)</small></a></li>
                                                <li><a href="#">US airways<small>($3,158)</small></a></li>
                                                <li><a href="#">Air France<small>($4,239)</small></a></li>
                                                <li><a href="#">Air tahiti nui<small>($5,872)</small></a></li>
                                            </ul>
                                            <a class="button btn-mini">MORE</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#modify-search-panel" class="collapsed">Modify Search</a>
                                    </h4>
                                    <div id="modify-search-panel" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <form method="post">
                                                <div class="form-group">
                                                    <label>Country</label>
                                                    <input type="text" class="input-text full-width" placeholder="" value="city, district, or specific airpot" />
                                                </div>
                                                <div class="form-group">
                                                    <label>Special Interest</label>
                                                    <div class="datepicker-wrap">
                                                        <input type="text" name="date_from" class="input-text full-width" placeholder="mm/dd/yy" />
                                                    </div>
                                                </div>
                                               
                                                <br />
                                                <button class="btn-medium icon-check uppercase full-width">Search</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>    
                                
                                
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-9">
                            <div class="sort-by-section clearfix box">
                                <h4 class="sort-by-title block-sm">Sort results by:</h4>
                                <ul class="sort-bar clearfix block-sm">
                                    <li class="sort-by-name"><a class="sort-by-container" href="#"><span>name</span></a></li>
                                    <li class="sort-by-price"><a class="sort-by-container" href="#"><span>rating</span></a></li>
                                    <li class="sort-by-rating active"><a class="sort-by-container" href="#"><span></span></a></li>
                                </ul>
                                
                                <ul class="swap-tiles clearfix block-sm">
                                    <li class="swap-list">
                                        <a href="flight-list-view.html"><i class="soap-icon-list"></i></a>
                                    </li>
                                    <li class="swap-grid active">
                                        <a href="flight-grid-view.html"><i class="soap-icon-grid"></i></a>
                                    </li>
                                    <li class="swap-block">
                                        <a href="flight-block-view.html"><i class="soap-icon-block"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="row flight-list image-box flight listing-style1">
                                <div class="col-sm-6 col-lg-4">
                                    <article class="box">
                                        <figure>
                                            <span><img alt="" src="res/images/img1.jpg"></span>
                                        </figure>
                                        <div class="details">
                                            <span class="price"><small>Rate/Person</small>$20</span>
                                            <h4 class="box-title">Omari<small>Stephen</small></h4>
                                            <div class="time">
                                                <div class="take-off">
                                                    
                                                    <div>
                                                        <span class="skin-color">Special Interest</span><br />Adventure<br />Cultural
                                                    </div>
                                                </div>
                                                <div class="landing">
                                                    
                                                    <div>
                                                        <span class="skin-color">Rating</span><br />Excellent<br />4.5 Star
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="duration"><span class="skin-color">Availability</span> Daily, Weekend</p>
                                            <div class="action">
                                                <a class="button btn-small full-width" href="flight-detailed.html">BOOK</a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    <article class="box">
                                        <figure>
                                            <span><img alt="" src="res/images/img1.jpg"></span>
                                        </figure>
                                        <div class="details">
                                            <span class="price"><small>Rate/Person</small>$20</span>
                                            <h4 class="box-title">Omari<small>Stephen</small></h4>
                                            <div class="time">
                                                <div class="take-off">
                                                    
                                                    <div>
                                                        <span class="skin-color">Special Interest</span><br />Adventure<br />Cultural
                                                    </div>
                                                </div>
                                                <div class="landing">
                                                    
                                                    <div>
                                                        <span class="skin-color">Rating</span><br />Excellent<br />4.5 Star
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="duration"><span class="skin-color">Availability</span> Daily, Weekend</p>
                                            <div class="action">
                                                <a class="button btn-small full-width" href="flight-detailed.html">BOOK</a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    <article class="box">
                                        <figure>
                                            <span><img alt="" src="res/images/img1.jpg"></span>
                                        </figure>
                                        <div class="details">
                                            <span class="price"><small>Rate/Person</small>$20</span>
                                            <h4 class="box-title">Omari<small>Stephen</small></h4>
                                            <div class="time">
                                                <div class="take-off">
                                                    
                                                    <div>
                                                        <span class="skin-color">Special Interest</span><br />Adventure<br />Cultural
                                                    </div>
                                                </div>
                                                <div class="landing">
                                                    
                                                    <div>
                                                        <span class="skin-color">Rating</span><br />Excellent<br />4.5 Star
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="duration"><span class="skin-color">Availability</span> Daily, Weekend</p>
                                            <div class="action">
                                                <a class="button btn-small full-width" href="flight-detailed.html">BOOK</a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    <article class="box">
                                        <figure>
                                            <span><img alt="" src="http://placehold.it/270x160"></span>
                                        </figure>
                                        <div class="details">
                                            <span class="price"><small>Rate/Person</small>$20</span>
                                            <h4 class="box-title">Omari<small>Stephen</small></h4>
                                            <div class="time">
                                                <div class="take-off">
                                                    
                                                    <div>
                                                        <span class="skin-color">Special Interest</span><br />Adventure<br />Cultural
                                                    </div>
                                                </div>
                                                <div class="landing">
                                                    
                                                    <div>
                                                        <span class="skin-color">Rating</span><br />Excellent<br />4.5 Star
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="duration"><span class="skin-color">Availability</span> Daily, Weekend</p>
                                            <div class="action">
                                                <a class="button btn-small full-width" href="flight-detailed.html">BOOK</a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    <article class="box">
                                        <figure>
                                            <span><img alt="" src="http://placehold.it/270x160"></span>
                                        </figure>
                                        <div class="details">
                                            <span class="price"><small>Rate/Person</small>$20</span>
                                            <h4 class="box-title">Omari<small>Stephen</small></h4>
                                            <div class="time">
                                                <div class="take-off">
                                                    
                                                    <div>
                                                        <span class="skin-color">Special Interest</span><br />Adventure<br />Cultural
                                                    </div>
                                                </div>
                                                <div class="landing">
                                                    
                                                    <div>
                                                        <span class="skin-color">Rating</span><br />Excellent<br />4.5 Star
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="duration"><span class="skin-color">Availability</span> Daily, Weekend</p>
                                            <div class="action">
                                                <a class="button btn-small full-width" href="flight-detailed.html">BOOK</a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    <article class="box">
                                        <figure>
                                            <span><img alt="" src="http://placehold.it/270x160"></span>
                                        </figure>
                                        <div class="details">
                                            <span class="price"><small>Rate/Person</small>$20</span>
                                            <h4 class="box-title">Omari<small>Stephen</small></h4>
                                            <div class="time">
                                                <div class="take-off">
                                                    
                                                    <div>
                                                        <span class="skin-color">Special Interest</span><br />Adventure<br />Cultural
                                                    </div>
                                                </div>
                                                <div class="landing">
                                                    
                                                    <div>
                                                        <span class="skin-color">Rating</span><br />Excellent<br />4.5 Star
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="duration"><span class="skin-color">Availability</span> Daily, Weekend</p>
                                            <div class="action">
                                                <a class="button btn-small full-width" href="flight-detailed.html">BOOK</a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            </div>
                            <a class="button uppercase full-width btn-large">Load More</a>
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