<?php
    ob_start();
    require_once 'cctech-admin/core/init.php';
    require 'PHPMailer/PHPMailerAutoload.php';

    $paylive= Config::get('slydepay/paylive');
    $ns= Config::get('slydepay/namespace');
    $wsdl= Config::get('slydepay/wsdl');
    $api_version= Config::get('slydepay/version');
    $merchant_email= Config::get('slydepay/merchantEmail');
    $merchant_secret_key= Config::get('slydepay/merchantKey');
    $service_type= Config::get('slydepay/serviceType');
    $integration_mode= Config::get('slydepay/integrationmode');
    $iwl = new IwalletConnector($ns, $wsdl, $api_version, $merchant_email, $merchant_secret_key, $service_type, $integration_mode);


    $statusRedirect = ("http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']));
    $statusCode = filter_input(INPUT_GET, "status", FILTER_SANITIZE_STRING);echo '<br>';
    $transactionId = filter_input(INPUT_GET, "transac_id", FILTER_SANITIZE_STRING);echo '<br>';
    $orderId = filter_input(INPUT_GET, "cust_ref", FILTER_SANITIZE_STRING);echo '<br>';
    $paymentToken = filter_input(INPUT_GET, "pay_token", FILTER_SANITIZE_STRING);

    $statusCodeValue = parseTransactionStatusCode($statusCode);
    
    if(null == $statusCode || null == $orderId || null == $paymentToken){
        Session::flash('danger',"Not good, details are missing or someone is messing with you");
        Redirect::to($statusRedirect);
    }

    //var_dump($_SESSION['cart']);
    
    
    switch ($statusCodeValue ){
        case "success":
            confirmPayment($orderId);
            $iwl->ConfirmTransaction($paymentToken, $transactionId);
            //unset($_SESSION['cart']);
            Session::delete('cart');
            Session::flash('success', 'Thank you for booking with us. Please check your mail for confirmation message');
            //Redirect::to($statusRedirect);
            Redirect::to('https://travelafric.com/cart.php');
            break;
        case "cancelled":
            $iwl->CancelTransaction($paymentToken, $transactionId);
            Session::flash('cancelled', 'Your transaction was cancelled. ');
            //Redirect::to($statusRedirect);
            Redirect::to('https://travelafric.com/cart.php');
            break;
        case "error":
            Session::flash('error', 'There was an error in transaction. ');
            //Redirect::to($statusRedirect);
            Redirect::to('https://travelafric.com/cart.php');
            break;
        default:
            $status = "unknown";
    }
    
     
    function parseTransactionStatusCode($statusCode) {
        $status = "";
        switch ($statusCode){
            case "0":
                $status = "success";
                break;
            case "-2":
                $status = "cancelled";
                break;
            case "-1":
                $status = "error";
                break;
            default:
                $status = "unknown";
           
        }
        return $status;
    }

    function confirmPayment($orderid){
        $client = new Client();
        $agent = ''; $agentEmail = '';
        if( $client->isLoggedIn() ) {
            if ($client->data()->groups == 2) {
                $agent = $client->data()->id;
                $agentEmail = $client->data()->email;
            }else{$agent = ''; $agentEmail = '';}
        }else{$agent = ''; $agentEmail='';}

        $year = date('Y');
        
        $transactionDetails = find_by_transactionId($orderid);

        foreach ($_SESSION['cart'] as $value){

            if ($transactionDetails->trans_type == 'hotels') {
                $roomId = $value['roomId'];
                $hotelId = $value['serviceId'];
                $roomQty = $value['roomqty'];
                $roomdetails = find_by_id('rooms',$roomId);
                $checkIn = $value['checkin'];
                $checkOut = $value['checkout'];
                $days = $value['duration'];
                $info = find_by_id('clients',$hotelId); $jsonHotel = json_decode($info->company_details);
                $date = new DateTime($checkIn);
                $cancellation_date = $date->sub(new DateInterval('P1D'))->format('d-m-Y');

                $fullname = $value['fname'].' '.$value['lname'];
                $recepit_id = substr(GUID(), 9,9);

                //update payment statue to true
                $sql = DB::getInstance()->query("UPDATE booking SET payment_status = '1', booking_no='$recepit_id' WHERE trans_id = '{$orderid}' ");

                // update the room quantity
                DB::getInstance()->query("UPDATE rooms SET vacant = vacant - $roomQty WHERE id = $roomId");

                //create notification
                DB::getInstance()->insert('notify',array('type'=>'Booking','tag'=>$transactionDetails->trans_type,'comment'=>'New Hotel Booking.'));

                //insert booking date into availability table
                $start = $date->add(new DateInterval('P0D'))->format('Y-m-d');
                $end = $date->add(new DateInterval('P1D'))->format('Y-m-d');
                for ($i=0; $i <= $days ; $i++) { 
                    DB::getInstance()->insert('availability',array('hId'=>$hotelId,'rId'=>$roomId,'title'=>"{$roomdetails->name} Booked",'start'=>$start,'ending'=>$end ) );
                    $start = $date->add(new DateInterval('P0D'))->format('Y-m-d');
                    $end = $date->add(new DateInterval('P1D'))->format('Y-m-d');
                }

                $message = " 
                        <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.1//EN' 'http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd'>
                        <html xmlns='http://www.w3.org/1999/xhtml'>
                        <head>
                            <meta charset='utf-8'>
                            <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'>
                            <title>Confirmation Mail</title>
                            <style type='text/css'>
                                *{margin:0px;padding:0px;font-weight:normal; } 
                                h2{font-size:1.2em;}
                                
                                dl{width:100%; }
                                dl>dt, dl>dd{float: left;width:50%;padding:5px 0;text-transform:uppercase;font-size:13px  }
                                dl>dd{padding-left:20px; }
                                dl>dt{width:40%;color:#01b7f2;border-right: 1px solid #f5f5f5;clear: both; }
                                
                            </style>
                        </head>
                        <body bgcolor=''>
                            <div style='background:#ccc;width:900px;padding:2px; margin:20px auto;'>
                            <div style='background:#fff;min-height:50px;padding:10px 5px '>
                                <table style='width:100%;border-collapse: collapse;' class='table'>
                                    <tr style='background:#0b0061 '>
                                        <td colspan='2' style='text-align:center;color:#fff;'><h2 style='padding:7px'>Booking Confirmation</h2></td>
                                    </tr>
                                    <tr style='background: #dee8eb;'>
                                        <td style='padding:10px 0;width:70%'><img src='https://travelafric.com/res/images/logo3.png' height='60' width='156' alt='travelafric logo'></td>
                                        <td style='padding:10px 0'>
                                            <div style='float:right;padding-right:5px '>
                                                <h2>{$info->company_name}</h2>
                                                <h6>{$jsonHotel->address}</h6>
                                                <h6>{$jsonHotel->email}, {$jsonHotel->telephone}</h6>
                                            </div>
                                        </td>
                                    </tr>
                                </table>    
                                <table style='width:100%;' class='table'>    
                                    <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                    <tr><td colspan='2' style='padding:10px'><h2>Custmer Information</h2></td></tr>
                                    <tr>
                                        <td style='padding:10px;' colspan=''>
                                            <dl class='term-description'>
                                                <dt>Booking number:</dt><dd>{$recepit_id}</dd>
                                                <dt>First name:</dt><dd>{$value['fname']}</dd>
                                                <dt>Last name:</dt><dd>{$value['lname']}</dd>
                                                <dt>E-mail address:</dt><dd>{$value['email']}</dd>
                                            </dl>
                                        </td>
                                        <td>
                                            <img src='https://travelafric.com/'".$value['serviceImage']."' style='height:100px;width:120px;' alt='service_image'>
                                        </td>
                                    </tr>
                                </table>    
                                <table style='width:100%;' class='table'>
                                    <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                    <tr><td colspan='2' style='padding:10px;'><h2>Booking Details</h2></td></tr>
                                    <tr class='booking-details'>
                                        <td style='padding:10px'>
                                            <dl class='term-description'>
                                                <dt>Room type:</dt><dd>{$roomdetails->name}</dd>
                                                <dt>Check-In Date:</dt><dd>".get_date($value['checkin'])."</dd>
                                                <dt>No. of Nights:</dt><dd>{$value['duration']} Night(s)</dd>
                                                <dt>No. of Guest:</dt><dd>".$value['adult']."</dd>
                                            </dl>
                                        </td>

                                        <td style='padding:10px' >
                                            <dl class='term-description'>
                                                <dt>Meal plan:</dt><dd>{$roomdetails->meal_plan}</dd>
                                                <dt>Check-Out Date:</dt><dd>".get_date($value['checkout'])."</dd>
                                                <dt>No. of Rooms:</dt><dd>{$value['roomqty']} Room(s)</dd>
                                                <dt>No. of Children:</dt><dd>".$value['kids']."</dd>
                                            </dl>
                                        </td>
                                    </tr>
                                </table>    
                                <table style='width:100%;' class='table'>
                                    <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                    <tr><td colspan='2' style='padding:10px;'><h2>Hotel Norm</h2></td></tr>
                                    <tr><td style='padding:10px'><p>{$jsonHotel->norms}</p></td></tr>

                                    <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                    <tr><td colspan='2' style='padding:10px;'><h2>General Policy</h2></td></tr>
                                    <tr><td style='padding:10px'><p>{$jsonHotel->notes}</p></td></tr>
                                    <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                    <tr><td colspan='2'><img src='https://travelafric.com/{$info->map_image}' style='width:100%' /></td></tr>
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
                $mail->addAddress($jsonHotel->email, $info->company_name);
                $mail->addAddress('info@travelafric.com');
                $mail->addAddress($agentEmail);
                $mail->Subject = 'Booking Invoice';
                $mail->Body = $message;
                $mail->IsHTML(true); 
                $mail->send();   
                if(!$mail->send()) {
                    echo 'Mailer error: '.$mail->ErrorInfo;
                }
            }elseif ($transactionDetails->trans_type == 'transfers') {
                $cost = $value['subtotal'];
                $transferId = $value['serviceId'];
                $info = find_by_id('transfers',$transferId);
                $fullname = $value['fname'].' '.$value['lname'];
                $recepit_id = substr(GUID(), 9,9);

                //update payment statue to true
                $sql = DB::getInstance()->query("UPDATE booking SET payment_status = '1', booking_no='$recepit_id' WHERE trans_id = '{$orderid}' ");

                //create notification
                DB::getInstance()->insert('notify',array('type'=>'Booking','tag'=>$transactionDetails->trans_type,'comment'=>'New transfer booking.'));
                //sending email 
                $message = " 
                        <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.1//EN' 'http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd'>
                        <html xmlns='http://www.w3.org/1999/xhtml'>
                        <head>
                            <meta charset='utf-8'>
                            <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'>
                            <title>Confirmation Mail</title>
                            <style type='text/css'>
                                *{margin:0px;padding:0px;font-weight:normal; } 
                                h2{font-size:1.2em;}
                                dl{width:100%; }
                                dl>dt, dl>dd{float: left;width:50%;padding:5px 0;text-transform:uppercase;font-size:13px  }
                                dl>dd{padding-left:20px; }
                                dl>dt{width:40%;color:#01b7f2;border-right: 1px solid #f5f5f5;clear: both; }
                            </style>
                        </head>
                        <body bgcolor=''>
                            <div style='background:#ccc;width:900px;padding:2px; margin:20px auto;'>
                            <div style='background:#fff;min-height:50px;padding:10px 5px '>
                                <table style='width:100%;border-collapse: collapse;' class='table'>
                                    <tr style='background:#0b0061 '>
                                        <td colspan='2' style='text-align:center;color:#fff;'><h2 style='padding:7px'>Booking Confirmation</h2></td>
                                    </tr>
                                    <tr style='background: #dee8eb;'>
                                        <td style='padding:10px 0;width:70%'><img src='https://travelafric.com/res/images/logo3.png' height='60' width='156' alt='travelafric logo'></td>
                                        <td style='padding:10px 0'>
                                            <div style='float:right;padding-right:5px '>
                                                <h2>{$info->sup_name}</h2>
                                                <h6>{$info->sup_addr}</h6>
                                                <h6>{$info->sup_email}, {$info->sup_tel}</h6>
                                            </div>
                                        </td>
                                    </tr>
                                </table>    
                                <table style='width:100%;' class='table'>    
                                    <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                    <tr><td colspan='2' style='padding:10px'><h2>Custmer Information</h2></td></tr>
                                    <tr>
                                        <td style='padding:10px;' colspan=''>
                                            <dl class='term-description'>
                                                <dt>Booking number:</dt><dd>{$recepit_id}</dd>
                                                <dt>First name:</dt><dd>{$value['fname']}</dd>
                                                <dt>Last name:</dt><dd>{$value['lname']}</dd>
                                                <dt>E-mail address:</dt><dd>{$value['email']}</dd>
                                            </dl>
                                        </td>
                                        <td>
                                            <img src='https://travelafric.com/'".$value['serviceImage']."' style='height:100px;width:120px;' alt='service_image'>
                                        </td>
                                    </tr>
                                </table>    
                                <table style='width:100%;' class='table'>
                                    <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                    <tr><td colspan='2' style='padding:10px;'><h2>Booking Details</h2></td></tr>
                                    <tr class='booking-details'>
                                        <td style='padding:10px'>
                                            <dl class='term-description'>
                                                <dt>Service Type:</dt><dd>{$info->cat}</dd>
                                                <dt>Location:</dt><dd>{$info->city} - {$info->country}</dd>
                                                <dt>No. of Persons:</dt><dd>{$info->persons}</dd>
                                                <dt>Vehicle Type:</dt><dd>{$info->vehicle}</dd>
                                                <dt>Pick Up:</dt><dd>{$info->pick_up}</dd>
                                                <dt>Drop Off:</dt><dd>{$info->drop_off}</dd>
                                            </dl>
                                        </td>

                                        <td style='padding:10px' >
                                            <dl class='term-description'>
                                                <dt>Pick Up Address:</dt><dd>".$value['pick_loc']."</dd>
                                                <dt>Drop Off Address:</dt><dd>".$value['drop_loc']."</dd>
                                                <dt>Pick Up Date:</dt><dd>".$value['pick_date']."</dd>
                                                <dt>Pick Up Time:</dt><dd>".$value['pick_time']."</dd>
                                                <dt>Drop Off Time:</dt><dd>".$value['drop_time']."</dd>
                                            </dl>
                                        </td>
                                    </tr>
                                </table>    
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
                $mail->Subject = 'Booking Invoice';
                $mail->Body = $message;
                $mail->IsHTML(true);
                $mail->send();
                if(!$mail->send()) {
                    echo 'Mailer error: '.$mail->ErrorInfo;
                } 
            }elseif ($transactionDetails->trans_type == 'excursions') {
                $cost = $value['subtotal'];
                $excursionId = $value['serviceId'];
                $info = find_by_id('excursion',$excursionId);  
                $fullname = $value['fname'].' '.$value['lname'];
                $recepit_id = substr(GUID(), 9,9);
                //update payment statue to true
                $sql = DB::getInstance()->query("UPDATE booking SET payment_status = '1', booking_no='$recepit_id' WHERE trans_id = '{$orderid}' ");
                //create notification
                DB::getInstance()->insert('notify',array('type'=>'Booking','tag'=>$transactionDetails->trans_type,'comment'=>'New Excursion Booking.'));

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
                                *{margin:0px;padding:0px;font-weight:normal; } 
                                h2{font-size:1.2em;}
                                dl{width:100%; }
                                dl>dt, dl>dd{float: left;width:50%;padding:5px 0;text-transform:uppercase;font-size:13px  }
                                dl>dd{padding-left:20px; }
                                dl>dt{width:40%;color:#01b7f2;border-right: 1px solid #f5f5f5;clear: both; }
                            </style>
                        </head>
                        <body >
                            <div style='background:#ccc;width:900px;padding:2px; margin:20px auto;'>
                            <div style='background:#fff;min-height:50px;padding:10px 5px '>
                                <table style='width:100%;border-collapse: collapse;' class='table'>
                                    <tr style='background:#0b0061 '>
                                        <td colspan='2' style='text-align:center;color:#fff;'><h2 style='padding:7px'>Booking Confirmation</h2></td>
                                    </tr>
                                    <tr style='background: #dee8eb;'>
                                        <td style='padding:10px 0;width:70%'><img src='https://travelafric.com/res/images/logo3.png' height='60' width='156' alt='travelafric logo'></td>
                                        <td style='padding:10px 0'>
                                            <div style='float:right;padding-right:5px '>
                                                <h2>{$info->sup_name}</h2>
                                                <h6>{$info->sup_addr}</h6>
                                                <h6>{$info->sup_email}, {$info->sup_tel}</h6>
                                            </div>
                                        </td>
                                    </tr>
                                </table>    
                                <table style='width:100%;' class='table'>    
                                    <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                    <tr><td colspan='2' style='padding:10px'><h2>Custmer Information</h2></td></tr>
                                    <tr>
                                        <td style='padding:10px;' colspan=''>
                                            <dl class='term-description'>
                                                <dt>Booking number:</dt><dd>{$recepit_id}</dd>
                                                <dt>First name:</dt><dd>{$value['fname']}</dd>
                                                <dt>Last name:</dt><dd>{$value['lname']}</dd>
                                                <dt>E-mail address:</dt><dd>{$value['email']}</dd>
                                                <dt>Phone:</dt><dd>{$value['phone']}</dd>
                                                <dt>Address:</dt><dd>{$value['addr']}</dd>
                                            </dl>
                                        </td>
                                        <td>
                                            <img src='https://travelafric.com/'".$value['serviceImage']."' style='height:100px;width:120px;' alt='service_image'>
                                        </td>
                                    </tr>
                                </table>    
                                <table style='width:100%;' class='table'>
                                    <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                    <tr><td colspan='2' style='padding:10px;'><h2>Booking Details</h2></td></tr>
                                    <tr class='booking-details'>
                                        <td style='padding:10px'>
                                            <dl class='term-description'>
                                                <dt>Title:</dt><dd>{$info->title}</dd>
                                                <dt>Location:</dt><dd>{$info->city} - {$info->country}</dd>
                                                <dt>Package Includes:</dt><dd>{$info->type}</dd>
                                                <dt>Transportation:</dt><dd>{$info->transport}</dd>
                                            </dl>
                                        </td>

                                        <td style='padding:10px' >
                                            <dl class='term-description'>
                                                <dt>Date:</dt><dd>".$value['date']."</dd>
                                                <dt>Duration:</dt><dd>{$info->duration}</dd>
                                                <dt>No. of Adult:</dt><dd>".$value['adult']."</dd>
                                                <dt>No of Kids:</dt><dd>".$value['kids']."</dd>
                                            </dl>
                                        </td>
                                    </tr>
                                    <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                    <tr><td colspan='2'><img src='https://travelafric.com/{$info->map_image}' style='width:100%' /></td></tr>
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
                $mail->Subject = 'Booking Invoice';
                $mail->Body = $message;
                $mail->IsHTML(true);
                $mail->addAttachment($path,'Itinerary');
                $mail->send();
            }elseif ($transactionDetails->trans_type == 'tours') {
                $cost = $value['subtotal'];
                $tourId = $value['serviceId'];
                $info = find_by_id('tours',$tourId);
                $fullname = $value['fname'].' '.$value['lname'];
                $recepit_id = substr(GUID(), 9,9);
                //update payment statue to true
                $sql = DB::getInstance()->query("UPDATE booking SET payment_status = '1', booking_no='$recepit_id' WHERE trans_id = '{$orderid}' ");
                //create notification
                DB::getInstance()->insert('notify',array('type'=>'Booking','tag'=>$transactionDetails->trans_type,'comment'=>'New Tour Booking.'));

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
                                *{margin:0px;padding:0px;font-weight:normal;} 
                                h2{font-size:1.2em;}
                                dl{width:100%; }
                                dl>dt, dl>dd{float: left;width:50%;padding:5px 0;text-transform:uppercase;font-size:13px  }
                                dl>dd{padding-left:20px; }
                                dl>dt{width:40%;color:#01b7f2;border-right: 1px solid #f5f5f5;clear: both; }
                            </style>
                        </head>
                        <body >
                            <div style='background:#ccc;width:900px;padding:2px; margin:20px auto;'>
                            <div style='background:#fff;min-height:50px;padding:10px 5px '>
                                <table style='width:100%;border-collapse: collapse;' class='table'>
                                    <tr style='background:#0b0061 '>
                                        <td colspan='2' style='text-align:center;color:#fff;'><h2 style='padding:7px'>Booking Confirmation</h2></td>
                                    </tr>
                                    <tr style='background: #dee8eb;'>
                                        <td style='padding:10px 0;width:70%'><img src='https://travelafric.com/res/images/logo3.png' height='60' width='156' alt='travelafric logo'></td>
                                        <td style='padding:10px 0'>
                                            <div style='float:right;padding-right:5px '>
                                                <h2>{$info->sup_name}</h2>
                                                <h6>{$info->sup_addr}</h6>
                                                <h6>{$info->sup_email}, {$info->sup_tel}</h6>
                                            </div>
                                        </td>
                                    </tr>
                                </table>    
                                <table style='width:100%;' class='table'>    
                                    <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                    <tr><td colspan='2' style='padding:10px'><h2>Custmer Information</h2></td></tr>
                                    <tr>
                                        <td style='padding:10px;' colspan='2'>
                                            <dl class='term-description'>
                                                <dt>Booking number:</dt><dd>{$recepit_id}</dd>
                                                <dt>First name:</dt><dd>{$value['fname']}</dd>
                                                <dt>Last name:</dt><dd>{$value['lname']}</dd>
                                                <dt>E-mail address:</dt><dd>{$value['email']}</dd>
                                                <dt>Phone:</dt><dd>{$value['phone']}</dd>
                                                <dt>Address:</dt><dd>{$value['addr']}</dd>
                                            </dl>
                                        </td>
                                        <td>
                                            <img src='https://travelafric.com/'".$value['serviceImage']."' style='height:100px;width:120px;' alt='service_image'>
                                        </td>
                                    </tr>
                                </table>    
                                <table style='width:100%;' class='table'>
                                    <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                    <tr><td colspan='2' style='padding:10px;'><h2>Booking Details</h2></td></tr>
                                    <tr class='booking-details'>
                                        <td style='padding:10px'>
                                            <dl class='term-description'>
                                                <dt>Title:</dt><dd>{$info->title}</dd>
                                                <dt>Location:</dt><dd>{$info->city} - {$info->country}</dd>
                                                <dt>Package Includes:</dt><dd>{$info->type}</dd>
                                                <dt>Date:</dt><dd>{$info->start}</dd>
                                                <dt>Duration:</dt><dd>{$info->duration}</dd>
                                            </dl>
                                        </td>
                                    </tr>
                                    <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                    <tr><td colspan='2'><img src='https://travelafric.com/{$info->map_image}' style='width:100%' /></td></tr>
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
                $mail->Subject = 'Booking Invoice';
                $mail->Body = $message;
                $mail->IsHTML(true);
                $mail->addAttachment($path,'Itinerary');
                $mail->send();
            }elseif ($transactionDetails->trans_type == 'events') {
                $cost = $value['subtotal'];
                $eventId = $value['serviceId'];
                $info = find_by_id('events',$eventId);
                $fullname = $value['fname'].' '.$value['lname'];
                $recepit_id = substr(GUID(), 9,9);
                //update payment statue to true
                $sql = DB::getInstance()->query("UPDATE booking SET payment_status = '1', booking_no='$recepit_id' WHERE trans_id = '{$orderid}' ");
                //create notification
                DB::getInstance()->insert('notify',array('type'=>'Booking','tag'=>$transactionDetails->trans_type,'comment'=>'New Events Booking.'));

                //sending email 
                $message = " 
                        <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.1//EN' 'http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd'>
                        <html xmlns='http://www.w3.org/1999/xhtml'>
                        <head>
                            <meta charset='utf-8'>
                            <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'>
                            <title>Confirmation Mail</title>
                            <style type='text/css'>
                                *{margin:0px;padding:0px;font-weight:normal; } 
                                h2{font-size:1.2em;}
                                dl{width:100%; }
                                dl>dt, dl>dd{float: left;width:50%;padding:5px 0;text-transform:uppercase;font-size:13px  }
                                dl>dd{padding-left:20px; }
                                dl>dt{width:40%;color:#01b7f2;border-right: 1px solid #f5f5f5;clear: both; }
                            </style>
                        </head>
                        <body >
                            <div style='background:#ccc;width:900px;padding:2px; margin:20px auto;'>
                            <div style='background:#fff;min-height:50px;padding:10px 5px '>
                                <table style='width:100%;border-collapse: collapse;' class='table'>
                                    <tr style='background:#0b0061 '>
                                        <td colspan='2' style='text-align:center;color:#fff;'><h2 style='padding:7px'>Booking Confirmation</h2></td>
                                    </tr>
                                    <tr style='background: #dee8eb;'>
                                        <td style='padding:10px 0;width:70%'><img src='https://travelafric.com/res/images/logo3.png' height='60' width='156' alt='travelafric logo'></td>
                                        <td style='padding:10px 0'>
                                            <div style='float:right;padding-right:5px '>
                                                <h2>{$info->sup_name}</h2>
                                                <h6>{$info->sup_addr}</h6>
                                                <h6>{$info->sup_email}, {$info->sup_tel}</h6>
                                            </div>
                                        </td>
                                    </tr>
                                </table>    
                                <table style='width:100%;' class='table'>    
                                    <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                    <tr><td colspan='2' style='padding:10px'><h2>Custmer Information</h2></td></tr>
                                    <tr>
                                        <td style='padding:10px;' colspan='2'>
                                            <dl class='term-description'>
                                                <dt>Booking number:</dt><dd>{$recepit_id}</dd>
                                                <dt>First name:</dt><dd>{$value['fname']}</dd>
                                                <dt>Last name:</dt><dd>{$value['lname']}</dd>
                                                <dt>E-mail address:</dt><dd>{$value['email']}</dd>
                                                <dt>Phone:</dt><dd>{$value['phone']}</dd>
                                            </dl>
                                        </td>
                                        <td>
                                            <img src='https://travelafric.com/'".$value['serviceImage']."' style='height:100px;width:120px;' alt='service_image'>
                                        </td>
                                    </tr>
                                </table>    
                                <table style='width:100%;' class='table'>
                                    <tr><td colspan='2'><hr style='border:0.7px solid #f5f5f5;margin:10px'></td></tr>
                                    <tr><td colspan='2' style='padding:10px;'><h2>Booking Details</h2></td></tr>
                                    <tr class='booking-details'>
                                        <td style='padding:10px'>
                                            <dl class='term-description'>
                                                <dt>Title:</dt><dd>{$info->title}</dd>
                                                <dt>Location:</dt><dd>{$info->loc}</dd>
                                                <dt>City:</dt><dd>{$info->city}</dd>
                                                <dt>Date:</dt><dd>{$info->e_date}</dd>
                                                <dt>Time:</dt><dd>{$info->e_time}</dd>
                                                <dt>No. of Adult:</dt><dd>".$value['adult']."</dd>
                                            </dl>
                                        </td>
                                    </tr>
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
                $mail->Subject = 'Booking Invoice';
                $mail->Body = $message;
                $mail->IsHTML(true);
                $mail->send();
            }
        }


    }

?>