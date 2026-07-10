<?php
	ob_start();
	include '../core/init.php';
	$id = Input::get('edit-id');
	$newPrice = Input::get('new-price');
	$sql = DB::getInstance()->Update('rooms',$id,array('agent_price'=>$newPrice) );
	if ($sql) {
		echo '#cef1ce';
	}else{
		echo '#f1d0ce';
	}