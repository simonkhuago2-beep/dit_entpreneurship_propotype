<?php ob_start(); ?>
<!DOCTYPE html>
<html> 
<head>
    <!-- Page Title -->
    <title>Travelafric.com</title>
    
    <?php require 'template/head.html'; ?>   
</head>
<body>
    
    <div id="page-wrapper">
        <?php require 'template/nav.php'; ?>
        <!--Program Page to function per the format-->
        <div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title">Hotel Search Results</h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="#">HOME</a></li>
                    <li class="active">Hotel Search Results</li>
                </ul>
            </div>
        </div>
        <?php 
            $country = Input::get('country'); //$city = Input::get('city');
            $roomQty = Input::get('room-qty'); $adult = Input::get('adult');$infant = Input::get('infant'); 
            $dateIn = Input::get('in-date');$dateOut = Input::get('out-date'); 
            $in = new DateTime($dateIn); $out = new DateTime($dateOut);
            $nights = $interval = date_diff($in, $out)->format('%a');

            //if (is_numeric(Input::get('stars'))) { $stars = ">= "."'".Input::get('stars')."'"; }else{ $stars = "= "."'".Input::get('stars')."'"; }
        ?>

        <section id="content">
            <div class="container">
                <div id="main">
                    <div class="row">
                        <div class="col-sm-4 col-md-3">
                            <?php 
                                $found = $conn->query("SELECT h.id,h.company_name,h.company_details,h.stars,r.id AS rId,r.hid,r.name AS rName,r.vacant FROM clients h LEFT JOIN rooms r ON h.id = r.hid WHERE groups = 4 AND verified = 1 AND h.country = '$country' AND r.vacant >= $roomQty GROUP BY h.company_name ");
                            ?>
                            <h4 class="search-results-title"><i class="soap-icon-search"></i><b><?php echo $found->count();?></b> results found.</h4>
                            <?php 
                                $hotel = 0; $gustHse = 0; $hostel = 0;
                                $cable=0;$ac=0;$bar=0;$pets=0;$rms=0;$wifi=0;
                                foreach ($found->results() as $key => $sort) {
                                    if(is_numeric($sort->stars)){$hotel++;}elseif($sort->stars=='Guest House'){$gustHse++;}elseif($sort->stars=='Hostel'){$hostel++;}
                                    $faci=find_by('facilities','hotel_id',$sort->hid);
                                    if(!empty($faci->facil)){
                                        $jsonFaci = json_decode($faci->facil);
                                        if($jsonFaci->TELEVISION=='on'){$cable++;}if($jsonFaci->WINE_BAR=='on'){$bar++;}if($jsonFaci->WIFI=='on'){$wifi++;}
                                        if($jsonFaci->AIR_CONDITIONING=='on'){$ac++;}if($jsonFaci->ROOM_SERVICE=='on'){$rms++;}
                                    }
                                }
                            ?>
                            <div class="toggle-container filters-container">
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#modify-search-panel" class="collapsed">Modify Search</a>
                                    </h4>
                                    <div id="modify-search-panel" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <form method="post">
                                                <div class="form-group">
                                                    <label>destination</label>
                                                    <select name="country" required="required" style="width:100% ">
                                                        <option value="">Any</option>
                                                        <?php $countries = list_countries(); foreach($countries->results() as $key => $c): ?>
                                                            <option value="<?php echo $c->country ?>" <?php if($c->country == $country){echo 'selected';}?>><?php echo $c->country ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>check in</label>
                                                    <div class="datepicker-wrap">
                                                        <input type="text" name="in-date" class="input-text full-width" placeholder="mm/dd/yy" value="<?php echo $dateIn ;?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>check out</label>
                                                    <div class="datepicker-wrap">
                                                        <input type="text" name="out-date" class="input-text full-width" placeholder="mm/dd/yy" value="<?php echo $dateOut ;?>" />
                                                    </div>
                                                </div>
                                                <input type="hidden" name="adult" value="<?php echo $adult; ?>">
                                                <input type="hidden" name="infant" value="<?php echo $infant; ?>">
                                                <input type="hidden" name="room-qty" value="<?php echo $roomQty ?>">
                                                <br />
                                                <button type="submit" class="btn-medium icon-check uppercase full-width">search again</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#accomodation-type-filter" class="collapsed">Accomodation Type</a>
                                    </h4>
                                    <div id="accomodation-type-filter" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <!--php entry of total number-->
                                            <ul class="check-square filters-option">
                                                <li class="active"><a href="#">All<small>(<?php echo $found->count();?>)</small></a></li>
                                                <li><a href="#">Hotel<small>(<?php echo $hotel ?>)</small></a></li>
                                                <li><a href="#">Guest House<small>(<?php echo $gustHse ?>)</small></a></li>
                                                <li ><a href="#">Hostel<small>(<?php echo $hostel ?>)</small></a></li>
                                            </ul>
                                            <!-- <a class="button btn-mini">MORE</a> -->
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#amenities-filter" class="collapsed">Amenities</a>
                                    </h4>
                                    <div id="amenities-filter" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <ul class="check-square filters-option">
                                                <!-- <li><a href="#">Bathroom<small>(722)</small></a></li> -->
                                                <li><a href="#">Cable tv<small>(<?php echo $cable ?>)</small></a></li>
                                                <li class=""><a href="#">air conditioning<small>(<?php echo $ac ?>)</small></a></li>
                                                <li class=""><a href="#">mini bar<small>(<?php echo $bar ?>)</small></a></li>
                                                <li><a href="#">wi - fi<small>(<?php echo $wifi ?>)</small></a></li>
                                                <li><a href="#">pets allowed<small>(<?php echo $pets ?>)</small></a></li>
                                                <li><a href="#">room service<small>(<?php echo $rms ?>)</small></a></li>
                                            </ul>
                                            <!-- <a class="button btn-mini">MORE</a> -->
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
                                        <a data-toggle="collapse" href="#rating-filter" class="collapsed">User Rating</a>
                                    </h4>
                                    <div id="rating-filter" class="panel-collapse collapse filters-container">
                                        <div class="panel-content">
                                            <div id="rating" class="five-stars-container editable-rating"></div>
                                            <br />
                                            <!-- <small>2458 REVIEWS</small> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            $search = $conn->query("SELECT h.id,h.company_name,h.company_details,h.stars,r.id AS rId,r.hid,r.name AS rName,r.vacant FROM clients h LEFT JOIN rooms r ON h.id = r.hid WHERE groups = 4 AND verified = 1 AND h.country = '$country' AND r.vacant >= $roomQty GROUP BY h.company_name ");
                            $num = $search->count();
                        ?>

                        <div class="col-sm-8 col-md-9" id="hotel-list">
                            <div class="sort-by-section clearfix">
                                <h4 class="sort-by-title block-sm">Sort results by:</h4>
                                <ul class="sort-bar clearfix block-sm">
                                    <li class="sort-by-name"><a class="sort-by-container" href="#"><span>name</span></a></li>
                                    <li class="sort-by-price"><a class="sort-by-container" href="#"><span>price</span></a></li>
                                    <li class="clearer visible-sms"></li>
                                    <li class="sort-by-rating active"><a class="sort-by-container" href="#"><span>rating</span></a></li>
                                </ul>
                                
                                <ul class="swap-tiles clearfix block-sm">
                                    <li class="swap-list active">
                                        <a href="#"><i class="soap-icon-list"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <!--Programe sections to display results per format-->
                            <div class="hotel-list listing-style3 hotel list">
                                <?php 
                                    if($search->count()){
                                    foreach ($search->results() as $key => $hotel):
                                        $json = json_decode($hotel->company_details);
                                ?>
                                <article class="box ">
                                    <figure class="col-sm-5 col-md-4">
                                        <?php 
                                            $getImage = $conn->query("SELECT path FROM media WHERE hid = $hotel->id LIMIT 1");
                                            foreach ($getImage->results() as $key => $img):
                                        ?>
                                        <a title="" href="ajax/slideshow-popup.html" class="hover-effect popup-gallery"><img alt="hotelImage" src="hotels/<?php echo $img->path;?>"></a>
                                        <?php endforeach; ?>
                                    </figure>
                                    <div class="details col-sm-7 col-md-8">
                                        <div>
                                            <div>
                                                <h4 class="box-title"><?php echo $hotel->company_name;?> <small><i class="soap-icon-departure yellow-color"></i> <?php echo $json->city.', '.$json->country ; ?></small></h4>
                                                <?php $fac=find_by('facilities','hotel_id',$hotel->id);if(!empty($fac->facil)){$jsonFac = json_decode($fac->facil); ?>
                                                <div class="amenities">
                                                    <?php if($jsonFac->WIFI=='on'){?><i class="soap-icon-wifi circle"></i><?php } ?>
                                                    <?php if($jsonFac->FITNESS_FACILITY=='on'){?><i class="soap-icon-fitnessfacility circle"></i><?php } ?>
                                                    <?php if($jsonFac->COMPLIMENTARY_BREAKFAST=='on'){?><i class="soap-icon-fork circle"></i><?php } ?>
                                                    <?php if($jsonFac->TELEVISION=='on'){?><i class="soap-icon-television circle"></i><?php } ?>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <?php 
                                                $avag = cal_ratings($hotel->id);
                                                if($avag['total']==5){$width='100%';}elseif($avag['total']==4){$width='80%';}elseif($avag['total']==3){$width='60%';}elseif($avag['total']==2){$width='40%';}elseif($avag['total']==1){$width='20%';}elseif($avag['total']==0){$width='0%';}
                                            ?>
                                            <div>
                                                <div class="five-stars-container">
                                                    <span class="five-stars" style="width:<?php echo $width ?>;"></span>
                                                </div>
                                                <span class="review"><?php echo num_reviews($hotel->id); ?> reviews</span>
                                            </div>
                                        </div>
                                        <div>
                                            <p><?php echo substr($json->descp, 0, 199);  ?>...</p>
                                            <div>
                                                <span class="price"><small>RATE</small><?php echo '$'.lowest_roomPrice($hotel->id); ?></span>
                                                <a class="button btn-small full-width text-center" title="" href="hotel-detailed.php?hotel=<?php echo $hotel->id.'&from='.$dateIn.'&to='.$dateOut.'&adult='.$adult.'&infant='.$infant.'&room='.$roomQty;?>">SELECT</a>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <?php endforeach; }
                                    else{ ?>
                                        <div class="alert alert-danger" role="alert">
                                            <i class="icon-sad depp-red-text"></i><span><strong>Alert!</strong> No records found. try a different search .</span>
                                        </div>
                                <?php 
                                    }        
                                ?>
                            </div>
                            <!-- <a href="#" class="uppercase full-width button btn-large">load more listing</a> -->
                            <ul class="pagination"></ul>
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
            
            tjq("#rating").slider({
                range: "min",
                value: 40,
                min: 0,
                max: 50,
                slide: function( event, ui ) {
                    
                }
            });
        });

        (function($){
            
        })(jQuery); 
    </script>
</body>
</html>

