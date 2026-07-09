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

        <div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title">Sign-up</h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="#">HOME</a></li>
                    <li><a href="#">sign-up</a></li>
                    <li class="active">Agents</li>
                </ul>
            </div>
        </div>

        <section id="content" style="padding-top:20px">
            <div class="container">

<div class="pageintro clearfix">
 <img src="res/images/signup-banner.jpg" alt="intro banner" class="img-responsive" style="width:80%;margin:0px auto" />
</div>



                <div id="main">
                    <div class="tab-container style1">
                        <ul class="tabs full-width">
                            <li class="active"><a href="#unlimited-layouts" data-toggle="tab">Accommodation Partner</a></li>
                            <li><a href="#design-inovation" data-toggle="tab">Suppler Partner</a></li>
                            <li><a href="#design-inovation" data-toggle="tab">Agency partner</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="unlimited-layouts">
                                <form action="" method="post" id="frmHotel">
                                            <h3>Hotel Details</h3><hr>
                                            <div class="form-group row">
                                                <div class="col-sm-6 col-md-6">
                                                    <label>Hotel Name</label>
                                                    <input type="text" name="h_name" id="h_name" class="input-text full-width" require >
                                                </div>
                                                <div class="col-sm-3">
                                                    <label>Hotel Rating</label>
                                                    <div class="selector">
                                                        <select name="stars" require>
                                                            <option value="1">1 Star</option>
                                                            <option value="2">2 Stars</option>
                                                            <option value="3">3 Stars</option>
                                                            <option value="4">4 Stars</option>
                                                            <option value="5">5 Stars</option>
                                                            <option value="Apartment">Apartment</option>
                                                            <option value="Guest House">Guest House</option>
                                                            <option value="Hostel">Hostel</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label>Date Established</label>
                                                    <div class="datepicker-wrap">
                                                        <input type="text" name="est" id="est" class="input-text full-width" placeholder="mm/dd/yy" require />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-xs-4">
                                                    <label>Country</label>
                                                    <input type="text" name="h_country" id="h_country" class="input-text full-width" require />
                                                </div>   
                                                <div class="col-xs-4">
                                                    <label>City</label>
                                                    <input type="text" name="h_city" id="h_city" class="input-text full-width" require />
                                                </div> 
                                                <div class="col-xs-4">
                                                    <label>Zip/Postal</label>
                                                    <input type="text" name="zip" id="zip" class="input-text full-width" require />
                                                </div> 
                                            </div> 
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label class="text-uppercase">Address</label>
                                                    <textarea class="full-width" name="h_addr" id="h_addr" require></textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="text-uppercase">Landmarks</label>
                                                    <textarea class="full-width" name="landmarks" id="landmarks" require></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-xs-6">
                                                    <label>Email</label>
                                                    <input type="text" name="h_email" id="h_email" class="input-text full-width" require />
                                                </div> 
                                                <div class="col-xs-6">
                                                    <label>Telephone</label>
                                                    <input type="number" name="h_tel" id="h_tel" class="input-text full-width" require />
                                                </div> 
                                            </div>
                                            <hr><h3>User Details</h3><hr>
                                            <div class="row">
                                                <div class="form-group col-xs-5">
                                                    <label>Full Name</label>
                                                    <input type="text" name="h_fname" id="h_fname" class="input-text full-width" require />
                                                </div> 
                                                <div class="form-group col-xs-5">
                                                    <label>Display Name</label>
                                                    <input type="text" name="h_username" id="h_username" class="input-text full-width" require />
                                                </div> 
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-xs-5">
                                                    <label>Email</label>
                                                    <input type="email" name="email" id="email" class="input-text full-width" placeholder="This email will be used to login" require />
                                                </div> 
                                                <div class="form-group col-xs-5">
                                                    <label>Position</label>
                                                    <input type="text" name="position" id="position" class="input-text full-width" require />
                                                </div> 
                                            </div>
                                            <div class=" row">
                                                <div class="form-group col-xs-5">
                                                    <label>Password</label>
                                                    <input type="password" name="password" id="password" class="input-text full-width" require />
                                                </div> 
                                                <div class="form-group col-xs-5">
                                                    <label>Confirm Password</label>
                                                    <input type="password" name="repassword" id="repassword" class="input-text full-width" require />
                                                </div> 
                                            </div>
                                            <div class="row pwd-mismatch hidden">
                                                <div class="alert alert-error">Error: Password mismatch, try entering the same password. <span class="close"></span></div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-xs-6">
                                                    <button type="submit" class="btn btn-medium" id="btnReg">Create Account</button>  
                                                </div>
                                            </div>
                                </form>
                            </div>l
                            <div class="tab-content">
                            <div class="tab-pane fade in active" id="unlimited-layouts">
                                <form action="" method="post" id="frmHotel">
                                            <h3>Supplier Details</h3><hr>
                                            <div class="form-group row">
                                                <div class="col-sm-6 col-md-6">
                                                    <label>Name Name</label>
                                                    <input type="text" name="h_name" id="h_name" class="input-text full-width" require >
                                                </div>
                                                <div class="col-sm-3">
                                                    <label>Service Type</label>
                                                    <div class="selector">
                                                        <select name="stars" require>
                                                            <option value="1">Rent-A-Car</option>
                                                            <option value="2">S</option>
                                                            <option value="3">3 Stars</option>
                                                            <option value="4">4 Stars</option>
                                                            <option value="5">5 Stars</option>
                                                            <option value="Apartment">Apartment</option>
                                                            <option value="Guest House">Guest House</option>
                                                            <option value="Hostel">Hostel</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label>Date Established</label>
                                                    <div class="datepicker-wrap">
                                                        <input type="text" name="est" id="est" class="input-text full-width" placeholder="mm/dd/yy" require />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-xs-4">
                                                    <label>Country</label>
                                                    <input type="text" name="h_country" id="h_country" class="input-text full-width" require />
                                                </div>   
                                                <div class="col-xs-4">
                                                    <label>City</label>
                                                    <input type="text" name="h_city" id="h_city" class="input-text full-width" require />
                                                </div> 
                                                <div class="col-xs-4">
                                                    <label>Zip/Postal</label>
                                                    <input type="text" name="zip" id="zip" class="input-text full-width" require />
                                                </div> 
                                            </div> 
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label class="text-uppercase">Address</label>
                                                    <textarea class="full-width" name="h_addr" id="h_addr" require></textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="text-uppercase">Landmarks</label>
                                                    <textarea class="full-width" name="landmarks" id="landmarks" require></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-xs-6">
                                                    <label>Email</label>
                                                    <input type="text" name="h_email" id="h_email" class="input-text full-width" require />
                                                </div> 
                                                <div class="col-xs-6">
                                                    <label>Telephone</label>
                                                    <input type="number" name="h_tel" id="h_tel" class="input-text full-width" require />
                                                </div> 
                                            </div>
                                            <hr><h3>User Details</h3><hr>
                                            <div class="row">
                                                <div class="form-group col-xs-5">
                                                    <label>Full Name</label>
                                                    <input type="text" name="h_fname" id="h_fname" class="input-text full-width" require />
                                                </div> 
                                                <div class="form-group col-xs-5">
                                                    <label>Display Name</label>
                                                    <input type="text" name="h_username" id="h_username" class="input-text full-width" require />
                                                </div> 
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-xs-5">
                                                    <label>Email</label>
                                                    <input type="email" name="email" id="email" class="input-text full-width" placeholder="This email will be used to login" require />
                                                </div> 
                                                <div class="form-group col-xs-5">
                                                    <label>Position</label>
                                                    <input type="text" name="position" id="position" class="input-text full-width" require />
                                                </div> 
                                            </div>
                                            <div class=" row">
                                                <div class="form-group col-xs-5">
                                                    <label>Password</label>
                                                    <input type="password" name="password" id="password" class="input-text full-width" require />
                                                </div> 
                                                <div class="form-group col-xs-5">
                                                    <label>Confirm Password</label>
                                                    <input type="password" name="repassword" id="repassword" class="input-text full-width" require />
                                                </div> 
                                            </div>
                                            <div class="row pwd-mismatch hidden">
                                                <div class="alert alert-error">Error: Password mismatch, try entering the same password. <span class="close"></span></div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-xs-6">
                                                    <button type="submit" class="btn btn-medium" id="btnReg">Create Account</button>  
                                                </div>
                                            </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="design-inovation">
                                <form action="" method="post" id="frmAgency">
                                            <h3>Agency Details</h3><hr>
                                            <div class="form-group row">
                                                <div class="col-xs-12">
                                                    <label>Agency Name</label>
                                                    <input type="text" name="a_name" id="a_name" class="input-text full-width" required />
                                                </div> 
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-xs-4">
                                                    <label>Country</label>
                                                    <input type="text" name="a_country" id="a_country" class="input-text full-width" required />
                                                </div> 
                                                <div class="col-xs-4">
                                                    <label>City</label>
                                                    <input type="text" name="a_city" id="a_city" class="input-text full-width" required />
                                                </div> 
                                                <div class="col-xs-4">
                                                    <label>Zip/Postal Code</label>
                                                    <input type="text" name="a_zip" id="a_zip" class="input-text full-width" required />
                                                </div> 
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-xs-12">
                                                    <label>Address</label>
                                                    <textarea name="a_addr" id="a_addr" class="full-width" required></textarea>
                                                </div> 
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-xs-4">
                                                    <label>Email</label>
                                                    <input type="email" name="a_email" id="a_email" class="input-text full-width" required />
                                                </div> 
                                                <div class="col-xs-4">
                                                    <label>Telephone</label>
                                                    <input type="number" name="a_tel" id="a_tel" class="input-text full-width" required />
                                                </div> 
                                                <div class="col-xs-4">
                                                    <label>Skype Id</label>
                                                    <input type="text" name="a_skype" id="a_skype" class="input-text full-width" required />
                                                </div> 
                                            </div>
                                            <hr><h3>User Details</h3><hr>
                                            <div class="form-group row">
                                                <div class="col-xs-4">
                                                    <label>Full Name</label>
                                                    <input type="text" name="a_fname" id="a_fname" class="input-text full-width"  required />
                                                </div> 
                                                <div class="col-xs-4">
                                                    <label>Display Name</label>
                                                    <input type="text" name="username" id="username" class="input-text full-width" required />
                                                </div> 
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-xs-4">
                                                    <label>Email</label>
                                                    <input type="email" name="email" id="email" class="input-text full-width" placeholder="This email will be used to login" required />
                                                </div> 
                                                <div class="col-xs-4">
                                                    <label>Position</label>
                                                    <input type="text" name="position" id="position" class="input-text full-width" required />
                                                </div> 
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-xs-4">
                                                    <label>Password</label>
                                                    <input type="password" name="password" id="password" class="input-text full-width" required />
                                                </div> 
                                                <div class="col-xs-4">
                                                    <label>Confirm Password</label>
                                                    <input type="password" name="repassword" id="repassword" class="input-text full-width" required />
                                                </div> 
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-xs-6">
                                                    <button type="submit" class="btn btn-medium" id="btnReg2">Create Account</button>  
                                                </div>
                                            </div>
                                </form>
                            </div>
                                    
                        </div>
                    </div>
                    <div id="feedback"></div>
                </div>
            </div>
        </section>
        
        <?php include 'template/footer.php'; ?>
    </div>

    <!-- Javascript -->
    <?php include 'template/js-loader.html'; ?>
    <script type="text/javascript">
        (function($){
            // register service provider
            $(document).on('submit', '#frmHotel', function(){
                $('#btnReg').addClass('disabled');
                $('#btnReg').delay(500).html('Proccesing...');
                var data = $(this).serialize();
                if ($('#password').val()==$('#repassword').val()) {
                    $('.pwd-mismatch').addClass('hidden');
                    $.ajax({
                        type : 'POST', url  : 'ajax/controller.php?request=register&type=hotel',  data : data,
                        success :  function(data){
                            $('#feedback').html(data);
                            $('#password').value = '';$('#repassword').value = '';
                            //console.log(data);
                        },
                    });
                }else{
                    $('.pwd-mismatch').removeClass('hidden');
                }    
                $('#btnReg').removeClass('disabled');
                $('#btnReg').delay(500).html('Register Now');
                return false;
            });

            // register standard user
            $(document).on('submit', '#frmAgency', function(){
                $('#btnReg2').addClass('disabled');
                $('#btnReg2').delay(500).html('Proccesing...');
                var data = $(this).serialize();
                $.ajax({
                    type : 'POST',
                    url  : 'ajax/controller.php?request=register&type=agency',
                    data : data,
                    success :  function(data){
                        $('#feedback').html(data);
                        $('#password').value = '';$('#repassword').value = '';
                        $('#btnReg2').removeClass('disabled');
                        $('#btnReg2').delay(500).html('Register Now');
                        //console.log(data);
                    },    
                });
                return false;
            });

        })(jQuery); 

    </script>
</body>
</html>

