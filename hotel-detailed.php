<?php ob_start(); ?>
<!DOCTYPE html>
<html> 
<head>
    <!-- Page Title -->
    <title>Travelafric.com</title>
    
    <?php require 'template/head.html'; ?>
    <style type="text/css">
        iframe{width:100%!important }
    </style>
</head>
<body>
    
    <div id="page-wrapper">
        <?php require 'template/nav.php'; ?>
        <?php 
            $hotel_id = Input::get('hotel');
            $roomQty = Input::get('room'); $adult = Input::get('adult');$infant = Input::get('infant'); 
            $dateIn = Input::get('from');$dateOut = Input::get('to'); 
            $in = new DateTime($dateIn); $out = new DateTime($dateOut);
            $nights = $interval = date_diff($in, $out)->format('%a');
            $hotel = find_by_id('clients',$hotel_id);
            $full_stars =  $hotel->stars;

            $jsonHotel = json_decode($hotel->company_details);
            $jsonRep = json_decode($hotel->user_details);

            if(Input::get('newsearch')){
                echo $new_dateIn = Input::get('new-in-date'); $new_dateOut = Input::get('new-out-date');
                $new_roomQty = Input::get('new-room-qty'); $new_adult=Input::get('new-adult'); $new_infant=Input::get('new-infant');
                header('Location: hotel-detailed.php?hotel='.$hotel->id.'&from='.$new_dateIn.'&to='.$new_dateOut.'&adult='.$new_adult.'&infant='.$new_infant.'&room='.$new_roomQty.'#hotel-availability');
            }
        ?>    
        <div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title"><?php echo $hotel->company_name; ?></h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="#">HOME</a></li>
                    <li class="active">Hotel Details</li>
                </ul>
            </div>
        </div>
        <section id="content">
            <div class="container">
                <div class="row">
                    <div id="main" class="col-md-9">
                        <div class="tab-container style1" id="hotel-main-content">
                            <ul class="tabs">
                                <li class="active"><a data-toggle="tab" href="#photos-tab">photos</a></li>
                                <li><a data-toggle="tab" href="#map-tab">map</a></li>
                                <!-- <li class="pull-right"><a class="button btn-small yellow-bg white-color" href="extra-pages-travel-guide.html">TRAVEL GUIDE</a></li> -->
                            </ul>
                            <div class="tab-content">
                                <div id="photos-tab" class="tab-pane fade in active">
                                    <div class="photo-gallery style1" data-animation="slide" data-sync="#photos-tab .image-carousel">
                                        <!--Link to Database for results display-->
                                        <ul class="slides">
                                            <?php $sliders = DB::getInstance()->query("SELECT * FROM media WHERE hid = $hotel_id"); 
                                                $num = $sliders->count(); $x=1;
                                                foreach ($sliders->results() as $key => $value) { 
                                                    $active = $x<=$num ? 'active' : '';
                                                    $lastImg = $value->path;
                                            ?>
                                            <li><img src="hotels/<?php echo $value->path; ?>" alt="" /></li>
                                            
                                            <?php        
                                                $x++; }
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="image-carousel style1" data-animation="slide" data-item-width="70" data-item-margin="10" data-sync="#photos-tab .photo-gallery">
                                        <ul class="slides">
                                            <?php $slidersthumb = DB::getInstance()->query("SELECT * FROM media WHERE hid = $hotel_id"); 
                                                foreach ($slidersthumb->results() as $key => $valuethumb) { 
                                            ?>
                                            <li><img src="hotels/<?php echo $valuethumb->path; ?>" alt="" /></li>
                                            <?php        
                                                }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                                <div id="map-tab" class="tab-pane fade">
                                    <img src="hotels/<?php echo $hotel->map_image; ?>" class="img-responsive" style="width:100% ">
                                </div>
                                <div id="steet-view-tab" class="tab-pane fade" style="height: 500px;">
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div id="hotel-features" class="tab-container">
                            <ul class="tabs">
                                <li class="active"><a href="#hotel-description" data-toggle="tab">Description</a></li>
                                <li><a href="#hotel-availability" data-toggle="tab">Book Now</a></li>
                                <li><a href="#hotel-amenities" data-toggle="tab">Amenities</a></li>
                                <li><a href="#hotel-reviews" data-toggle="tab">Reviews</a></li>
                                <li><a href="#hotel-faqs" data-toggle="tab">Norms</a></li>
                                <li><a href="#hotel-things-todo" data-toggle="tab">Things to Do</a></li>
                                
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="hotel-description">
                                    <div class="intro table-wrapper full-width hidden-table-sms" style="border-spacing:0px;border: 15px solid #f5f5f5; ">
                                        <div class="col-sm-5 col-lg-4 features table-cell">
                                            <ul>
                                                <li><label>hotel type:</label><?php if(is_numeric($hotel->stars)){echo $hotel->stars.' star';}else{echo $hotel->stars;}?></li>
                                                <li><label>Country:</label><?php echo $hotel->country; ?></li>
                                                <li><label>City:</label><?php echo $hotel->city; ?></li>
                                                <li><label>Cancellation:</label>strict</li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-7 col-lg-8 table-cell testimonials">
                                            <div class="testimonial style1">
                                                <p>Welcome Note</p>
                                                <h5 class="name"><?php echo $jsonRep->fullname;?><br><small><?php echo $jsonRep->position;?></small></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="long-description">
                                        <h2>About <?php echo $hotel->company_name; ?></h2>
                                        <p><?php echo  $jsonHotel->descp; ?>  </p>
                                    </div>
                                    <div class="long-description">
                                        <h2>Landmark</h2>
                                        <p><?php echo  $jsonHotel->landmark; ?>  </p>
                                    </div>
                                </div>
                                <!-- available room -->
                                <div class="tab-pane fade" id="hotel-availability">
                                    <form action="" method="post">
                                        <div class="update-search clearfix">
                                            <div class="col-md-5">
                                                <h4 class="title">When</h4>
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <label>CHECK IN</label>
                                                        <div class="datepicker-wrap">
                                                            <input type="text" name="new-in-date" placeholder="mm/dd/yy" class="input-text full-width" value="<?php echo $dateIn ;?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <label>CHECK OUT</label>
                                                        <div class="datepicker-wrap">
                                                            <input type="text" name="new-out-date" placeholder="mm/dd/yy" class="input-text full-width" value="<?php echo $dateOut ;?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <h4 class="title">Who</h4>
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <label>ROOMS</label>
                                                        <div class="selector">
                                                            <select class="full-width" name="new-room-qty">
                                                                <option value="1" <?php if($roomQty==1){echo 'selected';} ?>>01</option>
                                                                <option value="2" <?php if($roomQty==2){echo 'selected';} ?>>02</option>
                                                                <option value="3" <?php if($roomQty==3){echo 'selected';} ?>>03</option>
                                                                <option value="4" <?php if($roomQty==4){echo 'selected';} ?>>04</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <label>ADULTS</label>
                                                        <div class="selector">
                                                            <select class="full-width" name="new-adult">
                                                                <option value="1" <?php if($adult==1){echo 'selected';} ?>>01</option>
                                                                <option value="2" <?php if($adult==2){echo 'selected';} ?>>02</option>
                                                                <option value="3" <?php if($adult==3){echo 'selected';} ?>>03</option>
                                                                <option value="4" <?php if($adult==4){echo 'selected';} ?>>04</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <label>KIDS</label>
                                                        <div class="selector">
                                                            <select class="full-width" name="new-infant">
                                                                <option value="0" <?php if($infant==0){echo 'selected';} ?>>00</option>
                                                                <option value="1" <?php if($infant==1){echo 'selected';} ?>>01</option>
                                                                <option value="2" <?php if($infant==2){echo 'selected';} ?>>02</option>
                                                                <option value="3" <?php if($infant==3){echo 'selected';} ?>>03</option>
                                                                <option value="4" <?php if($infant==4){echo 'selected';} ?>>04</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-3">
                                                <h4 class="visible-md visible-lg">&nbsp;</h4>
                                                <label class="visible-md visible-lg">&nbsp;</label>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <button data-animation-duration="1" data-animation-type="bounce" class="full-width icon-check animated" type="submit" name="newsearch" value="newsearch">SEARCH NOW</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <h2>Available Rooms</h2>
                                    <div class="room-list listing-style3 hotel">
                                        <?php
                                            $getRoooms = DB::getInstance()->query("SELECT * FROM rooms WHERE hid = $hotel_id AND vacant != 0 AND adult >= $adult AND child >= $infant ORDER BY name ASC "); 
                                            foreach ($getRoooms->results() as $key => $rm){
                                                $availability = DB::getInstance()->query("SELECT * FROM availability WHERE rId = {$rm->id} AND date(start) >= '$dateIn' AND date(start) <= '$dateOut' ");
                                                if($availability->count()<=0){
                                        ?>
                                        <article class="box">
                                            <figure class="col-sm-4 col-md-3">
                                                <a class="hover-effect popup-gallery" href="ajax/slideshow-popup.html" title=""><img width="230" height="160" src="hotels/<?php echo $rm->imgOne; ?>" alt=""></a>
                                            </figure>
                                            <div class="details col-xs-12 col-sm-8 col-md-9">
                                                <div>
                                                    <div>
                                                        <div class="box-title">
                                                            <h4 class="title"><?php echo $rm->name; ?></h4>
                                                            <dl class="description">
                                                                <dt>Max Guests:</dt>
                                                                <dd><?php echo $rm->adult; ?> persons</dd>
                                                            </dl>
                                                            <dl class="description">
                                                                <dt>Meal Plan:</dt>
                                                                <dd><?php echo $rm->meal_plan; ?></dd>
                                                            </dl>
                                                        </div>
                                                        <div class="amenities">
                                                            <i class="soap-icon-wifi circle"></i>
                                                            <i class="soap-icon-fitnessfacility circle"></i>
                                                            <i class="soap-icon-fork circle"></i>
                                                            <i class="soap-icon-television circle"></i>
                                                        </div>
                                                    </div>
                                                    <div class="price-section">
                                                        <?php $isPromo = find_promo("$rm->id");
                                                            if(empty($isPromo->status)){ ?>
                                                        <span class="price"><small> </small>
                                                            <?php if($client->isLoggedIn()){
                                                                    if($client->data()->groups == 2){echo '$'.$rm->agent_price*$nights*$roomQty;}else{ echo '$'.$rm->price*$nights*$roomQty;}  
                                                                }else{ echo '$'.$rm->price*$nights*$roomQty;}                                         
                                                            ?>
                                                        </span>
                                                        <?php echo $nights.' Night(s)';?>S
                                                        <?php }else{ ?>
                                                        <span class="price">
                                                            <small><?php echo $isPromo->title; ?>
                                                            <del class="">
                                                                <?php if($client->isLoggedIn()){
                                                                        if($client->data()->groups == 2){echo '$'.$rm->agent_price*$nights*$roomQty;}else{ echo '$'.$rm->price*$nights*$roomQty;} 
                                                                    }else{ echo '$'.$rm->price*$nights*$roomQty;}                                         
                                                                ?>
                                                            </del>
                                                            </small>
                                                            $<?php 
                                                                if($client->isLoggedIn()){
                                                                    if($client->data()->groups == 2){
                                                                        echo $rm->agent_price*$nights*$roomQty - ( ($isPromo->rate/100)*$rm->agent_price*$nights*$roomQty ); 
                                                                    }else{echo $rm->price*$nights*$roomQty - ( ($isPromo->rate/100)*$rm->price*$nights*$roomQty );}
                                                                }else{echo $rm->price*$nights*$roomQty - ( ($isPromo->rate/100)*$rm->price*$nights*$roomQty );}                                         
                                                            ?>
                                                        </span>
                                                        <?php echo $nights.' Night(s)';?>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                
                                                <div>
                                                    <p><?php echo $rm->descp; ?></p>
                                                    <div class="action-section">
                                                        <a href="hotel-booking.php?room=<?php echo $rm->id.'&hotel='.$hotel->id.'&from='.$dateIn.'&to='.$dateOut.'&adult='.$adult.'&infant='.$infant.'&roomqty='.$roomQty;?>" title="" class="button btn-small full-width text-center">BOOK NOW</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                        <?php }else{} ?>


                                        <?php } ?>
                                        
                                        <!-- <a href="#" class="load-more button full-width btn-large fourty-space">LOAD MORE ROOMS</a> -->
                                    </div>
                                    
                                </div>
                                <!-- amenities -->
                                <div class="tab-pane fade" id="hotel-amenities">
                                    <h2>Our Facilities and Services</h2>
                                    <?php $fac=find_by('facilities','hotel_id',$hotel->id);if(!empty($fac->facil)){$jsonFac = json_decode($fac->facil); ?>
                                    <ul class="amenities clearfix style2">
                                        <?php if($jsonFac->WIFI=='on'){?>
                                        <li class="col-md-4 col-sm-6"> <div class="icon-box style2"><i class="soap-icon-wifi circle"></i>WI_FI</div></li>
                                        <?php }?><?php if($jsonFac->SWIMMING_POOL=='on'){?>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-swimming circle"></i>swimming pool</div>
                                        </li><?php }?><?php if($jsonFac->TELEVISION=='on'){?>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-television circle"></i>television</div>
                                        </li><?php }?><?php if($jsonFac->COFFEE=='on'){?>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-coffee circle"></i>coffee</div>
                                        </li><?php }?><?php if($jsonFac->AIR_CONDITIONING=='on'){?>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-aircon circle"></i>air conditioning</div>
                                        </li><?php }?><?php if($jsonFac->FITNESS_FACILITY=='on'){?>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-fitnessfacility circle"></i>fitness facility</div>
                                        </li><?php }?><?php if($jsonFac->FRIDGE=='on'){?>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-fridge circle"></i>fridge</div>
                                        </li><?php }?><?php if($jsonFac->WINE_BAR=='on'){?>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-winebar circle"></i>wine bar</div>
                                        </li><?php }?><?php if($jsonFac->SMOKING_ALLOWED=='on'){?>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-smoking circle"></i>smoking allowed</div>
                                        </li><?php }?><?php if($jsonFac->ENTERTAINMENT=='on'){?>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-entertainment circle"></i>entertainment</div>
                                        </li><?php }?><?php if($jsonFac->SECURE_VAULT=='on'){?>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-securevault circle"></i>secure vault</div>
                                        </li><?php }?><?php if($jsonFac->PICK_DROP=='on'){?>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-pickanddrop circle"></i>pick and drop</div>
                                        </li><?php }?><?php if($jsonFac->ROOM_SERVICE=='on'){?>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-phone circle"></i>room service</div>
                                        </li><?php }?><?php if($jsonFac->PETS_ALLOWED=='on'){?>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-pets circle"></i>pets allowed</div>
                                        </li><?php }?><?php if($jsonFac->PLAY_PLACE=='on'){?>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-playplace circle"></i>play place</div>
                                        </li><?php }?><?php if($jsonFac->COMPLIMENTARY_BREAKFAST=='on'){?>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-breakfast circle"></i>complimentary breakfast</div>
                                        </li><?php }?><?php if($jsonFac->FREE_PARKING=='on'){?>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-parking circle"></i>Free parking</div>
                                        </li><?php }?><?php if($jsonFac->CONFERENCE_ROOM=='on'){?>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-conference circle"></i>conference room</div>
                                        </li><?php }?><?php if($jsonFac->FIRE_PLACE=='on'){?>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-fireplace circle"></i>fire place</div>
                                        </li><?php }?><?php if($jsonFac->HANDICAP_ACCESSIBLE=='on'){?>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-handicapaccessiable circle"></i>Handicap Accessible</div>
                                        </li><?php }?><?php if($jsonFac->DOORMAN=='on'){?>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-doorman circle"></i>Doorman</div>
                                        </li><?php }?><?php if($jsonFac->HOT_TUB=='on'){?>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-tub circle"></i>Hot Tub</div>
                                        </li><?php }?><?php if($jsonFac->ELEVATOR=='on'){?>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-elevator circle"></i>Elevator in Building</div>
                                        </li><?php }?><?php if($jsonFac->SUITABLE_EVENTS=='on'){?>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-star circle"></i>Suitable for Events</div>
                                        </li><?php }?>
                                    </ul>
                                    <?php } ?>
                                    <br />
                                </div>
                                <!-- review list -->
                                <?php $avag = cal_ratings($hotel->id); ?>
                                <div class="tab-pane fade" id="hotel-reviews">
                                    <div class="intro table-wrapper full-width hidden-table-sms">
                                        <div class="rating table-cell col-sm-4">
                                            <span class="score"><?php echo $avag['total'].'.0';?>/5.0</span>
                                            <div class="each-rating"><div class="five-stars-container editable-rating" data-original-stars="<?php echo $avag['total'];?>"></div></div>
                                            <span class="status"><?php echo rating_expression($avag['total']); ?></span>
                                            <!-- <a href="#" class="goto-writereview-pane button green btn-small full-width">WRITE A REVIEW</a> -->
                                        </div>
                                        <div class="table-cell col-sm-8">
                                            <div class="detailed-rating">
                                                <ul class="clearfix">
                                                    <li class="col-md-6"><div class="each-rating"><label>service</label><div class="five-stars-container editable-rating" data-original-stars="<?php echo $avag['service'];?>"></div></div></li>
                                                    <li class="col-md-6"><div class="each-rating"><label>Value</label><div class="five-stars-container editable-rating" data-original-stars="<?php echo $avag['values'];?>"></div></div></li>
                                                    <li class="col-md-6"><div class="each-rating"><label>Sleep Quality</label><div class="five-stars-container editable-rating" data-original-stars="<?php echo $avag['sleep'];?>"></div></div></li>
                                                    <li class="col-md-6"><div class="each-rating"><label>Cleanliness</label><div class="five-stars-container editable-rating" data-original-stars="<?php echo $avag['cleanliness'];?>"></div></div></li>
                                                    <li class="col-md-6"><div class="each-rating"><label>location</label><div class="five-stars-container editable-rating" data-original-stars="<?php echo $avag['location'];?>"></div></div></li>
                                                    <li class="col-md-6"><div class="each-rating"><label>rooms</label><div class="five-stars-container editable-rating" data-original-stars="<?php echo $avag['room'];?>"></div></div></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="guest-reviews">
                                        <h2>Guest Reviews</h2>
                                        <?php
                                            $reviews = DB::getInstance()->query("SELECT * FROM reviews WHERE hotel = $hotel_id AND reply = 0 LIMIT 5");
                                            foreach ($reviews->results() as $key => $review) {
                                                $bkId = find_by_id('booking',$review->bookId);
                                                $jsonArray = json_decode($bkId->trans_details);
                                                $singleRateing = single_rating($review->bookId);
                                        ?>
                                        <div class="guest-review table-wrapper">
                                            <!-- <div class="col-xs-3 col-md-2 author table-cell">
                                                <a href="#"><img src="http://placehold.it/270x263" alt="" width="270" height="263" /></a>
                                                <p class="name"><?php //echo $jsonArray->name; ?></p>
                                                <p class="date"><?php //echo review_date($review->datee); ?> </p>
                                            </div> -->
                                            <div class="col-xs-9 col-md-10 table-cell comment-container">
                                                <div class="comment-header clearfix">
                                                    <h4 class="comment-title"><?php echo $review->title; ?></h4>
                                                    <div class="review-score">
                                                        <div class="each-rating"><div class="five-stars-container editable-rating" data-original-stars="<?php echo $singleRateing['total'];?>"></div><span class="score"><?php echo $singleRateing['total'].'.0';?>/5.0</span></div>
                                                    </div>
                                                </div>
                                                <div class="comment-content">
                                                    <p><?php echo $review->comment ?></p>
                                                </div>
                                                <p class="name pull-left" style="text-transform:capitalize"><?php echo $jsonArray->name ?></p>
                                                <p class="date pull-right"><?php echo review_date($review->datee); ?> </p>
                                            </div>
                                        </div>
                                        <?php } ?>

                                    </div>
                                    <!-- <a href="#" class="button full-width btn-large">LOAD MORE REVIEWS</a> -->
                                </div>
                                <!-- norms and notes -->
                                <div class="tab-pane fade" id="hotel-faqs">
                                    <h2>Hotel Norms</h2>
                                    <p><?php echo $jsonHotel->norms; ?></p>
                                    <h2>General Information</h2>
                                    <p><?php echo $jsonHotel->notes; ?></p>
                                </div>
                                <!-- things we do -->
                                <div class="tab-pane fade" id="hotel-things-todo">
                                    <h2>Things to Do</h2>
                                    <p>Browse a list events, tours and sightseeing. within the city</p>
                                    <div class="activities image-box style2 innerstyle">
                                        <?php $search = DB::getInstance()->query("SELECT * FROM excursion WHERE status = 1 AND country='$hotel->country' AND city='$hotel->city' ORDER BY start ASC LIMIT 3");  
                                            if ($search->count()) {
                                                $today = date('m/d/Y');
                                                foreach ($search->results() as $key => $value) :
                                        ?>
                                        <article class="box">
                                            <figure>
                                                <a title="" href="#"><img width="250" alt="image" style="height:161px" src="<?php echo 'cctech-admin/'.$value->image; ?>"></a>
                                            </figure>
                                            <div class="details">
                                                <div class="details-header">
                                                    <!-- <div class="review-score">
                                                        <div class="five-stars-container"><div style="width: 60%;" class="five-stars"></div></div>
                                                        <span class="reviews">25 reviews</span>
                                                    </div> -->
                                                    <h4 class="box-title"><?php echo $value->title;?></h4>
                                                </div>
                                                <p><?php echo 'Enjoy an awesome sightseeing experience';?></p>
                                                <a class="button" title="" href="cruise-detailed.php?id=<?php echo $value->id ?>&date=<?php echo $today;?>&kids=<?php echo $value->infant ?>">MORE</a>
                                            </div>
                                        </article>
                                        <?php endforeach; }else{ ?>
                                        <div class="alert alert-notice">Notice Message. No result found.<span class="close"></span></div>
                                        <?php } ?>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                               
                            </div>
                        
                        </div>
                    </div>
                    <div class="sidebar col-md-3">
                        <article class="detailed-logo">
                            <figure>
                                <?php 
                                    $getImage2 = $conn->query("SELECT path FROM media WHERE hid = $hotel->id LIMIT 1");
                                    foreach ($getImage2->results() as $key => $img):
                                ?>
                                <img width="114" height="85" src="hotels/<?php echo $img->path;?>" alt="">
                                <?php endforeach; ?>
                            </figure>
                            <div class="details">
                                <h2 class="box-title"><?php echo $hotel->company_name; ?><small><i class="soap-icon-departure yellow-color"></i><span class="fourty-space"><?php echo $hotel->city.', '.$hotel->country; ?></span></small></h2>
                                <span class="price clearfix">
                                    <small class="pull-left">avg/night</small>
                                    <span class="pull-right"><?php echo '$'.lowest_roomPrice($hotel_id); ?></span>
                                </span>
                                <div class="feedback clearfix">
                                    <div title="4 stars" class="five-stars-container" data-toggle="tooltip" data-placement="bottom"><span class="five-stars" style="width: 80%;"></span></div>
                                    <span class="review pull-right"><?php echo num_reviews($hotel_id); ?> reviews</span>
                                </div>
                                <!-- <p class="description">Nunc cursus libero purus ac congue ar lorem cursus ut sed vitae pulvinar massa idend porta nequetiam elerisque mi id, consectetur adipi deese cing elit maus fringilla bibe endum.</p>
                                <a class="button yellow full-width uppercase btn-small" href="001%20Cart.html">add to Cart</a> -->
                            </div>
                        </article>
                        <div class="travelo-box contact-box">
                            <h4>Need Travelafric Help?</h4>
                            <p>We would be more than happy to help you. Our Account Manager are 24/7 at your service to help you.</p>
                            <address class="contact-details">
                                <span class="contact-phone"><i class="soap-icon-phone"></i> +233-247-93-3218 </span>
                                <br>
                                <a class="contact-email" href="#">info@travelafric.com</a>
                            </address>
                        </div>
                        <div class="travelo-box">
                            <h4>Similar Listings</h4>
                            <div class="image-box style14">
                                <?php 
                                    $s_hotel = DB::getInstance()->query("SELECT * FROM clients WHERE country='$hotel->country' AND groups=4 AND verified=1 ORDER BY id DESC LIMIT 3");
                                        if($s_hotel->count()){
                                           foreach ($s_hotel->results() as $key => $hval) {
                                            $jsonSimilar=json_decode($hval->company_details);
                                ?>
                                <article class="box">
                                    <figure>
                                        <?php 
                                            $getImagetwo = $conn->query("SELECT path FROM media WHERE hid = $hval->id LIMIT 1");
                                            foreach ($getImagetwo->results() as $key => $imgtwo):
                                        ?>
                                        <a href="hotel-detailed.php?hotel=<?php echo $hval->id.'&from='.$dateIn.'&to='.$dateOut.'&adult='.$adult.'&infant='.$infant.'&room='.$roomQty;?>"><img src="hotels/<?php echo $imgtwo->path;?>" alt="image" style="width:63px;height:59px;"  /></a>
                                        <?php endforeach; ?>
                                    </figure>
                                    <div class="details">
                                        <h5 class="box-title"><a href="hotel-detailed.php?hotel=<?php echo $hval->id.'&from='.$dateIn.'&to='.$dateOut.'&adult='.$adult.'&infant='.$infant.'&room='.$roomQty;?>"><?php echo $hval->company_name ?></a></h5>
                                        <label class="price-wrapper">
                                            <span class="price-per-unit"><?php echo '$'.lowest_roomPrice($hval->id); ?></span>avg/night
                                        </label>
                                    </div>
                                </article>
                                <?php } } ?>
                                
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
        
        <?php include 'template/footer.php'; ?>
    </div>

    <?php include 'template/js-loader.html'; ?>
    <!-- Google Map Api -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA760wvLttcQlwxy5fhzgi36tWGHOgW23g.exp&amp;sensor=false"></script>
    <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA760wvLttcQlwxy5fhzgi36tWGHOgW23g"
  type="text/javascript"></script> -->

    <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA760wvLttcQlwxy5fhzgi36tWGHOgW23g"> </script> -->
    
    <script type="text/javascript" src="res/js/calendar.js"></script>
    <script type="text/javascript">
        tjq(document).ready(function() {
            // calendar panel
            var cal = new Calendar();
            var unavailable_days = [17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31];
            var price_arr = {3: '$170', 4: '$170', 5: '$170', 6: '$170', 7: '$170', 8: '$170', 9: '$170', 10: '$170', 11: '$170', 12: '$170', 13: '$170', 14: '$170', 15: '$170', 16: '$170', 17: '$170'};

            var current_date = new Date();
            var current_year_month = (1900 + current_date.getYear()) + "-" + (current_date.getMonth() + 1);
            tjq("#select-month").find("[value='" + current_year_month + "']").prop("selected", "selected");
            cal.generateHTML(current_date.getMonth(), (1900 + current_date.getYear()), unavailable_days, price_arr);
            tjq(".calendar").html(cal.getHTML());
            
            tjq("#select-month").change(function() {
                var selected_year_month = tjq("#select-month option:selected").val();
                var year = parseInt(selected_year_month.split("-")[0], 10);
                var month = parseInt(selected_year_month.split("-")[1], 10);
                cal.generateHTML(month - 1, year, unavailable_days, price_arr);
                tjq(".calendar").html(cal.getHTML());
            });
            
            
            tjq(".goto-writereview-pane").click(function(e) {
                e.preventDefault();
                tjq('#hotel-features .tabs a[href="#hotel-write-review"]').tab('show')
            });
            
            // editable rating
            tjq(".editable-rating.five-stars-container").each(function() {
                var oringnal_value = tjq(this).data("original-stars");
                if (typeof oringnal_value == "undefined") {
                    oringnal_value = 0;
                } else {
                    //oringnal_value = 10 * parseInt(oringnal_value);
                }
                tjq(this).slider({
                    range: "min",
                    value: oringnal_value,
                    min: 0,
                    max: 5,
                    slide: function( event, ui ) {
                        
                    }
                });
            });
        });
        
        /*tjq('a[href="#map-tab"]').on('shown.bs.tab', function (e) {
            var center = panorama.getPosition();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
        });
        tjq('a[href="#steet-view-tab"]').on('shown.bs.tab', function (e) {
            fenway = panorama.getPosition();
            panoramaOptions.position = fenway;
            panorama = new google.maps.StreetViewPanorama(document.getElementById('steet-view-tab'), panoramaOptions);
            map.setStreetView(panorama);
        });
        var map = null;
        var panorama = null;
        var fenway = new google.maps.LatLng(48.855702, 2.292577);
        var mapOptions = {
            center: fenway,
            zoom: 12
        };
        var panoramaOptions = {
            position: fenway,
            pov: {
                heading: 34,
                pitch: 10
            }
        };
        function initialize() {
            tjq("#map-tab").height(tjq("#hotel-main-content").width() * 0.6);
            map = new google.maps.Map(document.getElementById('map-tab'), mapOptions);
            panorama = new google.maps.StreetViewPanorama(document.getElementById('steet-view-tab'), panoramaOptions);
            map.setStreetView(panorama);
        }
        google.maps.event.addDomListener(window, 'load', initialize);*/
    </script>
</body>
</html>

