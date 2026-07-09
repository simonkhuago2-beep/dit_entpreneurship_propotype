<?php
	ob_start();
	include "../cctech-admin/core/init.php"; 
	$country_name = Input::get('id');
	$sql = DB::getInstance()->query("SELECT DISTINCT city FROM excursion WHERE country = '{$country_name}' ORDER BY city ASC");
	 ?>
		<label class="text-uppercase white-text">City</label>
		<div class="select-style no-border no-margin-top margin-eight">
		<select class="" name="city">
			<option value="">Any</option>
			<?php foreach ($sql->results() as $key => $value) {			?>
				<option value="<?php echo $value->city; ?>" ><?php echo $value->city; ?></option>	
			<?php } ?>            	 	
		</select> 
		</div>

	