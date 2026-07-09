<?php ob_start();?>
<!DOCTYPE html>
<html>
<head>
    <title>Travelafric.com</title>
    <?php require 'template/head.html'; ?>
</head>
<body>
    <div id="page-wrapper">
        <?php require 'template/nav.php'; ?>
        <?php 
            $bookId = Input::get('booking_id');
            $details = find_by_id('booking',$bookId);
            $json = json_decode($details->trans_details);
            $hotel = find_by_id('clients',$json->hotelId);
        ?>

        <div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title">Write a review</h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="#">HOME</a></li>
                    <li><a href="#">review</a></li>
                    <!-- <li class="active">Agents</li> -->
                </ul>
            </div>
        </div>

        <section id="content">
            <div class="container" id="hotel-write-review">
                <div id="main" class="travelo-box">
                    <div class="main-rating table-wrapper full-width hidden-table-sms intro">
                        <article class="image-box box hotel listing-style1 photo table-cell col-sm-4">
                            <figure>
                                <?php 
                                    $getImage = $conn->query("SELECT path FROM media WHERE hid = $json->hotelId LIMIT 1");
                                    foreach ($getImage->results() as $key => $img):
                                ?>
                                <a class="hover-effect" title="" href="#"><img width="270" height="160" alt="" src="hotels/<?php echo $img->path;?>"></a>
                                <?php endforeach; ?>
                            </figure>
                            <div class="details">
                                <h4 class="box-title"><?php echo $hotel->company_name; ?><small><i class="soap-icon-departure"></i> <?php echo $hotel->city.', '.$hotel->country;?></small></h4>
                                <!-- <div class="feedback">
                                <div title="4 stars" class="five-stars-container" data-toggle="tooltip" data-placement="bottom"><span class="five-stars" style="width: 80%;"></span></div>
                                    <span class="review"><?php //echo num_reviews($hotel->id); ?> reviews</span>
                                </div> -->
                            </div>
                        </article>
                        <div class="table-cell col-sm-8">
                            <div class="overall-rating">
                                <h4><?php echo num_reviews($hotel->id);?> rating of this property</h4>
                                <?php $avag = cal_ratings($hotel->id); ?>
                                <div class="star-rating clearfix">
                                    <!-- <div class="five-stars-container"><div class="five-stars" style="width: 80%;"></div></div> -->
                                    <div class="each-rating"><div class="five-stars-container editable-rating" data-original-stars="<?php echo $avag['total'];?>"></div></div>
                                    <span class="status">VERY GOOD</span>
                                </div>
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
                    </div>     
                    <div id="feedback"></div>
                    <form class="review-form" id="frmReview">
                        <input type="hidden" name="bookId" required readonly value="<?php echo $bookId;?>">
                        <input type="hidden" name="hotelId" required readonly value="<?php echo $hotel->id;?>">
                        <div class="form-group col-md-5 no-float no-paddin">
                            <h4 class="title">Title of your review</h4>
                            <input type="text" name="title" id="title" class="input-text full-width" value="" placeholder="Enter a review title" />
                        </div>

                        <div class="form-group col-md-4 no-floa no-paddin">
                            <h4 class="title">Service Rating</h4>
                            <div class="selector">
                                <select class="full-width" name="service-rating" id="service-rating" required="">
                                    <option value="0">--Select--</option>
                                    <option value="1">1 </option>
                                    <option value="2">2 </option>
                                    <option value="3">3 </option>
                                    <option value="4">4 </option>
                                    <option value="5">5 </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4 no-floa no-paddin">
                            <h4 class="title">Value Rating</h4>
                            <div class="selector">
                                <select class="full-width" name="value-rating" id="value-rating" required="">
                                    <option value="0">--Select--</option>
                                    <option value="1">1 </option>
                                    <option value="2">2 </option>
                                    <option value="3">3 </option>
                                    <option value="4">4 </option>
                                    <option value="5">5 </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4 no-floa no-paddin">
                            <h4 class="title">Sleep Quality Rating</h4>
                            <div class="selector">
                                <select class="full-width" name="sleeping-rating" id="sleeping-rating" required="">
                                    <option value="0">--Select--</option>
                                    <option value="1">1 </option>
                                    <option value="2">2 </option>
                                    <option value="3">3 </option>
                                    <option value="4">4 </option>
                                    <option value="5">5 </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4 no-floa no-paddin">
                            <h4 class="title">Cleanliness Rating</h4>
                            <div class="selector">
                                <select class="full-width" name="cleanliness-rating" id="cleanliness-rating" required="">
                                    <option value="0">--Select--</option>
                                    <option value="1">1 </option>
                                    <option value="2">2 </option>
                                    <option value="3">3 </option>
                                    <option value="4">4 </option>
                                    <option value="5">5 </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4 no-floa no-paddin">
                            <h4 class="title">Location Rating</h4>
                            <div class="selector">
                                <select class="full-width" name="location-rating" id="location-rating" required="">
                                    <option value="0">--Select--</option>
                                    <option value="1">1 </option>
                                    <option value="2">2 </option>
                                    <option value="3">3 </option>
                                    <option value="4">4 </option>
                                    <option value="5">5 </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4 no-floa no-paddin">
                            <h4 class="title">Rooms Rating</h4>
                            <div class="selector">
                                <select class="full-width" name="room-rating" id="room-rating" required="">
                                    <option value="0">--Select--</option>
                                    <option value="1">1 </option>
                                    <option value="2">2 </option>
                                    <option value="3">3 </option>
                                    <option value="4">4 </option>
                                    <option value="5">5 </option>
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group col-md-12 clearfix">
                            <h4 class="title">Your review</h4>
                            <textarea class="input-text full-width" id="comment" name="comment" placeholder="Enter your review (minimum 200 characters)" rows="5"></textarea>
                        </div>
                        <!-- <div class="form-group col-md-5 no-float no-paddin">
                            <h4 class="title">Do you have photo to share? <small>(Optional)</small> </h4>
                            <div class="fileinput full-width">
                                <input type="file" name="file" id="file" class="input-text" data-placeholder="select image/s" />
                            </div>
                        </div> -->
                        
                        <div class="form-group col-md-5 ">
                            <h4 class="title">When did you travel?</h4>
                            <div class="selector">
                                <select class="full-width" name="month" id="month" required="">
                                    <option>Select a Month</option>
                                    <option value="January">January </option>
                                    <option value="February">February </option>
                                    <option value="March">March </option>
                                    <option value="April">April </option>
                                    <option value="May">May </option>
                                    <option value="June">June </option>
                                    <option value="July">July </option>
                                    <option value="August">August </option>
                                    <option value="September">September </option>
                                    <option value="October">October </option>
                                    <option value="November">November </option>
                                    <option value="December">December </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-5">
                            <h4 class="title">&nbsp;</h4>
                            <input type="number" name="year" id="year" class="input-text full-width" placeholder="Year">
                        </div>
                        <!-- <div class="form-group col-md-12 no-padding">
                            <h4 class="title">Add a tip to help travelers choose a good room</h4>
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
                        </div> -->
                        <div class="clearfix"></div>
                        <div class="form-group col-md-5 no-float  no-margin">
                            <button type="submit" class="btn-large full-width" id="btnReview">SUBMIT REVIEW</button>
                        </div>
                    </form>

                </div>
            </div>
        </section>
        
        <?php include 'template/footer.php'; ?>
    </div>

    <!-- Javascript -->
    <?php include 'template/js-loader.html'; ?>
    <script type="text/javascript">
        tjq(document).ready(function() {
            
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
                    range: "min", value: oringnal_value, min: 0,  max: 5,
                    slide: function( event, ui ) {
                        
                    }
                });
            });
        });

        (function($){
             // sned a review
            $(document).on('submit', '#frmReview', function(){
                $('#btnReview').addClass('disabled');
                $('#btnReview').delay(500).html('Proccesing...');
                var data = $(this).serialize();
                $.ajax({
                    type : 'POST',
                    url  : 'ajax/controller.php?type=sendReview',
                    data : data,
                    success :  function(data){$('#feedback').html(data);
                        $('#comment').val('');
                        $('#btnReview').removeClass('disabled');
                        $('#btnReview').delay(500).html('Send Review');
                        //$('#alert').html(data).fadeIn('slow');
                        //console.log(data);
                    },
                });
                return false;
            });

        })(jQuery); 

    </script>
</body>
</html>

