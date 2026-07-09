<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Travelafric.com</title>
    <?php require 'template/head.html'; ?>
</head>
<body>
    
    <div id="page-wrapper">
        <?php require 'template/nav.php'; ?>
        <div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title">Car Search Results</h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="#">HOME</a></li>
                    <li class="active">Car Search Results</li>
                </ul>
            </div>
        </div>
        <?php 
            $type = Input::get('type');
            $country = Input::get('country'); $city = Input::get('city');
            $pick = Input::get('pick_up'); $drop = Input::get('drop_off');
            $date_from =Input::get('date_from'); $date_to =Input::get('date_to');
            $adult = Input::get('adult'); $kids=Input::get('kids');
            $found = $conn->query("SELECT * FROM transfers WHERE country = '$country' AND city = '$city' AND pick_up = '$pick' AND drop_off = '$drop'")->count();
        ?>
        <section id="content" class="gray-area">
            <div class="container">
                <div id="main">
                    <div class="row">
                        <div class="col-sm-4 col-md-3">
                            <h4 class="search-results-title"><i class="soap-icon-search"></i><b><?php echo $found; ?></b> results found.</h4>
                            <div class="toggle-container filters-container">
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#modify-search-panel" class="collapsed">Modify Search</a>
                                    </h4>
                                    <div id="modify-search-panel" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <form method="post" action="">
                                                <input type="hidden" name="pick_up" value="<?php echo $pick;?>">
                                                <input type="hidden" name="drop_off" value="<?php echo $drop;?>">
                                                <input type="hidden" name="adult" value="<?php echo $adult;?>">
                                                <input type="hidden" name="kids" value="<?php echo $kids;?>">
                                                <input type="hidden" name="date_from" value="<?php echo $date_from;?>">
                                                <input type="hidden" name="date_to" value="<?php echo $date_to;?>">

                                                <div class="form-group">
                                                    <label>Country</label>
                                                    <div class="selector">
                                                    <select name="country" onchange="listTransCities(this.value)" required="required" class="full-width">
                                                        <option value="">Select</option>
                                                        <?php $countriesList = DB::getInstance()->query("SELECT DISTINCT country FROM transfers"); 
                                                            foreach($countriesList->results() as $key => $ex): ?>
                                                            <option value="<?php echo $ex->country ?>" <?php if($ex->country==$country){echo 'selected';}?> ><?php echo $ex->country ?></option>
                                                        <?php endforeach ?>
                                                   </select>
                                                   </div>
                                                </div>
                                                <div class="form-group" >
                                                    <label>City</label>
                                                    <div class="selector">
                                                        <select name="city" class="full-width" id="transfer_city"  required="required">
                                                            <option>Select</option>
                                                            <?php $citiesList = DB::getInstance()->query("SELECT DISTINCT city FROM transfers WHERE country='$country' ORDER BY city ASC ");
                                                            foreach($citiesList->results() as $key => $c): ?>
                                                            <option value="<?php echo $c->city ?>" <?php if($c->city==$city){echo 'selected';}?> ><?php echo $c->city ?></option>
                                                        <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Pick-up Type</label>
                                                    <div class="selector">
                                                        <select class="full-width" name="pick_up">
                                                            <option value="0">Select</option>
                                                            <?php $pick_up = DB::getInstance()->query("SELECT DISTINCT pick_up FROM transfers "); 
                                                                foreach($pick_up->results() as $key => $pu): 
                                                                    $active = ($pu->pick_up == $pick) ? 'selected' : '';?>
                                                                <option value="<?php echo $pu->pick_up ?>" <?php echo $active ?>><?php echo $pu->pick_up ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label>Drop-off Type</label>
                                                    <div class="selector">
                                                        <select class="full-width" name="drop_off">
                                                            <option value="0">Select</option>
                                                            <?php $drop_off = DB::getInstance()->query("SELECT DISTINCT drop_off FROM transfers "); 
                                                                foreach($drop_off->results() as $key => $df): 
                                                                    $active = ($df->drop_off == $drop) ? 'selected' : '';?> ?>
                                                                <option value="<?php echo $df->drop_off ?>" <?php echo $active ?>><?php echo $df->drop_off ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <br />
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
                                        <a data-toggle="collapse" href="#cartype-filter" class="collapsed">Car Type</a>
                                    </h4>
                                    <div id="cartype-filter" class="panel-collapse collapse filters-container">
                                        <div class="panel-content">
                                            <ul class="check-square filters-option">
                                                <?php $seeingTypes = $conn->query("SELECT DISTINCT vehicle FROM transfers  ORDER BY vehicle ASC");
                                                    if($seeingTypes->count()){foreach ($seeingTypes->results() as $key => $stype) {
                                                ?>
                                                <li><a href="#"><?php echo $stype->vehicle; ?></a></li>
                                                <?php } } ?>
                                                <!-- <li><a href="#">Sedan<small>(10)</small></a></li>
                                                <li><a href="#">4x4<small>(82)</small></a></li>
                                                <li class="active"><a href="#">Van/Minivan<small>(127)</small></a></li>
                                                <li><a href="#">Bus<small>(22)</small></a></li>
                                                <li><a href="#">Luxury<small>(38)</small></a></li>
                                            </ul>
                                            <a class="button btn-mini">MORE</a> -->
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#car-preferences-filter" class="collapsed">Car Preferences</a>
                                    </h4>
                                    <div id="car-preferences-filter" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <ul class="check-square filters-option">
                                                <li><a href="#">Passenger Quantity</a></li>
                                                <li class="active"><a href="#">Satellite Navigation</a></li>
                                                <li class="active"><a href="#">Air Conditioning</a></li>
                                                <li><a href="#">Doors</a></li>
                                                <li><a href="#">Diesel Vehicle</a></li>
                                            </ul>
                                            <a class="button btn-mini">MORE</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-8 col-md-9">
                            <div class="sort-by-section clearfix">
                                <h4 class="sort-by-title block-sm">Sort results by:</h4>
                                <ul class="sort-bar clearfix block-sm">
                                    <li class="sort-by-name"><a class="sort-by-container" href="#"><span>name</span></a></li>
                                    <li class="sort-by-price"><a class="sort-by-container" href="#"><span>price</span></a></li>
                                    <li class="clearer visible-sms"></li>
                                    <!-- <li class="sort-by-rating active"><a class="sort-by-container" href="#"><span>rating</span></a></li> -->
                                    <!-- <li class="sort-by-popularity"><a class="sort-by-container" href="#"><span>popularity</span></a></li> -->
                                </ul>
                                
                                <ul class="swap-tiles clearfix block-sm">
                                    <li class="swap-list active">
                                        <a href="car-list-view.html"><i class="soap-icon-list"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <!--Program Car Listing from Admin-->
                            <div class="car-list listing-style3 car">
                                <?php
                                    $list = $conn->query("SELECT * FROM transfers WHERE country = '$country' AND city = '$city' AND pick_up = '$pick' AND drop_off = '$drop'");
                                    if($list->count()){
                                        foreach ($list->results() as $key => $value) {
                                ?>        
                                <article class="box" style="margin-bottom:10px">
                                    <figure class="col-xs-3">
                                        <span><img alt="" src="cctech-admin/<?php echo $value->images;?>"></span>
                                    </figure>
                                    <div class="details col-xs-9 clearfix">
                                        <div class="col-sm-6">
                                            <div class="clearfix">
                                                <h4 class="box-title">Vehicle<small><?php echo $value->vehicle; ?></small></h4>
                                            </div>
                                            <div class="amenities">
                                                <ul>
                                                    <li><i class="soap-icon-user circle"></i><?php echo $value->persons; ?></li>
                                                    <li><i class="soap-icon-suitcase circle"></i>3</li>
                                                    <li><i class="soap-icon-aircon circle"></i>AC</li>
                                                    <li><i class="soap-icon-fueltank circle"></i>12</li>
                                                    <li><i class="soap-icon-fmstereo circle"></i>YES</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-4 character">
                                            <dl class="">
                                                <dt class="skin-color">Transfer Type</dt><dd><?php echo $value->pick_up.' - '.$value->drop_off; ?></dd>
                                                <dt class="skin-color">Country</dt><dd><!--show selection country--><?php echo $value->country; ?></dd>
                                                <dt class="skin-color"><!--show selected cit-->City</dt><dd><?php echo $value->city; ?></dd>
                                            </dl>
                                        </div>
                                        <div class="action col-xs-6 col-sm-2">
                                            <!--program price here-->
                                            <span class="price"><small>per day</small><?php echo '$'.$value->price;?></span>
                                            <a href="car-detailed.php?id=<?php echo $value->id.'&adult='.$adult.'&kids='.$kids.'&date_from='.$date_from.'&date_to='.$date_to ?>" class="button btn-small full-width">select</a>
                                        </div>
                                    </div>
                                </article>
                                <?php }
                                }else{ echo  'NO RECORD FOUND'; } ?> 
                            </div>
                            <a href="#" class="button uppercase full-width btn-large">load more listings</a>
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
        });
    </script>
</body>
</html>

