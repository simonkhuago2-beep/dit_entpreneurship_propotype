<?php
/*--------------------------------------------------------------*/
/* Function for Readable date time
/*--------------------------------------------------------------*/
function read_date($str){
    if($str)
      return date('F j, Y, g:i:s a', strtotime($str));
    else
      return null;
}
/*----------chat line date----------------*/
function chat_date($str){
    if($str)
      return date('j F,  g:i a', strtotime($str));
    else
      return null;
}
/*--------------------------------------------------------------*/
/* Function for  Readable Make date time
/*--------------------------------------------------------------*/
function make_date(){
  return strftime("%Y-%m-%d %H:%M:%S", time());
}
function review_date(){
  $today =  strftime("%Y-%m-%d %H:%M:%S", time());
  return date('F d Y', strtotime($today));
}
function date_only(){
  $today =  strftime("%Y-%m-%d %H:%M:%S", time());
  return date('d F Y', strtotime($today));
}
/*----- make sql date format---*/
function make_db_date($str){
  if($str)
    return date('Y-m-j ', strtotime($str));
  else
    return null;
}
function get_date($str){
  if($str)
    return date('d F, Y ', strtotime($str));
  else
    return null;
}
function get_date_two($str){
  if($str)
    return date('M d, Y ', strtotime($str));
  else
    return null;
}
function get_month($str){
  if ($str) {
    $mnth = date('F', strtotime($str));
    return substr($mnth, 0, 3);
  }else{return null;}
}  
function get_day($str){
  if ($str) {
    return date('j', strtotime($str));
  }else{return null;}
}
function get_mnth_yr($str){
  if ($str) {
    return date('F Y', strtotime($str));
  }else{return null;}
}
function memb_since($str){
  if ($str) {
    return date('M Y', strtotime($str));
  }else{return null;}
}
/*--------------------------------------------------------------*/
/* Function for  Readable date time
/*--------------------------------------------------------------*/
function count_id(){
  static $count = 1;
  return $count++;
}
/*--------------------------
  generate random unique string
 ------------------------------*/ 
function GUID(){
  if (function_exists('com_create_guid') === true) {
    return trim(com_create_guid(), '{}');
  }
  return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}


/*----------------------------------------------------------------------------------------------------------
                              common sql quries
---------------------------------------------------------------------------------------------------------------*/

/*-----------------------Determine if database table exists--------------------------------------------*/

