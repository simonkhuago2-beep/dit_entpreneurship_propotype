<?php
include '../cctech-admin/core/init.php';
$target_dir = "libs/img/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$fileName = $_FILES['file']['name'];
$path = $target_dir.$fileName;
$id = Input::get('hotel_id');


if (move_uploaded_file($_FILES["file"]["tmp_name"], $path)) {
	$sql = DB::getInstance()->update('clients',$id,array('map_image'=>$path));
	$status = 1;
}

?>