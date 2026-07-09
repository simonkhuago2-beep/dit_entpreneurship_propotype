<?php
	ob_start();
	include '../cctech-admin/core/init.php';
	$id = Input::get('id');
	$sql = find_by_id('rooms',$id);

	$mat_arr[] = array(
	    "id" =>  $sql->id,
	    "name" => $sql->name,
	    "qty" => $sql->qty,
	    "vacant" => $sql->vacant,
	    "price" => $sql->price,
	    "adult" => $sql->adult,
	    "child" => $sql->child,
	    "brkfst" => $sql->brkfst,
	    "extra" => $sql->extra,
	    "rollaway" => $sql->rollaway,
	    "descp" => $sql->descp,
	    "imgOne" => $sql->imgOne,
	    "imgTwo" => $sql->imgTwo,
	    "facil" => $sql->facil,
	    "meal_plan" =>$sql->meal_plan
	);


	//echo '[' . $results . ']'; 
	//echo $results;
	echo json_encode($mat_arr);
?>