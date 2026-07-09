<?php
	ob_start();
	include 'cctech-admin/core/init.php';
	$id = $_GET['id'];
	unset($_SESSION['cart'][$id]);
	Session::flash('deleted', 'Item deleted successfully');
	Redirect::to('cart.php');

?>