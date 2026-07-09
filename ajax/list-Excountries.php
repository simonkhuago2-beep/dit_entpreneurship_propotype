<?php
	ob_start();
	include "../cctech-admin/core/init.php"; 
	$types = Input::get('id');
	$sql = DB::getInstance()->query("SELECT DISTINCT country FROM excursion WHERE type = '{$types}' ORDER BY country ASC");
	/*if (empty($types)) {
		$sql = DB::getInstance()->query("SELECT DISTINCT country FROM excursion ORDER BY country ASC");
	}else{
		$sql = DB::getInstance()->query("SELECT DISTINCT country FROM excursion WHERE type = '{$types}' ORDER BY country ASC");
	}*/
	
	 ?>
		<label class="text-uppercase white-text">Country</label>
		<div class="select-style no-border no-margin-top margin-eight">
		<select class="" name="country" onchange="listExCities(this.value)">
			<option value="">Any</option>
			<?php foreach ($sql->results() as $key => $value) {			?>
				<option value="<?php echo $value->country; ?>" ><?php echo $value->country; ?></option>	
			<?php } ?>            	 	
		</select> 
		</div>

	