<?php 
	ob_start();
	include 'cctech-admin/core/init.php';
	Session::delete('cart');
	header('Location: cart.php');
?>