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
        <?php  
            $event = find_by_id('events',Input::get('id'));
        ?>

        <div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title">Event Details</h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="#">HOME</a></li>
                    <li><a href="#">EVENTS</a></li>
                    <li class="active">Events Details</li>
                </ul>
            </div>
        </div>

        <section id="content">
            <div class="container tour-detail-page">
                <div class="row">
                    <div id="main" class="col-md-9">
                        <div class="featured-image">
                            <img src="cctech-admin/<?php echo $event->image ?>" style="" class="img-responsive" alt="" />
                        </div>

                        <div id="tour-details" class="travelo-box">
                            <div class="intro small-box table-wrapper full-width hidden-table-sms">
                                <div class="col-sm-6 table-cell travelo-box">
                                    <dl class="term-description">
                                        <dt>Event Host:</dt><dd><?php echo $event->sup_name ?></dd>
                                        <dt>Contact:</dt><dd><?php echo $event->sup_tel ?></dd>
                                        <dt>Duration:</dt><dd>4 hours</dd>
                                        <dt>Address</dt><dd><?php echo $event->loc ?></dd>
                                    </dl>
                                </div>
                                <div class="col-sm-8 table-cell">
                                    <div class="detailed-features">
                                        <div class="price-section clearfix">
                                            <div class="details">
                                                <h4 class="box-title"><?php echo $event->title ?><small><?php echo get_date_two($event->e_date); ?></small></h4>
                                            </div>
                                            <div class="details">
                                                <span class="price">$<?php echo $event->price ?></span>
                                                <a href="event-booking.php?id=<?php echo $event->id ?>" class="button green btn-small uppercase">Book Ticket</a>
                                            </div>
                                        </div>
                                        <div class="flights table-wrapper">
                                            <div class="table-row">
                                                <div class="table-cell">
                                                    <h4 class="box-title">City<small><?php echo $event->city ?></small></h4>
                                                </div>
                                                <div class="table-cell">
                                                    <dl><dt>Start</dt><dd><?php echo $event->e_time ?></dd></dl>
                                                </div>
                                                <div class="table-cell">
                                                    <dl><dt>End</dt><dd>20:40 PM</dd></dl>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                            <h2>Description</h2>
                            <p><?php echo $event->body ?></p><br><br>
                            <h3><center> <a href="extra-pages-group-booking.html" class="red-color">For more than 9 pax, Please click this link for Group Booking<!--onclick link to slydepay for payment and return to "hotel-payment confirm" page--></a></center></h3>

                        </div>
                    </div>
                    <div class="sidebar col-md-3">
                        <div class="travelo-box">
                            <h4 class="box-title">Recommended Hotels</h4>
                            <div class="image-box style14">
                                <?php 
                                    $today = date('m/d/Y');$date = new DateTime($today); $tomrw = $date->add(new DateInterval('P1D'))->format('m/d/Y');
                                    $s_hotel = DB::getInstance()->query("SELECT * FROM clients WHERE groups=4 AND verified=1 ORDER BY id DESC LIMIT 3");
                                        if($s_hotel->count()){
                                            foreach ($s_hotel->results() as $key => $hval) {
                                                $image = DB::getInstance()->query("SELECT * FROM media WHERE hid = $hval->id LIMIT 1");
                                                if($image->count()){
                                                    foreach ($image->results() as $key => $img) {$path = 'hotels/'.$img->path;}    
                                                }else{$path = 'http://placehold.it/63x60';}
                                ?>
                                <article class="box">
                                    <figure><a href="#" title=""><img style="height:60px;" src="<?php echo $path ?>" alt=""></a></figure>
                                    <div class="details">
                                        <h5 class="box-title">
                                            <a href="hotel-detailed.php?hotel=<?php echo $hval->id.'&from='.$today.'&to='.$tomrw.'&adult=1&infant=1&room=1';?>"><?php echo $hval->company_name;?></a>
                                        </h5>
                                        <label class="price-wrapper"><span class="price-per-unit"><?php echo '$'.avag_roomPrice($hval->id); ?></span>avg/night</label>
                                    </div>
                                </article>
                                <?php } }?>
                                <!-- <article class="box">
                                    <figure><a href="#" title=""><img width="63" height="59" src="http://placehold.it/63x60" alt=""></a></figure>
                                    <div class="details">
                                        <h5 class="box-title"><a href="#">Ocean Park Tour</a></h5>
                                        <label class="price-wrapper"><span class="price-per-unit">$620</span>avg/night</label>
                                    </div>
                                </article>
                                <article class="box">
                                    <figure><a href="#" title=""><img width="63" height="59" src="http://placehold.it/63x60" alt=""></a></figure>
                                    <div class="details">
                                        <h5 class="box-title"><a href="#">Dream World Trip</a></h5>
                                        <label class="price-wrapper"><span class="price-per-unit">$322</span>avg/night</label>
                                    </div>
                                </article> -->
                            </div>
                        </div>
                        <div class="travelo-box book-with-us-box">  
                       <h4>Need Travelafric Help?</h4>
                            <p>We would be more than happy to help you. Our Account Manager are 24/7 at your service to help you.</p>
                            <address class="contact-details">
                                <span class="contact-phone"><i class="soap-icon-phone"></i> +233-247-94-3218</span>
                                <br>
                                <a class="contact-email" href="#">info@travelafric.com</a>
                            </address>
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
        tjq(".tour-google-map").gmap3({
            map: {
                options: {
                    center: [48.85661, 2.35222],
                    zoom: 12
                }
            },
            marker:{
                values: [
                    {latLng:[48.85661, 2.35222], data:"Paris"}

                ],
                options: {
                    draggable: false
                },
            }
        });
    </script>
    
</body>
</html>

