<?php
	ob_start();
	include "../cctech-admin/core/init.php"; 
	$for=Input::get('for');
	if ($for=='hotels') {
		$country_name = Input::get('id');
		$sql = DB::getInstance()->query("SELECT DISTINCT city FROM clients WHERE country = '{$country_name}' AND groups = 4 ORDER BY city ASC");
		 ?>
			<label class="text-uppercase white-text">City</label>
			<div class="select-style no-border no-margin-top margin-eight">
			<select class="" name="city" onchange="listRooms(this.value)"  required="required">
				<option value="">Any</option>
				<?php foreach ($sql->results() as $key => $value) {			?>
					<option value="<?php echo $value->city; ?>"><?php echo $value->city; ?></option>	
				<?php } ?>            	 	
			</select> 
			</div>
	<?php 
		}elseif ($for=='transfer') {
			$country_name = Input::get('country');
			$sql = DB::getInstance()->query("SELECT DISTINCT city FROM transfers WHERE country = '{$country_name}' ORDER BY city ASC");
			$list = array();
			foreach ($sql->results() as $key => $value) {$list[] = $value->city;}	
			echo $result =  json_encode($list);
		}	

	?>

	