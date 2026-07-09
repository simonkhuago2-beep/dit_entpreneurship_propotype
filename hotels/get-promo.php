<?php
	ob_start();
	include '../cctech-admin/core/init.php';
	$id = Input::get('id');
	$sql = find_by_id('promo',$id);
	$roomName = find_by_id('rooms',$sql->room);

	$mat_arr[] = array(
	    "id" =>  $sql->id,
	    "title" => $sql->title,
	    "roomType" => $sql->room,
	    "rate" => $sql->rate,
	    "detail" => $sql->details,
	);

	//echo '[' . $results . ']'; 
	//echo $results;
	echo json_encode($mat_arr);
?>