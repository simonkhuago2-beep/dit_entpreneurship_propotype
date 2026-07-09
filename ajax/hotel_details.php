<?php
    ob_start();

?>

<!doctype html>
<html class="no-js" lang="en">
    <head>
        <title>I-Travel | Home</title>
        <?php include('layouts/head.ctp'); ?>
    </head>
    <body>
        <!-- navigation panel -->
        <?php include('layouts/navbar.ctp'); ?>
        <!-- end navigation panel -->
        
        <!--breadcrumb-->
	        <section class="bg-gray page-title page-title-small border-bottom-light border-top-light">
	            <div class="container">
	                <div class="row">
	                    <div class="col-md-8 col-sm-12 wow fadeInUp animated" data-wow-duration="300ms" style="visibility: visible; animation-duration: 300ms; animation-name: fadeInUp;">
	                        <!-- page title -->
	                        <h1 class="black-text">AVAILABLE ROOMS</h1>
	                        <!-- end page title -->
	                    </div>
	                    <div class="col-md-4 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none animated" data-wow-duration="600ms" style="visibility: visible; animation-duration: 600ms; animation-name: fadeInUp;">
	                        <!-- breadcrumb -->
	                        <ul>
	                            <li><a href="#">Home</a></li>
	                            <!-- <li><a href="#">Pages</a></li> -->
	                            <li>ROOM TYPES</li>
	                        </ul>
	                        <!-- end breadcrumb -->
	                    </div>
	                </div>
	            </div>
	        </section>
        <!--/breadcrumb-->
        
        <section class="container">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr><th>ROOM TYPE</th><th>CONDITIONS</th><th>MAXIMUM OCCUPANCY</th><th>PRICE</th><th>RESERVATION</th></tr>
                </thead>
                <tbody id="tbody">
                    <?php
                        $hotel_id = Input::get('id');
                        $sql = DB::getInstance()->query("SELECT * FROM rooms WHERE hid= '{$hotel_id}' ORDER BY id DESC");
                        if ($sql->count()) {
                            
                        foreach ($sql->results() as $key => $value) {
                            echo '<tr>';                                                                
                            ?>
                               <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                        <img  src="<?php echo $value->imgOne?>" alt="room-image">
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <p><?php echo $value->name?></p>
                                            <div>
                                                <div class="checkbox-inline"><label><input type="checkbox" <?php if($value->fan == 'no'){echo 'checked';}?> >FAN</label></div>
                                                <div class="checkbox-inline"><label><input type="checkbox" <?php if($value->ac == 'yes'){echo 'checked';}?> >AC</label></div>
                                                <div class="checkbox-inline"><label><input type="checkbox" <?php if($value->tv == 'yes'){echo 'checked';}?> >TV</label></div>
                                            </div>

                                            <div>
                                                <div class="checkbox-inline"><label><input type="checkbox" <?php if($value->fridge == 'yes'){echo 'checked';}?> >FRIDGE</label></div>
                                                <div class="checkbox-inline"><label><input type="checkbox" <?php if($value->shower == 'yes'){echo 'checked';}?> >SHOWER</label></div>
                                                <div class="checkbox-inline"><label><input type="checkbox" <?php if($value->bath == 'yes'){echo 'checked';}?> >BATH</label></div>
                                            </div>
                                        </div>
                                   </div>                                   
                               </td>
                    
                            <?php
                                echo '<td>';
                                    echo '<ul>';
                                        echo '<li>' . $value->brkfst . '</li>'; 
                                        echo '<li>' . $value->facil . '</li>';
                                    echo '</ul>';
                                echo '</td>';
                            
                                echo '<td>';
                                    echo '<ul>';
                                        echo '<li> Adult : ' . $value->adult . '</li>'; 
                                        echo '<li> Child : ' . $value->child . '</li>';
                                    echo '</ul>';
                                echo '</td>';
                            
                                echo '<td>' . $value->price . ' GHS</td>';
                            ?>
                                <td><a href="/travel/booking.php?id=<?php echo $value->id;?>&hid=<?php echo $value->hid;?>" class="highlight-button-dark btn btn-small button no-margin-lr">RESERVE</a></td>                                
                            <?php
                            echo '</tr>';
                        }
                            
                        }else{
                            echo '<tr><td colspan="5">No Records Found! </tr>'; 
                        }
        
                    ?>
                </tbody>
            </table>
        </section>
        
        <!-- footer -->
        <?php include 'layouts/footer.ctp';?>
        <!-- end footer -->

        <script type="text/javascript">
            $(document).ready(function() {
                $('input[type="checkbox"]').click(function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                });
            });
        </script>
        
    </body>
</html>
