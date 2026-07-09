
<?php 
    ob_start();
    require_once 'cctech-admin/core/init.php';
    require 'PHPMailer/PHPMailerAutoload.php';
    //require 'transaction_verify.php'
    $client = new Client();
    if( $client->isLoggedIn() ) {
        if ($client->data()->groups == 2) {
            $agent = $client->data()->id;
            $agentEmail = $client->data()->email;
        }else{$agent = ''; $agentEmail = '';}
    }else{$agent = ''; $agentEmail='';};
 
    
    /*------------PAYMENT PLUGINS VARIABLES------------------*/
    /*$apiUrl = "https://api.paystack.co/transaction"; // Replace with the actual API endpoint
    $authToken = "sk_test_a5bec9d9ed28a79407bff3ba3e8bf24a564b7a6e"; // Replace with your actual token
    $secret_key = Config::get('paystack/secretKey');
    $public_key = Config::get('paystack/publicKey');
    $api_version = Config::get('paystack/version');
    $integration_mode = Config::get('paystack/integrationMode');
    $merchant_email = Config::get('paystack/merchantEmail');
    $base_url = Config::get('paystack/baseUrl');
    $paystack = new PaystackConnector($secret_key, $public_key, $api_version, $integration_mode, $merchant_email, $base_url);*/
    

    $conn = DB::getInstance();
    $mode = Input::get('mode');
    $transactionId = GUID();
    $year = date('Y');
    $rn = "\r\n";
    $subTotalAmount = 0;

    // echo currencyConverter02(200.00,'USD','GHS');
    
    // die();
    
    
