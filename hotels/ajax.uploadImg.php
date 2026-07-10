<?php
	ob_start();
	include "../cctech-admin/core/init.php";
	//header('Content-Type: application/json');
	$dir = 'libs/profiles/';
	$id = Input::get('id');
	$new = $_FILES["pics"]["name"];
	//$old = Input::get('oldPics');
	$field = Input::get('field');

	if (!empty(is_uploaded_file($_FILES['pics']['tmp_name']))) {$imgPath = 'libs/profiles/'.$new;}/*else{$imgPath = $old;}*/

	echo $id.'  '.$new.' '.$field.' '.$imgPath;
	DB::getInstance()->update("clients", $id, array($field=> $imgPath));
	move_uploaded_file( $_FILES['pics']['tmp_name'], $imgPath);

?>