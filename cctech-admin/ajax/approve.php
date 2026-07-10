<?php
	ob_start();
	include '../core/init.php';
	$id = Input::get('edit-id');
	$sql = DB::getInstance()->Update('clients',$id,array('verified'=>1) );
	if ($sql) {
		echo '#cef1ce';
	}else{
		echo '#f1d0ce';
	}