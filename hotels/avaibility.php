<?php ob_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CCTECH | Rooms Availability</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="libs/css/font-awesome.min.css">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- Theme style -->
     <!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="libs/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="libs/plugins/fullcalendar/fullcalendar.print.css" media="print">
    <!-- DataTables -->
    <link rel="stylesheet" href="libs/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="libs/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="libs/plugins/iCheck/square/blue.css">
    <link rel="stylesheet" href="libs/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php 
            include 'layouts/header.php'; 
            include 'layouts/sidebar.php';
            
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <section class="content-header">
              <h1>Availability </h1>
              <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Availability</li>
              </ol>
            </section>
            <!-- Main content -->
            <section class="content" >
              <div class="row col-xs-10 col-xs-offset-1">
                <div class="col-md-4 col-sm-4 ">
                  <div class="box box-primary">
                    <div class="box-header">
                      <h2>List of Rooms</h2>
                    </div>
                    <div class="box-body">
                      <table class="table table-striped">
                        <thead><tr><th>Room Type</th><th>Room Id</th></tr></thead>
                        <tbody>
                          <?php $rooms = DB::getInstance()->query("SELECT * FROM rooms WHERE hid=$clientId"); 
                            foreach ($rooms->results() as $key => $value):
                          ?>
                          <tr><td><?php echo $value->name; ?></td><td><?php echo $value->id; ?></td></tr>
                          <?php endforeach;?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <!-- /room list -->

                <div class="col-md-8 col-sm-8">
                  <div class="box box-primary"><div id='calendar'></div></div>
                </div>
                <!-- /calendar -->

                <div class="clearfix"></div>
              </div><!-- /.row -->
              <div class="clearfix"></div>
            </section>
            <!-- /.content -->
            
            <!-- Modal  to Add Event -->
            <div id="createEventModal" class="modal fade" role="dialog">
              <div class="modal-dialog">
                 <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Status</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <label class="control-label" for="rid">Room Type:</label>
                      <input class="form-control" id="rid" name="rid" placeholder="Enter Room Id" type="text" required>
                    </div>
                    <div class="form-group">
                      <label class="control-label" for="title">Status:</label>
                      <input class="form-control" id="title" name="title" placeholder="Status" type="text" required>
                    </div>
                    
                    <input type="hidden" name="hid" id="hid" value="<?php echo $clientId;?>">
                    <input type="hidden" id="startTime"/>
                    <input type="hidden" id="endTime"/>
                       
                    <div class="form-group">
                      <label class="control-label" for="when">When:</label>
                      <div class="controls controls-row" id="when" style="margin-top:5px;">
                      </div>
                    </div>
                     
                  </div>
                  <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submitButton">Save</button>
                  </div>
                </div>
                 
              </div>
            </div>
 
          <!-- Modal to Event Details -->
          <div id="calendarModal" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Event Details</h4>
                </div>
                <div id="modalBody" class="modal-body">
                  <h4 id="modalTitle" class="modal-title"></h4>
                  <div id="modalWhen" style="margin-top:5px;"></div>
                </div>
                <input type="hidden" id="eventID"/>
                <div class="modal-footer">
                  <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                  <button type="submit" class="btn btn-danger" id="deleteButton">Delete</button>
                </div>
              </div>
            </div>
          </div>
          <!--Modal-->

        </div> 
        <?php include 'layouts/footer.php'; ?> 
        <script src="libs/js/angular.js"></script>
        <script src="libs/plugins/moment/min/moment.min.js"></script>
        <script src="libs/plugins/fullcalendar/fullcalendar.min.js"></script>
        <script src="libs/js/availability.js" type="text/javascript"></script>
        <!-- FullCalendar -->

    
    </div><!-- /wrapper -->
    
  </body>
</html>  