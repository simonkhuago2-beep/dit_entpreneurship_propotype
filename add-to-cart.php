<?php 
	include 'cctech-admin/core/init.php';
	$_SESSION['cart']= isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
	$service = Input::get('service');

	if($service=='hotel'){
		$cart_item = array(
			'service'=>$service,
			'serviceTitle'=>Input::get('title'),
			'serviceCountry'=>Input::get('ser_country'),
			'serviceId'=>Input::get('hotel-id'),
			'serviceImage'=>Input::get('image'),
			'roomId'=>Input::get('room-id'),
			'roomqty'=>Input::get('roomqty'),
			'checkin'=>Input::get('checkin'),
			'checkout'=>Input::get('checkout'),
			'duration'=>Input::get('duration'),
			'adult'=>Input::get('adult'),
			'kids'=>Input::get('kids'),
			'subtotal'=>Input::get('subtotal'),
			'fname'=>Input::get('fname'),
			'lname'=>Input::get('lname'),
			'email'=>Input::get('email'),
			'phone'=>Input::get('phone'),
			'sup_email'=>Input::get('sup_email'),
			'sup_name'=>Input::get('sup_name')

		);
	}elseif ($service=='transfer') {
		$cart_item = array(
			'service'=>$service,
			'serviceTitle'=>Input::get('title'),
			'serviceCountry'=>Input::get('ser_country'),
			'serviceId'=>Input::get('id'),
			'serviceImage'=>Input::get('image'),
			'duration'=>Input::get('duration'),
			'subtotal'=>Input::get('subtotal'),
			'fname'=>Input::get('fname'),
			'lname'=>Input::get('lname'),
			'email'=>Input::get('email'),
			'pick_loc'=>Input::get('pick_loc'),
			'pick_time'=>Input::get('pick_time'),
			'drop_loc'=>Input::get('drop_loc'),
			'drop_time'=>Input::get('drop_time'),
			'phone'=>Input::get('phone'),
			'sup_email'=>Input::get('sup_email'),
			'sup_name'=>Input::get('sup_name'),
			'adult'=>Input::get('adult'),
			'pick_date'=>Input::get('date_from'),
			'drop_date'=>input::get('date_to')
			
			);
	}elseif ($service=='cruise') {
		$cart_item = array(
			'service'=>$service,
			'serviceTitle'=>Input::get('title'),
			'serviceCountry'=>Input::get('ser_country'),
			'serviceId'=>Input::get('id'),
			'serviceImage'=>Input::get('image'),
			'subtotal'=>Input::get('subtotal'),
			'fname'=>Input::get('fname'),
			'lname'=>Input::get('lname'),
			'email'=>Input::get('email'),
			'phone'=>Input::get('phone'),
			'sup_email'=>Input::get('sup_email'),
			'sup_name'=>Input::get('sup_name'),
			'gender'=>Input::get('gender'),
			'date'=>Input::get('date'),
			'addr'=>Input::get('addr'),
			'duration'=>'',
			'adult'=>Input::get('adult'),
			'kids'=>Input::get('kids')
		);	
	}elseif ($service=='package') {
		$cart_item = array(
			'service'=>$service,
			'serviceTitle'=>Input::get('title'),
			'serviceCountry'=>Input::get('ser_country'),
			'serviceId'=>Input::get('id'),
			'serviceImage'=>Input::get('image'),
			'subtotal'=>Input::get('subtotal'),
			'fname'=>Input::get('fname'),
			'lname'=>Input::get('lname'),
			'email'=>Input::get('email'),
			'phone'=>Input::get('phone'),
			'sup_email'=>Input::get('sup_email'),
			'sup_name'=>Input::get('sup_name'),
			'gender'=>Input::get('gender'),
			'date'=>Input::get('date'),
			'addr'=>Input::get('addr'),
			'duration'=>'',
			'adult'=>Input::get('adult'),
			'kids'=>Input::get('kids')
		);	
	}elseif ($service=='events') {
		$cart_item = array(
			'service'=>$service,
			'serviceTitle'=>Input::get('title'),
			'serviceCountry'=>Input::get('ser_country'),
			'serviceId'=>Input::get('id'),
			'serviceImage'=>Input::get('image'),
			'subtotal'=>Input::get('subtotal'),
			'fname'=>Input::get('fname'),
			'lname'=>Input::get('lname'),
			'email'=>Input::get('email'),
			'phone'=>Input::get('phone'),
			'sup_email'=>Input::get('sup_email'),
			'sup_name'=>Input::get('sup_name'),
			'duration'=>'',
			'adult'=>Input::get('adult')
		);
	}

	
	array_push($_SESSION['cart'], $cart_item);
	Redirect::to('cart.php');
	

?>