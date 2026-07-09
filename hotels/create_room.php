<?php 
	include("../cctech-admin/core/init.php");
	$data = json_decode(file_get_contents("php://input")); 
	var_dump($data);

/*$name = $data->name ;
$qty = $data->qty ;
$adult = $data->adult ;
$child = $data->child ;
$rate = $data->rate ;
$facil = $data->facil ;
$descp = $data->descp ;
$imgOne = $data->imgOne ;
$imgTwo = $data->imgTwo ;
$id = $data->id ;
$rollaway = $data->rollaway ;
$brkfst = $data->brkfst ;
$extra = $data->extra ;*/

?>
<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                    Success alert preview. This alert is dismissable.
                  </div>