/*--------  run a select all query -----*/
function select_all($table,$id='id',$order='ASC'){
  $sql=DB::getInstance()->query("SELECT * FROM $table ORDER BY $id $order ");
  
    return $sql;
  
} 
/*-------   find by id -------------*/
function find_by_id($table,$id){
  $sql=DB::getInstance()->query("SELECT * FROM $table WHERE id = $id LIMIT 1");
  if ($sql->count()) {
    $results = array();
    foreach ($sql->results() as $key => $value ){
      $results[] = $value; 
    }
    return $value;
  }
} 
function find_by($table,$field,$id){
  $sql=DB::getInstance()->query("SELECT * FROM $table WHERE $field = $id LIMIT 1");
  if ($sql->count()) {
    $results = array();
    foreach ($sql->results() as $key => $value ){
      $results[] = $value; 
    }
    return $value;
  }
}
/*-------   find by email -------------*/
function find_by_email($table,$email){
  $sql=DB::getInstance()->query("SELECT * FROM $table WHERE email = '$email' LIMIT 1");
  if ($sql->count()) {
    $results = array();
    foreach ($sql->results() as $key => $value ){
      $results[] = $value; 
    }
    return $value;
  }
}
/*-------   find by customer id -------------*/
function find_by_custId($table,$id){
  $sql=DB::getInstance()->query("SELECT * FROM $table WHERE cust_id = $id LIMIT 1");
  if ($sql->count()) {
    $results = array();
    foreach ($sql->results() as $key => $value ){
      $results[] = $value; 
    }
    return $value;
  }
} 
/*-------   find promo by room id -------------*/
function find_promo($id){
  $sql=DB::getInstance()->query("SELECT * FROM promo WHERE room = $id LIMIT 1");
  if ($sql->count()) {
    $results = array();
    foreach ($sql->results() as $key => $value ){
      $results[] = $value; 
    }
    return $value;
  }
}
/*-------   find booking by transaction id -------------*/
function find_by_transactionId($id){
  $sql=DB::getInstance()->query("SELECT * FROM booking WHERE trans_id = '$id' LIMIT 1");
  if ($sql->count()) {
    $results = array();
    foreach ($sql->results() as $key => $value ){
      $results[] = $value; 
    }
    return $value;
  }
}
/*---------------- find by username----------*/
function find_by_username($table,$username){
  $sql=DB::getInstance()->query("SELECT * FROM $table WHERE username = $username LIMIT 1");
  if ($sql->count()) {
    $results = array();
    foreach ($sql->results() as $key => $value ){
      $results[] = $value; 
    }
    return $value;
  }
} 
/*---------------------------Function to count total rows in a tbl-----------------------------------*/
function count_rows($table){
    $sql = DB::getInstance()->query("SELECT COUNT(id) AS total FROM $table ");
    if ($sql->count()) {
     $results = array();
    foreach ($sql->results() as $key => $value ){
      $results[] = $value; 
    }
    return $value->total;
    }else{return 0;}
  
}
/*-------------------------find all countries from hotel table-------------------------------------------------------------*/
function list_countries(){
  $sql=DB::getInstance()->query("SELECT DISTINCT country FROM clients WHERE groups = 4 AND verified = 1 ORDER BY country");
   if ($sql->count()) {
    return $sql;
   }
}
/*-------------------------- total revenue-------------------*/
function total_revenue(){
  $sql = DB::getInstance()->query("SELECT SUM(trans_cost) AS total FROM booking WHERE payment_status = 1");
  if ($sql->count()) {
     $results = array();
    foreach ($sql->results() as $key => $value ){
      $results[] = $value; 
    }
    return number_format($value->total);
  } else{return 0;}
}
/*-------------average room price-----------*/
function avag_roomPrice($hotel){
  $sql = DB::getInstance()->query("SELECT price FROM rooms WHERE hid = $hotel  LIMIT 1");
  if ($sql->count()) {
     $results = array();
    foreach ($sql->results() as $key => $value ){
      $results[] = $value; 
    }
    return $value->price;
  } else{return 0;}
}
/*-----------lowest room price-----------------*/
function lowest_roomPrice($hotel){
  $sql = DB::getInstance()->query("SELECT price FROM rooms WHERE hid = $hotel ORDER BY price ASC LIMIT 1");
  if ($sql->count()) {
     $results = array();
    foreach ($sql->results() as $key => $value ){
      $results[] = $value; 
    }
    return $value->price;
  } else{return 0;}
}
/*------- count number of reviews -------*/
function num_reviews($hotel){
  $sql = DB::getInstance()->query("SELECT * FROM reviews WHERE hotel = $hotel");
  if ($sql->count()) {
    return $sql->count();
  } else{return 0;}
}
function num_reviews_02($table,$id){
  $sql = DB::getInstance()->query("SELECT * FROM $table WHERE package_id = $id");
  if ($sql->count()) {
    return $sql->count();
  } else{return 0;}
}
/*--------- calculating reviews--------*/
function cal_ratings($id){
  $sql = DB::getInstance()->query("SELECT * FROM reviews WHERE hotel = $id");
  if ($sql->count()) {
    $numberOfReviews = $sql->count();
    $service=0; $room=0; $location=0; $cleaniness=0; $values=0; $sleep=0;
    foreach ($sql->results() as $key => $value) {
      $ratingJson = json_decode($value->rating);
      $service = ceil($ratingJson->service / $numberOfReviews);
      $room = ceil($ratingJson->room / $numberOfReviews);
      $location = ceil($ratingJson->location / $numberOfReviews);
      $cleaniness = ceil($ratingJson->cleanliness / $numberOfReviews);
      $values = ceil($ratingJson->value / $numberOfReviews);
      $sleep = ceil($ratingJson->sleeping / $numberOfReviews);

      $total = (($service+$room+$location+$cleaniness+$values+$sleep)/6)/$numberOfReviews;

    }
    return array('service'=>$service,'room'=>$room,'location'=>$location,'cleanliness'=>$cleaniness,'values'=>$values,'sleep'=>$sleep,'total'=>ceil($total));
  }else{
    return 0;
  }
}
/*--------- calculating package reviews--------*/
function cal_package_ratings($table,$id){
  $sql = DB::getInstance()->query("SELECT * FROM $table WHERE package_id = $id");
  if ($sql->count()) {
    $numberOfReviews = $sql->count();
    $value_money=0; $activities=0; $accommodation=0; $safety=0; $proff=0; $dinning=0;$tour_guide=0; $quality=0;
    foreach ($sql->results() as $key => $value) {
      $ratingJson = json_decode($value->rating);
      $value_money = ceil($ratingJson->value / $numberOfReviews);
      $activities = ceil($ratingJson->activities / $numberOfReviews);
      $accommodation = ceil($ratingJson->accommodation / $numberOfReviews);
      $safety = ceil($ratingJson->safety / $numberOfReviews);
      $proff = ceil($ratingJson->professionalism / $numberOfReviews);
      $dinning = ceil($ratingJson->dinning / $numberOfReviews);
      $tour_guide = ceil($ratingJson->guiding / $numberOfReviews);
      $quality = ceil($ratingJson->quality / $numberOfReviews);

      $total = (($value_money+$activities+$accommodation+$safety+$proff+$dinning+$tour_guide+$quality)/8)/$numberOfReviews;

    }
    return array('value'=>$value_money,'activities'=>$activities,'accommodation'=>$accommodation,'safety'=>$safety,'professionalism'=>$proff,'dinning'=>$dinning,'guide'=>$tour_guide,'quality'=>$quality,'total'=>ceil($total));
  }else{
    return 0;
  }
}
/*-------cal single review---------*/
function single_rating($id){
  $sql = DB::getInstance()->query("SELECT * FROM reviews WHERE id = $id");
  if ($sql->count()) {
    $numberOfReviews = $sql->count();
    $service=0; $room=0; $location=0; $cleaniness=0; $values=0; $sleep=0;
    foreach ($sql->results() as $key => $value) {
      $ratingJson = json_decode($value->rating);
      $service = ceil($ratingJson->service );
      $room = ceil($ratingJson->room );
      $location = ceil($ratingJson->location );
      $cleaniness = ceil($ratingJson->cleanliness );
      $values = ceil($ratingJson->value );
      $sleep = ceil($ratingJson->sleeping );

      $total = (($service+$room+$location+$cleaniness+$values+$sleep)/6);

    }
    return array('service'=>$service,'room'=>$room,'location'=>$location,'cleanliness'=>$cleaniness,'values'=>$values,'sleep'=>$sleep,
      'total'=>ceil($total));
  }else{
    return 0;
  }
}
function single_rating_02($table,$id){
  $sql = DB::getInstance()->query("SELECT * FROM $table WHERE id = $id");
  if ($sql->count()) {
    $numberOfReviews = $sql->count();
    $value_money=0; $activities=0; $accommodation=0; $safety=0; $proff=0; $dinning=0;$tour_guide=0; $quality=0;
    foreach ($sql->results() as $key => $value) {
      $ratingJson = json_decode($value->rating);
      $value_money = ceil($ratingJson->value );
      $activities = ceil($ratingJson->activities );
      $accommodation = ceil($ratingJson->accommodation );
      $safety = ceil($ratingJson->safety );
      $proff = ceil($ratingJson->professionalism );
      $dinning = ceil($ratingJson->dinning );
      $tour_guide = ceil($ratingJson->guiding );
      $quality = ceil($ratingJson->quality );

      $total = (($value_money+$activities+$accommodation+$safety+$proff+$dinning+$tour_guide+$quality)/8);

    }
    return array('value'=>$value_money,'activities'=>$activities,'accommodation'=>$accommodation,'safety'=>$safety,'professionalism'=>$proff,'dinning'=>$dinning,'guide'=>$tour_guide,'quality'=>$quality,
      'total'=>ceil($total));
  }else{
    return 0;
  }
}
/*------------ rating number expression---------*/
function rating_expression($num){
  $string = 'POOR';
  switch ($num) {
    case '1': $string = 'POOR';  break;
    case '2': $string = 'POOR';  break;
    case '3': $string = 'GOOD';  break;
    case '4': $string = 'VERY GOOD';  break;
    case '5': $string = 'EXECLLENT';  break;
    default:  $string = 'POOR'; break;  
  }
  return $string;
}
/*--------- get time elasped ------------*/
function time_elapsed_string($datetime, $full = false) {
  $now = new DateTime;  $ago = new DateTime($datetime);
  $diff = $now->diff($ago); $diff->w = floor($diff->d / 7);  $diff->d -= $diff->w * 7;

  $string = array('y' => 'year','m' => 'month','w' => 'week','d' => 'day','h' => 'hour','i' => 'minute','s' => 'second', );
  foreach ($string as $k => &$v) { if ($diff->$k) { $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : ''); } else { unset($string[$k]); }   }

  if (!$full) $string = array_slice($string, 0, 1);
  return $string ? implode(', ', $string) . ' ago' : 'just now';
}
/*-----------currency converter----------*/
function currencyConverter($currency_from,$currency_to,$currency_input){
  $yql_base_url = "https://query.yahooapis.com/v1/public/yql";
  $yql_query = 'select * from yahoo.finance.xchange where pair in ("'.$currency_from.$currency_to.'")';
  $yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query);
  $yql_query_url .= "&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";
  $yql_session = file_get_contents($yql_query_url);
  $yql_json =  json_decode($yql_session,true);
  $currency_output = (float) $currency_input*$yql_json['query']['results']['rate']['Rate'];
  return $currency_output;
}

