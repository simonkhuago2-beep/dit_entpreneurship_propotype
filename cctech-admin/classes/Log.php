<?php
/*
 author:kennedy uzoh
 date:19/10/2015
*/
class Log{
	
	public function create($action, $msg=""){
		if (file_exists('cctech-admin')) {
			$file_loc = 'cctech-admin/logs.txt';
		}else{$file_loc = '../cctech-admin/logs.txt';}
		$new_file = file_exists($file_loc) ? true : false ;
		if ($handle = fopen($file_loc, 'a')) {
			$time_of_action = strftime('%Y-%m-%d %H:%M:%S', time());
			$content = "{$time_of_action} | {$action}: {$msg}\n";
			fwrite($handle, $content);
			fclose($handle);
		}else{
			echo "Could not access file for writing!";
		}
	}

	public function reset($user, $redirect_loc){
		$file_loc = '../cctech-admin/logs.txt';
		file_put_contents($file_loc, '');
		$this->add_log('Clear logs', "{$user} cleared log content" );
		Redirect::to($redirect_loc);

	}
}
?>