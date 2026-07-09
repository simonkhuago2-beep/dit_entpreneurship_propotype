<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CCTECH | Accounts</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="libs/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
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
    <style type="text/css">
        .table>tbody>tr>td{vertical-align: middle;}
    </style>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php 
            include 'layouts/header.php'; 
            include 'layouts/sidebar.php';


            /*-----------------------------
                delete a room
            ----------------------------*/
            if(Input::get('del')){
                $sql = DB::getInstance()->delete('booking', array('id', '=', Input::get('del') )); 
                if ($sql) {
                  Session::flash('delete', 'Transaction deleted successfully');
                  Redirect::to('accounts.php');
                } 
            }
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <section class="content-header">
              <h1> Accounts Management</h1>
              <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Accounts Management</li>
              </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <?php
                            if(Session::exists('delete')){ ?>
                              <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4>  <i class="icon fa fa-check"></i> Alert!</h4> <?php echo Session::flash("delete") ?>
                              </div>
                        <?php } ?>
                        <div class="box box-primary" >
                            <div class="box-header">
                              <h3 class="box-title">All Transactions</h3>
                              
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <table id="example2" class="table table-bordere table-hover">
                                    <thead>
                                      <tr>
                                        <th>Reference No</th>
                                        <th>Guest Name</th><th>Duration</th>
                                        <th>No. of Rooms</th><th>No of Persons </th>
                                        <th>Total Cost ($)</th><th>OTA Commission</th>
                                        <th>Payment Due</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                        $list = DB::getInstance()->query("SELECT * FROM booking WHERE trans_type = 'hotels' ");
                                        if ($list->count()) {
                                            foreach ($list->results() as $key => $value) { 
                                                $bookingDetails = json_decode($value->trans_details);
                                                $room = find_by_id('rooms',$bookingDetails->roomId);
                                                if($clientId == $bookingDetails->hotelId){
                                            ?>
                                                <tr id="<?php echo $value->id ?>">
                                                    <td><?php echo $value->id;?></td>
                                                    <td>
                                                        <h4 class="text-capitalize"><?php echo $bookingDetails->name ?></h4>
                                                    </td>
                                                    <td><?php echo $bookingDetails->days; ?></td>
                                                    <td><?php echo $bookingDetails->roomqty; ?>         </td>
                                                    <td><?php echo $bookingDetails->adult; ?> Adults <br><?php echo $bookingDetails->child; ?> Child</td>
                                                    <td><?php echo $value->trans_cost; ?></td>
                                                    <td><?php echo $comm = 0.2*$value->trans_cost; ?></td>
                                                    <td><?php echo $value->trans_cost - $comm; ?></td>
                                                   
                                                    <!-- <td>
                                                        <div class="btn-group">
                                                          <a href="#" class="edit btn btn-sm btn-warning"><i class="fa-edit fa"></i></a>
                                                          <a href="javascript:del('<?php echo $value->id?>','<?php echo $value->name?>')" class="btn btn-sm btn-danger"><i class="fa-trash-o fa"></i></a>
                                                        </div>
                                                    </td> -->
                                                </tr>
                                        <?php   }
                                            }
                                        }    
                                      ?>
                                    </tbody>  
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>

                </div>   

                
            </section>
            <!-- /.content -->
        </div> 
        <?php include 'layouts/footer.php'; ?> 
        <!-- DataTables -->
        <script src="libs/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="libs/plugins/datatables/dataTables.bootstrap.min.js"></script>
        <script src="libs/js/angular.js"></script>
        <script>
          var link = document.getElementById('accounts').className='active';
          /*-----------------------------------
            fir table
          -------------------------------------*/
            $(function () {
                $("#example1").DataTable();
                $('#example2').DataTable({"paging": true,"lengthChange": true,"searching": true,"ordering": false,"info": true,"autoWidth": false });
            }); 
            

            function del(id, title) { if (confirm("Are you sure you want to delete '" + title + "'"))  { window.location.href = 'accounts.php?del=' + id; } }

            
            
    
        </script>   
    </div><!-- /wrapper -->
    
  </body>
</html>  