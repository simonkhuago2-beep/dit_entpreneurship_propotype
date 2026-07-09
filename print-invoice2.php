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
				 
                <div style="margin: 0px auto; max-width: 600px">
        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%">
          <tbody>
            <tr>
              <td style="direction: ltr; font-size: 0px; padding: 20px 0; padding-bottom: 10px; padding-top: 40px; text-align: center">
                <!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]-->
                <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size: 0px; text-align: left; direction: ltr; display: inline-block; vertical-align: top; width: 100%">
                  <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align: top" width="100%">
                    <tbody>
                      <tr>
                        <td align="left" style="font-size: 0px; padding: 10px 25px; padding-bottom: 5px; word-break: break-word">
                          <table cellpadding="0" cellspacing="0" width="100%" border="0" style="color: #000000; font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 22px; table-layout: auto; width: 100%; border: none">
                            <tr>
                              <td style="width: 50%">
                                <img align="left" src="{{ settings.logo }}" width="100%" style="max-width: 160px" />
                              </td>
                              <td style="width: 50%"><div class="invoice-word" style="font-family: helvetica; color: #333; font-weight: bold"> INVOICE </div></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!--[if mso | IE]></td></tr></table><![endif]-->
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]-->
      <div style="margin: 0px auto; max-width: 600px">
        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%">
          <tbody>
            <tr>
              <td style="direction: ltr; font-size: 0px; padding: 20px 0; padding-bottom: 0; padding-top: 0; text-align: center">
                <!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]-->
                <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size: 0px; text-align: left; direction: ltr; display: inline-block; vertical-align: top; width: 100%">
                  <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align: top" width="100%">
                    <tbody>
                      <tr>
                        <td align="center" style="font-size: 0px; padding: 10px 25px; word-break: break-word">
                          <p style="border-top: solid 1px #dddddd; font-size: 1px; margin: 0px auto; width: 100%"></p>
                          <!--[if mso | IE
                            ]><table align="center" border="0" cellpadding="0" cellspacing="0" style="border-top: solid 1px #dddddd; font-size: 1px; margin: 0px auto; width: 550px" role="presentation" width="550px">
                              <tr>
                                <td style="height: 0; line-height: 0">&nbsp;</td>
                              </tr>
                            </table><!
                          [endif]-->
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!--[if mso | IE]></td></tr></table><![endif]-->
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]-->
      <div style="margin: 0px auto; max-width: 600px">
        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%">
          <tbody>
            <tr>
              <td style="direction: ltr; font-size: 0px; padding: 20px 0; padding-bottom: 0; padding-top: 0; text-align: center">
                <!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]-->
                <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size: 0px; text-align: left; direction: ltr; display: inline-block; vertical-align: top; width: 100%">
                  <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align: top" width="100%">
                    <tbody>
                      <tr>
                        <td align="left" style="font-size: 0px; padding: 10px 25px; padding-top: 5px; padding-bottom: 5px; word-break: break-word">
                          <table cellpadding="0" cellspacing="0" width="100%" border="0" style="color: #000000; font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 22px; table-layout: auto; width: 100%; border: none">
                            <tr>
                              <td>
                                <div style="font-family: helvetica">
                                  <span style="color: #333"><strong>Invoice Numer:</strong></span>
                                  <span style="color: #555; white-space: nowrap">{{ invoice.general.formatted_invoice_number }}</span>
                                </div>
                              </td>
                              <td width="50%">
                                <div style="font-family: helvetica">
                                  <span style="color: #333"><strong>Date Issued:</strong></span>
                                  <span style="color: #555; white-space: nowrap">{{ invoice.general.invoice_date }}</span>
                                </div>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!--[if mso | IE]></td></tr></table><![endif]-->
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]-->
      <div style="margin: 0px auto; max-width: 600px">
        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%">
          <tbody>
            <tr>
              <td style="direction: ltr; font-size: 0px; padding: 20px 0; padding-bottom: 0; padding-top: 0; text-align: center">
                <!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]-->
                <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size: 0px; text-align: left; direction: ltr; display: inline-block; vertical-align: top; width: 100%">
                  <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align: top" width="100%">
                    <tbody>
                      <tr>
                        <td align="center" style="font-size: 0px; padding: 10px 25px; word-break: break-word">
                          <p style="border-top: solid 1px #dddddd; font-size: 1px; margin: 0px auto; width: 100%"></p>
                          <!--[if mso | IE
                            ]><table align="center" border="0" cellpadding="0" cellspacing="0" style="border-top: solid 1px #dddddd; font-size: 1px; margin: 0px auto; width: 550px" role="presentation" width="550px">
                              <tr>
                                <td style="height: 0; line-height: 0">&nbsp;</td>
                              </tr>
                            </table><!
                          [endif]-->
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!--[if mso | IE]></td></tr></table><![endif]-->
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]-->
      <div style="margin: 0px auto; max-width: 600px">
        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%">
          <tbody>
            <tr>
              <td style="direction: ltr; font-size: 0px; padding: 20px 0; padding-top: 10px; text-align: center">
                <!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]-->
                <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size: 0px; text-align: left; direction: ltr; display: inline-block; vertical-align: top; width: 100%">
                  <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align: top" width="100%">
                    <tbody>
                      <tr>
                        <td align="left" style="font-size: 0px; padding: 10px 25px; word-break: break-word">
                          <table cellpadding="0" cellspacing="0" width="100%" border="0" style="color: #000000; font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 22px; table-layout: auto; width: 100%; border: none">
                            <tr>
                              <td style="vertical-align: top">
                                <div class="company-info-header" style="color: #333; font-family: helvetica"><strong>Bill To:</strong></div>
                                {% for data in customer %}
                                <div class="company-info" style="color: #555; font-family: helvetica">{{ data }}</div>
                                {% endfor %}
                              </td>
                              <td width="50%" v-align="top" style="vertical-align: top">
                                <div class="company-info-header" style="color: #333; font-family: helvetica"><strong>Bill From:</strong></div>
                                <div class="company-info" style="color: #555; font-family: helvetica">{{ settings.company_name }}</div>
                                {% if settings.company_number %}
                                <div class="company-info" style="color: #555; font-family: helvetica">Company number: {{ settings.company_number }}</div>
                                {% endif %} {% if settings.vat_number %}
                                <div class="company-info" style="color: #555; font-family: helvetica">VAT number: {{ settings.vat_number }}</div>
                                {% endif %}
                                <div class="company-info" style="color: #555; font-family: helvetica">{{ settings.address1 }}</div>
                                <div class="company-info" style="color: #555; font-family: helvetica">{{ settings.postcode }}, {{settings.city}}</div>
                                <div class="company-info" style="color: #555; font-family: helvetica">{{ settings.country }}</div>
                                <div class="company-info" style="color: #555; font-family: helvetica">{{ settings.email }}</div>
                                <div class="company-info" style="color: #555; font-family: helvetica">{{ settings.phone }}</div>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!--[if mso | IE]></td></tr></table><![endif]-->
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]-->
      <div style="margin: 0px auto; max-width: 600px">
        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%">
          <tbody>
            <tr>
              <td style="direction: ltr; font-size: 0px; padding: 20px 0; padding-top: 5px; text-align: center">
                <!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]-->
                <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size: 0px; text-align: left; direction: ltr; display: inline-block; vertical-align: top; width: 100%">
                  <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align: top" width="100%">
                    <tbody>
                      <tr>
                        <td align="left" style="font-size: 0px; padding: 10px 25px; word-break: break-word">
                          <table cellpadding="0" cellspacing="0" width="100%" border="0" style="color: #000000; font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 22px; table-layout: auto; width: 100%; border: none">
                            <tr>
                              <td style="max-width: 50%; width: 50%; border-bottom: 1px solid #777; padding: 0 0 10px 0; color: #333; font-family: helvetica"><strong>ITEM</strong></td>
                              <td style="border-bottom: 1px solid #777; padding: 0 0 10px 0; color: #333; font-family: helvetica; white-space: nowrap"><strong>QTY</strong></td>
                              <td style="border-bottom: 1px solid #777; padding: 0 0 10px 0; color: #333; font-family: helvetica; white-space: nowrap" align="right"><strong>PRICE</strong></td>
                              <td style="border-bottom: 1px solid #777; padding: 0 0 10px 0; color: #333; font-family: helvetica; white-space: nowrap" align="right"><strong>SUBTOTAL</strong></td>
                            </tr>
                            {% for product in invoice.products %}
                            <tr>
                              <td class="td-line-item" style="color: #555; padding: 10px 0; font-family: helvetica; border-bottom: 1px solid #ddd">{{ product.name }}</td>
                              <td class="td-line-item nowrap" align="left" style="color: #555; padding: 10px 0; font-family: helvetica; border-bottom: 1px solid #ddd; white-space: nowrap">{{ product.quantity }}</td>
                              <td class="td-line-item nowrap" align="right" style="color: #555; padding: 10px 0; font-family: helvetica; border-bottom: 1px solid #ddd; white-space: nowrap">{{ product.price }}</td>
                              <td class="td-line-item nowrap" align="right" style="color: #555; padding: 10px 0; font-family: helvetica; border-bottom: 1px solid #ddd; white-space: nowrap">{{ product.subtotal }}</td>
                            </tr>
                            {% endfor %}
                            <tr>
                              <td></td>
                              <td style="border-top: 1px solid #555; color: #555; padding: 10px 0; font-family: helvetica; border-bottom: 1px solid #ddd" align="left" colspan="2">Total:</td>
                              <td style="border-top: 1px solid #555; color: #555; padding: 10px 0; font-family: helvetica; border-bottom: 1px solid #ddd; white-space: nowrap" align="right">{{ invoice.totals.productsWithoutVat }}</td>
                            </tr>
                            <tr>
                              <td></td>
                              <td style="color: #555; padding: 10px 0; font-family: helvetica" align="left" colspan="2">VAT ({{ invoice.general.vat_rate }}):</td>
                              <td style="color: #555; padding: 10px 0; font-family: helvetica; white-space: nowrap" align="right">{{ invoice.totals.vat }}</td>
                            </tr>
                            <tr>
                              <td></td>
                              <td style="border-top: 1px solid #777; color: #333; padding: 10px 0 0 0; font-family: helvetica" align="left" colspan="2"><strong>Invoice Total:</strong></td>
                              <td style="border-top: 1px solid #777; color: #333; padding: 10px 0 0 0; font-family: helvetica; white-space: nowrap" align="right"><strong>{{ invoice.totals.productsWithVat }}</strong></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!--[if mso | IE]></td></tr></table><![endif]-->
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]-->
      <div style="margin: 0px auto; max-width: 600px">
        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%">
          <tbody>
            <tr>
              <td style="direction: ltr; font-size: 0px; padding: 20px 0; text-align: center">
                <!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]-->
                <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size: 0px; text-align: left; direction: ltr; display: inline-block; vertical-align: top; width: 100%">
                  <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align: top" width="100%">
                    <tbody>
                      <tr>
                        <td align="left" style="font-size: 0px; padding: 10px 25px; word-break: break-word">
                          <div style="font-family: helvetica; font-size: 13px; line-height: 1; text-align: left; color: #000000">
                            <span style="color: #333"><strong>Due Date:</strong></span>
                            <span style="color: #555; white-space: nowrap">{{ invoice.general.invoice_due }}</span>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td align="left" style="font-size: 0px; padding: 10px 25px; word-break: break-word">
                          <div style="font-family: helvetica; font-size: 13px; line-height: 1; text-align: left; color: #555555">{{ settings.info_text1 }}</div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!--[if mso | IE]></td></tr></table><![endif]-->
              </td>
            </tr>
          </tbody>
        </table>
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