if ($mode == 'accounts') {
    $comment1= 'Booking made from Travelafric.com';
    $comment2= '';
   $arrayOfOrderItems = array();
        
        /*----------total cost---------*/
        $total = 0; foreach ($_SESSION['cart'] as $item) {$total += $item['subtotal'];}
        /*----------get agent current account balance------*/
        $currentBalance = find_by_custId('accounts',$agent);

        /*---------check if there is sufficient fund for transaction-------*/
        if ($total > $currentBalance->balance) {
            Session::flash('less-fund','Insufficient fund to complete this transaction');
            Redirect::to('cart.php');
        }else{    
            foreach ($_SESSION['cart'] as $value){
                $fullname = $value['fname'].' '.$value['lname'];

                if ($value['service']=='transfer') {
                   $transferId = $value['serviceId'];
                   $info = find_by_id('transfers',$transferId);
                   $transactionDetails = '{"id":"'.$transferId.'","name":"'.$fullname.'","tel":"'.$value['phone'].'","email":"'.$value['email'].'",
                    "pick_addr":"'.$value['pick_loc'].'","pick_date":"'.$value['pick_date'].'","pick_time":"'.$value['pick_time'].'",
                    "drop_addr":"'.$value['drop_loc'].'","drop_date":"'.$value['drop_date'].'","drop_time":"'.$value['date_time'].'"
                    }';
                    $recepit_id = substr(GUID(), 9,9);
                    $makeBooking = $conn->insert('booking',array('trans_id'=>$transactionId,'trans_type'=>'transfers','trans_details'=>$transactionDetails,'trans_cost'=>$value['subtotal'],'payment_status'=>1,'booking_no'=>$recepit_id,'payment_mode'=>$mode,'made_by'=>$agent) );

                    if ($makeBooking) {
                        /*---------create notification-------------*/
                        $conn->insert('notify',array('type'=>'Booking','tag'=>'transfers','comment'=>'New transfer booking.'));

                        /*--------sending email-----------*/ 
                        $message = " 
                            <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.1//EN' 'http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd'>
                            <html xmlns='http://www.w3.org/1999/xhtml'>
                            <head>
                                <meta charset='utf-8'>
                                <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'>
                                <title>Confirmation Mail</title>
                                <style type='text/css'>
                                    body{font: 75% / 150% 'Lato', Arial, Helvetica, sans-serif;}
                                    *{margin:0px;padding:0px;font-weight:normal; } 
                                    h2{font-size:1.5em; color: #838383;}
                                    dl{width:100%; }
                                    dl>dt, dl>dd{float: left;width:50%;padding:5px 0;text-transform:uppercase;font-size:12px  }
                                    dl>dd{padding-left:20px; }
                                    dl>dt{width:40%;color:#01b7f2;border-right: 1px solid #f5f5f5;clear: both; }
                                    h3{color: #01b7f2}
                                    h4{font-size: 1.2333em; color: #01b7f2}
                                    #content {min-height: 400px; padding-top: 40px; text-align: left; background: #f5f5f5;}
                                    .gray-area {background: #f5f5f5;}
                                    .container {padding-right: 100px; padding-left: 100px; margin-right: auto; margin-left: auto;}
                                    .row {margin-right: 30px; margin-left: 30px;}
                                    #main {margin-bottom: 40px;}
                                    .booking-information.travelo-box { background: #fff; padding: 20px 30px 30px; margin-bottom: 30px;}
                                    clearfix{5}
                                    .clearfix:after,.clearfix:before,{display:table;content:''}
                                    .character {font-size: 0.8333em;border-top: 1px solid #f5f5f5;border-bottom: 1px solid #f5f5f5;margin-bottom: 15px;display: table;width: 100%;table-layout: fixed;}
                                    .col-sm-4 {width: 33.33333333%;float: left;position: relative;min-height: 1px;}
                                    .col-sm-8{float: left;width: 58.66666667%; position: relative;min-height: 1px;}
                                    .col-xs-4 {width: 33.33333333%; position: relative;min-height: 1px;padding-right: 15px;}
                                    .col-xs-5 {width: 41.66666667%;position: relative;min-height: 1px;padding-right: 15px;padding-left: 15px;}
                                    .details {font-size: 0.8333em;padding: 0px 300px;text-transform: uppercase;}
                                    .character {border-top: 1px solid #f5f5f5;border-bottom: 1px solid #f5f5f5;margin-bottom: 15px;display: table;width: 100%;table-layout: fixed;}
                                    .character > div:first-child {font-size: 1.1333em; border: none;padding-left: 0;}
                                    .character > div {font-size: 1.1333em; display: table-cell;float: none;vertical-align: middle;margin: 0;padding-top: 12px;padding-bottom: 12px;}
                                    .skin-color {color: #01b7f2;}
                                    .box-title {font-size: 13px;text-transform: none;margin-bottom: 10px;letter-spacing: 0.04em;line-height: 1em;}
                                    .box-title small {font-size: 10px;color: #838383;text-transform: uppercase;display: block;margin-top: 4px;line-height: 1.8333em;}
                                    .price {float: none;text-align: center;color: #7db921;font-size: 1.6667em;text-transform: uppercase;float: right;text-align: center;line-height: 1;display: block;letter-spacing: 0.04em; line-height: 1.0333em;}
                                    .price small {display: block;color: #838383;font-size: 0.5em;   }
                                    .pull-left {float: left !important;}
                                    .pull-right {float: right !important;}
                                    span {border-color: #01b7f2;color: #01b7f2;}
                                    a.button {display: inline-block;background: #d9d9d9;font-size: 0.8333em;line-height: 1.8333em;white-space: nowrap;text-align: center;letter-spacing: 0.04em;}
                                    a.button:hover {background: #98ce44;}
                                    a.button.btn-small, a.button.full-width {font-weight: bold;height: 28px;padding: 0 24px;line-height: 28px;font-size: 0.9167em;}
                                 
                                </style>
                                
                            </head>
                            <body bgcolor=''>
                                <div style='background:#ccc;width:900px;padding:2px; margin:20px auto;'>
                                <div style='background:#fff;min-height:50px;padding:10px 5px '>
                                    <table style='width:100%;border-collapse: collapse;' class='table'>
                                        <tr style='background:#0b0061 '>
                                            <td colspan='2' style='background-color: #eeeeee; border:2px #eeeeee; padding:15px; padding-bottom: 20px; margin:-20px -30px -35px -30px;'><h2>Transfer Booking Confirmation</h2></td>
                                            <td style='float: left; padding:10px 0;width:70%'><img src='https://travelafric.com/res/images/logo3.png' height='40' width='50' alt='travelafric logo'></td>
                                        </tr>
                                        <tr style='background:#0b0061;'>
                                            <td colspan='2' style='background-color: #fff; border:2px #eeeeee; padding:10px; padding-bottom: 0px; margin:-20px -30px -35px -30px'>
                                                <div class=''>
                                                  <i class=''></i>
                                                    <div class=''>
                                                      <h4>Thank You Simon. Your Booking Order is Now Confirmed.</h4>
                                                      <p style='line-height: 2.3em'>This is your confirmation email. Print this confirmation voucher and prsent to Supplier</p>
                                                    </div>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                    </table>    
                                    <table style='width:100%;' class='table'>    
                                        <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                        <tr><td colspan='2' style='padding:10px'><h2>Guest Information</h2></td></tr>
                                        <tr>
                                             <td style='padding:10px;' colspan=''>
                                                <dl class='term-description'>
                                                    <dt>Booking number:</dt><dd>{$recepit_id}</dd>
                                                    <dt>First name:</dt><dd>{$value['fname']}</dd>
                                                    <dt>Last name:</dt><dd>{$value['lname']}</dd>
                                                    <dt>E-mail address:</dt><dd>{$value['email']}</dd>
                                                    <dt>E-mail address:</dt><dd>{$value['phone']}</dd>
                                                    <dt>Address:</dt><dd>{$value['addr']}</dd> <!--enter address at booking details-->
                                                    <dt>City:</dt><dd>Paris,France</dd> <!--enter city at booking details-->
                                                    <dt>ZIP code:</dt><dd>75800-875</dd> <!--enter zip code at booking details-->
                                                    <dt>Country:</dt><dd>United States of america</dd><!--retrieve country using IP-->
                                                </dl>
                                              </td>
                                        </tr>
                                    </table>    
                                    <table style='width:100%;' class='table'>
                                        <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                        <tr><td colspan='2' style='padding:10px;'><h2>Booking Details</h2></td></tr>
                                        <tr class='booking-details'>
                                             
                                        </tr>
                                    </table>
                                    
                                    <article>       
                                        <figure class='col-sm-4'>
                                            <img src='' style='height:px;width:px;' alt='service_image'>
                                        </figure>
                                        <div class='details col-sm-8'>
                                        <div class='clearfix'>
                                            <h3 class='box-title pull-left'>".$value['pick_loc']." to ".$value['drop_loc']."<small>{$info->persons}</small></h3>
                                            <span class='price pull-right'><small>Paid</small>$358</span>
                                        </div>
                                        <div class='character clearfix'>
                                            <div class='col-xs-4 date'>
                                                
                                                <div>
                                                    <span class='skin-color'>Date</span><br>".$value['pick_date']."
                                                </div>
                                            </div>
                                            <div class='col-xs-4 date'>
                                                
                                                <div>
                                                    <span class='skin-color'>Vehicle</span><br>{$info->vehicle}
                                                </div>
                                            </div>
                                            <div class='col-xs-5 departure'>
                                                
                                                <div>
                                                    <span class='skin-color'>Supplier</span><br>{$info->sup_name}
                                                </div>
                                            </div>
                                        </div>
                                        <div class='character clearfix'>
                                            <div class='col-xs-4 date'>
                                                
                                                <div>
                                                    <span class='skin-color'>Pick Up Time</span><br>".$value['pick_time']."
                                                </div>
                                            </div>
                                            <div class='col-xs-4 date'>
                                                
                                                <div>
                                                    <span class='skin-color'>Drop Off Time</span><br>".$value['drop_time']."
                                                </div>
                                            </div>
                                            <div class='col-xs-5 departure'>
                                                
                                                <div>
                                                    <span class='skin-color'>Flight Info</span><br>Delta Flight 777
                                                </div>
                                            </div>
                                        </div>
                                        <div class='character clearfix'>
                                            <div class='col-xs-4 date'>
                                                
                                                <div>
                                                    <span class='skin-color'>Contact</span><br>{$info->sup_tel}
                                                </div>
                                                
                                            </div>
                                            <div class='col-xs-4 date'>
                                                <!--<i class='soap-icon-clock yellow-color'></i>-->
                                                <div>
                                                    <span class='skin-color'>Email</span><br>{$info->sup_email}
                                                </div>
                                            </div>
                                            <div class='col-xs-5 departure'>
                                                <!--<i class='soap-icon-departure yellow-color'></i>-->
                                                <div>
                                                    <span class='skin-color'>Cancellation Cost</span><br>$100
                                                </div>
                                            </div>
                                        </div>

                                        <div class='clearfix'>
                                            <div class='review pull-left'>
                                                <span>Ticket # :</span>{$recepit_id}
                                                <br>
                                                <span>Cancellation :</span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <table style='width:100%;' class='table'>
                                        <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                        <tr><td colspan='2' style='padding:10px;'><h2>Transfer/Rental Policy</h2></td></tr>
                                        <tr><td style='padding:10px'>{$info->policy}</td></tr>
                                    </table>
                                    <div style='padding:20px 10px ;text-align:center; border-top:1px solid #777;margin-top:10px;background: #dee8eb;'>
                                       <a href='https://travelafric.com/' style='text-decoration:none;color:#555; '>&copy; {$year} Travelafric.com</a>
                                    </div>
                                </div>
                                </div>
                            </body>
                            </html>    
                        ";
                        $mail = new PHPMailer;
                        $mail->setFrom('info@travelafric.com', 'Team Travelafric');
                        $mail->addAddress($value['email'], $fullname);
                        $mail->addAddress($info->sup_email, $info->sup_name);
                        $mail->addAddress('info@travelafric.com');
                        $mail->addAddress($agentEmail);
                        $mail->Subject = 'Booking Voucher';
                        $mail->Body = $message;
                        $mail->IsHTML(true);
                        $mail->send();
                    }

                }elseif ($value['service']=='cruise') {
                    $excursionId = $value['serviceId'];
                    $info = find_by_id('excursion',$excursionId);
                    $transactionDetails = '{"id":"'.$excursionId.'","name":"'.$fullname.'","tel":"'.$value['phone'].'","email":"'.$value['email'].'","date":"'.$value['date'].'","time":""}';
                    $recepit_id = substr(GUID(), 9,9);
                    $makeBooking = $conn->insert('booking',array('trans_id'=>$transactionId,'trans_type'=>'excursions','trans_details'=>$transactionDetails,'trans_cost'=>$value['subtotal'],'payment_status'=>1,'booking_no'=>$recepit_id,'payment_mode'=>$mode,'made_by'=>$agent) );

                    if ($makeBooking) {
                        /*---------create notification-------------*/
                        $conn->insert('notify',array('type'=>'Booking','tag'=>'excursions','comment'=>'New Excursion booking.'));

                        /*--------sending email-----------*/ 
                        $path = 'cctech-admin/'.$info->pdf;
                        $message = " 
                            <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.1//EN' 'http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd'>
                            <html xmlns='http://www.w3.org/1999/xhtml'>
                            <head>
                                <meta charset='utf-8'>
                                <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'>
                                <title>Confirmation Mail</title>
                                <style type='text/css'>
                                    body{font: 75% / 150% 'Lato', Arial, Helvetica, sans-serif;}
                                    *{margin:0px;padding:0px;font-weight:normal; } 
                                    h2{font-size:1.5em; color: #838383;}
                                    h3{color: #01b7f2}
                                    h4{font-size: 1.2333em; color: #01b7f2}
                                    dl{width:100%; }
                                    dl>dt, dl>dd{float: left;width:50%;padding:5px 0;text-transform:uppercase;font-size:11px  }
                                    dl>dd{padding-left:20px; }
                                    dl>dt{width:40%;color:#01b7f2;border-right: 1px solid #f5f5f5;clear: both; }
                                    dl2{letter-spacing: 0.04em;     margin-top: 0;margin-bottom: 20px;}
                                    dt2{font-weight: normal;line-height: 1.42857143;display: block;unicode-bidi: isolate;    letter-spacing: 0.04em}
                                    dd{margin-left: 0;line-height: 1.42857143;display: block; unicode-bidi: isolate;letter-spacing: 0.04em}
                                    #content {min-height: 400px; padding-top: 40px; text-align: left; background: #f5f5f5;}
                                    .gray-area {background: #f5f5f5;}
                                    .container {padding-right: 100px; padding-left: 100px; margin-right: auto; margin-left: auto;}
                                    .row {margin-right: 30px; margin-left: 30px;}
                                    #main {margin-bottom: 40px;}
                                    .booking-information.travelo-box { background: #fff; padding: 20px 30px 30px; margin-bottom: 30px;}
                                    clearfix{5}
                                    .clearfix:after,.clearfix:before,{display:table;content:''}
                                    .character {font-size: 0.8333em;border-top: 1px solid #f5f5f5;border-bottom: 1px solid #f5f5f5;margin-bottom: 15px;display: table;width: 100%;table-layout: fixed;}
                                    .col-sm-4 {width: 33.33333333%;float: left;position: relative;min-height: 1px;}
                                    .col-sm-8{float: left;width: 58.66666667%; position: relative;min-height: 1px;}
                                    .col-xs-4 {width: 33.33333333%; position: relative;min-height: 1px;padding-right: 15px;}
                                    .col-xs-5 {width: 41.66666667%;position: relative;min-height: 1px;padding-right: 15px;padding-left: 15px;}
                                    .col-sm-4{position: relative;min-height: 1px;}
                                    .col-sm-8{position: relative;min-height: 10px;}
                                    .col-md-6 {width: 50%;float:left;position: relative;min-height: 1px;}

                                    .details {font-size: 0.8333em;padding: -10px 300px;text-transform: uppercase;}
                                    .character {border-top: 1px solid #f5f5f5;border-bottom: 1px solid #f5f5f5;margin-bottom: 15px;display: table;width: 100%;table-layout: fixed;}
                                    .character > div:first-child {font-size: 1.1333em; border: none;padding-left: 0;}
                                    .character > div {font-size: 1.1333em; display: table-cell;float: none;vertical-align: middle;margin: 0;padding-top: 12px;padding-bottom: 12px;}
                                    .skin-color {color: #01b7f2;}
                                    .box-title {font-size: 13px;text-transform: none;margin-bottom: 10px;letter-spacing: 0.04em;line-height: 1em;}
                                   
                                    .box-title small {font-size: 10px;color: #838383;text-transform: uppercase;display: block;margin-top: 4px;line-height: 1.8333em;}
                                    .price {float: none;text-align: center;color: #7db921;font-size: 1.6667em;text-transform: uppercase;float: right;text-align: center;line-height: 1;display: block;letter-spacing: 0.04em; line-height: 1.0333em;}
                                    .price small {display: block;color: #838383;font-size: 0.5em;   }
                                    .pull-left {float: left !important;}
                                    .pull-right {float: right !important;}
                                    span {border-color: #01b7f2;color: #01b7f2;}
                                    a.button {display: inline-block;background: #d9d9d9;font-size: 0.8333em;line-height: 1.8333em;white-space: nowrap;text-align: center;letter-spacing: 0.04em;}
                                    a.button:hover {background: #98ce44;}
                                    a.button.btn-small, a.button.full-width {font-weight: bold;height: 28px;padding: 0 24px;line-height: 28px;font-size: 0.9167em;}
                                    
                                    .intro.table-wrapper{padding: 0;border-spacing: 15px;border-collapse: separate;table-layout: fixed;margin-bottom: 15px;}
                                    #car-details{background: #ffffff;padding: 0;border-spacing: 15px;border-collapse: separate;table-layout: fixed;}
                                    .intro{background: #f5f5f5;margin-bottom: 15px;}
                                    .table-wrapper {display: table;}
                                    .full-width {width: 100% !important;}
                                    .fade.in {opacity: 1;}
                                    .fade{transition: opacity .15s linear;}
                                    .table-cell:first-child{margin-bottom: 15px;}
                                    .table-cell{background: #fff;}
                                    .travelo-box {padding: 25px 25px 20px 25px;margin: 0;}
                                    .table-wrapper .table-cell {display: table-cell;vertical-align: top;float: none !important;}
                                    .table-cell:last-child{padding-left: 0;padding-right: 0;}
                                    .details2 {width: 50%; text-transform: uppercase;display: table-cell;vertical-align: middle;letter-spacing: 0.04em;}
                                    .detailed-features {background: #fff;}
                                    .clearfix:before{display: table;content: ' ';box-sizing: border-box;}
                                    .clearfix:after:after{clear: both;display: table;content: ' ';}
                                    
                                </style>
                                
                            </head>
                            <body bgcolor=''>
                                <div style='background:#ccc;width:900px;padding:2px; margin:20px auto;'>
                                <div style='background:#fff;min-height:50px;padding:10px 5px '>
                                    <table style='width:100%;border-collapse: collapse;' class='table'>
                                        <tr style='background:#0b0061 '>
                                            <td colspan='2' style='background-color: #eeeeee; border:2px #eeeeee; padding:15px; padding-bottom: 20px; margin:-20px -30px -35px -30px'><h2>Sightseeing Booking Confirmation</h2></td>
                                            <!--<td style='float: left; padding:10px 0;width:70%;'><img src='https://travelafric.com/res/images/logo3.png' height='40' width='50' alt='travelafric logo'></td>-->
                                        </tr>
                                        <tr style='background:#0b0061 '>
                                            <td colspan='2' style='background-color: #fff; border:2px #eeeeee; padding:10px; padding-bottom: 0px; margin:-20px -30px -35px -30px'>
                                                <div class='booking-confirmation clearfix'>
                                                  <i class='soap-icon-recommend icon circle'></i>
                                                    <div class='message'>
                                                      <h4>Thank You Simon. Your Booking Order is Now Confirmed.</h4>
                                                      <p style='line-height: 2.3em'>This is your confirmation email. Print this confirmation voucher and prsent to Supplier</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                    </table>    
                                    <table style='width:100%;' class='table'>    
                                        <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                        <tr><td colspan='2' style='padding:10px'><h2>Guest Information</h2></td></tr>
                                        <tr>
                                            <td style='padding:10px;' colspan=''>
                                                <dl class='term-description'>
                                                    <dt>Booking number:</dt><dd>{$recepit_id}</dd>
                                                    <dt>First name:</dt><dd>{$value['fname']}</dd>
                                                    <dt>Last name:</dt><dd>{$value['lname']}</dd>
                                                    <dt>E-mail address:</dt><dd>{$value['email']}</dd>
                                                    <dt>E-mail address:</dt><dd>{$value['phone']}</dd>
                                                    <dt>Address:</dt><dd>{$value['addr']}</dd> <!--enter address at booking details-->
                                                    <dt>City:</dt><dd>Paris,France</dd> <!--enter city at booking details-->
                                                    <dt>ZIP code:</dt><dd>75800-875</dd> <!--enter zip code at booking details-->
                                                    <dt>Country:</dt><dd>United States of america</dd><!--retrieve country using IP-->
                                                </dl>
                                            </td>
                                        </tr>
                                    </table>    
                                    <table style='width:100%;' class='table'>
                                        <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                        <tr><td colspan='2' style='padding:10px;'><h2>Booking Details</h2></td></tr>
                                        <tr class='booking-details'>
                                           
                                            
                                          </tr>
                                      </table>
                                    
                                    <article>       
                                        <figure class='col-sm-4'>
                                            <img src='https://travelafric.com/'".$value['serviceImage']." style='height:px;width:px;' alt='service_image'>
                                        </figure>
                                        <div class='details col-sm-8'>
                                        <div class='clearfix'>
                                            <h3 class='box-title pull-left'>{$info->title}
                                                 <small>{$info->city} - {$info->country}</small>
                                                <small>".$value['adult']." - ".$value['kids']."</small></h3>
                                            <span class='price pull-right'><small>Paid</small>$358</span>
                                        </div>
                                        <div class='character clearfix'>
                                            <div class='col-xs-4 date'>
                                                
                                                <div>
                                                    <span class='skin-color'>Date</span><br>".$value['pick_date']."
                                                </div>
                                            </div>
                                            <div class='col-xs-4 date'>
                                                
                                                <div>
                                                    <span class='skin-color'>Duration</span><br>{$info->duration}
                                                </div>
                                            </div>
                                            <div class='col-xs-5 departure'>
                                                
                                                <div>
                                                    <span class='skin-color'>Type</span><br>{$info->type}
                                                </div>
                                            </div>
                                        </div>
                                        <div class='character clearfix'>
                                            <div class='col-xs-4 date'>
                                                
                                                <div>
                                                    <span class='skin-color'>Pick Up Location</span><br>".$value['pick_time']."
                                                </div>
                                            </div>
                                            <div class='col-xs-4 date'>
                                                
                                                <div>
                                                    <span class='skin-color'>Transport</span><br>{$info->transport}
                                                </div>
                                            </div>
                                            <div class='col-xs-5 departure'>
                                                
                                                <div>
                                                    <span class='skin-color'>Inclusion</span><br>Delta Flight 777
                                                </div>
                                            </div>
                                        </div>
                                        <div class='character clearfix'>
                                            <div class='col-xs-4 date'>
                                                
                                                <div>
                                                    <span class='skin-color'>Contact</span><br>{$info->sup_tel}
                                                </div>
                                                <!--<img src='http://placehold.it/110x25' alt='' />-->
                                            </div>
                                            <div class='col-xs-4 date'>
                                                <!--<i class='soap-icon-clock yellow-color'></i>-->
                                                <div>
                                                    <span class='skin-color'>Email</span><br>{$info->sup_email}
                                                </div>
                                            </div>
                                            <div class='col-xs-5 departure'>
                                                <!--<i class='soap-icon-departure yellow-color'></i>-->
                                                <div>
                                                    <span class='skin-color'>Cancellation Cost</span><br>$100
                                                </div>
                                            </div>
                                        </div>

                                        <div class='clearfix'>
                                            <div class='review pull-left'>
                                                <span>Ticket # :</span>{$recepit_id}
                                                <br>
                                                <span>Cancellation :</span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                       
                                    <table style='width:100%;' class='table'>
                                        <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                        <tr><td colspan='2' style='padding:10px;'><h2>Payment</h2></td></tr>
                                        <tr>
                                          <td style='padding:10px'>
                                         
                                          <div class='tab-pane fade in active' id='car-details'>
                                            <div class='intro box table-wrapper full-width hidden-table-sms'>
                                                <div class='col-sm-4 table-cell travelo-box'>
                                                    <dl class='term-description'>
                                                                              
                                                    <dt>Total Cost:</dt><dd>$200</dd>
                                                    <dt>Service Fee:</dt><dd>$150</dd>
                                                     <dt>Taxes &amp; Fees:</dt><dd>$20.61</dd>
                                                    <dt>Total price:</dt><dd>$1000</dd>
                                                    <dt>Amount Paid:</dt><dd>$1000</dd>
                                                                                                        
                                                    </dl>
                                                    
                                                </div>
                                            <div class='col-sm-8 table-cell'>
                                                <div class='detailed-features clearfix'>
                                                    <div class='col-md-6'>
                                                    <h4 class='box-title' style='padding-left: 15px'>
                                                        Payment Status
                                                        <small>Reserved</small>
                                                    </h4>
                                                    <div class='icon-box style11'>
                                                        <div class='icon-wrapper'>
                                                           
                                                        </div>
                                                        <dl2 class='details2' style='padding-bottom: 0px'>
                                                            <dt2 class='skin-color'>Confirm Before</dt2>
                                                            <dd><small>Nov 14, 2013 |<br> 11:00 AM</small></dd>
                                                        </dl2>
                                                    </div>
                                                    <div class='icon-box style11'>
                                                        <div class='icon-wrapper'>
                                                           
                                                        </div>
                                                        <dl2 class='details2'>
                                                            <dt2 class='skin-color'>ACCOUNT</dt2>
                                                            <dd><small>Paid</small></dd>
                                                        </dl2>
                                                        <br>
                                                        
                                                    </div>
                                                    </div>
                                               <div class='col-md-6'>
                                                    <h3 class='box-title' style='padding-left: 15px'>
                                                        Payment Mode
                                                        <small>Credit Card</small>
                                                    </h3>
                                                    <div class='icon-box style11'>
                                                        <div class='icon-wrapper'>
                                                            <i class='soap-icon-clock'></i>
                                                        </div>
                                                        <dl2 class='details2' style='padding-bottom: 10px'>
                                                            <dt2 class='skin-color'>Number of Guests</dt2>
                                                            <dd><small>3 Pax</small></dd>
                                                        </dl2>
                                                    </div>
                                                    <div class='icon-box style11'>
                                                        <div class='icon-wrapper'>
                                                            <i class='soap-icon-departure'></i>
                                                        </div>
                                                        <dl2 class='details2'>
                                                            <dt2 class='skin-color'>Cancellation Fee</dt2>
                                                            <dd><small>Free</small></dd>
                                                        </dl2>
                                                    </div>
                                               </div>
                                             </div>
                                           </div>
                                         </div>
                                        </div>
                                       </td>
                                      </tr>
                                   </table>
                                        
                                    <table style='width:100%;' class='table'>
                                        <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                        <tr><td colspan='2' style='padding:10px;'><h2>Map</h2></td></tr>
                                        <tr>
                                          <td style='padding:10px'>
                                              <div class='tab-pane fade in active' id='car-details'>
                                                <div class='intro box table-wrapper full-width hidden-table-sms'>
                                                   <div class='col-sm-4 table-cell travelo-box'>
                                                    <img src='https://travelafric.com/{$info->map_image}' style='width:100%' />
                                                   </div>
                                                   <div class='col-sm-8 table-cell'>
                                                     <div class='detailed-features clearfix'></div>
                                                     <img src='https://travelafric.com/{$info->map_image}' style='width:100%' />
                                                   </div>
                                                </div>
                                              </div>
                                          </td>
                                         </tr>
                                    </table>
                                    
                                        
                                        
                                        
                                    <table style='width:100%;' class='table'>
                                        <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                        <tr><td colspan='2' style='padding:10px;'><h2>Important Information</h2></td></tr>
                                        <tr><td colspan='2' style='padding:10px;'><h3>Special Notes</h3></td></tr>
                                        <tr><td style='padding:10px'>{$info->policy}</td></tr>
                                    </table>
                                    <div style='padding:20px 10px ;text-align:center; border-top:1px solid #777;margin-top:10px;background: #dee8eb;'>
                                       <a href='https://travelafric.com/' style='text-decoration:none;color:#555; '>&copy; {$year} Travelafric.com</a>     
                                        <p>All rights reserved</p>
                                        <p>Don't want to receive any more marketing offers in your confirmation emails?</p>
                                        <p>When communicating with your supplier via Travelafric.com, you agree with the terms and conditions of processing information communications as indicated in our Privacy Policy.</p>
                                    </div>
                                </article>
                                    
                                    
                              </div>
                            </div>
                        </body>
                        </html>         
                        ";

                        $mail = new PHPMailer;
                        $mail->setFrom('info@travelafric.com', 'Team Travelafric');
                        $mail->addAddress($value['email'], $fullname);
                        $mail->addAddress($info->sup_email, $info->sup_name);
                        $mail->addAddress('info@travelafric.com');
                        $mail->addAddress($agentEmail);
                        $mail->Subject = 'Booking Voucher';
                        $mail->Body = $message;
                        $mail->IsHTML(true);
                        $mail->addAttachment($path,'Itinerary');
                        $mail->send();
                    }

                }elseif ($value['service']=='package') {
                    $tourId = $value['serviceId'];
                    $info = find_by_id('tours',$tourId);
                    $transactionDetails = '{"id":"'.$tourId.'","name":"'.$fullname.'","tel":"'.$value['phone'].'","email":"'.$value['email'].'"}';
                    $recepit_id = substr(GUID(), 9,9);
                    $makeBooking = $conn->insert('booking',array('trans_id'=>$transactionId,'trans_type'=>'tours','trans_details'=>$transactionDetails,'trans_cost'=>$value['subtotal'],'payment_status'=>1,'booking_no'=>$recepit_id,'payment_mode'=>$mode,'made_by'=>$agent) );
                    if ($makeBooking) {
                        //create notification
                        $conn->insert('notify',array('type'=>'Booking','tag'=>'tours','comment'=>'New Tour Booking.'));

                        //sending email 
                        $path = 'cctech-admin/'.$info->pdf;
                        $message = " 
                            <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.1//EN' 'http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd'>
                        <html xmlns='http://www.w3.org/1999/xhtml'>
                        <head>
                            <meta charset='utf-8'>
                            <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'>
                            <title>Confirmation Mail</title>
                            <style type='text/css'>
                                body{font: 75% / 150% 'Lato', Arial, Helvetica, sans-serif;}
                                *{margin:0px;padding:0px;font-weight:normal; } 
                                h2{font-size:1.5em; color: #838383;}
                                h3{color: #01b7f2}
                                h4{font-size: 1.2333em; color: #01b7f2}
                                dl{width:100%; }
                                dl>dt, dl>dd{float: left;width:50%;padding:5px 0;text-transform:uppercase;font-size:11px  }
                                dl>dd{padding-left:20px; }
                                dl>dt{width:40%;color:#01b7f2;border-right: 1px solid #f5f5f5;clear: both; }
                                dl2{letter-spacing: 0.04em;     margin-top: 0;margin-bottom: 20px;}
                                dt2{font-weight: normal;line-height: 1.42857143;display: block;unicode-bidi: isolate;    letter-spacing: 0.04em}
                                dd{margin-left: 0;line-height: 1.42857143;display: block; unicode-bidi: isolate;letter-spacing: 0.04em}
                                #content {min-height: 400px; padding-top: 40px; text-align: left; background: #f5f5f5;}
                                .gray-area {background: #f5f5f5;}
                                .container {padding-right: 100px; padding-left: 100px; margin-right: auto; margin-left: auto;}
                                .row {margin-right: 30px; margin-left: 30px;}
                                #main {margin-bottom: 40px;}
                                .booking-information.travelo-box { background: #fff; padding: 20px 30px 30px; margin-bottom: 30px;}
                                clearfix{5}
                                .clearfix:after,.clearfix:before,{display:table;content:' '}
                                .character {font-size: 0.8333em;border-top: 1px solid #f5f5f5;border-bottom: 1px solid #f5f5f5;margin-bottom: 15px;display: table;width: 100%;table-layout: fixed;}
                                .col-sm-4 {width: 33.33333333%;float: left;position: relative;min-height: 1px;}
                                .col-sm-8{float: left;width: 58.66666667%; position: relative;min-height: 1px;}
                                .col-xs-4 {width: 33.33333333%; position: relative;min-height: 1px;padding-right: 15px;}
                                .col-xs-5 {width: 41.66666667%;position: relative;min-height: 1px;padding-right: 15px;padding-left: 15px;}
                                .col-sm-4{position: relative;min-height: 1px;}
                                .col-sm-8{position: relative;min-height: 10px;}
                                .col-md-6 {width: 50%;float:left;position: relative;min-height: 1px;}

                                .details {font-size: 0.8333em;padding: -10px 300px;text-transform: uppercase;}
                                .character {border-top: 1px solid #f5f5f5;border-bottom: 1px solid #f5f5f5;margin-bottom: 15px;display: table;width: 100%;table-layout: fixed;}
                                .character > div:first-child {font-size: 1.1333em; border: none;padding-left: 0;}
                                .character > div {font-size: 1.1333em; display: table-cell;float: none;vertical-align: middle;margin: 0;padding-top: 12px;padding-bottom: 12px;}
                                .skin-color {color: #01b7f2;}
                                .box-title {font-size: 13px;text-transform: none;margin-bottom: 10px;letter-spacing: 0.04em;line-height: 1em;}
                               
                                .box-title small {font-size: 10px;color: #838383;text-transform: uppercase;display: block;margin-top: 4px;line-height: 1.8333em;}
                                .price {float: none;text-align: center;color: #7db921;font-size: 1.6667em;text-transform: uppercase;float: right;text-align: center;line-height: 1;display: block;letter-spacing: 0.04em; line-height: 1.0333em;}
                                .price small {display: block;color: #838383;font-size: 0.5em;   }
                                .pull-left {float: left !important;}
                                .pull-right {float: right !important;}
                                span {border-color: #01b7f2;color: #01b7f2;}
                                a.button {display: inline-block;background: #d9d9d9;font-size: 0.8333em;line-height: 1.8333em;white-space: nowrap;text-align: center;letter-spacing: 0.04em;}
                                a.button:hover {background: #98ce44;}
                                a.button.btn-small, a.button.full-width {font-weight: bold;height: 28px;padding: 0 24px;line-height: 28px;font-size: 0.9167em;}
                                
                                .intro.table-wrapper{padding: 0;border-spacing: 15px;border-collapse: separate;table-layout: fixed;margin-bottom: 15px;}
                                #car-details{background: #ffffff;padding: 0;border-spacing: 15px;border-collapse: separate;table-layout: fixed;}
                                .intro{background: #f5f5f5;margin-bottom: 15px;}
                                .table-wrapper {display: table;}
                                .full-width {width: 100% !important;}
                                .fade.in {opacity: 1;}
                                .fade{transition: opacity .15s linear;}
                                .table-cell:first-child{margin-bottom: 15px;}
                                .table-cell{background: #fff;}
                                .travelo-box {padding: 25px 25px 20px 25px;margin: 0;}
                                .table-wrapper .table-cell {display: table-cell;vertical-align: top;float: none !important;}
                                .table-cell:last-child{padding-left: 0;padding-right: 0;}
                                .details2 {width: 50%; text-transform: uppercase;display: table-cell;vertical-align: middle;letter-spacing: 0.04em;}
                                .detailed-features {background: #fff;}
                                .clearfix:before{display: table;content: ' ';box-sizing: border-box;}
                                .clearfix:after:after{clear: both;display: table;content: ' ';}
                                
                            </style>
                            
                        </head>
                        <body bgcolor=''>
                            <div style='background:#ccc;width:900px;padding:2px; margin:20px auto;'>
                            <div style='background:#fff;min-height:50px;padding:10px 5px '>
                                <table style='width:100%;border-collapse: collapse;' class='table'>
                                    <tr style='background:#0b0061 '>
                                        <td colspan='2' style='background-color: #eeeeee; border:2px #eeeeee; padding:15px; padding-bottom: 20px; margin:-20px -30px -35px -30px'><h2>Tour Package Booking Confirmation</h2></td>
                                        <td style='float: left; padding:10px 0;width:70%;'><img src='https://travelafric.com/res/images/logo3.png' height='40' width='50' alt='travelafric logo'></td>
                                    </tr>
                                    <tr style='background:#0b0061 '>
                                        <td colspan='2' style='background-color: #fff; border:2px #eeeeee; padding:10px; padding-bottom: 0px; margin:-20px -30px -35px -30px'>
                                            <div class='booking-confirmation clearfix'>
                                              <i class='soap-icon-recommend icon circle'></i>
                                                <div class='message'>
                                                  <h4>Thank You Simon. Your Booking Order is Now Confirmed.</h4>
                                                  <p style='line-height: 2.3em'>This is your confirmation email. Print this confirmation voucher and prsent to Supplier</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                </table>    
                                <table style='width:100%;' class='table'>    
                                    <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                    <tr><td colspan='2' style='padding:10px'><h2>Guest Information</h2></td></tr>
                                    <tr>
                                        <td style='padding:10px;' colspan=''>
                                            <dl class='term-description'>
                                                <dt>Booking number:</dt><dd>{$recepit_id}</dd>
                                                <dt>First name:</dt><dd>{$value['fname']}</dd>
                                                <dt>Last name:</dt><dd>{$value['lname']}</dd>
                                                <dt>E-mail address:</dt><dd>{$value['email']}</dd>
                                                <dt>E-mail address:</dt><dd>{$value['phone']}</dd>
                                                <dt>Address:</dt><dd>{$value['addr']}</dd> <!--enter address at booking details-->
                                                <dt>City:</dt><dd>Paris,France</dd> <!--enter city at booking details-->
                                                <dt>ZIP code:</dt><dd>75800-875</dd> <!--enter zip code at booking details-->
                                                <dt>Country:</dt><dd>United States of america</dd><!--retrieve country using IP-->
                                            </dl>
                                        </td>
                                    </tr>
                                </table>    
                                <table style='width:100%;' class='table'>
                                    <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                    <tr><td colspan='2' style='padding:10px;'><h2>Booking Details</h2></td></tr>
                                    <tr class='booking-details'>
                                       
                                        
                                      </tr>
                                  </table>
                                
                                <article>       
                                    <figure class='col-sm-4'>
                                        <img src='' style='height:px;width:px;' alt='service_image'>
                                    </figure>
                                    <div class='details col-sm-8'>
                                    <div class='clearfix'>
                                        <h3 class='box-title pull-left'>{$info->title}
                                             <small>{$info->city} - {$info->country}</small>
                                            <small>".$value['adult']." - ".$value['kids']."</small></h3>
                                        <span class='price pull-right'><small>Paid</small>$358</span>
                                    </div>
                                    <div class='character clearfix'>
                                        <div class='col-xs-4 date'>
                                            
                                            <div>
                                                <span class='skin-color'>Start Date</span><br>".$value['pick_date']."
                                            </div>
                                        </div>
                                        <div class='col-xs-4 date'>
                                            
                                            <div>
                                                <span class='skin-color'>Duration</span><br>{$info->duration}
                                            </div>
                                        </div>
                                        <div class='col-xs-5 departure'>
                                            
                                            <div>
                                                <span class='skin-color'>Type</span><br>{$info->type};
                                            </div>
                                        </div>
                                    </div>
                                    <div class='character clearfix'>
                                        <div class='col-xs-4 date'>
                                            
                                            <div>
                                                <span class='skin-color'>Pick Up Location</span><br>".$value['pick_loc']."
                                            </div>
                                        </div>
                                        <div class='col-xs-4 date'>
                                            
                                            <div>
                                                <span class='skin-color'>Pick Up Time</span><br>".$value['pick_time']."
                                            </div>
                                        </div>
                                        <div class='col-xs-5 departure'>
                                            
                                            <div>
                                                <span class='skin-color'>Vehicle</span><br>{$info->vehicle}
                                            </div>
                                        </div>
                                    </div>
                                    <div class='character clearfix'>
                                        <div class='col-xs-4 date'>
                                            
                                            <div>
                                                <span class='skin-color'>Contact</span><br>{$info->sup_tel}
                                            </div>
                                            <!--<img src='http://placehold.it/110x25' alt='' />-->
                                        </div>
                                        <div class='col-xs-4 date'>
                                            <!--<i class='soap-icon-clock yellow-color'></i>-->
                                            <div>
                                                <span class='skin-color'>Email</span><br>{$info->sup_email}
                                            </div>
                                        </div>
                                        <div class='col-xs-5 departure'>
                                            <!--<i class='soap-icon-departure yellow-color'></i>-->
                                            <div>
                                                <span class='skin-color'>Cancellation Cost</span><br>$100
                                            </div>
                                        </div>
                                    </div>
                                    <div class='character clearfix'>
                                        <div class='review pull-left'>
                                            <div>
                                                <span class='skin-color'>Package Include: </span> {$info->inclusion}
                                            </div>
                                        </div>
                                    </div>

                                    <div class='clearfix'>
                                        <div class='review pull-left'>
                                            <span>Ticket # :</span>{$recepit_id}
                                            <br>
                                            <span>Cancellation :</span>
                                        </div>
                                        
                                    </div>
                                </div>
                                   
                                <table style='width:100%;' class='table'>
                                    <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                    <tr><td colspan='2' style='padding:10px;'><h2>Payment</h2></td></tr>
                                    <tr>
                                      <td style='padding:10px'>
                                     
                                      <div class='tab-pane fade in active' id='car-details'>
                                        <div class='intro box table-wrapper full-width hidden-table-sms'>
                                            <div class='col-sm-4 table-cell travelo-box'>
                                                <dl class='term-description'>
                                                                          
                                                <dt>Total Cost:</dt><dd>$200</dd>
                                                <dt>Service Fee:</dt><dd>$150</dd>
                                                 <dt>Taxes &amp; Fees:</dt><dd>$20.61</dd>
                                                <dt>Total price:</dt><dd>$1000</dd>
                                                <dt>Amount Paid:</dt><dd>$1000</dd>
                                                                                                    
                                                </dl>
                                                
                                            </div>
                                        <div class='col-sm-8 table-cell'>
                                            <div class='detailed-features clearfix'>
                                                <div class='col-md-6'>
                                                <h4 class='box-title' style='padding-left: 15px'>
                                                    Payment Status
                                                    <small>Reserved</small>
                                                </h4>
                                                <div class='icon-box style11'>
                                                    <div class='icon-wrapper'>
                                                       
                                                    </div>
                                                    <dl2 class='details2' style='padding-bottom: 0px'>
                                                        <dt2 class='skin-color'>Confirm Before</dt2>
                                                        <dd><small>Nov 14, 2013 |<br> 11:00 AM</small></dd>
                                                    </dl2>
                                                </div>
                                                <div class='icon-box style11'>
                                                    <div class='icon-wrapper'>
                                                       
                                                    </div>
                                                    <dl2 class='details2'>
                                                        <dt2 class='skin-color'>ACCOUNT</dt2>
                                                        <dd><small>Paid</small></dd>
                                                    </dl2>
                                                    <br>
                                                    
                                                </div>
                                                </div>
                                           <div class='col-md-6'>
                                                <h3 class='box-title' style='padding-left: 15px'>
                                                    Payment Mode
                                                    <small>Credit Card</small>
                                                </h3>
                                                <div class='icon-box style11'>
                                                    <div class='icon-wrapper'>
                                                        <i class='soap-icon-clock'></i>
                                                    </div>
                                                    <dl2 class='details2' style='padding-bottom: 10px'>
                                                        <dt2 class='skin-color'>Number of Guests</dt2>
                                                        <dd><small>2 Pax</small></dd>
                                                    </dl2>
                                                </div>
                                                <div class='icon-box style11'>
                                                    <div class='icon-wrapper'>
                                                        <i class='soap-icon-departure'></i>
                                                    </div>
                                                    <dl2 class='details2'>
                                                        <dt2 class='skin-color'>Cancellation Fee</dt2>
                                                        <dd><small>Free</small></dd>
                                                    </dl2>
                                                </div>
                                           </div>
                                         </div>
                                       </div>
                                     </div>
                                    </div>
                                   </td>
                                  </tr>
                               </table>
                                    
                                <table style='width:100%;' class='table'>
                                    <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                    <tr><td colspan='2' style='padding:10px;'><h2>Map</h2></td></tr>
                                    <tr>
                                      <td style='padding:10px'>
                                          <div class='tab-pane fade in active' id='car-details'>
                                            <div class='intro box table-wrapper full-width hidden-table-sms'>
                                               <div class='col-sm-4 table-cell travelo-box'>
                                                   <img src='https://travelafric.com/{$info->map_image}' style='width:100%' />
                                               </div>
                                               <div class='col-sm-8 table-cell'>
                                                 <div class='detailed-features clearfix'>
                                                 <img src='https://travelafric.com/{$info->map_image}' style='width:100%' />
                                                 </div>
                                               </div>
                                            </div>
                                          </div>
                                      </td>
                                     </tr>
                                </table>
                                
                                <table style='width:100%;' class='table'>
                                    <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                    <tr><td colspan='2' style='padding:10px;'><h2>Important Information</h2></td></tr>
                                    <tr><td colspan='2' style='padding:10px;'><h3>Transfer/Rental Policy</h3></td></tr>
                                    <tr><td style='padding:10px'>{$info->policy}</td></tr>
                                </table>
                                <div style='padding:20px 10px ;text-align:center; border-top:1px solid #777;margin-top:10px;background: #dee8eb;'>
                                   <a href='https://travelafric.com/' style='text-decoration:none;color:#555; '>&copy; {$year} Travelafric.com</a>     
                                    <p>All rights reserved</p>
                                    <p>Don't want to receive any more marketing offers in your confirmation emails?</p>
                                    <p>When communicating with your supplier via Travelafric.com, you agree with the terms and conditions of processing information communications as indicated in our Privacy Policy.</p>
                                </div>
                            </article>
                                
                                
                            </div>
                            </div>
                        </body>
                        </html>      
                        ";
                        $mail = new PHPMailer;
                        $mail->setFrom('info@travelafric.com', 'Team Travelafric');
                        $mail->addAddress($value['email'], $fullname);
                        $mail->addAddress($info->sup_email, $info->sup_name);
                        $mail->addAddress('info@travelafric.com');
                        $mail->addAddress($agentEmail);
                        $mail->Subject = 'Booking Voucher';
                        $mail->Body = $message;
                        $mail->IsHTML(true);
                        $mail->addAttachment($path,'Itinerary');
                        $mail->send();
                    }

                }elseif ($value['service']=='events') {
                    $eventId = $value['serviceId'];
                    $info = find_by_id('events',$eventId);
                    $transactionDetails = '{"id":"'.$eventId.'","name":"'.$fullname.'","tel":"'.$value['phone'].'","email":"'.$value['email'].'"}';
                    $recepit_id = substr(GUID(), 9,9);
                    $makeBooking = $conn->insert('booking',array('trans_id'=>$transactionId,'trans_type'=>'events','trans_details'=>$transactionDetails,'trans_cost'=>$value['subtotal'],'payment_status'=>1,'payment_mode'=>$mode,'booking_no'=>$recepit_id,'made_by'=>$agent) );
                    if ($makeBooking) {
                        //create notification
                        $conn->insert('notify',array('type'=>'Booking','tag'=>'events','comment'=>'New Events Booking.'));
                        //sending mail
                        $message = " 
                             <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.1//EN' 'http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd'>
                            <html xmlns='http://www.w3.org/1999/xhtml'>
                            <head>
                                <meta charset='utf-8'>
                                <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'>
                                <title>Confirmation Mail</title>
                                <style type='text/css'>
                                    body{font: 75% / 150% 'Lato', Arial, Helvetica, sans-serif;}
                                    *{margin:0px;padding:0px;font-weight:normal; } 
                                    h2{font-size:1.5em; color: #838383;}
                                    h3{color: #01b7f2}
                                    h4{font-size: 1.2333em; color: #01b7f2}
                                    dl{width:100%; }
                                    dl>dt, dl>dd{float: left;width:50%;padding:5px 0;text-transform:uppercase;font-size:11px  }
                                    dl>dd{padding-left:20px; }
                                    dl>dt{width:40%;color:#01b7f2;border-right: 1px solid #f5f5f5;clear: both; }
                                    dl2{letter-spacing: 0.04em;     margin-top: 0;margin-bottom: 20px;}
                                    dt2{font-weight: normal;line-height: 1.42857143;display: block;unicode-bidi: isolate;    letter-spacing: 0.04em}
                                    dd{margin-left: 0;line-height: 1.42857143;display: block; unicode-bidi: isolate;letter-spacing: 0.04em}
                                    #content {min-height: 400px; padding-top: 40px; text-align: left; background: #f5f5f5;}
                                    .gray-area {background: #f5f5f5;}
                                    .container {padding-right: 100px; padding-left: 100px; margin-right: auto; margin-left: auto;}
                                    .row {margin-right: 30px; margin-left: 30px;}
                                    #main {margin-bottom: 40px;}
                                    .booking-information.travelo-box { background: #fff; padding: 20px 30px 30px; margin-bottom: 30px;}
                                    clearfix{5}
                                    .clearfix:after,.clearfix:before,{display:table;content:' '}
                                    .character {font-size: 0.8333em;border-top: 1px solid #f5f5f5;border-bottom: 1px solid #f5f5f5;margin-bottom: 15px;display: table;width: 100%;table-layout: fixed;}
                                    .col-sm-4 {width: 33.33333333%;float: left;position: relative;min-height: 1px;}
                                    .col-sm-8{float: left;width: 58.66666667%; position: relative;min-height: 1px;}
                                    .col-xs-4 {width: 33.33333333%; position: relative;min-height: 1px;padding-right: 15px;}
                                    .col-xs-5 {width: 41.66666667%;position: relative;min-height: 1px;padding-right: 15px;padding-left: 15px;}
                                    .col-sm-4{position: relative;min-height: 1px;}
                                    .col-sm-8{position: relative;min-height: 1px;}
                                    .col-md-6 {width: 50%;float:left;position: relative;min-height: 1px;}

                                    .details {font-size: 0.8333em;padding: 0px 300px;text-transform: uppercase;}
                                    .character {border-top: 1px solid #f5f5f5;border-bottom: 1px solid #f5f5f5;margin-bottom: 15px;display: table;width: 100%;table-layout: fixed;}
                                    .character > div:first-child {font-size: 1.1333em; border: none;padding-left: 0;}
                                    .character > div {font-size: 1.1333em; display: table-cell;float: none;vertical-align: middle;margin: 0;padding-top: 12px;padding-bottom: 12px;}
                                    .skin-color {color: #01b7f2;}
                                    .box-title {font-size: 13px;text-transform: none;margin-bottom: 10px;letter-spacing: 0.04em;line-height: 1em;}
                                   
                                    .box-title small {font-size: 10px;color: #838383;text-transform: uppercase;display: block;margin-top: 4px;line-height: 1.8333em;}
                                    .price {float: none;text-align: center;color: #7db921;font-size: 1.6667em;text-transform: uppercase;float: right;text-align: center;line-height: 1;display: block;letter-spacing: 0.04em; line-height: 1.0333em;}
                                    .price small {display: block;color: #838383;font-size: 0.5em;   }
                                    .pull-left {float: left !important;}
                                    .pull-right {float: right !important;}
                                    span {border-color: #01b7f2;color: #01b7f2;}
                                    a.button {display: inline-block;background: #d9d9d9;font-size: 0.8333em;line-height: 1.8333em;white-space: nowrap;text-align: center;letter-spacing: 0.04em;}
                                    a.button:hover {background: #98ce44;}
                                    a.button.btn-small, a.button.full-width {font-weight: bold;height: 28px;padding: 0 24px;line-height: 28px;font-size: 0.9167em;}
                                    
                                    .intro.table-wrapper{padding: 0;border-spacing: 15px;border-collapse: separate;table-layout: fixed;margin-bottom: 15px;}
                                    #car-details{background: #ffffff;padding: 0;border-spacing: 15px;border-collapse: separate;table-layout: fixed;}
                                    .intro{background: #f5f5f5;margin-bottom: 15px;}
                                    .table-wrapper {display: table;}
                                    .full-width {width: 100% !important;}
                                    .fade.in {opacity: 1;}
                                    .fade{transition: opacity .15s linear;}
                                    .table-cell:first-child{margin-bottom: 15px;}
                                    .table-cell{background: #fff;}
                                    .travelo-box {padding: 25px 25px 20px 25px;margin: 0;}
                                    .table-wrapper .table-cell {display: table-cell;vertical-align: top;float: none !important;}
                                    .table-cell:last-child{padding-left: 0;padding-right: 0;}
                                    .details2 {width: 50%; text-transform: uppercase;display: table-cell;vertical-align: middle;letter-spacing: 0.04em;}
                                    .detailed-features {background: #fff;}
                                    .clearfix:before{display: table;content: ' ';box-sizing: border-box;}
                                    .clearfix:after:after{clear: both;display: table;content: ' ';}
                                    
                                </style>
                                
                            </head>
                            <body bgcolor=''>
                                <div style='background:#ccc;width:900px;padding:2px; margin:20px auto;'>
                                <div style='background:#fff;min-height:50px;padding:10px 5px '>
                                    <table style='width:100%;border-collapse: collapse;' class='table'>
                                        <tr style='background:#0b0061 '>
                                            <td colspan='2' style='background-color: #eeeeee; border:2px #eeeeee; padding:15px; padding-bottom: 20px; margin:-20px -30px -35px -30px'><h2>Event Booking Confirmation</h2></td>
                                            <td style='float: left; padding:10px 0;width:70%;'><img src='https://travelafric.com/res/images/logo3.png' height='40' width='50' alt='travelafric logo'></td>
                                        </tr>
                                        <tr style='background:#0b0061 '>
                                            <td colspan='2' style='background-color: #fff; border:2px #eeeeee; padding:10px; padding-bottom: 0px; margin:-20px -30px -35px -30px'>
                                                <div class='booking-confirmation clearfix'>
                                                  <i class='soap-icon-recommend icon circle'></i>
                                                    <div class='message'>
                                                      <h4>Thank You Simon. Your Booking Order is Now Confirmed.</h4>
                                                      <p style='line-height: 2.3em'>This is your confirmation email. Print this confirmation voucher and present to Supplier</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                    </table>    
                                    <table style='width:100%;' class='table'>    
                                        <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                        <tr><td colspan='2' style='padding:10px'><h2>Guest Information</h2></td></tr>
                                        <tr>
                                            <td style='padding:10px;' colspan=''>
                                                <dl class='term-description'>
                                                    <dt>Booking number:</dt><dd>{$recepit_id}</dd>
                                                    <dt>First name:</dt><dd>{$value['fname']}</dd>
                                                    <dt>Last name:</dt><dd>{$value['lname']}</dd>
                                                    <dt>E-mail address:</dt><dd>{$value['email']}</dd>
                                                    <dt>E-mail address:</dt><dd>{$value['phone']}</dd>
                                                    <dt>Address:</dt><dd>{$value['addr']}</dd> <!--enter address at booking details-->
                                                    <dt>City:</dt><dd>Paris,France</dd> <!--enter city at booking details-->
                                                    <dt>ZIP code:</dt><dd>75800-875</dd> <!--enter zip code at booking details-->
                                                    <dt>Country:</dt><dd>United States of america</dd><!--retrieve country using IP-->
                                                </dl>
                                            </td>
                                        </tr>
                                    </table>    
                                    <table style='width:100%;' class='table'>
                                        <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                        <tr><td colspan='2' style='padding:10px;'><h2>Booking Details</h2></td></tr>
                                        <tr class='booking-details'>
                                           
                                            
                                          </tr>
                                      </table>
                                    
                                    <article>       
                                        <figure class='col-sm-4'>
                                            <img src=''style='height:px;width:px;' alt='service_image'>
                                        </figure>
                                        <div class='details col-sm-8'>
                                        <div class='clearfix'>
                                            <h3 class='box-title pull-left'>".$value['pick_loc']." to ".$value['drop_loc']."<small>{$info->persons}</small><small>{$info->city}</small></h3>
                                            <span class='price pull-right'><small>Paid</small>$358</span>
                                        </div>
                                        <div class='character clearfix'>
                                            <div class='col-xs-4 date'>
                                                
                                                <div>
                                                    <span class='skin-color'>Event Date</span><br>".$value['pick_date']."
                                                </div>
                                            </div>
                                            <div class='col-xs-4 date'>
                                                
                                                <div>
                                                    <span class='skin-color'>Event Time</span><br>{$info->vehicle}
                                                </div>
                                            </div>
                                            <div class='col-xs-5 departure'>
                                                
                                                <div>
                                                    <span class='skin-color'>Type of Event</span><br>{$info->sup_name}
                                                </div>
                                            </div>
                                        </div>
                                        <div class='character clearfix'>
                                            <div class='col-xs-4 date'>
                                                
                                                <div>
                                                    <span class='skin-color'>Duration</span><br>".$value['pick_time']."
                                                </div>
                                            </div>
                                            <div class='col-xs-4 date'>
                                                
                                                <div>
                                                    <span class='skin-color'>Pax</span><br>".$value['adult']." - ".$value['kids']."
                                                </div>
                                            </div>
                                            <div class='col-xs-5 departure'>
                                                
                                                <div>
                                                    <span class='skin-color'>Organizer</span><br>Delta Flight 777
                                                </div>
                                            </div>
                                        </div>
                                        <div class='character clearfix'>
                                            <div class='col-xs-4 date'>
                                                
                                                <div>
                                                    <span class='skin-color'>Contact</span><br>{$info->sup_tel}
                                                </div>
                                                <!--<img src='http://placehold.it/110x25' alt='' />-->
                                            </div>
                                            <div class='col-xs-4 date'>
                                                <!--<i class='soap-icon-clock yellow-color'></i>-->
                                                <div>
                                                    <span class='skin-color'>Email</span><br>{$info->sup_email}
                                                </div>
                                            </div>
                                            <div class='col-xs-5 departure'>
                                                <!--<i class='soap-icon-departure yellow-color'></i>-->
                                                <div>
                                                    <span class='skin-color'>Cancellation Cost</span><br>$100
                                                </div>
                                            </div>
                                        </div>
                                            
                                        <div class='character clearfix'>
                                        <div class='review pull-left'>
                                            <div>
                                                <span class='skin-color'>Event Summary: </span> {$info->description}
                                            </div>
                                            </div>
                                        </div>

                                        <div class='clearfix'>
                                            <div class='review pull-left'>
                                                <span>Ticket # :</span>{$recepit_id}
                                                <br>
                                                <span>Cancellation :</span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                       
                                    <table style='width:100%;' class='table'>
                                        <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                        <tr><td colspan='2' style='padding:10px;'><h2>Payment</h2></td></tr>
                                        <tr>
                                          <td style='padding:10px'>
                                         
                                          <div class='tab-pane fade in active' id='car-details'>
                                            <div class='intro box table-wrapper full-width hidden-table-sms'>
                                                <div class='col-sm-4 table-cell travelo-box'>
                                                    <dl class='term-description'>
                                                                              
                                                    <dt>Total Cost:</dt><dd>$200</dd>
                                                    <dt>Service Fee:</dt><dd>$150</dd>
                                                     <dt>Taxes &amp; Fees:</dt><dd>$20.61</dd>
                                                    <dt>Total price:</dt><dd>$1000</dd>
                                                    <dt>Amount Paid:</dt><dd>$1000</dd>
                                                                                                        
                                                    </dl>
                                                    
                                                </div>
                                            <div class='col-sm-8 table-cell'>
                                                <div class='detailed-features clearfix'>
                                                    <div class='col-md-6'>
                                                    <h4 class='box-title' style='padding-left: 15px'>
                                                        Payment Status
                                                        <small>Reserved</small>
                                                    </h4>
                                                    <div class='icon-box style11'>
                                                        <div class='icon-wrapper'>
                                                           
                                                        </div>
                                                        <dl2 class='details2' style='padding-bottom: 0px'>
                                                            <dt2 class='skin-color'>Confirm Before</dt2>
                                                            <dd><small>Nov 14, 2013 |<br> 11:00 AM</small></dd>
                                                        </dl2>
                                                    </div>
                                                    <div class='icon-box style11'>
                                                        <div class='icon-wrapper'>
                                                           
                                                        </div>
                                                        <dl2 class='details2'>
                                                            <dt2 class='skin-color'>ACCOUNT</dt2>
                                                            <dd><small>Paid</small></dd>
                                                        </dl2>
                                                        <br>
                                                        
                                                    </div>
                                                    </div>
                                               <div class='col-md-6'>
                                                    <h3 class='box-title' style='padding-left: 15px'>
                                                        Payment Mode
                                                        <small>Credit Card</small>
                                                    </h3>
                                                    <div class='icon-box style11'>
                                                        <div class='icon-wrapper'>
                                                            <i class='soap-icon-clock'></i>
                                                        </div>
                                                        <dl2 class='details2' style='padding-bottom: 10px'>
                                                            <dt2 class='skin-color'><small>Number of Guests</small></dt2>
                                                            <dd><small>2 pax</small></dd>
                                                        </dl2>
                                                    </div>
                                                    <div class='icon-box style11'>
                                                        <div class='icon-wrapper'>
                                                            <i class='soap-icon-departure'></i>
                                                        </div>
                                                        <dl2 class='details2'>
                                                            <dt2 class='skin-color'>Cancellation Fee</dt2>
                                                            <dd><small>Free</small></dd>
                                                        </dl2>
                                                    </div>
                                               </div>
                                             </div>
                                           </div>
                                         </div>
                                        </div>
                                       </td>
                                      </tr>
                                   </table>
                                        
                                    <table style='width:100%;' class='table'>
                                        <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                        <tr><td colspan='2' style='padding:10px;'><h2>Map</h2></td></tr>
                                        <tr>
                                          <td style='padding:10px'>
                                              <div class='tab-pane fade in active' id='car-details'>
                                                <div class='intro box table-wrapper full-width hidden-table-sms'>
                                                   <div class='col-sm-4 table-cell travelo-box'>
                                                       QR CODE
                                                   </div>
                                                   <div class='col-sm-8 table-cell'>
                                                     <div class='detailed-features clearfix'></div>
                                                   </div>
                                                </div>
                                              </div>
                                          </td>
                                         </tr>
                                    </table>
                                          
                                    <table style='width:100%;' class='table'>
                                        <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                        <tr><td colspan='2' style='padding:10px;'><h2>Important Information</h2></td></tr>
                                        <tr><td colspan='2' style='padding:10px;'><h3>Transfer/Rental Policy</h3></td></tr>
                                        <tr><td style='padding:10px'>{$info->policy}</td></tr>
                                    </table>
                                    <div style='padding:20px 10px ;text-align:center; border-top:1px solid #777;margin-top:10px;background: #dee8eb;'>
                                       <a href='https://travelafric.com/' style='text-decoration:none;color:#555; '>&copy; {$year} Travelafric.com</a>     
                                        <p>All rights reserved</p>
                                        <p>Don't want to receive any more marketing offers in your confirmation emails?</p>
                                        <p>When communicating with your supplier via Travelafric.com, you agree with the terms and conditions of processing information communications as indicated in our Privacy Policy.</p>
                                    </div>
                                </article>
                                    
                                    
                              </div>
                            </div>
                        </body>
                        </html>      
                        ";
                        $mail = new PHPMailer;
                        $mail->setFrom('info@travelafric.com', 'Team Travelafric');
                        $mail->addAddress($value['email'], $fullname);
                        $mail->addAddress($info->sup_email, $info->sup_name);
                        $mail->addAddress('info@travelafric.com');
                        $mail->addAddress($agentEmail);
                        $mail->Subject = 'Booking Voucher';
                        $mail->Body = $message;
                        $mail->IsHTML(true);
                        $mail->send();
                    }
                    
                }elseif ($value['service']=='hotel') {
                    $roomdetails = find_by_id('rooms',$value['roomId']);
                    $info = find_by_id('clients',$value['serviceId']);
                    $date = new DateTime($value['checkin']);
                    $cancellation_date = $date->sub(new DateInterval('P1D'))->format('d-m-Y');
                    $recepit_id = substr(GUID(), 9,9);

                    $transactionDetails = '{"roomId":"'.$value['roomId'].'","hotelId":"'.$value['serviceId'].'","name":"'.$fullname.'","tel":"'.$value['phone'].'",
                    "email":"'.$value['email'].'","adult":"'.$value['adult'].'","child":"'.$value['kids'].'","checkin":"'.$value['checkin'].'","checkout":"'.$value['checkout'].'",
                    "days":"'.$value['duration'].'","roomqty":"'.$value['roomqty'].'"}';
                    //"request":"","breakfast":"","rollaway":"","extrabed":"","city":"","zip":"",
                    // update the room quantity
                    $conn->query("UPDATE rooms SET vacant = vacant - {$value['roomqty']} WHERE id = {$value['roomId']} ");

                    //insert booking date into availability table
                    $start = $date->add(new DateInterval('P0D'))->format('Y-m-d');
                    $end = $date->add(new DateInterval('P1D'))->format('Y-m-d');
                    for ($i=0; $i <= $days ; $i++) { 
                        //echo $start.'-'.$end;
                        $conn->insert('availability',array('hId'=>$value['serviceId'],'rId'=>$value['roomId'],'title'=>"{$roomdetails->name} Booked",'start'=>$start,'ending'=>$end ) );
                        $start = $date->add(new DateInterval('P0D'))->format('Y-m-d');
                        $end = $date->add(new DateInterval('P1D'))->format('Y-m-d');
                    }

                    // insert booking
                    $makeBooking = $conn->insert('booking',array('trans_id'=>$transactionId,'trans_type'=>'hotels','trans_details'=>$transactionDetails,'trans_cost'=>$value['subtotal'],'payment_status'=>1,'payment_mode'=>$mode,'booking_no'=>$recepit_id,'made_by'=>$agent) );

                    //create notification
                    $conn->insert('notify',array('type'=>'Booking','tag'=>'hotels','comment'=>'New Hotel Booking.'));

                    //sending email 
                    $message = " 
                            <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.1//EN' 'http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd'>
                    <html xmlns='http://www.w3.org/1999/xhtml'>
                    <head>
                        <meta charset='utf-8'>
                        <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'>
                        <title>Confirmation Mail</title>
                        <style type='text/css'>
                            body{font: 75% / 150% 'Lato', Arial, Helvetica, sans-serif;}
                            *{margin:0px;padding:0px;font-weight:normal; } 
                            h2{font-size:1.5em; color: #838383;}
                            h3{color: #01b7f2}
                            h4{font-size: 1.2333em; color: #01b7f2}
                            dl{width:100%; }
                            dl>dt, dl>dd{float: left;width:50%;padding:5px 0;text-transform:uppercase;font-size:11px  }
                            dl>dd{padding-left:20px; }
                            dl>dt{width:40%;color:#01b7f2;border-right: 1px solid #f5f5f5;clear: both; }
                            dl2{letter-spacing: 0.04em;     margin-top: 0;margin-bottom: 20px;}
                            dt2{font-weight: normal;line-height: 1.42857143;display: block;unicode-bidi: isolate;    letter-spacing: 0.04em}
                            dd{margin-left: 0;line-height: 1.42857143;display: block; unicode-bidi: isolate;letter-spacing: 0.04em}
                            #content {min-height: 400px; padding-top: 40px; text-align: left; background: #f5f5f5;}
                            .gray-area {background: #f5f5f5;}
                            .container {padding-right: 100px; padding-left: 100px; margin-right: auto; margin-left: auto;}
                            .row {margin-right: 30px; margin-left: 30px;}
                            #main {margin-bottom: 40px;}
                            .booking-information.travelo-box { background: #fff; padding: 20px 30px 30px; margin-bottom: 30px;}
                            clearfix{5}
                            .clearfix:after,.clearfix:before,{display:table;content:' '}
                            .character {font-size: 0.8333em;border-top: 1px solid #f5f5f5;border-bottom: 1px solid #f5f5f5;margin-bottom: 15px;display: table;width: 100%;table-layout: fixed;}
                            .col-sm-4 {width: 33.33333333%;float: left;position: relative;min-height: 1px;}
                            .col-sm-8{float: left;width: 58.66666667%; position: relative;min-height: 1px;}
                            .col-xs-4 {width: 33.33333333%; position: relative;min-height: 1px;padding-right: 15px;}
                            .col-xs-5 {width: 41.66666667%;position: relative;min-height: 1px;padding-right: 15px;padding-left: 15px;}
                            .col-sm-4{position: relative;min-height: 1px;}
                            .col-sm-8{position: relative;min-height: 10px;}
                            .col-md-6 {width: 50%;float:left;position: relative;min-height: 1px;}

                            .details {font-size: 0.8333em;padding: -10px 300px;text-transform: uppercase;}
                            .character {border-top: 1px solid #f5f5f5;border-bottom: 1px solid #f5f5f5;margin-bottom: 15px;display: table;width: 100%;table-layout: fixed;}
                            .character > div:first-child {font-size: 1.1333em; border: none;padding-left: 0;}
                            .character > div {font-size: 1.1333em; display: table-cell;float: none;vertical-align: middle;margin: 0;padding-top: 12px;padding-bottom: 12px;}
                            .skin-color {color: #01b7f2;}
                            .box-title {font-size: 13px;text-transform: none;margin-bottom: 10px;letter-spacing: 0.04em;line-height: 1em;}
                           
                            .box-title small {font-size: 10px;color: #838383;text-transform: uppercase;display: block;margin-top: 4px;line-height: 1.8333em;}
                            .price {float: none;text-align: center;color: #7db921;font-size: 1.6667em;text-transform: uppercase;float: right;text-align: center;line-height: 1;display: block;letter-spacing: 0.04em; line-height: 1.0333em;}
                            .price small {display: block;color: #838383;font-size: 0.5em;   }
                            .pull-left {float: left !important;}
                            .pull-right {float: right !important;}
                            span {border-color: #01b7f2;color: #01b7f2;}
                            a.button {display: inline-block;background: #d9d9d9;font-size: 0.8333em;line-height: 1.8333em;white-space: nowrap;text-align: center;letter-spacing: 0.04em;}
                            a.button:hover {background: #98ce44;}
                            a.button.btn-small, a.button.full-width {font-weight: bold;height: 28px;padding: 0 24px;line-height: 28px;font-size: 0.9167em;}
                            
                            .intro.table-wrapper{padding: 0;border-spacing: 15px;border-collapse: separate;table-layout: fixed;margin-bottom: 15px;}
                            #car-details{background: #ffffff;padding: 0;border-spacing: 15px;border-collapse: separate;table-layout: fixed;}
                            .intro{background: #f5f5f5;margin-bottom: 15px;}
                            .table-wrapper {display: table;}
                            .full-width {width: 100% !important;}
                            .fade.in {opacity: 1;}
                            .fade{transition: opacity .15s linear;}
                            .table-cell:first-child{margin-bottom: 15px;}
                            .table-cell{background: #fff;}
                            .travelo-box {padding: 25px 25px 20px 25px;margin: 0;}
                            .table-wrapper .table-cell {display: table-cell;vertical-align: top;float: none !important;}
                            .table-cell:last-child{padding-left: 0;padding-right: 0;}
                            .details2 {width: 50%; text-transform: uppercase;display: table-cell;vertical-align: middle;letter-spacing: 0.04em;}
                            .detailed-features {background: #fff;}
                            .clearfix:before{display: table;content: ' ';box-sizing: border-box;}
                            .clearfix:after:after{clear: both;display: table;content: ' ';}
                            
                        </style>
                        
                    </head>
                    <body bgcolor=''>
                        <div style='background:#ccc;width:900px;padding:2px; margin:20px auto;'>
                        <div style='background:#fff;min-height:50px;padding:10px 5px '>
                            <table style='width:100%;border-collapse: collapse;' class='table'>
                                <tr style='background:#0b0061 '>
                                    <td colspan='2' style='background-color: #eeeeee; border:2px #eeeeee; padding:15px; padding-bottom: 20px; margin:-20px -30px -35px -30px'><h2>Aparthotel Booking Confirmation</h2></td>
                                    <td style='float: left; padding:10px 0;width:70%;'><img src='https://travelafric.com/res/images/logo3.png' height='40' width='50' alt='travelafric logo'></td>
                                </tr>
                                <tr style='background:#0b0061 '>
                                    <td colspan='2' style='background-color: #fff; border:2px #eeeeee; padding:10px; padding-bottom: 0px; margin:-20px -30px -35px -30px'>
                                        <div class='booking-confirmation clearfix'>
                                          <i class='soap-icon-recommend icon circle'></i>
                                            <div class='message'>
                                              <h4>Thank You Simon. Your Booking Order is Now Confirmed.</h4>
                                              <p style='line-height: 2.3em'>This is your confirmation email. Print this confirmation voucher and present to Supplier</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                
                            </table>    
                            <table style='width:100%;' class='table'>    
                                <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                <tr><td colspan='2' style='padding:10px'><h2>Guest Information</h2></td></tr>
                                <tr>
                                    <td style='padding:10px;' colspan=''>
                                        <dl class='term-description'>
                                            <dt>Booking number:</dt><dd>{$recepit_id}</dd>
                                            <dt>First name:</dt><dd>{$value['fname']}</dd>
                                            <dt>Last name:</dt><dd>{$value['lname']}</dd>
                                            <dt>E-mail address:</dt><dd>{$value['email']}</dd>
                                            <dt>E-mail address:</dt><dd>{$value['phone']}</dd>
                                            <dt>Address:</dt><dd>{$value['addr']}</dd> <!--enter address at booking details-->
                                            <dt>City:</dt><dd>Paris,France</dd> <!--enter city at booking details-->
                                            <dt>ZIP code:</dt><dd>75800-875</dd> <!--enter zip code at booking details-->
                                            <dt>Country:</dt><dd>United States of america</dd><!--retrieve country using IP-->
                                        </dl>
                                    </td>
                                </tr>
                            </table>    
                            <table style='width:100%;' class='table'>
                                <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                <tr><td colspan='2' style='padding:10px;'><h2>Booking Details</h2></td></tr>
                                <tr class='booking-details'>
                                   
                                    
                                  </tr>
                              </table>
                            
                            <article>       
                                <figure class='col-sm-4'>
                                    <img src='' style='height:px;width:px;' alt='service_image'>
                                </figure>
                                <div class='details col-sm-8'>
                                <div class='clearfix'>
                                    <h3 class='box-title pull-left'>{$info->company_name}
                                        <small>{$value['duration']} Night(s)</small>
                                        <small>".$value['adult']." - ".$value['kids']."</small></h3>
                                    <span class='price pull-right'><small>Paid</small>$358</span>
                                </div>
                                <div class='character clearfix'>
                                    <div class='col-xs-4 date'>
                                        
                                        <div>
                                            <span class='skin-color'>Check-In</span><br>".get_date($value['checkin'])."
                                        </div>
                                        <!--<img src='http://placehold.it/110x25' alt='' />-->
                                    </div>
                                    <div class='col-xs-4 date'>
                                        <!--<i class='soap-icon-clock yellow-color'></i>-->
                                        <div>
                                            <span class='skin-color'>Check-Out</span><br>".get_date($value['checkout'])."
                                        </div>
                                    </div>
                                    <div class='col-xs-5 departure'>
                                       
                                        <div>
                                            <span class='skin-color'>Room Type</span><br>{$roomdetails->name}
                                        </div>
                                    </div>
                                </div>
                                <div class='character clearfix'>
                                    <div class='col-xs-4 date'>
                                        
                                        <div>
                                            <span class='skin-color'>No. of Guests</span><br>".$value['adult']." - ".$value['kids']."
                                        </div>
                                        
                                    </div>
                                    <div class='col-xs-4 date'>
                                        <!--<i class='soap-icon-clock yellow-color'></i>-->
                                        <div>
                                            <span class='skin-color'>Meal Plan</span><br>{$roomdetails->meal_plan}
                                        </div>
                                    </div>
                                    <div class='col-xs-5 departure'>
                                        <!--<i class='soap-icon-departure yellow-color'></i>-->
                                        <div>
                                            <span class='skin-color'>Number of Rooms</span><br>{$value['roomqty']} Room(s)
                                        </div>
                                    </div>
                                </div>
                                <div class='character clearfix'>
                                    <div class='review pull-left'>
                                        
                                        <div>
                                            <span class='skin-color' >Location : </span> {$jsonHotel->address}
                                        </div>
                                        <!--<img src='http://placehold.it/110x25' alt='' />-->
                                    </div>
                                </div>
                                
                                <div class='character clearfix'>
                                    <div class='col-xs-4 date'>
                                        
                                        <div>
                                            <span class='skin-color'>Contact</span><br>{$jsonHotel->telephone}
                                        </div>
                                        <!--<img src='http://placehold.it/110x25' alt='' />-->
                                    </div>
                                    <div class='col-xs-4 date'>
                                        <!--<i class='soap-icon-clock yellow-color'></i>-->
                                        <div>
                                            <span class='skin-color'>Email</span><br>{$jsonHotel->email}
                                        </div>
                                    </div>
                                    <div class='col-xs-5 departure'>
                                        <!--<i class='soap-icon-departure yellow-color'></i>-->
                                        <div>
                                            <span class='skin-color'>Cancellation Cost</span><br>$100
                                        </div>
                                    </div>
                                </div>
                                <div class='character clearfix'>
                                    <div class='review pull-left'>
                                        
                                        <div>
                                            <span class='skin-color'>Amenities : </span> No.109-113, Changxing Road, Tianhe Bus Station, Tianhe, Guangzhou, 510500,
                                        </div>
                                        <!--<img src='http://placehold.it/110x25' alt='' />-->
                                    </div>
                                </div>
                                <div class='clearfix'>
                                    <div class='review pull-left'>
                                        <!--<div class='five-stars-container'>
                                            <span class='five-stars' style='width: 60%;'></span>
                                        </div>-->
                                        <span class='skin-color'>Ref No :</span>{$recepit_id}
                                        <br>
                                        <span class='skin-color'>Cancellation Policy :  </span> Cancel for Free until 18 Oct, 18:00
                                        <br>
                                        
                                    </div>
                                    
                                </div>

                                </div>
                               
                            <table style='width:100%;' class='table'>
                                <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                <tr><td colspan='2' style='padding:10px;'><h2>Payment</h2></td></tr>
                                <tr>
                                  <td style='padding:10px'>
                                 
                                  <div class='tab-pane fade in active' id='car-details'>
                                    <div class='intro box table-wrapper full-width hidden-table-sms'>
                                        <div class='col-sm-4 table-cell travelo-box'>
                                            <dl class='term-description'>
                                                                      
                                            <dt>Total Cost:</dt><dd>$200</dd>
                                            <dt>Service Fee:</dt><dd>$150</dd>
                                             <dt>Taxes &amp; Fees:</dt><dd>$20.61</dd>
                                            <dt>Total price:</dt><dd>$1000</dd>
                                            <dt>Amount Paid:</dt><dd>$1000</dd>
                                                                                                
                                            </dl>
                                            
                                        </div>
                                    <div class='col-sm-8 table-cell'>
                                        <div class='detailed-features clearfix'>
                                            <div class='col-md-6'>
                                            <h4 class='box-title' style='padding-left: 15px'>
                                                Payment Status
                                                <small>Reserved</small>
                                            </h4>
                                            <div class='icon-box style11'>
                                                <div class='icon-wrapper'>
                                                   
                                                </div>
                                                <dl2 class='details2' style='padding-bottom: 0px'>
                                                    <dt2 class='skin-color'>Confirm Before</dt2>
                                                    <dd><small>Nov 14, 2013 |<br> 11:00 AM</small></dd>
                                                </dl2>
                                            </div>
                                            <div class='icon-box style11'>
                                                <div class='icon-wrapper'>
                                                   
                                                </div>
                                                <dl2 class='details2'>
                                                    <dt2 class='skin-color'>ACCOUNT</dt2>
                                                    <dd><small>Paid</small></dd>
                                                </dl2>
                                                <br>
                                                
                                            </div>
                                            </div>
                                       <div class='col-md-6'>
                                            <h3 class='box-title' style='padding-left: 15px'>
                                                Payment Mode
                                                <small>Credit Card</small>
                                            </h3>
                                            <div class='icon-box style11'>
                                                <div class='icon-wrapper'>
                                                    <i class='soap-icon-clock'></i>
                                                </div>
                                                <dl2 class='details2' style='padding-bottom: 10px'>
                                                    <dt2 class='skin-color'><small>Number of Guests</small></dt2>
                                                    <dd><small>2 pax</small></dd>
                                                </dl2>
                                            </div>
                                            <div class='icon-box style11'>
                                                <div class='icon-wrapper'>
                                                    <i class='soap-icon-departure'></i>
                                                </div>
                                                <dl2 class='details2'>
                                                    <dt2 class='skin-color'>Cancellation Fee</dt2>
                                                    <dd><small>Free</small></dd>
                                                </dl2>
                                            </div>
                                       </div>
                                     </div>
                                   </div>
                                 </div>
                                </div>
                               </td>
                              </tr>
                           </table>
                                
                            <table style='width:100%;' class='table'>
                                <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                <tr><td colspan='2' style='padding:10px;'><h2>Map</h2></td></tr>
                                <tr>
                                  <td style='padding:10px'>
                                      <div class='tab-pane fade in active' id='car-details'>
                                        <div class='intro box table-wrapper full-width hidden-table-sms'>
                                           <div class='col-sm-4 table-cell travelo-box'>
                                           </div>
                                           <div class='col-sm-8 table-cell'>
                                             <div class='detailed-features clearfix'>
                                               <img src='https://travelafric.com/{$info->map_image}' style='width:100%' /></div>
                                           </div>
                                        </div>
                                      </div>
                                  </td>
                                 </tr>
                            </table>
                            
                                
                                
                                
                            <table style='width:100%;' class='table'>
                                <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                <tr><td colspan='2' style='padding:10px;'><h2>Important Information</h2></td></tr>
                                <tr><td colspan='2' style='padding:10px;'><h3>{$jsonHotel->norms}</h3></td></tr>
                                <tr><td style='padding:10px'>{$jsonHotel->notes}</td></tr>
                            </table>
                            <div style='padding:20px 10px ;text-align:center; border-top:1px solid #777;margin-top:10px;background: #dee8eb;'>
                               <a href='https://travelafric.com/' style='text-decoration:none;color:#555; '>&copy; {$year} Travelafric.com</a>     
                                <p>All rights reserved</p>
                                <p>Don't want to receive any more marketing offers in your confirmation emails?</p>
                                <p>When communicating with your supplier via Travelafric.com, you agree with the terms and conditions of processing information communications as indicated in our Privacy Policy.</p>
                            </div>
                            </article>
                            
                            
                            </div>
                          </div>
                       
                    </body>
                    </html>    
                    ";
                    $mail = new PHPMailer;
                    $mail->setFrom('info@travelafric.com', 'Team Travelafric');
                    $mail->addAddress($value['email'], $fullname);
                    $mail->addAddress($info->sup_email, $info->sup_name);
                    $mail->addAddress('info@travelafric.com');
                    $mail->addAddress($agentEmail);
                    $mail->Subject = 'Booking Voucher';
                    $mail->Body = $message;
                    $mail->IsHTML(true);
                    $mail->send();    

                }
            }

            //update agent account balance
            $newBalance = $currentBalance->balance - $total;
            $accountBalance = $conn->query("UPDATE accounts SET balance = $newBalance WHERE cust_id = $agent");
            //clear cart items
            unset($_SESSION['cart']);
            /*--Session::flash('success','Transaction completed');--*/
            Redirect::to('booking-voucher.php');
        }        
    }
