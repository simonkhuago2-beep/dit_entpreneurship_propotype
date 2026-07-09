<?php
session_start();
$GLOBALS['config'] = array(
   'mysql' => array('host' => 'localhost', 'username' => 'root', 'password' => '', 'db' => 'travbblp_admin',),
   //''mysql' => array('host'=>'localhost','username'=>'travelaf_user','password'=>'CRr-[V-)SKaQ','db'=>'travelaf_main'),
   'remember' => array('cookie_name' => 'hash', 'cookie_expiry' => '604800'),
   'session' => array('session_name' => 'user', 'token_name' => 'token'),
   'slydepay' => array(
      'namespace' => 'http://www.i-walletlive.com/payLIVE',
      'wsdl' => 'https://app.slydepay.com.gh/webservices/paymentservice.asmx?wsdl',
      'version' => '1.4',
      'merchantEmail' => 'glodestinations@hotmail.com',
      'merchantKey' => '1476009739965',
      'serviceType' => 'C2B',
      'integrationmode' => true,
      'paylive' => 'https://app.slydepay.com.gh/paylive/detailsnew.aspx?pay_token='
   ),
   'myghpay' => array('clientId' => 'f6cf8dc7-b5fb-4da4-b76b-28bfbedbdc61', 'clientSecret' => '1007f84c-d261-416d-b10c-710e67e80f58', 'baseUrl' => 'https://196.216.228.23/myghpayclient/')
);

spl_autoload_register(function ($class) {
   if (file_exists('classes/' . $class . '.php')) {
      require_once 'classes/' . $class . '.php';
      require_once 'functions/sanitize.php';
      require_once 'functions/Sql.php';
   } elseif (file_exists('cctech-admin/classes/' . $class . '.php')) {
      require_once 'cctech-admin/classes/' . $class . '.php';
      require_once 'cctech-admin/functions/sanitize.php';
      require_once 'cctech-admin/functions/Sql.php';
   } elseif (file_exists('../cctech-admin/classes/' . $class . '.php')) {
      require_once '../cctech-admin/classes/' . $class . '.php';
      require_once '../cctech-admin/functions/sanitize.php';
      require_once '../cctech-admin/functions/Sql.php';
   } elseif (file_exists('../classes/' . $class . '.php')) {
      require_once '../classes/' . $class . '.php';
      require_once '../functions/sanitize.php';
      require_once '../functions/Sql.php';
   }
});

if (Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))) {
   $hash = Cookie::get(Config::get('remember/cookie_name'));
   $hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));

   if ($hashCheck->count()) {
      $user = new User($hashCheck->first()->user_id);
      $user->login();
   }
}
