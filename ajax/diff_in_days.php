<?php
	ob_start();
	$bookIn = $_POST['in'];
	$bookOut = $_POST['out'];
	$in = new DateTime($bookIn); $out = new DateTime($bookOut);
	$days = $interval = date_diff($in, $out)->format('%a');
	echo $days;
?>