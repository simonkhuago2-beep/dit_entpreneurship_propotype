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
            $package = find_by_id('excursion',$json->id);
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
                                <a class="hover-effec" title="" href="#"><img style="height:260px " alt="" src="cctech-admin/<?php echo $package->image;?>"></a>
                                
                            </figure>
                            <div class="details">
                                <h4 class="box-title"><?php echo $package->title; ?><small><i class="soap-icon-departure"></i> <?php echo $package->city.', '.$package->country;?></small></h4>
                            </div>
                        </article>
                        <div class="table-cell col-sm-8">
                            <div class="overall-rating">
                                <h4><?php echo num_reviews_02('sightseeing_reviews',$package->id);?> rating on this package.</h4>
                                <?php $avag = cal_package_ratings('sightseeing_reviews',$package->id); ?>
                                <div class="star-rating clearfix">
                                    <!-- <div class="five-stars-container"><div class="five-stars" style="width: 80%;"></div></div> -->
                                    <div class="each-rating"><div class="five-stars-container editable-rating" data-original-stars="<?php echo $avag['total'];?>"></div></div>
                                    <span class="status"><?php echo rating_expression($avag['total']);?></span>
                                </div>
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
                    </div>     
                    <div id="feedback"></div>
                    <form class="review-form" id="frmReview">
                        <input type="hidden" name="bookId" required readonly value="<?php echo $bookId;?>">
                        <input type="hidden" name="package_id" required readonly value="<?php echo $package->id;?>">
                        <div class="form-group col-md-5 no-float no-paddin">
                            <h4 class="title">Title of your review</h4>
                            <input type="text" name="title" id="title" class="input-text full-width" value="" placeholder="Enter a review title" />
                        </div>

                        <div class="form-group col-md-4 no-floa no-paddin">
                            <h4 class="title">Value for Money Rating</h4>
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
                            <h4 class="title">Professionalism Rating</h4>
                            <div class="selector">
                                <select class="full-width" name="professionalism-rating" id="professionalism-rating" required="">
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
                            <h4 class="title">Activities Rating</h4>
                            <div class="selector">
                                <select class="full-width" name="activities-rating" id="activities-rating" required="">
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
                            <h4 class="title">Dinning/Food Rating</h4>
                            <div class="selector">
                                <select class="full-width" name="dinning-rating" id="dinning-rating" required="">
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
                            <h4 class="title">Accommodation Rating</h4>
                            <div class="selector">
                                <select class="full-width" name="accommodation-rating" id="accommodation-rating" required="">
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
                            <h4 class="title">Tour Guiding Rating</h4>
                            <div class="selector">
                                <select class="full-width" name="guiding-rating" id="guiding-rating" required="">
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
                            <h4 class="title">Safety Rating</h4>
                            <div class="selector">
                                <select class="full-width" name="safety-rating" id="safety-rating" required="">
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
                            <h4 class="title">Quality Rating</h4>
                            <div class="selector">
                                <select class="full-width" name="quality-rating" id="quality-rating" required="">
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
                    url  : 'ajax/controller.php?type=sendSightseeingReview',
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