function exchange_rate($from_Currency,$to_Currency,$amount) {
  $from_Currency = urlencode($from_Currency);
  $to_Currency = urlencode($to_Currency);
  $get = file_get_contents("https://finance.google.com/finance/converter?a=1&from=$from_Currency&to=$to_Currency");
  $get = explode("<span class=bld>",$get);
  $get = explode("</span>",$get[1]);
  $converted_currency = preg_replace("/[^0-9\.]/", null, $get[0]);
  return $converted_currency;
}

// function currencyConverter02($amount,$from, $to){
//     $url = file_get_contents('https://free.currencyconverterapi.com/api/v5/convert?q=' . $from . '_' . $to . '&compact=ultra');
//     $json = json_decode($url, true);
//         $rate = implode(" ",$json);
//         $total = $rate * $amount;
//         $rounded = round($total); //optional, rounds to a whole number
//         return $total; //or return $rounded if you kept the rounding bit from above
// }

function currencyConverter02($amount,$from_currency,$to_currency){
  $apikey = 'c7294f4fd09a54783481';

  $from_Currency = urlencode($from_currency);
  $to_Currency = urlencode($to_currency);
  $query =  "{$from_Currency}_{$to_Currency}";

  // change to the free URL if you're using the free version
  $json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}");
  $obj = json_decode($json, true);

  $val = floatval($obj["$query"]);


  $total = $val * $amount;
  return number_format($total, 2, '.', '');
}



















