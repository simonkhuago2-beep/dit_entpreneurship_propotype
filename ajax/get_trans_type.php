<?php
	ob_start();
	include '../cctech-admin/core/init.php';
	$id = Input::get('id');
	$sql = DB::getInstance()->query("SELECT DISTINCT type FROM transfers WHERE class = '$id' ");

?>
	<select class="form-control" id='type'>
		<option>Types</option>
		<?php 
			foreach ($sql->results() as $key => $value) { ?>
				<option value="<?php $value->type ?>"><?php echo $value->type?></option>
		<?php }	
		?>
	</select>	 
