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
        <?php if(!$client->isLoggedIn() ) { Session::flash('msg','Login to access your account.');Redirect::to('login.php'); } 
            $agent = find_by_id('clients',$client->data()->id);
            $acc = find_by_custId('accounts',$agent->id);
            $jsonUser = json_decode($agent->user_details);
            $jsonCompany = json_decode($agent->company_details);

            /*---------update profile--------*/
            if(Input::get('updateProfile')){
                
                $update = DB::getInstance()->update('clients',$agent->id,array('country'=>Input::get('country'),'city'=>Input::get('city'),'tel'=>Input::get('tel'),'addr'=>Input::get('addr'),'fullname'=>Input::get('fullname') ));
                if ($update) { Session::flash('done','You have successfully updated your profile.');}
                else{Session::flash('fail','Sorry could not commit update now.');}   
                Redirect::to('dashboard.php#profile');
            }    
            /*------update password------*/
            if(Input::get('updtpwd')){
                if ($agent->plain!=Input::get('current-pwd')) {
                    Session::flash('fail','Invalid current password.');
                }else{
                    if(Input::get('new-pwd')!=Input::get('vnew-pwd')){
                        Session::flash('fail','New password mismatch.');
                    }else{
                        $plain = Input::get('new-pwd');
                        $salt = Hash::salt(32);
                        $password = Hash::make(Input::get('new-pwd'), $salt);
                        $update = DB::getInstance()->update('clients',$agent->id,array('plain'=>$plain,'password'=>$password,'salt'=>$salt));
                        if ($update) { Session::flash('done','You have successfully updated your password.');}
                        else{Session::flash('fail','Sorry could not commit update now.');} 
                    }    
                }
                Redirect::to('dashboard.php#settings');
            }
        ?>

        <div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title">My Account</h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="#">HOME</a></li>
                    <li class="active"><a href="#">My Account</a></li>
                </ul>
            </div>
        </div>

        <section id="content">
            <div class="container">
                <?php if(Session::exists('done')){ ?>
                <div class="alert alert-success"><?php echo Session::flash('done');?><span class="close"></span></div> 
                <?php }if(Session::exists('fail')){ ?>
                <div class="alert alert-error"><?php echo Session::flash('fail');?><span class="close"></span></div> 
                <?php } ?>
                <div id="main">
                            
                    <div class="tab-container full-width-style arrow-left dashboard">
                        <ul class="tabs">
                            <li class="active"><a data-toggle="tab" href="#dashboard" aria-expanded="false"><i class="soap-icon-anchor circle"></i>Dashboard</a></li>
                            <li class=""><a data-toggle="tab" href="#profile"><i class="soap-icon-user circle"></i>Profile</a></li>
                            <li class=""><a data-toggle="tab" href="#booking"><i class="soap-icon-businessbag circle"></i>Booking</a></li>
                            <!-- <li class=""><a data-toggle="tab" href="#reservation" aria-expanded="false"><i class="soap-icon-wishlist circle"></i>Reservation</a></li> -->
                            <li class=""><a data-toggle="tab" href="#report" aria-expanded="false"><i class="soap-icon-conference circle"></i>Reports</a></li>
                            <li class=""><a data-toggle="tab" href="#settings" aria-expanded="true"><i class="soap-icon-settings circle"></i>Settings</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="dashboard" class="tab-pane fade active in">
                                <h1 class="no-margin skin-color">Hi <?php echo $jsonUser->fullname ?>, Welcome to your Dashboard!</h1>
                                <p>All your trips booked with us will appear here and you’ll be able to manage everything!</p>
                                <br>
                                <div class="row block">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="fact blue">
                                            <div class="numbers counters-box">
                                                <dl>
                                                    <dt class="display-counter" data-value="<?php if($acc){echo $acc->balance;}else{echo '0.00';} ?>"><?php if($acc){echo $acc->balance;}else{echo '0.00';} ?></dt>
                                                    <dd>Current Balance</dd>
                                                </dl>
                                                <i class="icon soap-icon-hotel"></i>
                                                </div>
                                                <div class="description">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="fact yellow">
                                            <div class="numbers counters-box">
                                                <dl>
                                                    <?php
                                                        $sumTrans = DB::getInstance()->query("SELECT SUM(trans_cost) AS sumT FROM booking WHERE made_by = {$client->data()->id} AND payment_status = 1 ");
                                                        $ttrans = 0;
                                                        foreach($sumTrans->results() as $key => $value)if($value->sumT){$ttrans=$value->sumT;}
                                                    ?>
                                                    <dt class="display-counter" data-value="<?php echo $ttrans; ?>"><?php echo $ttrans; ?></dt>
                                                    <dd>Total Transactions</dd>
                                                </dl>
                                                <i class="icon soap-icon-plane"></i>
                                            </div>
                                            <div class="description"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="fact red">
                                            <div class="numbers counters-box">
                                                <dl>
                                                    <?php
                                                        $now = date('Y-m-d');
                                                        $todaytrans = 0;
                                                        $sumToday = DB::getInstance()->query("SELECT SUM(trans_cost) AS tToday FROM booking WHERE made_by = {$client->data()->id} AND date(datee) = '$now'  ");
                                                        foreach($sumToday->results() as $key => $ttday)if($ttday->tToday){$todaytrans=$ttday->tToday;}
                                                    ?>
                                                    <dt class="display-counter" data-value="<?php echo $todaytrans; ?>"><?php echo $todaytrans; ?></dt>
                                                    <dd>Transaction Today</dd>
                                                </dl>
                                                <i class="icon soap-icon-car"></i>
                                            </div>
                                            <div class="description">
                                                    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <a href="#">
                                            <div class="fact green">
                                                <div class="numbers counters-box">
                                                    <dl><dd>Pay Into Account</dd></dl>
                                                </div>
                                                <div class="description">
                                                    
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="notification-area">
                                    
                                </div>
                                
                                <div class="row block">
                                    <div class="col-md-6 notifications">
                                        <h2>Notifications</h2>
                                        <?php 
                                            $noti = DB::getInstance()->query("SELECT * FROM booking WHERE made_by=$agent->id AND payment_status=1 LIMIT 8");
                                                if ($noti->count()) {
                                                    foreach ($noti->results() as $key => $not) {
                                                        $details=json_decode($not->trans_details);
                                        ?>
                                        <a href="#">
                                            <div class="icon-box style1 fourty-space">
                                                <?php if($not->trans_type=='transfers'){$id=$details->id; $each=find_by_id('transfers',$id); $name=$each->cat; ?>
                                                <i class="icon soap-icon-car red-bg"></i>
                                                <?php }elseif($not->trans_type=='excursions'){$id=$details->id; $each=find_by_id('excursion',$id); $name=$each->title;?>
                                                <i class="icon soap-icon-cruise green-bg"></i>
                                                <?php }elseif($not->trans_type=='tours'){$id=$details->id; $each=find_by_id('tours',$id); $name=$each->title;?>
                                                <i class="icon soap-icon-plane-right  takeoff-effect yellow-bg"></i>
                                                <?php }elseif($not->trans_type=='hotels'){$id=$details->hotelId; $each=find_by_id('clients',$id); $name=$each->company_name;?>
                                                <i class="icon soap-icon-hotel  blue-bg"></i>
                                                <?php }elseif($not->trans_type=='events'){$id=$details->id;$each = find_by_id('events',$id); $name=$each->title;?>
                                                <i class="icon soap-icon-card  blue-colo"></i>
                                                <?php } ?>
                                                <span class="time pull-right"><?php echo time_elapsed_string($not->datee); ?></span>
                                                <p class="box-title"><?php echo $name; ?> <span class="price">$<?php echo $not->trans_cost; ?></span></p>
                                            </div>
                                        </a>
                                       
                                        <?php } } ?>
                                        <!-- <a href="#">
                                            <div class="load-more">. . . . . . . . . . . . . </div>
                                        </a> -->
                                    </div>
                                    <div class="col-md-6">
                                        <h2>Recent Activity</h2>
                                        <div class="recent-activity">
                                            <ul>
                                                <?php 
                                                    $recent = DB::getInstance()->query("SELECT * FROM booking WHERE made_by=$agent->id AND payment_status=1 LIMIT 6");
                                                    if ($recent->count()) {
                                                        foreach ($recent->results() as $key => $recnt) {
                                                            $details=json_decode($recnt->trans_details);
                                                ?>
                                                <li>
                                                    <a href="#">
                                                        <?php if($recnt->trans_type=='transfers'){$id=$details->id; $each=find_by_id('transfers',$id); $title=$each->cat; ?>
                                                        <i class="icon soap-icon-car circle red-color"></i>
                                                        <?php }elseif($recnt->trans_type=='excursions'){$id=$details->id; $each=find_by_id('excursion',$id); $title=$each->title;?>
                                                        <i class="icon soap-icon-cruise circle green-color"></i>
                                                        <?php }elseif($recnt->trans_type=='tours'){$id=$details->id; $each=find_by_id('tours',$id); $title=$each->title;?>
                                                        <i class="icon soap-icon-plane-right circle takeoff-effect yellow-color"></i>
                                                        <?php }elseif($recnt->trans_type=='hotels'){$id=$details->hotelId; $each=find_by_id('clients',$id); $title=$each->company_name;?>
                                                        <i class="icon soap-icon-hotel circle blue-color"></i>
                                                        <?php }elseif($recnt->trans_type=='events'){$id=$details->id;$each = find_by_id('events',$id); $title=$each->title;?>
                                                        <i class="icon soap-icon-card circle blue-colo"></i>
                                                        <?php } ?>
                                                        
                                                        <span class="price"><small>avg/person</small>$<?php echo $recnt->trans_cost; ?></span>
                                                        <h4 class="box-title">
                                                            <?php echo $title; ?><small><?php echo $details->name;?></small>
                                                        </h4>
                                                    </a>
                                                </li>
                                                <?php } } ?>
                                                
                                            </ul>
                                            <a href="#" class="button green btn-small full-width">VIEW ALL ACTIVITIES</a>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4>Benefits of TavelAfric Account</h4>
                                        <ul class="benefits triangle hover">
                                            <li><a href="#">Faster bookings with lesser clicks</a></li>
                                            <li><a href="#">Track travel history &amp; manage bookings</a></li>
                                            <li class="active"><a href="#">Manage profile &amp; personalize experience</a></li>
                                            <li><a href="#">Receive alerts &amp; recommendations</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4 previous-bookings image-box style14">
                                        <h4>Your Previous Bookings</h4>
                                        <article class="box">
                                            <figure class="no-padding">
                                                <a title="" href="#">
                                                    <img alt="" src="http://placehold.it/63x59" width="63" height="59">
                                                </a>
                                            </figure>
                                            <div class="details">
                                                <h5 class="box-title"><a href="#">Half-Day Island Tour</a><small class="fourty-space"><span class="price">$35</span> Family Package</small></h5>
                                            </div>
                                        </article>
                                        <article class="box">
                                            <figure class="no-padding">
                                                <a title="" href="#">
                                                    <img alt="" src="http://placehold.it/63x59" width="63" height="59">
                                                </a>
                                            </figure>
                                            <div class="details">
                                                <h5 class="box-title"><a href="#">Ocean Park Tour</a><small class="fourty-space"><span class="price">$26</span> Per Person</small></h5>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="col-md-4">
                                        <h4>Need Travelo Help?</h4>
                                        <div class="contact-box">
                                            <p>We would be more than happy to help you. Our team advisor are 24/7 at your service to help you.</p>
                                            <address class="contact-details">
                                                <span class="contact-phone"><i class="soap-icon-phone"></i> +233-247-94-3218 </span>
                                                <br>
                                                <a class="contact-email" href="#">info@travelafric.com</a>
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="profile" class="tab-pane fade">
                                <div class="view-profile">
                                    <article class="image-box style2 box innerstyle personal-details">
                                        <figure>
                                            <a title="" href="#"><img width="270" height="263" alt="" src="http://placehold.it/270x263"></a>
                                        </figure>
                                        <div class="details">
                                            <a href="#" class="button btn-mini pull-right edit-profile-btn">EDIT PROFILE</a>
                                            <h2 class="box-title fullname"><?php echo $jsonUser->fullname ?></h2>
                                            <dl class="term-description">
                                                <dt>user name:</dt><dd><?php echo $jsonUser->display_name ?></dd>
                                                <dt>Skype:</dt><dd><?php echo $jsonCompany->skype ?></dd>
                                                <dt>Email:</dt><dd><?php echo $agent->email ?></dd>
                                                <dt>phone number:</dt><dd><?php echo $jsonCompany->telephone ?></dd>
                                                <!-- <dt>Date of birth:</dt><dd>15 August 1985</dd> -->
                                                <dt>Street Address and number:</dt><dd><?php echo $jsonCompany->address ?></dd>
                                                <dt>Town / City:</dt><dd><?php echo $agent->city; ?></dd>
                                                <dt>ZIP code:</dt><dd><?php echo $jsonCompany->zip ?></dd>
                                                <dt>Country:</dt><dd><?php echo $agent->country ?></dd>
                                            </dl>
                                        </div>
                                    </article>
                                    <hr>
                                    <!-- <h2>About You</h2>
                                        <div class="intro">
                                        <p>Vestibulum tristique, justo eu sollicitudin sagittis, metus dolor eleifend urna, quis scelerisque purus quam nec ligula. Suspendisse iaculis odio odio, ac vehicula nisi faucibus eu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse posuere semper sem ac aliquet. Duis vel bibendum tellus, eu hendrerit sapien. Proin fringilla, enim vel lobortis viverra, augue orci fringilla diam, sed cursus elit mi vel lacus. Nulla facilisi. Fusce sagittis, magna non vehicula gravida, ante arcu pulvinar arcu, aliquet luctus arcu purus sit amet sem. Mauris blandit odio sed nisi porttitor egestas. Mauris in quam interdum purus vehicula rutrum quis in sem. Integer interdum lectus at nulla dictum luctus. Sed risus felis, posuere id condimentum non, egestas pulvinar enim. Praesent pretium risus eget nisi ullamcorper fermentum. Duis lacinia nisi ac rhoncus vestibulum.</p>
                                    </div> -->
                                    <hr>
                                    <h2>Today’s Suggestions</h2>
                                    <div class="suggestions image-carousel style2" data-animation="slide" data-item-width="170" data-item-margin="22">
                                        <ul class="slides">
                                            <li>
                                                <a href="#" class="hover-effect">
                                                    <img src="http://placehold.it/170x170" alt="">
                                                </a>
                                                <h5 class="caption">Adventure</h5>
                                            </li>
                                            <li>
                                                <a href="#" class="hover-effect">
                                                    <img src="http://placehold.it/170x170" alt="">
                                                </a>
                                                <h5 class="caption">Beaches &amp; Sun</h5>
                                            </li>
                                            <li>
                                                <a href="#" class="hover-effect">
                                                    <img src="http://placehold.it/170x170" alt="">
                                                </a>
                                                <h5 class="caption">Casinos</h5>
                                            </li>
                                            <li>
                                                <a href="#" class="hover-effect">
                                                    <img src="http://placehold.it/170x170" alt="">
                                                </a>
                                                <h5 class="caption">Family Fun</h5>
                                            </li>
                                            <li>
                                                <a href="#" class="hover-effect">
                                                    <img src="http://placehold.it/170x170" alt="">
                                                </a>
                                                <h5 class="caption">History</h5>
                                            </li>
                                            <li>
                                                <a href="#" class="hover-effect">
                                                    <img src="http://placehold.it/170x170" alt="">
                                                </a>
                                                <h5 class="caption">Adventure</h5>
                                            </li>
                                        </ul>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h4>Benefits of TavelAfric Account</h4>
                                            <ul class="benefits triangle hover">
                                                <li><a href="#">Faster bookings with lesser clicks</a></li>
                                                <li><a href="#">Track travel history &amp; manage bookings</a></li>
                                                <li class="active"><a href="#">Manage profile &amp; personalize experience</a></li>
                                                <li><a href="#">Receive alerts &amp; recommendations</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4 previous-bookings image-box style14">
                                            <h4>Your Previous Bookings</h4>
                                            <article class="box">
                                                <figure class="no-padding">
                                                    <a title="" href="#">
                                                        <img alt="" src="http://placehold.it/63x59" width="63" height="59">
                                                    </a>
                                                </figure>
                                                <div class="details">
                                                    <h5 class="box-title"><a href="#">Half-Day Island Tour</a><small class="fourty-space"><span class="price">$35</span> Family Package</small></h5>
                                                </div>
                                            </article>
                                            <article class="box">
                                                <figure class="no-padding">
                                                    <a title="" href="#">
                                                        <img alt="" src="http://placehold.it/63x59" width="63" height="59">
                                                    </a>
                                                </figure>
                                                <div class="details">
                                                    <h5 class="box-title"><a href="#">Ocean Park Tour</a><small class="fourty-space"><span class="price">$26</span> Per Person</small></h5>
                                                </div>
                                            </article>
                                        </div>
                                        <div class="col-md-4">
                                            <h4>Need Travelo Help?</h4>
                                            <div class="contact-box">
                                                <p>We would be more than happy to help you. Our team advisor are 24/7 at your service to help you.</p>
                                                <address class="contact-details">
                                                    <span class="contact-phone"><i class="soap-icon-phone"></i> 1-800-123-HELLO</span>
                                                    <br>
                                                    <a class="contact-email" href="#">help@travelo.com</a>
                                                </address>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="edit-profile">
                                    <form class="edit-profile-form" action="" method="post">
                                        <h2>Personal Details</h2>
                                        <div class="col-sm-9 no-padding no-float">
                                            <div class="row form-group">
                                                <div class="col-sms-6 col-sm-6">
                                                    <label>Full Name</label>
                                                    <input type="text" name="fullname" required class="input-text full-width" value="<?php echo $jsonUser->fullname ?>">
                                                </div>
                                                <div class="col-sms-6 col-sm-6">
                                                    <label>Display Name</label>
                                                    <input type="text" class="input-text full-width" placeholder="" value="<?php echo $jsonUser->display_name ?>">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-sms-6 col-sm-6">
                                                    <label>Email Address</label>
                                                    <input type="email" name="email" required class="input-text full-width" value="<?php echo $agent->email; ?>">
                                                </div>
                                                <!-- <div class="col-sms-6 col-sm-6">
                                                    <label>Verify Email Address</label>
                                                    <input type="text" class="input-text full-width" placeholder="">
                                                </div> -->
                                            </div>
                                            <div class="row form-group">
                                                <!-- <div class="col-sms-6 col-sm-6">
                                                    <label>Country Code</label>
                                                    <div class="selector">
                                                        <select class="full-width">
                                                            <option>United Kingdom (+44)</option>
                                                            <option>United States (+1)</option>
                                                        </select><span class="custom-select full-width">United Kingdom (+44)</span>
                                                    </div>
                                                </div> -->
                                                <div class="col-sms-6 col-sm-6">
                                                    <label>Phone Number</label>
                                                    <input type="text" name="tel" required class="input-text full-width" value="<?php echo $jsonCompany->telephone ?>">
                                                </div>
                                            </div>
                                            <label>Date of Birth</label>
                                            <div class="row form-group">
                                                <div class="col-sms-4 col-sm-2">
                                                    <div class="selector">
                                                        <select class="full-width">
                                                            <option value="">date</option>
                                                        </select><span class="custom-select full-width">date</span>
                                                    </div>
                                                </div>
                                                <div class="col-sms-4 col-sm-2">
                                                    <div class="selector">
                                                        <select class="full-width">
                                                            <option value="">month</option>
                                                        </select><span class="custom-select full-width">month</span>
                                                    </div>
                                                </div>
                                                <div class="col-sms-4 col-sm-2">
                                                    <div class="selector">
                                                        <select class="full-width">
                                                            <option value="">year</option>
                                                        </select><span class="custom-select full-width">year</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <h2>Contact Details</h2>
                                            <div class="row form-group">
                                                <!-- <div class="col-sms-6 col-sm-6">
                                                    <label>Street Name</label>
                                                    <input type="text" class="input-text full-width">
                                                </div> -->
                                                <div class="col-sms-6 col-sm-6">
                                                    <label>Address</label>
                                                    <input type="text" name="addr" class="input-text full-width" value="<?php echo $jsonCompany->address;?>">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-sms-6 col-sm-6">
                                                    <label>City</label>
                                                    <input type="text" name="city" required class="input-text full-width" value="<?php echo $agent->city;?>">
                                                    <!-- <div class="selector">
                                                        <select class="full-width">
                                                            <option value="">Select...</option>
                                                        </select><span class="custom-select full-width">Select...</span>
                                                    </div> -->
                                                </div>
                                                <div class="col-sms-6 col-sm-6">
                                                    <label>Country</label>
                                                    <input type="text" name="country" required class="input-text full-width" value="<?php echo $agent->country;?>">
                                                    <!-- <div class="selector">
                                                        <select class="full-width">
                                                            <option value="">Select...</option>
                                                        </select><span class="custom-select full-width">Select...</span>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <!-- <div class="row form-group">
                                                <div class="col-sms-6 col-sm-6">
                                                    <label>Region State</label>
                                                    <div class="selector">
                                                        <select class="full-width">
                                                            <option value="">Select...</option>
                                                        </select><span class="custom-select full-width">Select...</span>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <hr>
                                            <h2>Upload Profile Photo</h2>
                                            <div class="row form-group">
                                                <div class="col-sms-12 col-sm-6 no-float">
                                                    <div class="fileinput full-width" style="line-height: 34px;">
                                                        <input type="file" class="input-text" data-placeholder="select image/s"><input type="text" class="custom-fileinput input-text" placeholder="select image/s">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <h2>Describe Yourself</h2>
                                            <div class="form-group">
                                                <textarea rows="5" class="input-text full-width" placeholder="please tell us about you"></textarea>
                                            </div>
                                            <div class="from-group">
                                                <button type="submit" name="updateProfile" value="updateProfile" class="btn-medium col-sms-6 col-sm-4">UPDATE SETTINGS</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div id="booking" class="tab-pane fade">
                                <h2>Trips You have Booked!</h2>
                                <div class="filter-section gray-area clearfix">
                                    <form>
                                        <label class="radio radio-inline checked">
                                            <input type="radio" name="filter" checked="checked">All Types
                                        </label>
                                        <label class="radio radio-inline">
                                            <input type="radio" name="filter"> Hotels
                                        </label>
                                        <label class="radio radio-inline">
                                            <input type="radio" name="filter">Transfers
                                        </label>
                                        <label class="radio radio-inline">
                                            <input type="radio" name="filter">Sightseeing
                                        </label>
                                        <label class="radio radio-inline">
                                            <input type="radio" name="filter">Packages
                                        </label>
                                        <label class="radio radio-inline">
                                            <input type="radio" name="filter">Events
                                        </label>
                                        <div class="pull-right col-md-6 action">
                                            <h5 class="pull-left no-margin col-md-4">Sort results by:</h5>
                                            <button class="btn-small white gray-color">UPCOMING</button>
                                            <button class="btn-small white gray-color">DONE</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="booking-history">
                                    <?php 
                                        $today = date('m/d/Y');$date = new DateTime($today); $tomrw = $date->add(new DateInterval('P1D'))->format('m/d/Y');
                                        $booking = DB::getInstance()->query("SELECT * FROM booking WHERE made_by=$agent->id AND payment_status=1 ORDER BY datee DESC");
                                        if ($booking->count()) {
                                            foreach ($booking->results() as $key => $book) {
                                                $bDetails=json_decode($book->trans_details);
                                    ?>
                                    <div class="booking-info clearfix">
                                        <div class="date">
                                            <label class="month text-uppercase"><?php echo get_month($book->datee); ?></label>
                                            <label class="date"><?php echo get_day($book->datee); ?></label>
                                            <label class="day"><?php echo date('D',strtotime($book->datee) ) ?></label>
                                        </div>
                                        <h4 class="box-title">
                                        <?php if($book->trans_type=='transfers'){$id=$bDetails->id; $each=find_by_id('transfers',$id); $title=$each->cat; ?>
                                        <i class="icon soap-icon-car circle red-color"></i>
                                        <?php }elseif($book->trans_type=='excursions'){$id=$bDetails->id; $each=find_by_id('excursion',$id); $title=$each->title;?>
                                        <i class="icon soap-icon-cruise circle green-color"></i>
                                        <?php }elseif($book->trans_type=='tours'){$id=$bDetails->id; $each=find_by_id('tours',$id); $title=$each->title;?>
                                        <i class="icon soap-icon-plane-right circle takeoff-effect yellow-color"></i>
                                        <?php }elseif($book->trans_type=='hotels'){$id=$bDetails->hotelId; $each=find_by_id('clients',$id); $title=$each->company_name;?>
                                        <i class="icon soap-icon-hotel circle blue-color"></i>
                                        <?php }elseif($book->trans_type=='events'){$id=$bDetails->id;$each = find_by_id('events',$id); $title=$each->title;?>
                                        <i class="icon soap-icon-card circle blue-colo"></i>
                                        <?php } ?>
                                        <?php echo $title ?><small><?php echo $book->trans_type; ?> booking</small>
                                        </h4>
                                        <dl class="info"> 
                                            <dt>MARKED UP</dt><br> 
                                            <dd>$<?php echo $book->markup_price; ?></dd>  
                                        </dl>
                                        <dl class="info">
                                            <dt>ACTUAL</dt>
                                            <dd>$<?php echo $book->trans_cost; ?></dd><br>
                                            <a href="javascript:markUp('<?php echo $book->id ?>')" class="button">EDIT</a>
                                        </dl>
                                        <dl class="info">
                                            <dt>TRIP ID</dt>
                                            <dd><?php echo substr($book->trans_id, 0,16) ; ?></dd>
                                            <dt>Reserved On</dt>
                                            <dd><?php echo date('D M j Y',strtotime($book->datee) ) ?></dd>
                                        </dl>
                                        
                                        <button onclick="printInvoice(<?php echo $book->id ?>)" class="btn-mini status">PRINT INVOICE</button>
                                    </div>
                                    <?php } } ?>
                                </div>
                            </div>

                            <!-- <div id="reservation" class="tab-pane fade">
                                <h2>Your Reservation</h2>
                                <div class="filter-section gray-area clearfix">
                                    <form>
                                        <label class="radio radio-inline checked">
                                            <input type="radio" name="filter" checked="checked">
                                            All Types
                                        </label>
                                        <label class="radio radio-inline">
                                            <input type="radio" name="filter">
                                            Hotels
                                        </label>
                                        <label class="radio radio-inline">
                                            <input type="radio" name="filter">
                                            Transfers
                                        </label>
                                        <label class="radio radio-inline">
                                            <input type="radio" name="filter">
                                            Sightseeing
                                        </label>
                                        <label class="radio radio-inline">
                                            <input type="radio" name="filter">
                                            Packages
                                        </label>
                                        <label class="radio radio-inline">
                                            <input type="radio" name="filter">
                                            Events
                                        </label>
                                    </form>
                                </div>
                                <div class="booking-history">
                                    <div class="booking-info clearfix">
                                        <div class="date">
                                            <label class="month">NOV</label>
                                            <label class="date">23</label>
                                            <label class="day">SAT</label>
                                        </div>
                                        <h4 class="box-title"><i class="icon soap-icon-plane-right takeoff-effect yellow-color circle"></i>Indianapolis to Paris<small>you are flying</small></h4>
                                        <dl class="info"> 
                                            <dt>MARKED UP</dt><br> 
                                            <dd>$250</dd>  
                                        </dl>
                                        <dl class="info">
                                            <dt>ACTUAL</dt><br>
                                            <dd>$200</dd>
                                        </dl>
                                        <dl class="info">
                                            <dt>TRIP ID</dt>
                                            <dd>5754-8dk8-8ee</dd>
                                            <dt>Reserved On</dt>
                                            <dd>Sat, Nov 30, 2013</dd>
                                        </dl>
                                        
                                        <button class="btn-mini status">VIEW INVOICE</button><br><br>
                                        <button class="btn-mini status">MAKE PAYMENT</button>
                                    </div>
                                    <div class="booking-info clearfix">
                                        <div class="date">
                                            <label class="month">NOV</label>
                                            <label class="date">30</label>
                                            <label class="day">SAT</label>
                                        </div>
                                        <h4 class="box-title"><i class="icon soap-icon-plane-right takeoff-effect yellow-color circle"></i>England to Rome<small>you are flying</small></h4>
                                        <dl class="info"> 
                                            <dt>MARKED UP</dt><br> 
                                            <dd>$250</dd>  
                                        </dl>
                                        <dl class="info">
                                            <dt>ACTUAL</dt><br>
                                            <dd>$200</dd>
                                        </dl>
                                        <dl class="info">
                                            <dt>TRIP ID</dt>
                                            <dd>5754-8dk8-8ee</dd>
                                            <dt>Reserved On</dt>
                                            <dd>Sat, Nov 30, 2013</dd>
                                        </dl>
                                        <button class="btn-mini status">VIEW INVOICE</button><br><br>
                                        <button class="btn-mini status">MAKE PAYMENT</button>
                                    </div>
                                    <div class="booking-info clearfix">
                                        <div class="date">
                                            <label class="month">DEC</label>
                                            <label class="date">11</label>
                                            <label class="day">MON</label>
                                        </div>
                                        <h4 class="box-title"><i class="icon soap-icon-hotel blue-color circle"></i>Hilton Hotel &amp; Resorts<small>2 adults staying</small></h4>
                                        <dl class="info"> 
                                            <dt>MARKED UP</dt><br> 
                                            <dd>$250</dd>  
                                        </dl>
                                        <dl class="info">
                                            <dt>ACTUAL</dt><br>
                                            <dd>$200</dd>
                                        </dl>
                                        <dl class="info">
                                            <dt>TRIP ID</dt>
                                            <dd>5754-8dk8-8ee</dd>
                                            <dt>Reserved On</dt>
                                            <dd>Sat, Nov 30, 2013</dd>
                                        </dl>
                                        <button class="btn-mini status">VIEW INVOICE</button><br><br>
                                        <button class="btn-mini status">MAKE PAYMENT</button>
                                    </div>
                                    <div class="booking-info clearfix">
                                        <div class="date">
                                            <label class="month">DEC</label>
                                            <label class="date">18</label>
                                            <label class="day">THU</label>
                                        </div>
                                        <h4 class="box-title"><i class="icon soap-icon-car red-color circle"></i>Economy Car<small>you are driving</small></h4>
                                        <dl class="info"> 
                                            <dt>MARKED UP</dt><br> 
                                            <dd>$250</dd>  
                                        </dl>
                                        <dl class="info">
                                            <dt>ACTUAL</dt><br>
                                            <dd>$200</dd>
                                        </dl>
                                        <dl class="info">
                                            <dt>TRIP ID</dt>
                                            <dd>5754-8dk8-8ee</dd>
                                            <dt>Reserved On</dt>
                                            <dd>Sat, Nov 30, 2013</dd>
                                        </dl>
                                        <button class="btn-mini status">VIEW INVOICE</button><br><br>
                                        <button class="btn-mini status">MAKE PAYMENT</button>
                                    </div>
                                    <div class="booking-info clearfix">
                                        <div class="date">
                                            <label class="month">DEC</label>
                                            <label class="date">22</label>
                                            <label class="day">SUN</label>
                                        </div>
                                        <h4 class="box-title"><i class="icon soap-icon-cruise green-color circle"></i>Baja Mexico<small>3 adults going on cruise</small></h4>
                                        <dl class="info"> 
                                            <dt>MARKED UP</dt><br> 
                                            <dd>$250</dd>  
                                        </dl>
                                        <dl class="info">
                                            <dt>ACTUAL</dt><br>
                                            <dd>$200</dd>
                                        </dl>
                                        <dl class="info">
                                            <dt>TRIP ID</dt>
                                            <dd>5754-8dk8-8ee</dd>
                                            <dt>Reserved On</dt>
                                            <dd>Sat, Nov 30, 2013</dd>
                                        </dl>
                                        <button class="btn-mini status">VIEW INVOICE</button><br><br>
                                        <button class="btn-mini status">MAKE PAYMENT</button>
                                    </div>
                                    <div class="booking-info clearfix cancelled">
                                        <div class="date">
                                            <label class="month">NOV</label>
                                            <label class="date">30</label>
                                            <label class="day">SAT</label>
                                        </div>
                                        <h4 class="box-title"><i class="icon soap-icon-plane-right takeoff-effect circle"></i>England to Rome<small>you are flying</small></h4>
                                        <dl class="info"> 
                                            <dt>MARKED UP</dt><br> 
                                            <dd>$250</dd>  
                                        </dl>
                                        <dl class="info">
                                            <dt>ACTUAL</dt><br>
                                            <dd>$200</dd>
                                        </dl>
                                        <dl class="info">
                                            <dt>TRIP ID</dt>
                                            <dd>5754-8dk8-8ee</dd>
                                            <dt>Reserved On</dt>
                                            <dd>Sat, Nov 30, 2013</dd>
                                        </dl>
                                        <button class="btn-mini status">CANCELLED</button>
                                    </div>
                                    <div class="booking-info clearfix cancelled">
                                        <div class="date">
                                            <label class="month">DEC</label>
                                            <label class="date">18</label>
                                            <label class="day">THU</label>
                                        </div>
                                        <h4 class="box-title"><i class="icon soap-icon-car circle"></i>Economy Car<small>you are driving</small></h4>
                                        <dl class="info"> 
                                            <dt>MARKED UP</dt><br> 
                                            <dd>$250</dd>  
                                        </dl>
                                        <dl class="info">
                                            <dt>ACTUAL</dt><br>
                                            <dd>$200</dd>
                                        </dl>
                                        <dl class="info">
                                            <dt>TRIP ID</dt>
                                            <dd>5754-8dk8-8ee</dd>
                                            <dt>Reserved On</dt>
                                            <dd>Sat, Nov 30, 2013</dd>
                                        </dl>
                                        <button class="btn-mini status">CANCELLED</button>
                                    </div>
                                </div>
                            </div> -->

                            <div id="report" class="tab-pane fade">
                                <h2>Share Your Story</h2>
                                <div class="filter-section gray-area clearfix" style="padding:1em 0;background: #dfdfdf; ">
                                    <form id="frmReport" action="" method="post">
                                        <div class="col-sm-3">
                                            <label>Report Type</label>
                                            <div class="selector">
                                                <select class="full-width" name="report-type" id="report-type" required>
                                                    <option value="">--select--</option>
                                                    <option value="Sales">Sales</option>
                                                    <option value="Transaction">Transaction</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label>From</label>
                                            <div class="datepicker-wra">
                                                <input type="date" name="start" id="start" class="input-text full-width" placeholder="mm/dd/yy" required />
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label>To</label>
                                            <div class="datepicker-wra">
                                                <input type="date" name="end" id="end" class="input-text full-width" placeholder="mm/dd/yy" required />
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3 col-md-3 fixheight">
                                            <label class="hidden-xs">&nbsp;</label>
                                            <!--Program Search Now-->
                                            <button id="btnReport" type="submit" class="full-width icon-check animated bounce" data-animation-type="bounce" data-animation-duration="1" style="animation-duration: 1s; visibility: visible;">SEARCH NOW</button>
                                        </div>
                                        <div class="clearfix"></div>
                                   </form>
                                </div>

                                <div id="report-results" class="col-md-12 col-sm-12 no-padding" style="min-height:500px; ">
                                    <div class="alert alert-danger hidden" id="reportAlert">No Records Found<span class="close"></span></div>
                                    <div id="preloader" class="opacity-light bg-mid-gray" style="padding: 20% 45%;">
                                        <img src="res/images/loader2.gif">
                                    </div>
                                </div>   
                            </div>

                            <div id="settings" class="tab-pane fade">
                                <h2>Account Settings</h2>
                                <h5 class="skin-color">Change Your Password</h5>
                                <form action="" method="post">
                                    <div class="row form-group">
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <label>Old Password</label>
                                            <input type="password" required name="current-pwd" class="input-text full-width">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <label>Enter New Password</label>
                                            <input type="password" required name="new-pwd" class="input-text full-width">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <label>Confirm New password</label>
                                            <input type="password" required name="vnew-pwd" class="input-text full-width">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" value="updtpwd" name="updtpwd" class="btn-medium">UPDATE PASSWORD</button>
                                    </div>
                                </form>
                                <hr>
                                <h5 class="skin-color">Change Your Email</h5>
                                <form>
                                    <div class="row form-group">
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <label>Old email</label>
                                            <input type="text" class="input-text full-width">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <label>Enter New Email</label>
                                            <input type="text" class="input-text full-width">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <label>Confirm New Email</label>
                                            <input type="text" class="input-text full-width">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn-medium">UPDATE EMAIL ADDRESS</button>
                                    </div>
                                </form>
                                <hr>
                                <h5 class="skin-color">Send Me Emails When</h5>
                                <form>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> Travelo has periodic offers and deals on really cool destinations.
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> Travelo has fun company news, as well as periodic emails.
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> I have an upcoming reservation.
                                        </label>
                                    </div>
                                    <button class="btn-medium uppercase">Update All Settings</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div id="MarkPrice" class="modal center-col fade new-bg" >
            <div id="" class="modal-dialog modal-md">
                <div class="modal-content clear-conten">
                    <div class="modal-header no-borde ">
                        <button type="button" class="close black-text" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Update Mark-up Price</h4>
                    </div>
                    <div class="modal-body text-justify">
                        <div id="feedback2"></div>
                        <form id="frmMarkPrice" action="" method="POST">
                            <div class="form-group">
                            <input name="amt" id="amt" type="text" placeholder="Enter Amount.." class="form-control input-text">
                            <input type="hidden" name="id" id="id">
                            </div>
                            <button id="btnMarkPrice" type="submit" class="btn btn-md full-width button ">Set Price</button>
                        </form>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>                
        </div>
        
        <?php include 'template/footer.php'; ?>
    </div>


    <!-- Javascript -->
    <?php include 'template/js-loader.html'; ?>
    <script src="cctech-admin/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="cctech-admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        tjq(document).ready(function() {
            tjq("#profile .edit-profile-btn").click(function(e) {
                e.preventDefault();
                tjq(".view-profile").fadeOut();
                tjq(".edit-profile").fadeIn();
            });

        });
        tjq('a[href="#profile"]').on('shown.bs.tab', function (e) {
            tjq(".view-profile").show();
            tjq(".edit-profile").hide();
        });
        tjq('#preloader').hide();

        
        (function($){
            /*-----------------markup modal $ update----------------*/
            $(document).on('submit','#frmMarkPrice',function (){
                $('#btnMarkPrice').addClass('disabled');
                $('#btnMarkPrice').delay(500).html('Proccesing...');
                let data = $(this).serialize();
                $.ajax({
                    type : 'POST',
                    url  : 'ajax/controller.php?type=setMarkup',
                    data : data,
                    success :  function(data){
                        $('#feedback2').html(data);
                        $('#btnMarkPrice').removeClass('disabled');
                        $('#btnMarkPrice').delay(500).html('Set Price');
                    },    
                });
                return false;
            });

            /*------------for report query------*/
            $(document).on('submit', '#frmReport', function(){
                $('#btnReport').addClass('disabled');
                $('#btnReport').delay(500).html('Proccesing...');
                $('#preloader').show();
                let data = $(this).serialize();
                let type = $('#report-type').val();
                
                $.ajax({
                    type : 'POST',
                    url  : 'ajax/controller.php?type=reports',
                    data : data,
                    //dataType : 'json',
                    success :  function(data){
                        let res = JSON.parse(data);
                        let newJson = res.data;
                       
                        if(res.status==1){
                            if (type == 'Transaction') {
                                let table = ``;
                                table +=`
                                    <table id='tblReport' class='table table-bordered table-striped'>
                                        <thead>
                                            <th class="text-left text-uppercase font-weight-800 letter-spacing-2  deep-red-text">Date</th>
                                            <th class="text-left text-uppercase font-weight-800 letter-spacing-2  deep-red-text">Service Type</th>
                                            <th class="text-left text-uppercase font-weight-800 letter-spacing-2  deep-red-text">Supplier</th>
                                            <th class="text-left text-uppercase font-weight-800 letter-spacing-2  deep-red-text">Lead Guest</th>
                                            <th class="text-left text-uppercase font-weight-800 letter-spacing-2  deep-red-text">Confirmed Date</th>
                                            <th class="text-left text-uppercase font-weight-800 letter-spacing-2  deep-red-text">Cancelled Date</th>
                                        </thead>
                                        <tbody>`
                                            for (var i = 0; i < newJson.length; i++) {
                                                table +=`<tr > 
                                                            <td>`+ newJson[i].date +`</td>
                                                            <td>`+ newJson[i].service +`</td>
                                                            <td>`+ newJson[i].supplier +`</td>
                                                            <td>`+ newJson[i].guest +`</td>
                                                            <td>`+ newJson[i].confirm +`</td>
                                                            <td>`+ newJson[i].cancel +`</td>
                                                        </tr>`;
                                                
                                            }
                                        `</tbody>
                                    </table>
                                `;
                                $('#report-results').html(table);
                            }else if (type == 'Sales'){
                                let table = `
                                    <table id="tblReport" class='table table-bordered table-striped'>
                                        <thead>
                                            <th class="text-left text-uppercase font-weight-800 letter-spacing-2  deep-red-text">Date</th>
                                            <th class="text-left text-uppercase font-weight-800 letter-spacing-2  deep-red-text">Country</th>
                                            <th class="text-left text-uppercase font-weight-800 letter-spacing-2  deep-red-text">Service Type</th>
                                            <th class="text-left text-uppercase font-weight-800 letter-spacing-2  deep-red-text">Lead Guest</th>
                                            <th class="text-left text-uppercase font-weight-800 letter-spacing-2  deep-red-text">No. of Guest</th>
                                            <th class="text-left text-uppercase font-weight-800 letter-spacing-2  deep-red-text">No. of Night(s)</th>
                                            <th class="text-left text-uppercase font-weight-800 letter-spacing-2  deep-red-text">Actual Rate</th>
                                            <th class="text-left text-uppercase font-weight-800 letter-spacing-2  deep-red-text">Agency Rate</th>
                                            <th class="text-left text-uppercase font-weight-800 letter-spacing-2  deep-red-text">Markup Rate</th>
                                            <th class="text-left text-uppercase font-weight-800 letter-spacing-2  deep-red-text">payment Mode</th>
                                        </thead>
                                        <tbody>`
                                            for (var i = 0; i < newJson.length; i++) {
                                                table +=`<tr > 
                                                            <td>`+ newJson[i].date +`</td>
                                                            <td>`+ newJson[i].country +`</td>
                                                            <td>`+ newJson[i].service +`</td>
                                                            <td>`+ newJson[i].guest +`</td>
                                                            <td>`+ newJson[i].noGuest +`</td>
                                                            <td>`+ newJson[i].duration +`</td>
                                                            <td>`+ newJson[i].actualPrice +`</td>
                                                            <td>`+ newJson[i].agentPrice +`</td>
                                                            <td>`+ newJson[i].markPrice +`</td>
                                                            <td>`+ newJson[i].paymentMode +`</td>
                                                        </tr>`;
                                                
                                            }
                                        `</tbody>
                                    </table>
                                `;
                                $('#report-results').html(table);
                            }
                            $('#tblReport').dataTable();
                        }else if(res.status==0){
                            $('#reportAlert').removeClass('hidden');
                        }
                        $('#preloader').fadeOut('slow');
                        $('#btnReport').removeClass('disabled');
                        $('#btnReport').delay(500).html('SEARCH REPORT');
                    }, 
                })       
        
                return false;
            });

        })(jQuery); 
        function markUp(id){document.getElementById('id').value=id; tjq('#MarkPrice').modal('show');}   
        function printInvoice(id){window.location.replace('print-invoice.php?id='+id)}
            
        
    </script>
    
</body>
</html>

