<?php ob_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CCTECH | Promotion</title>
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
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php 
            include 'layouts/header.php'; 
            include 'layouts/sidebar.php';

            if(Input::get('save') ) {
                $date = make_date();
                
                $add = DB::getInstance()->insert('promo',array(
                    'hid'=>Input::get('id'),'title'=>Input::get('title'),'room'=>Input::get('room-type'),
                    'rate'=>Input::get('rate'),'details'=>Input::get('descp'),
                    'datee'=>$date
                    ) 
                );
                if ($add) {Session::flash('saved', 'Added successfully!. ');}else{Session::flash('failed', 'Failed!. ');}

                Redirect::to('promotion.php');
            } 
            /*-----------update a room --------------*/
            if(Input::get('update') ) {                
                $add = DB::getInstance()->update('promo',Input::get('edit-id'),array(
                    'title'=>Input::get('title'),'room'=>Input::get('room-type'),'rate'=>Input::get('rate'),'details'=>Input::get('descp')
                    ) 
                  );
                if ($add) {Session::flash('saved', 'Updated successfully!. ');}else{Session::flash('failed', 'Failed!. ');}
                
                Redirect::to('promotion.php');
            } 

            /*-----------------------------
                delete a room
            ----------------------------*/
            if(Input::get('del')){
                $sql = DB::getInstance()->delete('promo', array('id', '=', Input::get('del') )); 
                if ($sql) {
                  Session::flash('delete', 'Promotion deleted successfully');
                  Redirect::to('promotion.php');
                } 
            }
            /*-----------------make approve-----------*/
                if(Input::get('ap')){
                    $sql = DB::getInstance()->update('promo',Input::get('ap'), array('status'=>1)); 
                    if ($sql) {Session::flash('chng', 'changes made successfully');Redirect::to('promotion.php');}
                }
                /*-----------------make banned-----------*/
                if(Input::get('bn')){
                    $sql = DB::getInstance()->update('promo',Input::get('bn'), array('status'=>0)); 
                    if ($sql) {Session::flash('chng', 'changes made successfully');Redirect::to('promotion.php');}
                }
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <section class="content-header">
              <h1> <?php echo $client->data()->name ?></h1>
              <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Manage Promotion</li>
              </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <?php
                            if(Session::exists('saved')){ ?>
                              <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4>  <i class="icon fa fa-check"></i> Alert!</h4> <?php echo Session::flash("saved") ?>
                              </div>
                        <?php } ?>
                        <?php
                            if(Session::exists('failed')){ ?>
                              <div class="alert alert-warning alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4>  <i class="icon fa fa-warning"></i> Alert!</h4> <?php echo Session::flash("failed") ?>
                              </div>
                        <?php } ?>
                        <?php
                            if(Session::exists('delete')){ ?>
                              <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4>  <i class="icon fa fa-check"></i> Alert!</h4> <?php echo Session::flash("delete") ?>
                              </div>
                        <?php } ?>
                        <?php
                            if(Session::exists('chng')){ ?>
                              <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4>  <i class="icon fa fa-check"></i> Alert!</h4> <?php echo Session::flash("chng") ?>
                              </div>
                        <?php } ?>
                        <div class="box" >
                            <div class="box-header">
                              <h3 class="box-title">All Promotions</h3>
                              <div class="box-tools pull-right">
                                <a class="btn btn-box-tool btn-default" href="#" onclick="addRooms()"><i class="fa fa-plus"></i> Add Promotion</a>
                              </div>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                      <tr>
                                       <th>Title</th><th>Room Type</th><th>Details</th><th>Description</th><th class="text-center">Status</th><th>Actions</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                        $list = DB::getInstance()->query("SELECT * FROM promo WHERE hid = {$clientId} ");
                                        if ($list->count()) {
                                            foreach ($list->results() as $key => $value) { ?>
                                               <tr id="<?php echo $value->id ?>">
                                                   <td><?php echo $value->title; ?></td>
                                                   <td>
                                                       <?php $roomName = find_by_id('rooms',$value->room); echo $roomName->name; ?>
                                                   </td>
                                                   <td><?php echo $value->rate;?>% Discount </td>
                                                   <td><?php echo $value->details;?> </td>
                                                   <td class="text-center">
                                                       <?php if($value->status == 1 ){echo "<i class='fa fa-certificate text-green'></i>";}else{echo "<i class='fa fa-certificate text-red'></i>";} ?>
                                                   </td>
                                                   <td>
                                                        <div class="btn-group">
                                                            <?php if($value->status == 0){?>
                                                            <a href="javascript:app('<?php echo $value->id ?>')" class="state btn btn-sm bg-olive"><i class="fa-tag fa"></i> Activate</a>
                                                            <?php }else{ ?>
                                                            <a href="javascript:ban('<?php echo $value->id ?>')" class="state btn btn-sm bg-orange"><i class="fa-tag fa"></i> Cancel</a>
                                                            <?php } ?>
                                                            <a href="#" class="edit btn btn-sm bg-navy "><i class="fa-edit fa"></i> Edit</a>
                                                            <a href="javascript:del('<?php echo $value->id?>','<?php echo $value->title?>')" class="btn btn-sm btn-danger"><i class="fa-trash-o fa"></i></a>
                                                        </div>
                                                   </td>
                                               </tr>
                                        <?php   }
                                        }
                                      ?>
                                    </tbody>  
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>

                    <!--modal window-->
                    <div class="modal modal-large fade" id="addModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="myModalLabel">Add a Promotion</h4>
                              </div>
                              <div class="modal-body"><form method="POST" enctype="multipart/form-data" action="" id="frmAdd">
                                    <div >
                                        <div class="col-sm-">
                                            <input type="hidden" name="id" class="form-control" id="hid" value="<?php echo  $clientId;?>">
                                            <input type="hidden" name="edit-id" id="edit-id">
                                            <div class="form-group col-sm-12">
                                                <label for="" class="control-label">Promotion Title</label>
                                                <input type="text" name="title" class="form-control" id="title" value="">
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <label for="" class="control-label">Room Type</label>
                                                <select class="form-control" name="room-type" id="room-type" required>
                                                    <?php  $roomList = DB::getInstance()->query("SELECT * FROM rooms WHERE hid = {$clientId} ");
                                                        foreach ($roomList->results() as $key => $rums) { ?>
                                                    <option value="<?php echo $rums->id; ?>"><?php echo $rums->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group col-sm-12">
                                                <label for="" class="control-label">Promotion Rate (calcuted in percentage )</label>
                                                <input type="text" name="rate" class="form-control" id="rate" value="">
                                            </div>
                                            
                                            <div class="form-group col-sm-12">
                                                <label for="" class="control-label">Promotion Description</label>
                                                <textarea name="descp" class="form-control" id="descp" rows="6"></textarea>
                                            </div>
                                            
                                        </div>

                                        <div class="clearfix"></div>
                                    </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="btn-add" value="save" name="save">Save Promo</button>
                                <button type="submit" class="btn btn-primary" id="btn-update" value="update" name="update" >Update Promo</button>
                              </div>
                            </form></div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
                    <!--/modal window-->
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
          var link = document.getElementById('promo').className='active';
          //var linkChild = document.getElementById('rooms').className='active';
          /*-----------------------------------
            fir table
          -------------------------------------*/
            $(function () {
                //$("#example2").DataTable();
                $('#example2').DataTable({"paging": true,"lengthChange": false,"searching": false,"ordering": true,"info": true,"autoWidth": true });
            }); 

            function addRooms(){$('#btn-update').hide();$('#btn-add').show();$("#addModal").modal('show');$('#frmAdd').find('input:text').val('');$('#desc, #facil,#adult,#child').val('');}

            $(document).ready(function(){ 
                $('#btn-update').hide();
            })

            function del(id, title) { if (confirm("Are you sure you want to delete '" + title + "'"))  { window.location.href = 'rooms.php?del=' + id; } }


            $('#example2 .edit').click(function(e){
                e.preventDefault();
                var id = $(this).parent().parent().parent().attr('id'),
                    data = { 'id' : id };
                $.ajax({type : 'POST',url  : 'get-promo.php', data : data,
                    dataType   : 'json',
                    encode     : true,
                    success :  function(data){
                        $('#title').val(data[0]["title"]);
                        $('#rate').val(data[0]["rate"]);
                        $('#descp').val(data[0]["detail"]);
                        $('#edit-id').val(data[0]["id"]);
                        $('#myModalLabel').html('Update Room');
                        $('#btn-update').show();$('#btn-add').hide();
                        $("#addModal").modal('show');
                    },
                });
                console.log(id);

            });

            function app(id){if (confirm("Are you sure you want to activate promotion")){ window.location.href = 'promotion.php?ap=' + id;}}
            function ban(id){if (confirm("Are you sure you want to cancel promotion.")){ window.location.href = 'promotion.php?bn=' + id;}}
    
        </script>   
    </div><!-- /wrapper -->
    
  </body>
</html>  