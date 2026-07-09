<?php ob_start();?>
<!DOCTYPE html>
<html>
<head>
    <title>Travelafric.com</title>
    <?php require 'template/head.html'; ?>
</head>
<body>
    <div id="page-wrapper">
		 <?php require 'template/nav.php'; ?>
		 <?php if(!$client->isLoggedIn() ) { Session::flash('msg','Login to access your account.');Redirect::to('login.php'); } 
		 	$item = find_by_id('booking',Input::get('id'));
            $type = Input::get('type');
            $json = json_decode($item->trans_details);
        	

            if($item->trans_type == 'events'){
                $sup = find_by_id('events',$json->id);
                $supplier = $sup->sup_name; $email = $sup->sup_email;
                $addr = $sup->sup_addr; $tel = $sup->sup_tel;
            }elseif ($item->trans_type == 'transfers') {
                $sup = find_by_id('transfers',$json->id);
                $supplier = $sup->sup_name; $email = $sup->sup_email;
                $addr = $sup->sup_addr; $tel = $sup->sup_tel;
            }elseif ($item->trans_type == 'tours') {
                $sup = find_by_id('tours',$json->id);
                $supplier = $sup->sup_name; $email = $sup->sup_email;
                $addr = $sup->sup_addr; $tel = $sup->sup_tel;
            }
            elseif ($item->trans_type == 'excursions') {
                $sup = find_by_id('excursion',$json->id);
                $supplier = $sup->sup_name; $email = $sup->sup_email;
                $addr = $sup->sup_addr; $tel = $sup->sup_tel;
            }
            elseif ($item->trans_type == 'hotels') {
                $sup = find_by_id('clients',$json->hotelId);
                $supplier = $sup->name; $email = $sup->contact_email;
                $addr = $sup->addr; $tel = $sup->tel;
                $droom = find_by_id('rooms',$json->roomId);
                $dhotel = find_by_id('clients',$json->hotelId);
            }
		 ?>

		 <div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title">My Account</h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="travelafric.com">HOME</a></li><li><a href="dashboard.php">Dashboard</a></li>
                    <li class="active"><a href="#">Print Preview</a></li>
                </ul>
            </div>
        </div>

        <section id="content">
            <div class="container">
				<div id="main">
					<div class="col-sm-12 shop-cart-table" id="divPrint">
                    	<table class="table shop-cart no-margin-bottom ">
                            <tbody>
                                <tr>
                                    <td colspan="3"><img alt="" src="/travel/libs/images/logo.png" class="logo-style-3" /></td>
                                    
                                    <td class="text-right">
                                        <span class="text-large xs-no-padding-left font-weight-700 black-text letter-spacing-1 margin-five no-margin-top display-block sm-margin-bottom-two">
                                            <?php echo $client->data()->name ?>
                                        </span>
                                        <div class="blog-date no-padding-top black-text"><?php echo $client->data()->addr ?></div>
                                        <div class="blog-date no-padding-top black-text"><?php echo $client->data()->email ?></div>
                                        <div class="blog-date no-padding-top black-text"><?php echo $client->data()->tel ?></div>
                                    </td>
                                </tr>
                                <tr><td colspan="4"><hr style="border-top: 1px solid #ef824c;"></td></tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="blog-title "><a href="#" class="deep-red-text no-margin">Billed to</a></div>
                                        <div class="blog-date no-padding-top black-text" id="bill-name"><?php echo $json->name; ?></div>
                                        <div class="blog-date no-padding-top black-text" id="bill-email">E: <?php echo $json->email; ?></div>
                                        <div class="blog-date no-padding-top black-text" id="bill-tel">T: <?php echo $json->tel; ?></div>
                                    </td>

                                    <td class="text-right" colspan="2">
                                        <div class="blog-title "><a href="#" class="deep-red-text no-margin">Supplier</a></div>
                                        <div class="blog-date no-padding-top black-text" id="bill-hotel"><?php echo $supplier; ?></div>
                                        <div class="blog-date no-padding-top black-text" id="bill-h-email">E: <?php echo $email; ?></div>
                                        <div class="blog-date no-padding-top black-text" id="bill-h-tel">T: <?php echo $tel; ?></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <?php if ($item->trans_type == 'hotels') { ?>
                        <table class="table shop-cart ">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="text-left text-uppercase font-weight-600 letter-spacing-2 text-small black-text">Description</th>
                                        <!-- <th class="text-right">TOTAL</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><th class="text-left">Room</th><td class="text-left" id="bill-room"><?php echo $droom->name.' ('. $droom->meal_plan .')'; ?> </td>
                                    </tr>
                                    <tr>
                                        <th class="text-left">Check-in:</th><td class="text-left" id="bill-in"><?php echo get_date($json->checkin) ?></td> 
                                    </tr>
                                    <tr><th class="text-left">Check-out:</th><td class="text-left" id="bill-out"><?php echo get_date($json->checkout) ?> </td></tr>
                                    <tr>
                                        <th class="text-left">Persons</th><td class="text-left" id="bill-persons"><?php echo $json->adult;?> Adult, <?php echo $json->child;?> Child</td>
                                    </tr>
                                    <tr class="bg-warning" style="font-size:15px">
	                                    <!-- <th colspan="2" class="font-weight-600 text-large" style="vertical-align:top"></th> -->
	                                    <th class="text-left">TOTAL</th>
	                                    <th class="text-right">$<?php echo $item->markup_price ?></th>
	                                </tr>
                                </tbody>
                        </table>  
                        <?php }elseif ($item->trans_type == 'events') {  ?>
                        <table class="table shop-cart ">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-left text-uppercase font-weight-600 letter-spacing-2 text-small black-text">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><th class="text-left">Event</th><td class="text-left" id="bill-room"><?php echo $sup->title; ?> </td>
                                </tr>
                                <tr>
                                    <th class="text-left">Location:</th><td class="text-left" id="bill-in"><?php echo $sup->loc ?></td> 
                                </tr>
                                <tr><th class="text-left">Date:</th><td class="text-left" id="bill-out"><?php echo get_date($sup->e_date).' : '. $sup->e_time; ?>  </td></tr>
                                <tr class="bg-warning" style="font-size:15px">
                                    <!-- <th colspan="2" class="font-weight-600 text-large" style="vertical-align:top"></th> -->
                                    <th class="text-left">TOTAL</th>
                                    <th class="text-right">$<?php echo $item->markup_price ?></th>
                                </tr>
                            </tbody>
                        </table>  
                        <?php }elseif ($item->trans_type == 'transfers') { ?>
                        <table class="table shop-cart ">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-left text-uppercase font-weight-600 letter-spacing-2 text-small black-text">Description</th>
                                    <!-- <th class="text-right">TOTAL</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr><th>Transfer Type</th><td><?php echo $sup->cat; ?></td></tr>
                                <tr>
                                    <th class="text-left">Pick-Up</th>
                                    <td class="text-left" id="bill-room">
                                        <?php echo $sup->pick_up; ?> <br>
                                        <?php echo $json->pick_addr; ?> <br>
                                        <?php echo $json->pick_date.' : '. $json->pick_time; ?> <br>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left">Drop-Off</th>
                                    <td class="text-left" id="bill-room">
                                        <?php echo $sup->drop_off; ?> <br>
                                        <?php echo $json->drop_addr; ?> <br>
                                        <?php echo $json->drop_date.' : '. $json->drop_time; ?> <br>
                                    </td>
                                </tr>
                                <tr><th class="text-left">Vehicle:</th><td class="text-left" id="bill-out"><?php echo $sup->vehicle; ?>  </td></tr>
                                <tr class="bg-warning" style="font-size:15px">
                                    <!-- <th colspan="2" class="font-weight-600 text-large" style="vertical-align:top"></th> -->
                                    <th class="text-left">TOTAL</th>
                                    <th class="text-right">$<?php echo $item->markup_price ?></th>
                                </tr>
                            </tbody>
                        </table> 
                        <?php }elseif ($item->trans_type == 'excursions') { ?>
                        <table class="table shop-cart ">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-left text-uppercase font-weight-600 letter-spacing-2 text-small black-text">Description</th>
                                    <!-- <th class="text-right">TOTAL</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr><th class="text-left">Excursion</th><td class="text-left" id="bill-room"><?php echo $sup->title; ?> </td>
                                </tr>
                                <tr>
                                    <th class="text-left">Location:</th><td class="text-left" id="bill-in"><?php echo $sup->city.' - '.$sup->country; ?></td> 
                                </tr>
                                <tr><th class="text-left">Duration:</th><td class="text-left" id="bill-out"><?php echo $sup->duration; ?>  </td></tr>
                                <tr><th class="text-left">Date:</th><td class="text-left" id="bill-out"><?php echo get_date($json->date).' : '. $json->time; ?>  </td></tr>
                                <tr class="bg-warning" style="font-size:15px">
                                    <!-- <th colspan="2" class="font-weight-600 text-large" style="vertical-align:top"></th> -->
                                    <th class="text-left">TOTAL</th>
                                    <th class="text-right">$<?php echo $item->markup_price ?></th>
                                </tr>
                            </tbody>
                        </table>  
                        <?php }elseif ($item->trans_type == 'tours') { ?>
                        <table class="table shop-cart ">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-left text-uppercase font-weight-600 letter-spacing-2 text-small black-text">Description</th>
                                    <!-- <th class="text-right">TOTAL</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr><th class="text-left">Tour</th><td class="text-left" id="bill-room"><?php echo $sup->title; ?> </td>
                                </tr>
                                <tr>
                                    <th class="text-left">Location:</th><td class="text-left" id="bill-in"><?php echo $sup->city.' - '.$sup->country; ?></td> 
                                </tr>
                                <tr><th class="text-left">Duration:</th><td class="text-left" id="bill-out"><?php echo $sup->duration; ?>  </td></tr>
                                <tr class="bg-warning" style="font-size:15px">
                                    <!-- <th colspan="2" class="font-weight-600 text-large" style="vertical-align:top"></th> -->
                                    <th class="text-left">TOTAL</th>
                                    <th class="text-right">$<?php echo $item->markup_price ?></th>
                                </tr>
                            </tbody>
                        </table>  
                        <?php } ?>
                    </div>
                    <div class="col-md-4 col-sm-12">
                    	<button id="btnReport" type="submit" class="full-width icon-print animated bounce" data-animation-type="bounce" data-animation-duration="1" style="animation-duration: 1s; visibility: visible;" onclick="PrintElem('#divPrint')">Print Receipt</button>
                    </div>
                    <dic class="clearfix"></dic>
				</div>
            </div>
        </section>
        <?php include 'template/footer.php'; ?>
   </div>
   <!-- Javascript -->
   <?php include 'template/js-loader.html'; ?>
   <script type="text/javascript">

            function PrintElem(elem) {Popup(tjq(elem).html()); }
   
            function Popup(data) {
                var mywindow = window.open('', 'divPrint', '');
                mywindow.document.write('<html><head><title>Billing Receipt</title>');
                mywindow.document.write(`<style type="text/css">
                    table { width:100%; } 
                    th,td{padding:10px;}
                    .text-right{text-align:right}
                    .text-left{text-align:left}
                    </style></head><body>`);
                mywindow.document.write('</head><body >');
                mywindow.document.write(data);
                mywindow.document.write('</body></html>');

                mywindow.document.close(); // necessary for IE >= 10
                mywindow.focus(); // necessary for IE >= 10

                mywindow.print();
                mywindow.close();

                return true;
            }
        </script>
</body>
</html>   