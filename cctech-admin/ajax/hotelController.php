<?php
	ob_start();
	include '../core/init.php';
	require '../PHPMailer/PHPMailerAutoload.php';
	//header('Content-Type: application/json');
	$response = '';
	$year = date('Y');

	if (Input::get('mode') == 'get') {
		$id = Input::get('id');
		$price = find_by_id('rooms',$id);
		$price = $price->agent_price;
		$response = array('status'=>'okay','price'=>$price);
		
	}elseif (Input::get('mode') == 'put') {
		$id = Input::get('edit-id');
		$newPrice = Input::get('new-price');
		$sql = DB::getInstance()->Update('rooms',$id,array('agent_price'=>$newPrice) );
		$status = ''; $color = '';
		if ($sql) {$status = 'okay'; $color = '#cef1ce';}else{$status = 'error'; $color = '#f1d0ce';}
		$response = array('status'=>$status,'color'=>$color);
		
	}elseif (Input::get('mode') == 'sendReview') {
		$bookId = Input::get('bookId');
		$details = find_by_id('booking',$bookId);
		$json = json_decode($details->trans_details);
		$guestEmail = $json->email;
		$guestName  = $json->name;
		$hotel = find_by_id('clients',$json->hotelId);
		$hotelName = $hotel->company_name; 
		$hotelId = $json->hotelId;
		$message = " 
			<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.1//EN' 'http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd'>
			<html xmlns='http://www.w3.org/1999/xhtml' > 
				<head> 
				<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
				<title>TravelAfric - Hotel Reviews</title>
				
				<style>
				/* reset */
				html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,font,img,ins,kbd,q,s,samp,strike,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td{margin:0;padding:0;border:0;outline:0;font-size:100%;vertical-align:baseline;background:transparent}body{line-height:1}ol,ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:'';content:none}:focus{outline:0}ins{text-decoration:none}del{text-decoration:line-through}table{border-collapse:collapse;border-spacing:0} 
				/* typography */
				body{font:13px/1.5 Helvetica,Arial,FreeSans,sans-serif}a:focus{outline:1px dotted invert}hr{border:0 #ccc solid;border-top-width:1px;clear:both;height:0}h1{font-size:25px}h2{font-size:23px}h3{font-size:21px}h4{font-size:19px}h5{font-size:17px}h6{font-size:15px}ol{list-style:decimal}ul{list-style:square}li{margin-left:30px}p,dl,hr,h1,h2,h3,h4,h5,h6,ol,ul,pre,table,address,fieldset{margin:10px 0;}
				.btn{background:#31249b;padding:15px;color:#fff;margin:2px;text-decoration:none;cursor:pointer;font-weight:800;font-size:20px;     }
				</style>
				</head> 
				<body >
				<div style='width:55%;margin:5px auto;background:#f1f1f1;colo:#fff;padding:10px;margin-bottom:0px; '>
				    <table styl='width:100%;border:1px #777 solid;'>
						<tr>
							<td style='text-align:center; '><img src='https://travelafric.com/res/images/logo3.png'></td>
						</tr>
						<tr>
							<td styl='padding:0 10px '>
								<h3>Dear {$guestName},</h3>
								<p style'font-size:14px;line-height:28px;>
									Thanks for booking with us. please be kind enough to write a review about your stay so they can better serve you well.  
								</p>
							</td>
						</tr>
						<tr>
							<td style='padding:60px;text-align:center; ' >
								<a href='https://travelafric.com/review.php?booking_id={$bookId}' target='blank' class='btn'>
									WRITE A REVIEW
								</a>
							</td>
						</tr>
						
					</table>
				</div>
				</body>
			</html>
		";

		$mail = new PHPMailer;
        $mail->setFrom('Info@travelafric.com', 'Team TravelAfric');
        $mail->addAddress($guestEmail, $guestName);
        $mail->Subject = 'TravelAfric - Sightseeing Review';
        $mail->Body = $message;
        $mail->IsHTML(true);
        $mail->send();
        if(!$mail->send()) {
        	$response = array('status'=>'Error','message'=>$mail->ErrorInfo);
            /*echo 'Message was not sent.';
            echo 'Mailer error: '.$mail->ErrorInfo;*/
        }else{
        	$response = array('status' => 'Okay','message' => 'Mail Sent Successfully' );
        }		
	}elseif (Input::get('mode') == 'requestSightseeingReview') {
		$bookId = Input::get('bookId');
		$details = find_by_id('booking',$bookId);
		$json = json_decode($details->trans_details);
		$guestEmail = $json->email;
		$guestName  = $json->name;	

		$message = " 
			<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.1//EN' 'http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd'>
			<html xmlns='http://www.w3.org/1999/xhtml' > 
				<head> 
				<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
				<title>TravelAfric - Hotel Reviews</title>
				
				<style>
				/* reset */
				html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,font,img,ins,kbd,q,s,samp,strike,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td{margin:0;padding:0;border:0;outline:0;font-size:100%;vertical-align:baseline;background:transparent}body{line-height:1}ol,ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:'';content:none}:focus{outline:0}ins{text-decoration:none}del{text-decoration:line-through}table{border-collapse:collapse;border-spacing:0} 
				/* typography */
				body{font:13px/1.5 Helvetica,Arial,FreeSans,sans-serif}a:focus{outline:1px dotted invert}hr{border:0 #ccc solid;border-top-width:1px;clear:both;height:0}h1{font-size:25px}h2{font-size:23px}h3{font-size:21px}h4{font-size:19px}h5{font-size:17px}h6{font-size:15px}ol{list-style:decimal}ul{list-style:square}li{margin-left:30px}p,dl,hr,h1,h2,h3,h4,h5,h6,ol,ul,pre,table,address,fieldset{margin:10px 0;}
				.btn{background:#31249b;padding:15px;color:#fff;margin:2px;text-decoration:none;cursor:pointer;font-weight:800;font-size:20px;     }
				</style>
				</head> 
				<body >
				<div style='width:55%;margin:5px auto;background:#f1f1f1;colo:#fff;padding:10px;margin-bottom:0px; '>
				    <table styl='width:100%;border:1px #777 solid;'>
						<tr>
							<td style='text-align:center; '><img src='https://travelafric.com/res/images/logo3.png'></td>
						</tr>
						<tr>
							<td styl='padding:0 10px '>
								<h3>Dear {$guestName},</h3>
								<p style'font-size:14px;line-height:28px;>
									Thanks for booking with us. Please be kind enough to write a review about your experience so they can better serve you well.  
								</p>
							</td>
						</tr>
						<tr>
							<td style='padding:60px;text-align:center; ' >
								<a href='https://travelafric.com/sightseeing-review.php?booking_id={$bookId}' target='blank' class='btn'>
									WRITE A REVIEW
								</a>
							</td>
						</tr>
						
					</table>
				</div>
				</body>
			</html>
		";
		$mail = new PHPMailer;
        $mail->setFrom('info@travelafric.com', 'Team TravelAfric');
        $mail->addAddress($guestEmail, $guestName);
        $mail->Subject = 'TravelAfric - Sightseeing Review';
        $mail->Body = $message;
        $mail->IsHTML(true);
        $mail->send();
        if(!$mail->send()) {
        	$response = array('status'=>'Error','message'=>$mail->ErrorInfo);
            /*echo 'Message was not sent.';
            echo 'Mailer error: '.$mail->ErrorInfo;*/
        }else{
        	$response = array('status' => 'Okay','message' => 'Mail Sent Successfully' );
        }
	}elseif (Input::get('mode') == 'requestPackageReview') {
		$bookId = Input::get('bookId');
		$details = find_by_id('booking',$bookId);
		$json = json_decode($details->trans_details);
		$guestEmail = $json->email;
		$guestName  = $json->name;	

		$message = " 
			<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.1//EN' 'http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd'>
			<html xmlns='http://www.w3.org/1999/xhtml' > 
				<head> 
				<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
				<title>TravelAfric - Hotel Reviews</title>
				
				<style>
				/* reset */
				html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,font,img,ins,kbd,q,s,samp,strike,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td{margin:0;padding:0;border:0;outline:0;font-size:100%;vertical-align:baseline;background:transparent}body{line-height:1}ol,ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:'';content:none}:focus{outline:0}ins{text-decoration:none}del{text-decoration:line-through}table{border-collapse:collapse;border-spacing:0} 
				/* typography */
				body{font:13px/1.5 Helvetica,Arial,FreeSans,sans-serif}a:focus{outline:1px dotted invert}hr{border:0 #ccc solid;border-top-width:1px;clear:both;height:0}h1{font-size:25px}h2{font-size:23px}h3{font-size:21px}h4{font-size:19px}h5{font-size:17px}h6{font-size:15px}ol{list-style:decimal}ul{list-style:square}li{margin-left:30px}p,dl,hr,h1,h2,h3,h4,h5,h6,ol,ul,pre,table,address,fieldset{margin:10px 0;}
				.btn{background:#31249b;padding:15px;color:#fff;margin:2px;text-decoration:none;cursor:pointer;font-weight:800;font-size:20px;     }
				</style>
				</head> 
				<body >
				<div style='width:55%;margin:5px auto;background:#f1f1f1;colo:#fff;padding:10px;margin-bottom:0px; '>
				    <table styl='width:100%;border:1px #777 solid;'>
						<tr>
							<td style='text-align:center; '><img src='https://travelafric.com/res/images/logo3.png'></td>
						</tr>
						<tr>
							<td styl='padding:0 10px '>
								<h3>Dear {$guestName},</h3>
								<p style'font-size:14px;line-height:28px;>
									Thanks for booking with us. Please be kind enough to write a review about your experience so they can better serve you well.  
								</p>
							</td>
						</tr>
						<tr>
							<td style='padding:60px;text-align:center; ' >
								<a href='https://travelafric.com/package-review.php?booking_id={$bookId}' target='blank' class='btn'>
									WRITE A REVIEW
								</a>
							</td>
						</tr>
						
					</table>
				</div>
				</body>
			</html>
		";
		$mail = new PHPMailer;
        $mail->setFrom('info@travelafric.com', 'Team TravelAfric');
        $mail->addAddress($guestEmail, $guestName);
        $mail->Subject = 'TravelAfric - Sightseeing Review';
        $mail->Body = $message;
        $mail->IsHTML(true);
        $mail->send();
        if(!$mail->send()) {
        	$response = array('status'=>'Error','message'=>$mail->ErrorInfo);
        }else{
        	$response = array('status' => 'Okay','message' => 'Mail Sent Successfully' );
        }
	}

	echo json_encode($response);


?>

