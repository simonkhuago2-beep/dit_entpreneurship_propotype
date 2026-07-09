<?php ob_start(); ?>
<?php
session_start();

// Collect personal information from POST request
$_SESSION['fname'] = $_POST['fname'];
$_SESSION['lname'] = $_POST['lname'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['phone'] = $_POST['phone'];
$_SESSION['pick_loc'] = $_POST['pick_loc'];
$_SESSION['drop_loc'] = $_POST['drop_loc'];
$_SESSION['pick_time'] = $_POST['pick_time'];
$_SESSION['drop_time'] = $_POST['drop_time'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Travelafric.com</title>
    <?php require 'template/head.html'; ?>
    <style type="text/css">
        .table>tbody>tr>td { vertical-align: middle; }
    </style>
</head>
<body>
    <div id="page-wrapper">
        <?php require 'template/nav.php'; ?>

        <div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title">Cart</h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="#">HOME</a></li>
                    <li><a href="#">CART</a></li>
                    <li class="active">Check-Out</li>
                </ul>
            </div>
        </div>

        <section id="content">
            <div class="container">
                <div id="main">
                    <?php
                    if (Session::exists('deleted')) { ?>
                        <div class="alert alert-success">
                            Done! <?php echo Session::flash("deleted"); ?> <span class="close"></span>
                        </div>
                    <?php } if (Session::exists('less-fund')) { ?>
                        <div class="alert alert-notice">
                            Heads up! <?php echo Session::flash("less-fund"); ?> <span class="close"></span>
                        </div>
                    <?php } if (Session::exists('cancelled')) { ?>
                        <div class="alert alert-notice">
                            Alert! <?php echo Session::flash("cancelled"); ?> <span class="close"></span>
                        </div>
                    <?php } if (Session::exists('error')) { ?>
                        <div class="alert alert-danger">
                            Alert! <?php echo Session::flash("error"); ?> <span class="close"></span>
                        </div>
                    <?php } if (Session::exists('success')) { ?>
                        <div class="alert alert-success">
                            Done! <?php echo Session::flash("success"); ?> <span class="close"></span>
                        </div>
                    <?php } ?>

                    <div class="sort-by-section clearfix">
                        <a class="button btn-small white pull-left"><?php echo count($_SESSION['cart']); ?> item(s)</a>
                        <a href="empty-cart.php" class="button btn-small red pull-right">Empty Cart</a>
                        <p class="pull-right">&nbsp;</p>
                        <a href="index.php" class="button btn-small green pull-right">Add More Service</a>
                    </div>

                    <?php 
                    $sum = 0;
                    if (!empty($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $item) {
                            $sum += $item['subtotal'];
                        }
                    ?>
                    <div class="hotel-list listing-style3 hotel" style="background:#fff;">
                        <table class="table">
                            <thead></thead>
                            <tbody>
                                <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
                                <tr>
                                    <td><img src="<?php echo $value['serviceImage']; ?>" style="height:100px;width:120px;"></td>
                                    <td><h5 class="text-capitalize"><?php echo $value['service']; ?></h5></td>
                                    <td>
                                        <h5 class="text-capitalize"><?php echo $value['serviceTitle']; ?></h5>
                                        <?php echo $value['serviceCountry']; ?>
                                    </td>
                                    <td>
                                        <h5 class="text-capitalize"><?php echo $value['sup_name']; ?></h5>
                                        <?php echo $value['sup_email']; ?>
                                    </td>
                                    <td>
                                        <h5 class="text-capitalize"><?php echo $value['fname'].' '.$value['lname']; ?></h5>
                                        <?php echo $value['email'].'<br>'.$value['phone']; ?>
                                    </td>
                                    <td>$<?php echo $value['subtotal']; ?></td>
                                    <td><a href="delete-cart.php?id=<?php echo $key; ?>" class="soap-icon-close red" style="font-size:2em;"></a></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="5"><h3>Total</h3></td>
                                    <td><h3>$<?php echo $sum; ?></h3></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php } else { ?>
                    <tr><td><div class="alert alert-general">No item in your cart.<span class="close"></span></div></td></tr>
                    <?php } ?>

                    <?php if (Session::exists('cart')) { ?>
                    <div class="sort-by-section clearfix">
                        <a class="button btn-small white pull-left">Check-Out with:</a>
                        <?php if ($client->isLoggedIn() && $client->data()->groups == 2) { ?>
                            <a href="checkout.php?mode=accounts" class="button btn-small dark-blue1 pull-right">ACCOUNTS</a>
                        <?php } ?>
                        <p class="pull-right">&nbsp;</p>
                        <a href="checkout.php?mode=reserve" class="button btn-small orange pull-right">RESERVE</a>
                        <p class="pull-right">&nbsp;</p>
                        <a href="checkout.php?mode=direct" onclick="payWithPaystack()" class="button btn-small sea-blue pull-right">PAYSTACK</a>
                        <p class="pull-right">&nbsp;</p>
                        <?php
                        include 'Paystack/configs.php';
                        ?>
                        <!--<a href="checkout.php?mode=direct" class="button btn-small sea-blue pull-right">PAY NOW</a>-->
                       
                    </div>
                    <?php } ?>
                </div>
            </div>
        </section>

        <?php include 'template/footer.php'; ?>
    </div>

    <!-- Javascript -->
    <?php include 'template/js-loader.html'; ?>
 <!-- Include Paystack inline script -->
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script type="text/javascript">
    
    function myghpay(){
         document.getElementById('myghpayForm').submit(); 
    }
        document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.pay-now').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            let email = button.getAttribute('data-email');
            let phone = button.getAttribute('data-phone');
            let amount = button.getAttribute('data-amount');
            payWithPaystack(email, phone, amount);
        });
    });
});

 function payWithPaystack() {
            console.log('Public Key:', '<?php echo $PublicKey; ?>');
            console.log('Email:', '<?php echo $value['email']; ?>');
            console.log('Amount:', <?php echo $sum * 100; ?>);
             console.log('First Name:', '<?php echo $value['fname'].' '.$value['lname'];?>');
            console.log('Phone:', <?php echo $value['phone']; ?>);
             
           

            let handler = PaystackPop.setup({
                key: '<?php echo $PublicKey; ?>', // Replace with your public key
                email: '<?php echo $value['email']; ?>',
                 phone: '<?php echo $value['phone']; ?>',
                amount: <?php echo $sum * 100; ?>, // Amount in cents
                currency: 'GHS', // Set to USD for US Dollars
                ref: '' + Math.floor((Math.random() * 1000000000) + 1), // Generates a pseudo-unique reference
                onClose: function() {
                    alert('Transaction was not completed, window closed.');
                },
                callback: function(response) {
                    let message = 'Payment complete! Reference: ' + response.reference;
                    alert(message);
                    window.location.href = "http://travelafric.com/new-voucher.php?reference=" + response.reference;
                }
            });

            handler.openIframe();
        }
    </script>
</body>
</html>
