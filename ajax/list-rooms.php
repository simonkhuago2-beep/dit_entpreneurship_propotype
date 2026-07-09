<?php
	ob_start();
	include "../cctech-admin/core/init.php"; 
	$city_name = Input::get('id');
	$sql = DB::getInstance()->query("SELECT id FROM clients WHERE city = '{$city_name}' AND groups = 4  ORDER BY id ASC");

?>
		<label class="text-uppercase white-text">Room Type</label>
		<div class="select-style no-border no-margin-top margin-eight">
		<select class="" name="room-type" required="required">
			<option value="">Any</option>
			<?php foreach ($sql->results() as $key => $value) {	
				$room_name = DB::getInstance()->query("SELECT * FROM rooms WHERE hid = {$value->id} ORDER BY id ASC");
				foreach ($room_name->results() as $key => $r) { ?>
					<option value="<?php echo $r->name; ?>"><?php echo $r->name ?></option>	
			<?php		
				}
			?>
				
			<?php } ?>            	 	
		</select> 
		</div>

	