<?php
ob_start();
include "cctech-admin/core/init.php"; 
$user = new Client();
$user->logout();
Redirect::to('index.php');
?>