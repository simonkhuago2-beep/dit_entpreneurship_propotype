<?php
	ob_start();
	include '../core/init.php';
	if (Input::get('notifier') == 'others') {
		$allNewNotification = DB::getInstance()->query("SELECT * FROM notify WHERE status = 0 AND tag !='chat' ")->count();

		$newHotel = DB::getInstance()->query("SELECT * FROM notify WHERE status = 0 AND tag='hotel' ")->count();

		$newAgency = DB::getInstance()->query("SELECT * FROM notify WHERE status = 0 AND tag='agency' ")->count();

        $newTransfer = DB::getInstance()->query("SELECT * FROM notify WHERE status = 0 AND tag='transfers' AND type = 'Booking' ")->count();
        $newEvent = DB::getInstance()->query("SELECT * FROM notify WHERE status = 0 AND tag='events' AND type = 'Booking' ")->count();
        $newTour = DB::getInstance()->query("SELECT * FROM notify WHERE status = 0 AND tag='tours' AND type = 'Booking' ")->count();
        $newExcursion = DB::getInstance()->query("SELECT * FROM notify WHERE status = 0 AND tag='excursions' AND type = 'Booking' ")->count();
        $newCheckin = DB::getInstance()->query("SELECT * FROM notify WHERE status = 0 AND tag='hotels' AND type = 'Booking' ")->count();

		//header('Content-Type: application/json');
		//echo '[{"all":"'.$allNewNotification.'","hotel":"'.$newHotel.'","agency":"'.$newAgency.'"}]';
?>
		<a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-bell-o"></i>
            <?php if($allNewNotification>0){ ?>                    
            <span class="badge bg-red" id="othersTotal"><?php echo $allNewNotification; ?></span>
            <?php }else{echo '';} ?>
        </a>
        <ul id="menu2" class="dropdown-menu list-unstyled msg_list" role="menu">
           	<?php if($newHotel>0){ ?> 
            <li><a href="manage-hotels.php"><b class="fa fa-building text-primary"></b> &nbsp; <?php echo $newHotel; ?> New Hotels</a></li>
            <?php }else{echo '';} ?> 
                        
            <?php if($newAgency>0){ ?> 
            <li><a href="agency.php"><b class="fa fa-users text-success"></b> &nbsp;<?php echo $newAgency; ?> New Agency</a></li>
            <?php }else{echo '';} ?>   

            <?php if($newTransfer>0){ ?>                         
            <li><a href="transfer-booking.php"><b class="fa fa-shopping-cart"></b> &nbsp;<?php echo $newTransfer; ?> New Transfer Booking </a></li>
            <?php }else{echo '';} ?> 

            <?php if($newEvent>0){ ?>                         
            <li><a href="events-booking.php"><b class="fa fa-shopping-cart"></b> &nbsp;<?php echo $newEvent; ?> New Event Booking </a></li>
            <?php }else{echo '';} ?> 

            <?php if($newTour>0){ ?>                         
            <li><a href="tours-booking.php"><b class="fa fa-shopping-cart"></b> &nbsp;<?php echo $newTour; ?> New Tour Booking </a></li>
            <?php }else{echo '';} ?> 

            <?php if($newExcursion>0){ ?>                         
            <li><a href="excursion-booking.php"><b class="fa fa-shopping-cart"></b> &nbsp;<?php echo $newExcursion; ?> New Excursion Booking </a></li>
            <?php }else{echo '';} ?> 

            <?php if($newCheckin>0){ ?>                         
            <li><a href="hotels-booking.php"><b class="fa fa-shopping-cart"></b> &nbsp;<?php echo $newCheckin; ?> New Hotel Booking </a></li>
            <?php }else{echo '';} ?> 


            <!-- <li>
            	<div class="text-center"><a><strong>Clear All </strong><i class="fa fa-close"></i></a></div>
            </li> -->
                                         
        </ul>
<?php                  
	}elseif(Input::get('notifier') == 'chats'){
		$allNewChat = DB::getInstance()->query("SELECT * FROM chat WHERE status = 0 AND user_rec = 1 ");
?>
		<a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-comments-o"></i>
            <?php if($allNewChat->count()>0){ ?>
            <span class="badge bg-green"><?php echo $allNewChat->count(); ?></span>
            <?php } ?>
        </a>
        <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
        	<?php foreach ($allNewChat->results() as $key => $value): 
        		$sender = find_by_id('clients',$value->user_send);
                $senderJson = json_decode($sender->user_details);
        	?>
            <li>
                <a href="view-hotel.php?id=<?php echo $value->user_send ?>">
                   	<span class="image"><img src="images/user.png" alt="Profile Image" /></span>
                    <span>
                        <span><?php echo $senderJson->display_name; ?></span>
                        <span class="time"><?php echo chat_date($value->tym); ?></span>
                    </span>
                    <span class="message">
                        <?php echo substr($value->msg, 0, 20);?>...
                    </span>
                </a>
            </li>
       	 	<?php endforeach; ?>
       	 	<!-- <li>
            	<div class="text-center"><a><strong>Clear All </strong> <i class="fa fa-close"></i></a> </div>               
            </li> -->
        </ul>
<?php	
	}elseif (Input::get('notifier') == 'removeChat') {
        $id = Input::get('id');
        DB::getInstance()->query("UPDATE chat SET status = 1 WHERE user_send = $id ");
    }


?>