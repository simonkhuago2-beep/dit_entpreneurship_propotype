<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Kcaesy! | Transfer Request</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
   
  </head>

  <body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <!-- left menus-->
            <?php include 'layout/left-menus.php'; ?>
            <!--/left menus-->

            <!-- top navigation -->
            <?php include 'layout/top-nav.php';?>
            <!-- /top navigation -->
            <?php
                /*------------add a tour guide 161811---*/
                if(Input::exists()){
                    if(Input::get('add')){
                        $date = make_date();
                        $user_dir = "uploads/guide";
                        $info = pathinfo($_FILES['guide']['name']);
                        $MediaPath = $user_dir.'/'.$_FILES['guide']['name'];
                        try {

                            $insert = DB::getInstance()->insert('tour_guide',array(
                                'sex'      =>Input::get('t-sex'),
                                'name'     =>Input::get('t-name'),
                                'country'  =>Input::get('t-country'),
                                'city'     =>Input::get('t-city'),
                                'address'  =>Input::get('sup-addr'),
                                'eml'      =>Input::get('sup-eml'),
                                'tel'      =>Input::get('sup-tel'),
                                'int1'     =>Input::get('t-interest1'),
                                'int2'     =>Input::get('t-interest2'),
                                'avail'    =>Input::get('t-avail'), 
                                'img'      =>$MediaPath,
                                'cat'      =>Input::get('t-cat'),
                                'qualify'  =>Input::get('t-qualify'),
                                'grate'    =>Input::get('t-grate'),
                                'prate'    =>Input::get('t- prate'),
                                'gpolicy'  =>Input::get('gpolicy'),
                                'pay'      =>Input::get('pay-policy'),
                                'date'     =>$date,  
                                ));

                                if($insert){
                                    move_uploaded_file( $_FILES['guide']['tmp_name'], $MediaPath);
                                    Session::flash('added', 'Tour Guide created!.');
                                    }
                        } catch (PDOException $e) { die($e->getMessage());}
                    }
                } 
            ?>    

            <!-- page content -->
            <div class="right_col" role="main" style="min-height: 930px;">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Tour Guide Details</h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                              <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                                <span class="input-group-btn">
                                  <button class="btn btn-default" type="button">Go!</button>
                                </span>
                              </div>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <?php
                              if(Session::exists('added')){
                                echo'
                                <div class="alert alert-success alert-dismissible fade in" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                  <strong><i class="glyphicon glyphicon-ok"></i> DONE!</strong><br> '.Session::flash("added").'
                                </div>
                                '; 
                              }
                              if(Session::exists('delete')){
                                echo'
                                <div class="alert alert-success alert-dismissible fade in" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                  <strong><i class="glyphicon glyphicon-ok"></i> DONE!</strong><br> '.Session::flash("delete").'
                                </div>
                                '; 
                            }
                            ?>  
                        </div>
                        <!-- /notifications-->
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Add New </h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <form action="" method="POST" enctype='multipart/form-data' class="form-horizonta form-label-lef">
                                        <div class="form-group col-md-3 col-sm-4 col-xs-12">
                                            <label class="control-label">Sex</label>
                                                <select name="t-sex" id="t-sex"  class="form-control" required="" placeholder="Sex">
                                                    <option value=" ">Male</option>
                                                    <option value=" ">Female</option>
                                                </select>
                                        </div>
                                        
                                        <div class="form-group col-md-9 col-sm-8 col-xs-12">
                                            <label class="">Tour Guide Name</label>
                                            <input type="text" id="t-name" name="t-name" class="form-control" required>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label class="control-label">Country</label>
                                            <input type="text" id="t-country" name="t-country" class="form-control" required>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label class="control-label">City</label>
                                            <input type="text" id="t-city" name="t-city" class="form-control" required>
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <label class="control-label">Address</label>
                                            <textarea id="sup-addr" name="sup-addr" required class="form-control"></textarea>
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label class="control-label">Email</label>
                                            <input type="text" id="sup-eml" name="sup-eml" class="form-control" required>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label class="control-label">Telephone</label>
                                            <input type="text" id="sup-tel" name="sup-tel" class="form-control" required>
                                        </div>
                                        
                                        <div class="form-group col-md-3 col-sm-3 col-xs-12">
                                            <label class="control-label">Special Interest 1</label>
                                            <select id="t-interest1" name="t-interest1" class="form-control" required>
                                                <option value="arrange it alphabetically" disabled selected>Choose Interest 1</option>
                                                <option value="Day_trips">Day Trips</option>
                                                <option value="Adventure">Adventure</option>
                                                <option value="Cultural">Cultural</option>
                                                <option value="Day_trip">Day Trip</option>
                                         </select>
                                        </div>
                                        <div class="form-group col-md-3 col-sm-3 col-xs-12">
                                            <label class="control-label">Special Interest 2</label>
                                            <select id="t-interest2" name="t-interest2" class="form-control" required>
                                                <option value="arrange it alphabetically" disabled selected>Choose Interest 2</option>
                                                <option value="group_tours">Group Tours</option>
                                                <option value="history">History</option>
                                                <option value="tour_by_night">Tour By Night</option>
                                                <option value="safare">Safari</option>
                                             </select>
                                        </div>
                                        
                                        <div class="form-group col-md-3 col-sm-3 col-xs-12">
                                            <label class="control-label">Availability</label>
                                            <select id="t-avail" name="t-avail" class="form-control" required>
                                                <option value="arrange it alphabetically" disabled selected>Availability</option>
                                                <option value="Daily">Daily</option>
                                                <option value="Weekends">Weekends</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group col-md-3 col-sm-3 col-xs-12">
                                            <label class="control-label">Category</label>
                                            <select id="t-cat" name="t-cat" class="form-control" required>
                                                <option value="arrange it alphabetically" disabled selected>Choose Type of Guide</option>
                                                <option value="Private">Private</option>
                                                <option value="Group">Group</option>
                                                <option value="Special_interest">Special Interest</option>
                                                <option value="Freelance">Freelance</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group col-md-3 col-sm-3 col-xs-12">
                                            <label class="control-label">Qualification</label>
                                            <input type="text" id="t-qaulify" name="t-qualify" class="form-control" required>
                                        </div>
                                        
                                        <div class="form-group col-md-3 col-sm-3 col-xs-12">
                                            <label class="control-label">Group Rate</label>
                                            <input type="text" id="t-grate" name="t-grate" class="form-control" required>
                                        </div>
                                        <div class="form-group col-md-3 col-sm-3 col-xs-12">
                                            <label class="control-label">Rate/Person</label>
                                            <input type="text" id="t-prate" name="t-prate" class="form-control" required>
                                        </div>

                                        <div class="form-group col-md-3 col-sm-3 col-xs-12">
                                            <label class="control-label">Image</label>
                                            <input type="file" id="t-guide" name="t-guide" class="form-control" required>
                                        </div>
                                        
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <label class="control-label">Guide Policy</label>
                                            <textarea class="form-control" name="gpolicy" id="gpolicy"></textarea>
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <label class="control-label">Pay Policy</label>
                                            <textarea class="form-control" name="pay-policy" id="pay-policy"></textarea>
                                        </div>
                                        <input type="hidden" name="edit-id" id="edit-id">
                                        <div class="form-group ">
                                            <div class="col-md-12 col-sm-8 col-xs-12 ">
                                                <button type="submit" value="add" name="add" id="btn-add" class="btn btn-md btn-success">Add Guide</button>
                                                <button type="submit" value="update" name="update" id="btn-update" class="btn btn-md btn-primary hidden">Update Guide</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <?php include 'layout/footer.php'; ?>
            <!-- /footer content -->
        </div>
    </div>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    
    <!-- tinymce -->
    <script src="vendors/tinymce/tinymce.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js">  </script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#policy',
            plugins : 'advlist autolink link image lists charmap print preview'
        });
    </script>
   </body>
</html>