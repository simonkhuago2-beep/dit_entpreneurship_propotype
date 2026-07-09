<?php ob_start(); ?>
<!DOCTYPE html>
<html> 
<head>
    <!-- Page Title -->
    <title>Travelafric.com</title>
    <?php include 'template/head.html'; ?>    
    <style type="text/css">
        .autocomplete-suggestions{background:#fff;padding:1px;overflow:hidden;border:1px #ccc solid;   }
        .autocomplete-suggestion{padding:5px 10px; }
        .autocomplete-suggestion:hover{background:#f1f1f1;cursor:pointer;  }
    </style>
</head>
<body>
<div id="page-wrapper">
        <?php include 'template/nav.php'; ?>
        <div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title">Contact Us</h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="#">HOME</a></li>
                    <li class="active">Contact Us</li>
                </ul>
            </div>
        </div>

        <section id="content">
            <div class="container">
                <div id="main">
                    <div class="travelo-google-map block"></div>
                    <div class="row">
                        <div class="col-sm-4 col-md-3">
                            <div class="travelo-box contact-us-box">
                                <h4>Contact us</h4>
                                <ul class="contact-address">
                                    <li class="address">
                                        <i class="soap-icon-address circle"></i>
                                        <h5 class="title">Address</h5>
                                        <p>Accra - Ghana</p>
                                        <p>No.1 Airport Square</p>
                                    </li>
                                    <li class="phone">
                                        <i class="soap-icon-phone circle"></i>
                                        <h5 class="title">Phone</h5>
                                        <p>Local: 233-247-943-218</p>
                                        <p>Mobile: 1-800-123-hello</p>
                                    </li>
                                    <li class="email">
                                        <i class="soap-icon-message circle"></i>
                                        <h5 class="title">Email</h5>
                                        <p>info@TravelAfric.com</p>
                                        <p>www.TravelAfric.com</p>
                                    </li>
                                </ul>
                                <ul class="social-icons full-width">
                                    <li><a href="#" data-toggle="tooltip" title="Twitter"><i class="soap-icon-twitter"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" title="GooglePlus"><i class="soap-icon-googleplus"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" title="Facebook"><i class="soap-icon-facebook"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" title="Linkedin"><i class="soap-icon-linkedin"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" title="Vimeo"><i class="soap-icon-vimeo"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-9">
                            <div class="travelo-box">
                                <form class="contact-form" action="contact-us-handler.php" method="post" onsubmit="return false;">
                                    <h4 class="box-title">Send us a Message</h4>
                                    <div class="alert small-box" style="display: none;"></div>
                                    <div class="row form-group">
                                        <div class="col-xs-6">
                                            <label>Your Name</label>
                                            <input type="text" name="name" class="input-text full-width">
                                        </div>
                                        <div class="col-xs-6">
                                            <label>Your Email</label>
                                            <input type="text" name="email" class="input-text full-width">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Your Message</label>
                                        <textarea name="message" rows="6" class="input-text full-width" placeholder="write message here"></textarea>
                                    </div>
                                    <button type="submit" class="btn-large full-width">SEND MESSAGE</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>








        <?php include 'template/footer.php'; ?>
    </div>
    
    <?php include 'template/js-loader.html'; ?>


    <script src="res/js/jquery.autocomplete.min.js"></script>
           
        
    </script>
</body>
</html>