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
        <div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title">Packages Search Results</h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="#">HOME</a></li>
                    <li class="active">Packages Search Results</li>
                </ul>
            </div>
        </div>

        <section id="content">
            <div class="container">
                <div id="main">
                    <div class="row">
                        <?php 
                            $found = $conn->query("SELECT * FROM tours WHERE status=1 ORDER BY start ASC")->count();
                        ?>
                        <div class="col-sm-4 col-md-3">
                            <h4 class="search-results-title"><i class="soap-icon-search"></i><b><?php echo $found;?></b> results found.</h4>
                            <div class="toggle-container filters-container">
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
                                        <a data-toggle="collapse" href="#cruise-length-filter" class="collapsed">Duration</a>
                                    </h4>
                                    <div id="cruise-length-filter" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <div id="cruise-length-range" class="slider-color-yellow"></div>
                                            <br />
                                            <span class="min-cruise-length pull-left">0</span>
                                            <span class="max-cruise-length pull-right"></span>
                                            <div class="clearer"></div>
                                        </div><!-- end content -->
                                    </div>
                                </div>
                                
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#cruise-line-filter" class="collapsed">Type</a>
                                    </h4>
                                    <div id="cruise-line-filter" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <ul class="check-square filters-option">
                                                <li class="active"><a href="#">All</a></li>
                                                <?php $toursTypes = $conn->query("SELECT DISTINCT type FROM tours WHERE type !='All' ORDER BY type ASC");
                                                    if($toursTypes->count()){foreach ($toursTypes->results() as $key => $ttype) {
                                                ?>
                                                <li><a href="#"><?php echo $ttype->type; ?></a></li>
                                                <?php } } ?>
                                                
                                            </ul>
                                            <!-- <a class="button btn-mini">MORE</a> -->
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
                                                    <label>destination</label>
                                                    <input type="text" class="input-text full-width" placeholder="" value="Paris" />
                                                </div>
                                                <div class="form-group">
                                                    <label>Departure date</label>
                                                    <div class="datepicker-wrap">
                                                        <input type="text" class="input-text full-width" placeholder="mm/dd/yy" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Cruise Length</label>
                                                    <div class="selector full-width">
                                                        <select>
                                                            <option value="">select cruise length</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Cruise line</label>
                                                    <div class="selector full-width">
                                                        <select>
                                                            <option value="">select cruise line</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn-medium icon-check uppercase full-width">search again</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                            $search = $conn->query("SELECT * FROM tours WHERE status=1 ORDER BY start ASC");
                        ?>
                        <div class="col-sm-8 col-md-9">
                            <div class="sort-by-section box clearfix">
                                <h4 class="sort-by-title block-sm">Sort results by:</h4>
                                <ul class="sort-bar clearfix block-sm">
                                    <li class="sort-by-name"><a class="sort-by-container" href="#"><span>name</span></a></li>
                                    <li class="sort-by-price"><a class="sort-by-container" href="#"><span>price</span></a></li>
                                    <li class="clearer visible-sms"></li>
                                    <li class="sort-by-date active"><a class="sort-by-container" href="#"><span>date</span></a></li>
                                    </ul>
                                
                                <ul class="swap-tiles clearfix block-sm">
                                    <li class="swap-grid active">
                                        <a href="cruise-grid-view.html"><i class="soap-icon-grid"></i></a>
                                </ul>
                            </div>
                            <!--Program results to display accordingly in the format below-->
                            <div class="cruise-list image-box style3 cruise listing-style1">
                                <div class="row">
                                    <?php 
                                        if($search->count()){
                                            foreach($search->results() as $key => $value ):
                                    ?>
                                    <div class="col-sm-6 col-md-4">
                                        <article class="box">
                                            <figure>
                                                <a href="packages-detailed.php?id=<?php echo $value->id; ?>" class="hover-effect"><img src="cctech-admin/<?php echo $value->image;?>" style="height: 160px;" ></a>
                                            </figure>
                                            <div class="details">
                                                <span class="price"><small>Adult</small>$<?php echo $value->price; ?></span>
                                                <h4 class="box-title"><?php echo $value->title; ?><small><?php echo $value->duration; ?></small></h4>
                                                <div class="feedback">
                                                    <div data-placement="bottom" data-toggle="tooltip" class="five-stars-container" title="3 stars"><span style="width: 60%;" class="five-stars"></span></div>
                                                    <span class="review">27 reviews</span>
                                                </div>
                                                <div class="row time">
                                                    <div class="date col-xs-6">
                                                        <i class="soap-icon-clock yellow-color"></i>
                                                        <div>
                                                            <span class="skin-color">Date</span><br /><?php echo get_date_two($value->start); ?>
                                                        </div>
                                                    </div>
                                                    <div class="departure col-xs-6">
                                                        <i class="soap-icon-departure yellow-color"></i>
                                                        <div>
                                                            <span class="skin-color">Destination</span><br /><?php echo $value->city; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="description fourty-space">Save up to <span class="skin-color">20%</span> in grand suite</p>
                                                <div class="action">
                                                    <a class="button btn-small full-width" href="package-detailed.php?id=<?php echo $value->id; ?>">SELECT NOW</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <?php 
                                            endforeach;
                                        }
                                    ?>

                                    <!-- <div class="col-sm-6 col-md-4">
                                        <article class="box">
                                            <figure>
                                                <a href="ajax/cruise-slideshow-popup.html" class="hover-effect popup-gallery"><img width="270" height="160"  src="images/zanzibar_pic04.jpg"></a>
                                            </figure>
                                            <div class="details">
                                                <span class="price"><small>Adult</small>$299</span>
                                                <h4 class="box-title">Miami to Florida<small>4 nights</small></h4>
                                                <div class="feedback">
                                                    <div data-placement="bottom" data-toggle="tooltip" class="five-stars-container" title="3 stars"><span style="width: 60%;" class="five-stars"></span></div>
                                                    <span class="review">27 reviews</span>
                                                </div>
                                                <div class="row time">
                                                    <div class="date col-xs-6">
                                                        <i class="soap-icon-clock yellow-color"></i>
                                                        <div>
                                                            <span class="skin-color">Date</span><br />Jan 26, 2014
                                                        </div>
                                                    </div>
                                                    <div class="departure col-xs-6">
                                                        <i class="soap-icon-departure yellow-color"></i>
                                                        <div>
                                                            <span class="skin-color">Destination</span><br />Los Angeles
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="description fourty-space">Save up to <span class="skin-color">20%</span> in grand suite</p>
                                                <div class="action">
                                                    <a class="button btn-small full-width" href="Packages-detailed.html">SELECT NOW</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <article class="box">
                                            <figure>
                                                <a href="ajax/cruise-slideshow-popup.html" class="hover-effect popup-gallery"><img width="270" height="160" alt="" src="images/South-Africa-Victoria-Falls-590x370.jpg"></a>
                                            </figure>
                                            <div class="details">
                                                <span class="price"><small>Adult</small>$578</span>
                                                <h4 class="box-title">Jacksonville to Asia<small>4 nights</small></h4>
                                                <div class="feedback">
                                                    <div data-placement="bottom" data-toggle="tooltip" class="five-stars-container" title="3 stars"><span style="width: 60%;" class="five-stars"></span></div>
                                                    <span class="review">27 reviews</span>
                                                </div>
                                                <div class="row time">
                                                    <div class="date col-xs-6">
                                                        <i class="soap-icon-clock yellow-color"></i>
                                                        <div>
                                                            <span class="skin-color">Date</span><br />Jan 26, 2014
                                                        </div>
                                                    </div>
                                                    <div class="departure col-xs-6">
                                                        <i class="soap-icon-departure yellow-color"></i>
                                                        <div>
                                                            <span class="skin-color">Destination</span><br />Los Angeles
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="description fourty-space">Save up to <span class="skin-color">20%</span> in grand suite</p>
                                                <div class="action">
                                                    <a class="button btn-small full-width" href="Packages-detailed.html">SELECT NOW</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <article class="box">
                                            <figure>
                                                <a href="ajax/cruise-slideshow-popup.html" class="hover-effect popup-gallery"><img width="270" height="160" alt="" src="http://placehold.it/270x160"></a>
                                            </figure>
                                            <div class="details">
                                                <span class="price"><small>Adult</small>$149</span>
                                                <h4 class="box-title">Hong Kong<small>4 nights</small></h4>
                                                <div class="feedback">
                                                    <div data-placement="bottom" data-toggle="tooltip" class="five-stars-container" title="3 stars"><span style="width: 60%;" class="five-stars"></span></div>
                                                    <span class="review">27 reviews</span>
                                                </div>
                                                <div class="row time">
                                                    <div class="date col-xs-6">
                                                        <i class="soap-icon-clock yellow-color"></i>
                                                        <div>
                                                            <span class="skin-color">Date</span><br />Jan 26, 2014
                                                        </div>
                                                    </div>
                                                    <div class="departure col-xs-6">
                                                        <i class="soap-icon-departure yellow-color"></i>
                                                        <div>
                                                            <span class="skin-color">Destination</span><br />Los Angeles
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="description fourty-space">Save up to <span class="skin-color">20%</span> in grand suite</p>
                                                <div class="action">
                                                    <a class="button btn-small full-width" href="Packages-grid-view.html">SELECT NOW</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <article class="box">
                                            <figure>
                                                <a href="ajax/cruise-slideshow-popup.html" class="hover-effect popup-gallery"><img width="270" height="160" alt="" src="http://placehold.it/270x160"></a>
                                            </figure>
                                            <div class="details">
                                                <span class="price"><small>Adult</small>$395</span>
                                                <h4 class="box-title">Malaga to Spain<small>4 nights</small></h4>
                                                <div class="feedback">
                                                    <div data-placement="bottom" data-toggle="tooltip" class="five-stars-container" title="3 stars"><span style="width: 60%;" class="five-stars"></span></div>
                                                    <span class="review">27 reviews</span>
                                                </div>
                                                <div class="row time">
                                                    <div class="date col-xs-6">
                                                        <i class="soap-icon-clock yellow-color"></i>
                                                        <div>
                                                            <span class="skin-color">Date</span><br />Jan 26, 2014
                                                        </div>
                                                    </div>
                                                    <div class="departure col-xs-6">
                                                        <i class="soap-icon-departure yellow-color"></i>
                                                        <div>
                                                            <span class="skin-color">Destination</span><br />Los Angeles
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="description fourty-space">Save up to <span class="skin-color">20%</span> in grand suite</p>
                                                <div class="action">
                                                    <a class="button btn-small full-width" href="Packages-detailed.html">SELECT NOW</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <article class="box">
                                            <figure>
                                                <a href="ajax/cruise-slideshow-popup.html" class="hover-effect popup-gallery"><img width="270" height="160" alt="" src="http://placehold.it/270x160"></a>
                                            </figure>
                                            <div class="details">
                                                <span class="price"><small>Adult</small>$357</span>
                                                <h4 class="box-title">New York to Paris<small>4 nights</small></h4>
                                                <div class="feedback">
                                                    <div data-placement="bottom" data-toggle="tooltip" class="five-stars-container" title="3 stars"><span style="width: 60%;" class="five-stars"></span></div>
                                                    <span class="review">27 reviews</span>
                                                </div>
                                                <div class="row time">
                                                    <div class="date col-xs-6">
                                                        <i class="soap-icon-clock yellow-color"></i>
                                                        <div>
                                                            <span class="skin-color">Date</span><br />Jan 26, 2014
                                                        </div>
                                                    </div>
                                                    <div class="departure col-xs-6">
                                                        <i class="soap-icon-departure yellow-color"></i>
                                                        <div>
                                                            <span class="skin-color">Destination</span><br />Los Angeles
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="description fourty-space">Save up to <span class="skin-color">20%</span> in grand suite</p>
                                                <div class="action">
                                                    <a class="button btn-small full-width" href="Packages-detailed.html">SELECT NOW</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div> -->
                                </div>
                            </div>
                            <a href="#" class="uppercase full-width button btn-large">load more listing</a>
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

