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
                    <h2 class="entry-title">Page Head</h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="#">HOME</a></li>
                    <li class="active">Page Title</li>
                </ul>
            </div>
        </div>









        <?php include 'template/footer.php'; ?>
    </div>
    
    <?php include 'template/js-loader.html'; ?>


    <script src="res/js/jquery.autocomplete.min.js"></script>
           
        
    </script>
</body>
</html>