/*-------------- select all posts with left join ----------*/
function list_posts(){
  $sql =  "SELECT *, p.id AS p_id, p.date AS p_date, c.id AS c_id, c.name FROM tbl_posts p LEFT JOIN tbl_category c ON p.cat_id = c.id ORDER BY p.date DESC ";
  $exec = DB::getInstance()->query($sql);
  if ($exec->count()) {
    return $exec;
  }
}
/*-------------------- find post by id -----------*/
function posts_by_id($id){
  $sql =  "SELECT *, p.id AS p_id, p.date AS p_date, c.id AS c_id, c.name FROM tbl_posts p LEFT JOIN tbl_category c ON p.cat_id = c.id WHERE p.id = $id ORDER BY p.date DESC ";
  $exec = DB::getInstance()->query($sql);
  if ($exec->count()) {
    $results = array();
    foreach ($exec->results() as $key => $value ){
      $results[] = $value; 
    }
    return $value;
  }
}

/*----------------------------------------list top 6 posts for slider-------------------------------------------*/  
function six_posts(){
  $sql = "SELECT * FROM tbl_posts WHERE status = 1 ORDER BY date DESC LIMIT 6";
  $exec=DB::getInstance()->query($sql);
  if ($exec->count()) {return $exec;}
}

/*-------------------list 4 featured posts ------------------------------------*/  
function four_posts(){
  $sql = "SELECT * FROM tbl_posts WHERE status = 1 ORDER BY date DESC LIMIT 4 OFFSET 6";
  $exec=DB::getInstance()->query($sql);
  if ($exec->count()) {return $exec;}
} 

