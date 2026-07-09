<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <!-- Page Title -->
    <title>Travelafric.com</title>
    <?php require 'template/head.html'; ?>
</head>
<div id="page-wrapper">
        <?php require 'template/nav.php'; ?>
        <?php 
            $country = Input::get('country');
            $type = Input::get('type');
            $kids = Input::get('kids');
            $date = Input::get('date_on');
        ?>

        <div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title">Sightseeing Search Results</h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="#">HOME</a></li>
                    <li class="active">Sightseeing Search Results</li>
                </ul>
            </div>
        </div>
        <section id="content">
            <div class="container">
                <div id="main">
                    <div class="row">
                        <div class="col-sm-4 col-md-3">
                            <?php 
                                $found = $conn->query("SELECT * FROM excursion WHERE status = 1 AND country='$country' AND type='$type' AND infant=$kids ORDER BY start ASC ")->count();
                            ?>    
                            <h4 class="search-results-title"><i class="soap-icon-search"></i><b><?php echo $found; ?></b> results found.</h4>
                            <div class="toggle-container filters-container">
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#modify-search-panel" class="collapsed">Modify Search</a>
                                    </h4>
                                    <div id="modify-search-panel" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <form method="post" action="">
                                                <input type="hidden" name="kids" value="<?php echo $kids;?>">
                                                <input type="hidden" name="type" value="<?php echo $type;?>">
                                                <div class="form-group">
                                                    <label>Destination</label>
                                                    <div class="selector">
                                                        <select class="full-width" name="country" required="required" >
                                                            <option value="">Select</option>
                                                            <?php $seeing = $conn->query("SELECT DISTINCT country FROM excursion ORDER BY country ASC");
                                                                if($seeing->count()){foreach ($seeing->results() as $key => $sight) {
                                                            ?>
                                                            <option value="<?php echo $sight->country ?>" <?php if($sight->country==$country){echo 'selected';}?> ><?php echo $sight->country ?></option>
                                                            <?php } } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Departure date</label>
                                                    <div class="datepicker-wrap">
                                                        <input type="text" name="date_on" class="input-text full-width" placeholder="mm/dd/yy" value="<?php echo $date;?>" />
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn-medium icon-check uppercase full-width">search again</button>
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
                                        <a data-toggle="collapse" href="#cruise-preference-filter" class="collapsed">Duration Preference</a>
                                    </h4>
                                    <div id="cruise-preference-filter" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <ul class="check-square filters-option">
                                                <li><a href="#">1 - 2 Hours</a></li>
                                                <li><a href="#">3 - 4 Hours</a></li>
                                                <li><a href="#">5 - 6 Hours</a></li>
                                                <li class="active"><a href="#">7 - 8 Hours</a></li>
                                                <li class="active"><a href="#">Full day</a></li>
                                                
                                            </ul>
                                            <a class="button btn-mini">FILTER</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#cruise-cabin-type-filter" class="collapsed">Excursion Type</a>
                                    </h4>
                                    <!--Fill in with excursion type-->
                                    <div id="cruise-cabin-type-filter" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <ul class="check-square filters-option">
                                                <li class="active"><a href="#">Tickets Only<!-- <small>($127)</small> --></a></li>
                                                <li class="active"><a href="#">Cruise<!-- <small>($127)</small> --></a></li>
                                                <li class="active"><a href="#">Adventure<!-- <small>($127)</small> --></a></li>
                                                <li class="active"><a href="#">Cultural<!-- <small>($127)</small> --></a></li>
                                                <li class="active"><a href="#">Hop-on Hop-off<!-- <small>($127)</small> --></a></li>
                                                <li class="active"><a href="#">Day Trips<!-- <small>($127)</small> --></a></li>
                                                <li class="active"><a href="#">Tourish Pass<!-- <small>($127)</small> --></a></li>
                                                <li class="active"><a href="#">Family Fun<!-- <small>($127)</small> --></a></li>
                                                <li class="active"><a href="#">Beach & Sun<!-- <small>($127)</small> --></a></li>
                                                <li class="active"><a href="#">Gaming<!-- <small>($127)</small> --></a></li>
                                                <li class="active"><a href="#">History<!-- <small>($127)</small> --></a></li>
                                                <li class="active"><a href="#">Shopping<!-- <small>($127)</small> --></a></li>
                                                <li class="active"><a href="#">Tour By Night<!-- <small>($127)</small> --></a></li>
                                                <li class="active"><a href="#">Safari<!-- <small>($127)</small> --></a></li>
                                                <li class="active"><a href="#">Self-Guided<!-- <small>($127)</small> --></a></li>
                                                <?php $seeingTypes = $conn->query("SELECT DISTINCT type FROM excursion WHERE type !='All' ORDER BY type ASC");
                                                    if($seeingTypes->count()){foreach ($seeingTypes->results() as $key => $stype) {
                                                ?>
                                                <li><a href="#"><?php echo $stype->type; ?></a></li>
                                                <?php } } ?>
                                            </ul>
                                            <!-- <a class="button btn-mini">FILTER</a> -->
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-9">
                            <div class="sort-by-section box clearfix">
                                <h4 class="sort-by-title block-sm">Sort results by:</h4>
                                <ul class="sort-bar clearfix block-sm">
                                    <li class="sort-by-name"><a class="sort-by-container" href="#"><span>name</span></a></li>
                                    <li class="sort-by-price"><a class="sort-by-container" href="#"><span>price</span></a></li>
                                    <li class="clearer visible-sms"></li>
                                    <li class="sort-by-cruise-line"><a class="sort-by-container" href="#"><span>type</span></a></li>
                                </ul>
                                
                                <ul class="swap-tiles clearfix block-sm">
                                    <li class="swap-list active">
                                        <a href="cruise-list-view.html"><i class="soap-icon-list"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="cruise-list listing-style3 cruise">
                                <?php $search = DB::getInstance()->query("SELECT * FROM excursion WHERE status = 1 AND country='$country' AND type='$type' AND infant=$kids ORDER BY start ASC ");  
                                    if ($search->count()) {
                                        foreach ($search->results() as $key => $value) :
                                ?>
                                <article class="box">
                                    <figure class="col-sm-4">
                                        <a title="" href="cruise-detailed.php?id=<?php echo $value->id.'&date='.$date.'&kids='.$kids;?>" class="hover-effect popup-gallery">
                                            <img style="width:270px; height:160px" alt="" src="cctech-admin/<?php echo $value->image?>">
                                        </a>
                                    </figure>
                                    <div class="details col-sm-8">
                                        <div class="clearfix">
                                            <h4 class="box-title pull-left"><?php echo $value->title;?><small><?php echo $value->duration;?></small></h4>
                                            <span class="price pull-right"><small>Rate/Adult</small>$<?php echo $value->price;?></span>
                                        </div>
                                        <h6 class="box-title pull-left"><?php echo $value->overview;?></h6>
                                        <div class="character clearfix">
                                            <!-- <div class="col-xs-3 cruise-logo">
                                                <img src="http://placehold.it/110x25" alt="">
                                            </div> -->
                                            <div class="col-xs-4 date">
                                                <i class="soap-icon-clock yellow-color"></i>
                                                <div>
                                                    <span class="skin-color">Scheduled Days</span><br><?php echo $value->scheduled_day;?>  
                                                </div>
                                            </div>
                                            <div class="col-xs-5 departure">
                                                <i class="soap-icon-departure yellow-color"></i>
                                                <div>
                                                    <span class="skin-color">Departure Point</span><br><?php echo $value->meeting;?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="clearfix">
                                            <?php 
                                                $avag = cal_package_ratings('sightseeing_reviews',$value->id);
                                                $width='0%';
                                                if($avag['total']==5){$width='100%';}elseif($avag['total']==4){$width='80%';}elseif($avag['total']==3){$width='60%';}elseif($avag['total']==2){$width='40%';}elseif($avag['total']==1){$width='20%';}elseif($avag['total']==0){$width='0%';}
                                            ?>
                                            <div class="review pull-left">
                                                <div class="five-stars-container">
                                                    <span class="five-stars" style="width:<?php echo $width ?>;"></span>
                                                </div>
                                                <span><?php echo num_reviews_02('sightseeing_reviews',$value->id);?> reviews</span>
                                            </div>
                                            <a href="cruise-detailed.php?id=<?php echo $value->id.'&date='.$date.'&kids='.$kids;?>" class="button btn-small pull-right">View Details</a>
                                        </div>
                                    </div>
                                </article>
                                <?php endforeach; }else{ ?>
                                <div class="alert alert-error">
                                    Search Query: <br>No records found! try a different search. <span class="close"></span>
                                </div>
                                <?php } ?>
                            </div>
                            <!-- <a href="#" class="uppercase full-width button btn-large">load more listing</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <?php include 'template/footer.php'; ?>
    </div>

    <?php include 'template/js-loader.html'; ?>
    
    <script type="text/javascript">
        tjq(document).ready(function() {
            tjq("#price-range").slider({
                range: true,
                min: 0,
                max: 1000,
                values: [ 100, 800 ],
                slide: function( event, ui ) {
                    tjq(".min-price-label").html( "$" + ui.values[ 0 ]);
                    tjq(".max-price-label").html( "$" + ui.values[ 1 ]);
                }
            });
            tjq(".min-price-label").html( "$" + tjq("#price-range").slider( "values", 0 ));
            tjq(".max-price-label").html( "$" + tjq("#price-range").slider( "values", 1 ));

            tjq("#cruise-length-range").slider({
                range: "min",
                min: 0,
                max: 12,
                value: 10,
                slide: function( event, ui ) {
                    tjq(".max-cruise-length").html( ui.value + " NIGHTS" );
                }
            });
            tjq(".max-cruise-length").html( tjq("#cruise-length-range").slider( "value" ) + " NIGHTS" );

            tjq("#rating").slider({
                range: "min",
                value: 40,
                min: 0,
                max: 50,
                slide: function( event, ui ) {
                    
                }
            });
        });
    </script>
</body>
</html>

