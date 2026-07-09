 <?php
	include "../cctech-admin/core/init.php"; 
	$request = Input::get('request');
	if ($request=='register' && Input::get('type')=='hotel') {
		$hotel_name = htmlspecialchars(Input::get('h_name'));	$hotel_country = htmlspecialchars(Input::get('h_country'));
		$hotel_city = htmlspecialchars(Input::get('h_city'));   $hotel_addr = htmlspecialchars(Input::get('h_addr'));
		$hotel_email = filter_var(Input::get('h_email'),FILTER_SANITIZE_STRING);
		$hotel_tel = htmlspecialchars(Input::get('h_tel'));	$hotel_fname = htmlspecialchars(Input::get('h_fname'));
		$hotel_username = htmlspecialchars(Input::get('h_username'));	$email = filter_var(Input::get('email'),FILTER_SANITIZE_STRING);
		$plain = htmlspecialchars(Input::get('password'));	$repassword = htmlspecialchars(Input::get('repassword'));
		$salt = Hash::salt(32);	$password = Hash::make(Input::get('password'), $salt);
		$group = 4;		$est = Input::get('est');		$landmarks = htmlspecialchars(Input::get('landmarks'));
		$date = make_date();		$stars = Input::get('stars');
		$pos = htmlspecialchars(Input::get('position'));
		$zip = htmlspecialchars(Input::get('zip'));

		if ($plain != $repassword) {
			echo '<div class="alert alert-error">Error: Password mismatch, try entering the same password. <span class="close"></span></div>';
		}else{
			$isEmail_exists = DB::getInstance()->query("SELECT email FROM clients WHERE email = '{$email}' ");
			if ($isEmail_exists->count()) { ?>
			    <br><div class="alert alert-info fade in" role="alert">
					<i class="fa fa-thumbs-up alert-info"></i>
					<strong>Heads Up!</strong> Your email <strong>'<?php echo $email; ?>'</strong> already exists. 
					<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				</div>
			<?php }else{
				$login = array('fullname'=>$hotel_fname,'display_name'=>$hotel_username,'plain'=>$plain,'position'=>$pos);
				$arr = array('company_name'=>$hotel_name,'country'=>$hotel_country,'city'=>$hotel_city,'address'=>$hotel_addr,'email'=>$hotel_email,'telephone'=>$hotel_tel,'landmark'=>$landmarks,'stars'=>$stars,'established'=>$est,'zip'=>$zip,'descp'=>'','map'=>'','norms'=>'','notes'=>'');
				
				$create = DB::getInstance()->insert('clients',array('company_name'=>$hotel_name,'company_details'=>json_encode($arr),'country'=>$hotel_country,'city'=>$hotel_city,'created'=>$date,'groups'=>4,'email'=>$email,'password'=>$password,'salt'=>$salt,'user_details'=>json_encode($login)));
				
				if ($create) {
					$notifier = DB::getInstance()->insert("notify",array('type'=>'Registration','comment'=>'New Hotel Registered','tag'=>'hotel'));
			?>
					<div class="alert alert-success fade in" role="alert">
		                <i class="fa fa-thumbs-up alert-success"></i> <strong>Well done!</strong> You have successfully created an account.
		                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		            </div>
			<?php	}else{ ?>
					<div class="alert alert-danger fade in" role="alert">
		                <i class="fa fa-warning alert-danger"></i>  <strong>Oh snap!</strong> An unknown error occurred.
		                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		            </div>
			<?php	}
			}	
		}	
	}elseif(Input::get('type')=='agency'){
		$hotel_name =  htmlspecialchars(Input::get('a_name'));		$hotel_country = htmlspecialchars(Input::get('a_country'));
		$hotel_city = htmlspecialchars(Input::get('a_city'));		$hotel_addr = htmlspecialchars(Input::get('a_addr'));
		$hotel_email = filter_var(Input::get('a_email'),FILTER_SANITIZE_STRING);
		$hotel_tel = htmlspecialchars(Input::get('a_tel'));		$hotel_fname = htmlspecialchars(Input::get('a_fname'));
		$hotel_username = htmlspecialchars(Input::get('username'));		$email = htmlspecialchars(Input::get('email'));
		$skype = htmlspecialchars(Input::get('a_skype'));		$plain = htmlspecialchars(Input::get('password'));
		$repassword = htmlspecialchars(Input::get('repassword'));$zip = htmlspecialchars(Input::get('zip'));
		$salt = Hash::salt(32);	$password = Hash::make(Input::get('password'), $salt);
		$date = make_date();		$pos = Input::get('position');

		if ($plain != $repassword) {
			echo '<div class="alert alert-danger fade in" role="alert"><p class="text-danger"><strong> Warning!</strong> Password mismatch, Please enter the same passwords.</p><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button></div>';
		}else{
			$isEmail_exists = DB::getInstance()->query("SELECT email FROM clients WHERE email = '{$email}' ");
			if ($isEmail_exists->count()) { ?>
			    <div class='alert alert-info fade in' role='alert'>
					<p class="text-info"><strong>Heads Up!</strong> Your email <strong><?php echo $email; ?></strong> already exists. </p>
					<button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>
				</div>
			<?php }else{
				$login = array('fullname'=>$hotel_fname,'display_name'=>$hotel_username,'plain'=>$plain,'position'=>$pos);
				$arr = array('company_name'=>$hotel_name,'country'=>$hotel_country,'city'=>$hotel_city,'address'=>$hotel_addr,'email'=>$hotel_email,'telephone'=>$hotel_tel,'landmark'=>'','stars'=>'','established'=>'','zip'=>$zip,'skype'=>$skype,'descp'=>'','map'=>'','norms'=>'','notes'=>'');

				$create = DB::getInstance()->insert('clients',array('company_name'=>$hotel_name,'company_details'=>json_encode($arr),'country'=>$hotel_country,'city'=>$hotel_city,'created'=>$date,'groups'=>2,'email'=>$email,'password'=>$password,'salt'=>$salt,'user_details'=>json_encode($login)));

				if ($create) { 
						$notifier = DB::getInstance()->insert("notify",array('type'=>'Registration','comment'=>'New Agency Registered','tag'=>'agency'));
				?>
					<div class="alert alert-success fade in" role="alert">
		                <p class="text-success"><strong>Well done!</strong> You successfully created an account.</p>
		                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		            </div>
				<?php }else{ ?>
					<div class="alert alert-danger fade in" role="alert">
		                <p class="text-danger"><strong>Oh snap!</strong> Something went wrong, try submitting again.</p>
		                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		            </div>
	<?php
		        }
			}

		}

	}elseif(Input::get('type')=='agencyUpdate'){
		$hotel_name = Input::get('a_name');
		$hotel_country = Input::get('a_country');
		$hotel_city = Input::get('a_city');
		$hotel_addr = Input::get('a_addr');
		$hotel_email = Input::get('a_email');
		$hotel_tel = Input::get('a_tel');
		$hotel_fname = Input::get('a_fname');
		$hotel_username = Input::get('username');
		$email = Input::get('email');
		$skype = Input::get('a_skype');
		$plain = Input::get('password');
		$repassword = Input::get('repassword');
		$salt = Hash::salt(32);
		$password = Hash::make(Input::get('password'), $salt);
		$group = 2;
		$date = make_date();
		$pos = Input::get('position');
		$id = Input::get('agent-id');

		if ($plain != $repassword) {
			echo '<div class="alert alert-danger fade in " role="alert"><p  class="text-danger"><strong> Warning!</strong> Password mismatch, Please enter the same password.</p><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button></div>';
		}else{
			
				$create = DB::getInstance()->update('clients',$id,array('name'=>$hotel_name,'country'=>$hotel_country,'city'=>$hotel_city, 'addr'=>$hotel_addr, 'tel'=>$hotel_tel,
				'fullname'=>$hotel_fname,'contact_email'=>$hotel_email, 'username'=>$hotel_username,'email'=>$email,'plain'=>$plain,'password'=>$password,'salt'=>$salt, 
				'skype'=>$skype,'groups'=>$group, 'position'=>$pos, 'created'=>$date ));

			if ($create) { 
					//$notifier = DB::getInstance()->insert("notify",array('type'=>'Registration','comment'=>'New Agency Registered','tag'=>'agency'));
				?>
					<div class="alert alert-success fade in" role="alert">
		                <i class="fa fa-thumbs-up alert-success"></i>
		                <strong>Well done!</strong> You successfully updated your account.
		                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		            </div>
			<?php }else{ ?>
					<div class="alert alert-danger fade in" role="alert">
		                <i class="fa fa-warning alert-danger"></i>
		                <strong>Oh snap!</strong> Something went wrong, try submitting again.
		                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		            </div>
	<?php
		    }
		}

	}elseif (Input::get('type')=='sendReview') {
		$rating=array('service'=>Input::get('service-rating'),'value'=>Input::get('value-rating'),'sleeping'=>Input::get('sleeping-rating'),'cleanliness'=>Input::get('cleanliness-rating'),'location'=>Input::get('location-rating'),'room'=>Input::get('room-rating') );
		$when=Input::get('month').' '.Input::get('year');
		$post = DB::getInstance()->insert('reviews',array('bookId'=>Input::get('bookId'),'hotel'=>Input::get('hotelId'),'title'=>Input::get('title'),'comment'=>Input::get('comment'),'datee'=>$when,'rating'=>json_encode($rating),'created'=>make_date() ));
		if ($post) {
			?>
			<div class="alert alert-success fade in" role="alert">
                <strong>Done!</strong> Review sent successfully.
	            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
	        </div>
	    <?php
		}else{
			?>
			<div class="alert alert-danger fade in" role="alert">
                <strong>Error!</strong> Review was not sent.
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
            </div>
		<?php	
		}
	}elseif (Input::get('type')=='reports') {
		$type = Input::get('report-type');
		$start = Input::get('start');
		$end = Input::get('end');

		$sql = DB::getInstance()->query("SELECT * FROM booking WHERE (date(datee) >= '$start'  AND date(datee) <= '$end' ) ORDER BY id DESC ");
		if ($sql->count()>0) {
		    $output = array(); $data=""; $x=1; $num = $sql->count();

		    foreach ($sql->results() as $key => $value ){
		    	$jsonDetails = json_decode($value->trans_details);
		    	Global $sup, $supName, $duration, $price, $aPrice, $country, $noGuest; 

		    	if ($value->trans_type == 'hotels') {
		    		$sup = find_by_id('clients',$jsonDetails->hotelId); 
		    		$room = find_by_id('rooms',$jsonDetails->roomId); 
		    		$supName = $sup->company_name; 
		    		$country = $sup->country;
		    		$duration = $jsonDetails->days; 
		    		$price = $value->trans_cost; 
		    		$aPrice= $value->markup_price - $price;
		    		$noGuest = $jsonDetails->adult;
		    	}
		    	elseif ($value->trans_type == 'transfers') {
		    		$sup = find_by_id('transfers',$jsonDetails->id); 
		    		$supName = $sup->sup_name; 
		    		$duration ='NA'; 
		    		$price =$value->trans_cost; 
		    		$aPrice=$value->markup_price - $price;  
		    		$country = $sup->country;
		    		$noGuest = $sup->persons;
		    	}
		    	elseif ($value->trans_type == 'tours') {
		    		$sup = find_by_id('tours',$jsonDetails->id); 
		    		$supName = $sup->sup_name; 
		    		$duration = $sup->duration; 
		    		$price =$value->trans_cost; 
		    		$aPrice=$value->markup_price - $price; 
		    		$noGuest = 1; 
		    		$country = $sup->country;
		    	}
		    	elseif ($value->trans_type == 'events') {
		    		$sup = find_by_id('events',$jsonDetails->id); 
		    		$supName = $sup->sup_name; 
		    		$duration =1; 
		    		$price =$value->trans_cost; 
		    		$aPrice=$value->markup_price - $price; 
		    		$noGuest = 1;
		    		$country = $sup->loc;
		    	}
		    	elseif ($value->trans_type == 'excursions') {
		    		$sup = find_by_id('excursion',$jsonDetails->id); 
		    		$supName = $sup->sup_name; 
		    		$duration =1; 
		    		$price =$value->trans_cost; 
		    		$aPrice=$value->markup_price - $price;
		    		$noGuest = 1;
		    		$country = $sup->country;
		    	}
		    	
		    	$data .= '{';
                $data .= '"date":"'  . $value->datee . '",'; 
                $data .= '"bookId":"'  . $value->id . '",'; 
                $data .= '"supplier":"'  . $supName . '",'; 
                $data .= '"country":"' . $country . '",';
                $data .= '"service":"' . $value->trans_type . '",';
                $data .= '"guest":"'   .$jsonDetails->name . '",';
                $data .= '"noGuest":"'  . $noGuest . '",';
                //$data .= '"child":"'  . $jsonDetails->child . '",';
                $data .= '"duration":"'  . $duration . '",';
                $data .= '"actualPrice":"' . $price . '",';
                $data .= '"agentPrice":"'   .$aPrice . '",';
                $data .= '"markPrice":"'  . $value->markup_price . '",';
                $data .= '"paymentMode":"'  . $value->payment_mode . '",';
                $data .= '"confirm":"'  . $value->datee . '",';
                $data .= '"cancel":"NA"';
                $data .= '}'; 

                $data .= $x<$num ? ',' : ''; $x++;
		    	
		      	$output[] = $key; 
		    }
		    //echo json_encode($output);
		    $records = ' ['.$data . '] ';
		    echo '{"status":"1","Message":"Records found!","data":['.$data.']}';
		}else{
			echo '{"status":"0","Message":"No Records Found!"}';
		}
		 
	}elseif (Input::get('type')=='setMarkup') {
		$upadate = DB::getInstance()->update('booking',Input::get('id'),array('markup_price'=>Input::get('amt')));
		if ($upadate) {
			?>
			<div class="alert alert-success fade in" role="alert">
                <!-- <i class="fa fa-thumbs-up alert-success"></i> -->
	            <strong>Done!</strong> Price updated successfully.
	            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
	        </div>
	    <?php
		}else{
			?>
			<div class="alert alert-danger fade in" role="alert">
                            <!-- <i class="fa fa-warning alert-danger"></i> -->
                <strong>Error!</strong> Failed to update.
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
            </div>
		<?php	
		}
	}elseif (Input::get('type')=='sendSightseeingReview') {
		$rating=array('value'=>Input::get('value-rating'),'professionalism'=>Input::get('professionalism-rating'),'activities'=>Input::get('activities-rating'),'dinning'=>Input::get('dinning-rating'),'accommodation'=>Input::get('accommodation-rating'),'guiding'=>Input::get('guiding-rating'),'safety'=>Input::get('safety-rating'),'quality'=>Input::get('quality-rating') );
		$when=Input::get('month').' '.Input::get('year');
		$post = DB::getInstance()->insert('sightseeing_reviews',array('bookId'=>Input::get('bookId'),'package_id'=>Input::get('package_id'),'title'=>Input::get('title'),'comment'=>Input::get('comment'),'datee'=>$when,'rating'=>json_encode($rating),'created'=>make_date() ));
		if ($post) {
			?>
			<div class="alert alert-success fade in" role="alert">
                <strong>Done!</strong> Review sent successfully.
	            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
	        </div>
	    <?php
		}else{
			?>
			<div class="alert alert-danger fade in" role="alert">
                <strong>Error!</strong> Review was not sent.
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
            </div>
		<?php	
		}
	}elseif (Input::get('type')=='sendPackageReview') {
		$rating=array('value'=>Input::get('value-rating'),'professionalism'=>Input::get('professionalism-rating'),'activities'=>Input::get('activities-rating'),'dinning'=>Input::get('dinning-rating'),'accommodation'=>Input::get('accommodation-rating'),'guiding'=>Input::get('guiding-rating'),'safety'=>Input::get('safety-rating'),'quality'=>Input::get('quality-rating') );
		$when=Input::get('month').' '.Input::get('year');
		$post = DB::getInstance()->insert('packages_reviews',array('bookId'=>Input::get('bookId'),'package_id'=>Input::get('package_id'),'title'=>Input::get('title'),'comment'=>Input::get('comment'),'datee'=>$when,'rating'=>json_encode($rating),'created'=>make_date() ));
		if ($post) {
			?>
			<div class="alert alert-success fade in" role="alert">
                <strong>Done!</strong> Review sent successfully.
	            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
	        </div>
	    <?php
		}else{
			?>
			<div class="alert alert-danger fade in" role="alert">
                <strong>Error!</strong> Review was not sent.
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
            </div>
		<?php	
		}
	}

	
?>