/*--------------------- list comments by id ----------------*/
function comment_by_id($id){
  $sql = " SELECT * FROM tbl_comment WHERE post_id = $id ORDER BY date DESC LIMIT 10 ";
  $exec = DB::getInstance()->query($sql);
  return $exec;
  /*if ($exec->count()) {
    
  }else {return null;}*/
}
/*--------------- list replies by comment id ---------------------*/
function replies_to_comments($id){
  $sql = "SELECT * FROM tbl_reply WHERE comment_id = $id ORDER BY date DESC LIMIT 3";
  $exec = DB::getInstance()->query($sql);
  if ($exec->count()) {
    return $exec;
  }
}





/*-------------------------
  update view count 
------------------------------*/
function update_views($table,$id){
  $sql=DB::getInstance()->query("UPDATE $table SET views = views + 1 WHERE id=$id LIMIT 1");
}

/*---------------------------
  add new view for hotel
----------------------------------------------*/
function add_views($id){
  $date = make_date();
  $sql=DB::getInstance()->insert("tbl_hotels_views",array('hid'=>$id,'date'=>$date));
  
}
/*-----------------------------
 find last user id
---------------------------------------*/
function last_user_id(){
   $sql=DB::getInstance()->query("SELECT * FROM users ORDER BY id DESC LIMIT 1");
   if ($sql->count()) {$results = array();foreach ($sql->results() as $key => $value ){$results[] = $value;}return $value->id;}
}
/*------------------------------
  count total hotel views
--------------------------------------*/
function count_views($id){
  $date = strftime("%Y-%m-%d");
  $sql=DB::getInstance()->query("SELECT COUNT(id) AS views FROM tbl_hotels_views WHERE hid=$id AND date = '{$date}' ");
   if ($sql->count()) {
     $results = array();
     foreach ($sql->results() as $key => $value ){
        $results[] = $value; 
     }
    return $value->views;
  }
} 
/*------------------------------
  count today's booking
--------------------------------------*/
function bookings_today($id){
  $date = make_date();$db_date = make_db_date($date);
  $sql=DB::getInstance()->query("SELECT COUNT(id) AS views FROM bookings WHERE h_id = $id && date = '{$db_date}' && booked = 1 ");
   if ($sql->count()) {
     $results = array();
     foreach ($sql->results() as $key => $value ){
        $results[] = $value; 
     }
    return $value->views;
  }
}
/*------------------------------
  count today's reservations
--------------------------------------*/
function resev_today($id){
  $date = make_date();$db_date = make_db_date($date);
  $sql=DB::getInstance()->query("SELECT COUNT(id) AS views FROM bookings WHERE h_id = $id && date = '{$db_date}' && reserved = 1 ");
   if ($sql->count()) {
     $results = array();
     foreach ($sql->results() as $key => $value ){
        $results[] = $value; 
     }
    return $value->views;
  }
}

/*---------------
  count total views per hotel id
--------------------------------------------*/  
function total_hotel_views($id){
  $sql=DB::getInstance()->query("SELECT COUNT(id) AS views FROM tbl_hotels_views WHERE hid=$id ");
   if ($sql->count()) {
     $results = array();
     foreach ($sql->results() as $key => $value ){
        $results[] = $value; 
     }
    return $value->views;
  }
} 

/*-----------------------------------
  list bookings & reservation 
--------------------------------------------*/
function list_bookings($id){
  $sql=DB::getInstance()->query("SELECT * FROM bookings WHERE h_id=$id ORDER BY date ASC ");
   if ($sql->count()) {
    return $sql;
   }
}   



  
?>