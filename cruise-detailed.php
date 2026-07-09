<?php ob_start() ?>
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
            $excur = find_by_id('excursion',Input::get('id'));
            $date = Input::get('date'); $kids = Input::get('kids');
        ?>
        <div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title">Sightseeing Detailed</h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="#">HOME</a></li>
                    <li class="active">Sightseeing Detailed</li>
                </ul>
            </div>
        </div>
        <section id="content">
            <div class="container">
                <div class="row">
                    <div id="main" class="col-md-9">
                        <div class="tab-container style1" id="cruise-main-content">
                            <ul class="tabs">
                                <li class="active"><a data-toggle="tab" href="#photos-tab">photos</a></li>
                                <li class="pull-right"><a class="button btn-small yellow-bg white-color" href="extra-pages-travel-guide.html">TRAVEL GUIDE</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="photos-tab" class="tab-pane fade in active">
                                    <div class="photo-gallery style1" data-animation="slide" data-sync="#photos-tab .image-carousel">
                                        <ul class="slides">
                                            <li><img src="cctech-admin/<?php echo $excur->image;?>" style="height:500px; " alt="" /></li>
                                            <li><img src="cctech-admin/<?php echo $excur->image1;?>" style="height:500px; " alt="" /></li>
                                            <li><img src="cctech-admin/<?php echo $excur->image2;?>" style="height:500px; " alt="" /></li>
                                        </ul>
                                    </div>
                                    <div class="image-carousel style1" data-animation="slide" data-item-width="70" data-item-margin="10" data-sync="#photos-tab .photo-gallery">
                                        <ul class="slides">
                                            <li><img src="cctech-admin/<?php echo $excur->image;?>" style="height:70px; " alt="" /></li>
                                            <li><img src="cctech-admin/<?php echo $excur->image1;?>" style="height:70px; " alt="" /></li>
                                            <li><img src="cctech-admin/<?php echo $excur->image2;?>" style="height:70px; " alt="" /></li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="calendar-tab" class="tab-pane fade">
                                    <label>SELECT MONTH</label>
                                    <div class="col-sm-6 col-md-4 no-float no-padding">
                                        <div class="selector">
                                            <select class="full-width" id="select-month">
                                                <option value="2014-6">June 2014</option>
                                                <option value="2014-7">July 2014</option>
                                                <option value="2014-8">August 2014</option>
                                                <option value="2014-9">September 2014</option>
                                                <option value="2014-10">October 2014</option>
                                                <option value="2014-11">November 2014</option>
                                                <option value="2014-12">December 2014</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="calendar"></div>
                                            <div class="calendar-legend">
                                                <label class="available">available</label>
                                                <label class="unavailable">unavailable</label>
                                                <label class="past">past</label>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div id="cruise-features" class="tab-container">
                            <ul class="tabs">
                                <li class="active"><a href="#cruise-description" data-toggle="tab">Description</a></li>
                                <li><a href="#cruise-availability" data-toggle="tab">Book Now</a></li>
                                <li><a href="#cruise-amenities" data-toggle="tab">Special Notes</a></li>
                                <li><a href="#cruise-food-dinning" data-toggle="tab">Map</a></li>
                                <li><a href="#cruise-reviews" data-toggle="tab">Reviews</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="cruise-description">
                                    <div class="intro table-wrapper full-width hidden-table-sms" style="border-bottom:1px solid #111;">
                                        <div class="col-sm-5 col-lg-6 features table-cell">
                                            <!--programe to provice response as required-->
                                            <ul>
                                                <li><label>Title:</label><strong><?php echo $excur->title;?></strong></li>
                                                <li><label>Duration</label><?php echo $excur->duration;?></li>
                                                <li><label>Scheduled Day</label><?php echo $excur->scheduled_day;?></li>
                                                <li><label>Supplier Name</label><?php echo $excur->sup_name;?></li>
                                                <li><label>Type:</label><?php echo $excur->type;?></li>
                                                <li><label>Transport</label><?php echo $excur->transport;?></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-7 col-lg-8 table-cell cruise-itinerary">
                                            <div class="travelo-box">
                                                <h4 class="box-title">Hightlights</h4>
                                                <?php //echo $excur->highlights;
                                                    $highlights = explode(';', $excur->highlights);
                                                ?>
                                                <table>
                                                    <tbody>
                                                        <?php foreach ($highlights as $key => $hyt) { ?>
                                                                <tr><td><?php echo $hyt; ?></td></tr> 
                                                        <?php  } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="long-description" >
                                        <h2>Details</h2>
                                        <?php echo $excur->details; ?>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="cruise-availability">
                                    <div class="border-box travelo-box clearfix">
                                        <h4 >Meeting Point</h4>
                                        <p><?php echo $excur->meeting;?></p>
                                    </div>
                                    <h2>Selected Sightseeing Package</h2>
                                    <div class="room-list listing-style3 hotel">
                                        <article class="box">
                                            <figure class="col-sm-4 col-md-3">
                                                <a class="hover-effect popup-gallery" href="ajax/cruise-slideshow-popup.html"><img src="cctech-admin/<?php echo $excur->image;?>" alt=""></a>
                                            </figure>
                                            <div class="details col-xs-12 col-sm-8 col-md-9">
                                                <div>
                                                    <div>
                                                        <div class="box-title">
                                                            <h4 class="title"><?php echo $excur->title;?></h4>
                                                            <dl class="description">
                                                                <dt>Duration</dt><dd><?php echo $excur->duration;?></dd>
                                                                <dt>City:</dt><dd><?php echo $excur->city;?></dd>
                                                                
                                                            </dl>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="price-section">
                                                        <span class="price"><small>PER ADULT</small>$<?php echo $excur->price;?></span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <p><?php echo $excur->overview;?></p>
                                                    <div class="action-section">
                                                        <span class="price"><small>PER CHILD</small>$<?php echo $excur->infant_price;?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                        
                                    </div>
                                    <a href="cruise-booking.php?id=<?php echo $excur->id.'&date='.$date.'&kids='.$kids;?>" class="pull-right button green btn-large">BOOK NOW</a><br><br>
                                </div>
                                <div class="tab-pane fade" id="cruise-amenities">
                                    <h2>Cancellation</h2>
                                    <p>All bookings require prepayment. Your credit card will be charge with the full amount at the time you make your reservation. All bookings can be cancelled no more than 48 hours prior to the scheduled pick-up time. Cancellations made less than 48 hours prior to pick-up are not refundable.</p>
                                    
                                    <h2>Other</h2>
                                    <p><?php echo $excur->special; ?></p>
                                </div>
                                <div class="tab-pane fade" id="cruise-food-dinning">
                                    <div class="box">
                                        <h2>Virtual Map of Tour</h2>
                                        <?php //echo $excur->map; ?>
                                        <img src="cctech-admin/<?php echo $excur->map_image; ?>" class="img-responsive" style="width:100% ">
                                    </div>
                                    <div class="food-dinning-list image-box style2">
                                        <div class="box">
                                        
                                        </div>
                                    </div>
                                   
                                </div>

                                <!-- review list -->
                                <?php $avag = cal_package_ratings('sightseeing_reviews',$excur->id); 
                                    $width='0%';
                                    if($avag['total']==5){$width='100%';}elseif($avag['total']==4){$width='80%';}elseif($avag['total']==3){$width='60%';}elseif($avag['total']==2){$width='40%';}elseif($avag['total']==1){$width='20%';}elseif($avag['total']==0){$width='0%';}
                                ?>
                                <div class="tab-pane fade" id="cruise-reviews">
                                    <div class="intro table-wrapper full-width hidden-table-sms">
                                        <div class="rating table-cell col-sm-4">
                                            <span class="score"><?php echo $avag['total'].'.0';?>/5.0</span>
                                            <div class="five-stars-container"><div class="five-stars" style="width:<?php echo $width ?>"></div></div>
                                            <a href="#" class=" button green btn-small full-width"><?php echo rating_expression($avag['total']); ?></a>
                                        </div>
                                        <div class="table-cell col-sm-8">
                                            <div class="detailed-rating">
                                                <ul class="clearfix">
                                                    <li class="col-md-6"><div class="each-rating"><label>Value for Money</label><div class="five-stars-container editable-rating" data-original-stars="<?php echo $avag['value'];?>"></div></div></li>
                                                    <li class="col-md-6"><div class="each-rating"><label>Professionalism</label><div class="five-stars-container editable-rating" data-original-stars="<?php echo $avag['professionalism'];?>"></div></div></li>
                                                    <li class="col-md-6"><div class="each-rating"><label>Activities</label><div class="five-stars-container editable-rating" data-original-stars="<?php echo $avag['activities'];?>"></div></div></li>
                                                    <li class="col-md-6"><div class="each-rating"><label>Dinning/Food</label><div class="five-stars-container editable-rating" data-original-stars="<?php echo $avag['dinning'];?>"></div></div></li>
                                                    <li class="col-md-6"><div class="each-rating"><label>Accommodation</label><div class="five-stars-container editable-rating" data-original-stars="<?php echo $avag['accommodation'];?>"></div></div></li>
                                                    <li class="col-md-6"><div class="each-rating"><label>Tour Guiding</label><div class="five-stars-container editable-rating" data-original-stars="<?php echo $avag['guide'];?>"></div></div></li>
                                                    <li class="col-md-6"><div class="each-rating"><label>Safety</label><div class="five-stars-container editable-rating" data-original-stars="<?php echo $avag['safety'];?>"></div></div></li>
                                                    <li class="col-md-6"><div class="each-rating"><label>Quality</label><div class="five-stars-container editable-rating" data-original-stars="<?php echo $avag['quality'];?>"></div></div></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="guest-reviews">
                                        <h2>Guest Reviews</h2>
                                        <?php
                                            $reviews = DB::getInstance()->query("SELECT * FROM sightseeing_reviews WHERE package_id = '$excur->id' AND reply = 0 LIMIT 5");
                                            foreach ($reviews->results() as $key => $review) {
                                                $bkId = find_by_id('booking',$review->bookId);
                                                $jsonArray = json_decode($bkId->trans_details);
                                                $singleRateing = single_rating_02('sightseeing_reviews',$review->id);
                                        ?>
                                        <div class="guest-review table-wrapper">
                                            <div class="col-xs-9 col-md-10 table-cell comment-container">
                                                <div class="comment-header clearfix">
                                                    <h4 class="comment-title"><?php echo $review->title; ?></h4>
                                                    <div class="review-score">
                                                        <div class="each-rating">
                                                            <div class="five-stars-container editable-rating" data-original-stars="<?php echo $singleRateing['total'];?>"></div>
                                                            <span class="score"><?php echo $singleRateing['total'].'.0';?>/5.0</span>
                                                        </div>
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
                                <div class="tab-pane fade" id="cruise-write-review">
                                    <div class="main-rating table-wrapper full-width hidden-table-sms intro">
                                        <article class="image-box box cruise listing-style1 photo table-cell col-sm-4">
                                            <figure>
                                                <a class="hover-effect" title="" href="#"><img width="270" height="160" alt="" src="cctech-admin/<?php echo $excur->image;?>"></a>
                                            </figure>
                                            <div class="details">
                                                <h4 class="box-title">Carnival Cruise Lines<small>Carnival inspiration</small></h4>
                                                <div class="feedback">
                                                    <div title="4 stars" class="five-stars-container" data-toggle="tooltip" data-placement="bottom"><span class="five-stars" style="width: 80%;"></span></div>
                                                    <span class="review">270 reviews</span>
                                                </div>
                                            </div>
                                        </article>
                                        <div class="table-cell col-sm-8">
                                            <div class="overall-rating">
                                                <h4>Your overall Rating of this property</h4>
                                                <div class="star-rating clearfix">
                                                    <div class="five-stars-container"><div class="five-stars" style="width: 80%;"></div></div>
                                                    <span class="status">VERY GOOD</span>
                                                </div>
                                                <div class="detailed-rating">
                                                    <ul class="clearfix">
                                                        <li class="col-md-6"><div class="each-rating"><label>Ship Quality</label><div class="five-stars-container editable-rating" data-original-stars="4"></div></div></li>
                                                        <li class="col-md-6"><div class="each-rating"><label>Ship Staff Quality</label><div class="five-stars-container editable-rating" data-original-stars="4"></div></div></li>
                                                        <li class="col-md-6"><div class="each-rating"><label>Dining/Food</label><div class="five-stars-container editable-rating" data-original-stars="4"></div></div></li>
                                                        <li class="col-md-6"><div class="each-rating"><label>Activities</label><div class="five-stars-container editable-rating" data-original-stars="4"></div></div></li>
                                                        <li class="col-md-6"><div class="each-rating"><label>rooms Quality</label><div class="five-stars-container editable-rating" data-original-stars="4"></div></div></li>
                                                        <li class="col-md-6"><div class="each-rating"><label>Play areas</label><div class="five-stars-container editable-rating" data-original-stars="4"></div></div></li>
                                                        <li class="col-md-6"><div class="each-rating"><label>Cleanliness</label><div class="five-stars-container editable-rating" data-original-stars="4"></div></div></li>
                                                        <li class="col-md-6"><div class="each-rating"><label>fitness facility</label><div class="five-stars-container editable-rating" data-original-stars="4"></div></div></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form class="review-form">
                                        <div class="form-group col-md-5 no-float no-padding">
                                            <h4 class="title">Title of your review</h4>
                                            <input type="text" name="review-title" class="input-text full-width" value="" placeholder="enter a review title" />
                                        </div>
                                        <div class="form-group">
                                            <h4 class="title">Your review</h4>
                                            <textarea class="input-text full-width" placeholder="enter your review (minimum 200 characters)" rows="5"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <h4 class="title">What sort of Trip was this?</h4>
                                            <ul class="sort-trip clearfix">
                                                <li><a href="#"><i class="soap-icon-businessbag circle"></i></a><span>Business</span></li>
                                                <li><a href="#"><i class="soap-icon-couples circle"></i></a><span>Couples</span></li>
                                                <li><a href="#"><i class="soap-icon-family circle"></i></a><span>Family</span></li>
                                                <li><a href="#"><i class="soap-icon-friends circle"></i></a><span>Friends</span></li>
                                                <li><a href="#"><i class="soap-icon-user circle"></i></a><span>Solo</span></li>
                                            </ul>
                                        </div>
                                        <div class="form-group col-md-5 no-float no-padding">
                                            <h4 class="title">When did you travel?</h4>
                                            <div class="selector">
                                                <select class="full-width">
                                                    <option value="2014-6">June 2014</option>
                                                    <option value="2014-7">July 2014</option>
                                                    <option value="2014-8">August 2014</option>
                                                    <option value="2014-9">September 2014</option>
                                                    <option value="2014-10">October 2014</option>
                                                    <option value="2014-11">November 2014</option>
                                                    <option value="2014-12">December 2014</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h4 class="title">Add a tip to help travelers choose a good ship</h4>
                                            <textarea class="input-text full-width" rows="3" placeholder="write something here"></textarea>
                                        </div>
                                        <div class="form-group col-md-5 no-float no-padding">
                                            <h4 class="title">Do you have photos to share? <small>(Optional)</small> </h4>
                                            <div class="fileinput full-width">
                                                <input type="file" class="input-text" data-placeholder="select image/s" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h4 class="title">Share with friends <small>(Optional)</small></h4>
                                            <p>Share your review with your friends on different social media networks.</p>
                                            <ul class="social-icons icon-circle clearfix">
                                                <li class="twitter"><a title="Twitter" href="#" data-toggle="tooltip"><i class="soap-icon-twitter"></i></a></li>
                                                <li class="facebook"><a title="Facebook" href="#" data-toggle="tooltip"><i class="soap-icon-facebook"></i></a></li>
                                                <li class="googleplus"><a title="GooglePlus" href="#" data-toggle="tooltip"><i class="soap-icon-googleplus"></i></a></li>
                                                <li class="pinterest"><a title="Pinterest" href="#" data-toggle="tooltip"><i class="soap-icon-pinterest"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="form-group col-md-5 no-float no-padding no-margin">
                                            <button type="submit" class="btn-large full-width">SUBMIT REVIEW</button>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>
                        
                        </div>
                    </div>
                    <div class="sidebar col-md-3">
                        <article class="detailed-logo">
                            <figure>
                                <img width="320" height="80" src="cctech-admin/<?php echo $excur->image;?>" alt="">
                            </figure>
                            <div class="details">
                                <h2 class="box-title"><?php echo $excur->title;?><small><?php echo $excur->duration;?></small></h2>
                                <span class="price clearfix">
                                    <small class="pull-left">Rate/Adult</small>
                                    <span class="pull-right">$<?php echo $excur->price;?></span>
                                </span>
                                <span class="price clearfix">
                                    <small class="pull-left">Rate/Child</small>
                                    <span class="pull-right">$<?php echo $excur->infant_price;?></span>
                                </span>
                                <div class="feedback clearfix">
                                    <div title="4 stars" class="five-stars-container" data-toggle="tooltip" data-placement="bottom"><span class="five-stars" style="width:<?php echo $width ?>;"></span></div>
                                    <span class="review pull-right"><?php echo num_reviews_02('sightseeing_reviews',$excur->id);?> reviews</span>
                                </div>
                                <p class="description"><?php echo $excur->overview;?></p>
                                <a href="cruise-booking.php?id=<?php echo $excur->id.'&date='.$date.'&kids='.$kids;?>" class="button yellow full-width uppercase btn-small">add to cart</a>
                            </div>
                        </article>
                        <div class="travelo-box contact-box">
                           <h4>Need Travelafric Help?</h4>
                            <p>We would be more than happy to help you. Our Account Manager are 24/7 at your service to help you.</p>
                            <address class="contact-details">
                                <span class="contact-phone"><i class="soap-icon-phone"></i> +233-247-94-3218</span>
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
    
    <script type="text/javascript">
        tjq(document).ready(function() {
            // calendar panel
            /*var cal = new Calendar();
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
                tjq('#cruise-features .tabs a[href="#cruise-write-review"]').tab('show')
            });*/
            
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
    </script>
</body>
</html>

