<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <!-- Page Title -->
    <title>Travelafric.com</title>
    <!-- Meta Tags -->
    <?php require 'template/head.html'; ?>
</head>
<body>
   <div id="page-wrapper">
        <?php require 'template/nav.php'; ?>

        <div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title">Events</h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="#">HOME</a></li>
                    <li><a href="#">Events List</a></li>
                </ul>
            </div>
        </div>

        <section id="content">
            <!-- <div class="col-sm-8 col-md-9"> -->
                            
            <div class="container">
                <div class="sort-by-section box clearfix">
                    <h4 class="sort-by-title block-sm">Sort results by:</h4>
                    <ul class="sort-bar clearfix block-sm">
                        <li class="sort-by-name"><a class="sort-by-container" href="#"><span>Country</span></a></li>
                        <li class="sort-by-price"><a class="sort-by-container" href="#"><span>City</span></a></li>
                        <li class="clearer visible-sms"></li>
                        <li class="sort-by-date active"><a class="sort-by-container" href="#"><span>Date</span></a></li>
                        <li class="sort-by-cruise-line"><a class="sort-by-container" href="#"><span>Type</span></a></li>
                    </ul>
                </div>

                <div id="main">
                    <div class="row add-clearfix image-box style1 tour-locations">
                        <?php 
                            $events = DB::getInstance()->query("SELECT * FROM events ORDER BY e_date DESC");
                            if($events->results()){
                                foreach ($events->results() as $key => $value) :
                        ?>
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <article class="box">
                                <figure>
                                    <a href="event-detailed.php?id=<?php echo $value->id ?>" class="hover-effect">
                                        <img src="cctech-admin/<?php echo $value->image?>" alt="" style="height:160px; ">
                                    </a>
                                </figure>
                                <!--Program to respond to event listing accordingly-example below-->
                                <div class="details">
                                    <span class="price">$<?php echo $value->price ?></span>
                                    <h4 class="box-title"><?php echo $value->title ?></h4>
                                    <hr>
                                    <ul class="features check">
                                        <li>Venue: <?php echo $value->loc ?></li>
                                        
                                    </ul>
                                    <hr>
                                    <div class="text-center">
                                        <div class="time">
                                            <i class="soap-icon-clock yellow-color"></i>
                                            <span><?php echo get_date_two($value->e_date) ?></span>
                                        </div>
                                    </div>
                                    <a href="event-detailed.php?id=<?php echo $value->id ?>" class="button btn-small full-width">BOOK NOW</a>
                                </div>
                            </article>
                        </div>
                        <?php
                                endforeach;
                            }
                        ?>
                        
                    </div>
                    <a href="#" class="button btn-large full-width uppercase">Load More Packages</a>
                </div>
            </div>
        </section>
        
        <?php include 'template/footer.php'; ?>
    </div>

    <!-- Javascript -->
    <?php include 'template/js-loader.html'; ?>
    
</body>
</html>

