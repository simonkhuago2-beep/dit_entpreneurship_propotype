<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CCTECH | Rooms</title>
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
    <style type="text/css">
      .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {vertical-align:middle;}
    </style>

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
                $one = $_FILES["imgOne"]["name"]; $imgPath1 = 'libs/rooms/'.$one;
                $two = $_FILES["imgTwo"]["name"]; $imgPath2 = 'libs/rooms/'.$two;
                $add = DB::getInstance()->insert('rooms',array(
                'hid'=>Input::get('id'),'name'=>Input::get('type'),'qty'=>Input::get('qty'),'brkfst'=>Input::get('brkfst'),'adult'=>Input::get('adult'),
                'rollaway'=>Input::get('rollaway'),'extra'=>Input::get('extra'),'descp'=>Input::get('descp'),'facil'=>Input::get('facil'),'child'=>Input::get('child'),
                'date'=>$date,'imgOne'=>$imgPath1,'imgTwo'=>$imgPath2,'price'=>Input::get('rate'),'meal_plan'=>Input::get('meal')
                ) 
              );
                if ($add) {
                    Session::flash('saved', 'Added successfully!. ');
                    move_uploaded_file( $_FILES['imgOne']['tmp_name'], $imgPath1);
                    move_uploaded_file( $_FILES['imgTwo']['tmp_name'], $imgPath2);
                }else{Session::flash('failed', 'Failed!. ');}
                Redirect::to('rooms.php');
            } 
            /*-----------update a room --------------*/
            if(Input::get('update') ) {
                $date = make_date();
                $user_dir = 'libs/rooms';
                $one = $_FILES["imgOne"]["name"]; 
                $two = $_FILES["imgTwo"]["name"]; 
                if (!empty(is_uploaded_file($_FILES['imgOne']['tmp_name']))) {$imgPath1 = $user_dir.'/'.$one;}else{$imgPath1 = Input::get('db-img1');}
                if (!empty(is_uploaded_file($_FILES['imgTwo']['tmp_name']))) {$imgPath2 = $user_dir.'/'.$two;}else{$imgPath2 = Input::get('db-img2');} 

                $add = DB::getInstance()->update('rooms',Input::get('edit-id'),array(
                    'name'=>Input::get('type'),'qty'=>Input::get('qty'),'vacant'=>Input::get('vacant'),'brkfst'=>Input::get('brkfst'),'adult'=>Input::get('adult'),
                    'rollaway'=>Input::get('rollaway'),'extra'=>Input::get('extra'),'descp'=>Input::get('descp'),'facil'=>Input::get('facil'),'child'=>Input::get('child'),
                    'imgOne'=>$imgPath1,'imgTwo'=>$imgPath2,'price'=>Input::get('rate'),'meal_plan'=>Input::get('meal')
                    ) 
                  );
                if ($add) {
                    Session::flash('saved', 'Updated successfully!. ');
                    move_uploaded_file( $_FILES['imgOne']['tmp_name'], $imgPath1);
                    move_uploaded_file( $_FILES['imgTwo']['tmp_name'], $imgPath2);
                }else{Session::flash('failed', 'Failed!. ');}

                Redirect::to('rooms.php');
            } 

            /*-----------------------------
                delete a room
            ----------------------------*/
            if(Input::get('del')){
                $fnd=find_by_id('rooms',Input::get('del'));
                unlink($find->imgOne);unlink($find->imgTwo);
                $sql = DB::getInstance()->delete('rooms', array('id', '=', Input::get('del') )); 
                if ($sql) {
                  Session::flash('delete', 'Room deleted successfully');
                  Redirect::to('rooms.php');
                } 
            }
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <section class="content-header">
              <h1> <?php echo $userCompany->company_name ?></h1>
              <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Manage Rooms</li>
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
                        <div class="box" >
                            <div class="box-header">
                              <h3 class="box-title">All Rooms</h3>
                              <div class="box-tools pull-right">
                                <a class="btn btn-box-tool btn-default" href="#" onclick="addRooms()"><i class="fa fa-plus"></i> Add Room</a>
                              </div>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover table-striped">
                                    <thead>
                                      <tr>
                                        <th></th><th>Rooms</th><th>Quantity</th><th>Vacant</th><th>Price</th><th>Services</th><th>Actions</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                        $list = DB::getInstance()->query("SELECT * FROM rooms WHERE hid = {$client->data()->id} ");
                                        if ($list->count()) {
                                            foreach ($list->results() as $key => $value) { ?>
                                                <tr id="<?php echo $value->id ?>">
                                                    <td><img src="<?php echo $value->imgOne ?>" alt="img" width="120px" height="100px"> </td>
                                                    <td>
                                                        <h4><?php echo $value->name; ?></h4>
                                                        <?php
                                                            $facil_arr = explode(",", $value->facil);
                                                            foreach ($facil_arr as $key => $f) { ?>
                                                            <span><i class="fa fa-check"></i><?php echo $f; ?></span>
                                                        <?php } ?>
                                                    </td>
                                                    <td><?php echo $value->qty; ?> </td>
                                                    <td><?php echo $value->vacant; ?> </td>
                                                    <td>$<?php echo $value->price; ?> </td>
                                                    <td>
                                                        <h5>Breakfast<span class="pull-right">$<?php echo $value->brkfst; ?></span></h5>
                                                        <h5>Rollaway Bed<span class="pull-right">$<?php echo $value->rollaway; ?></span></h5>
                                                        <h5>Extra Bed<span class="pull-right">$<?php echo $value->extra; ?></span></h5>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                          <a href="#" class="edit btn btn-xs btn-warning"><i class="fa-edit fa"></i></a>
                                                          <a href="javascript:del('<?php echo $value->id?>','<?php echo $value->name?>')" class="btn btn-xs btn-danger"><i class="fa-trash-o fa"></i></a>
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
                        <div class="modal-dialog" style="width:900px">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="myModalLabel">Add a Room</h4>
                              </div>
                              <div class="modal-body"><form method="POST" enctype="multipart/form-data" action="" id="frmAdd">
                                    <div >
                                        <div class="col-sm-">
                                            <input type="hidden" name="id" class="form-control" id="hid" value="<?php echo  $client->data()->id;?>">
                                            <input type="hidden" name="edit-id" id="edit-id">
                                            <input type="hidden" name="db-img1" id="db-img1"><input type="hidden" name="db-img2" id="db-img2">
                                            <div class="form-group col-sm-6">
                                                <label for="" class="control-label">Room Type</label>
                                                <input type="text" name="type" class="form-control" id="type" value="">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="" class="control-label">Meal Plan</label>
                                                <input type="text" name="meal" class="form-control" id="meal" value="">
                                            </div>
                                            <div class="form-group col-sm-4">
                                                <label for="" class="control-label">Room Rate</label>
                                                <input type="text" name="rate" class="form-control" id="rate" value="">
                                            </div>
                                            <div class="form-group col-sm-4">
                                                <label for="" class="control-label">Room Quantity</label>
                                                <input type="text" name="qty" class="form-control" id="qty" value="">
                                            </div>
                                            <div class="form-group col-sm-4">
                                                <label for="" class="control-label">Room Available</label>
                                                <input type="text" name="vacant" class="form-control" id="vacant" value="">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="" class="control-label">Maxmum number of adult</label>
                                                <input type="number" name="adult" class="form-control" id="adult" value="">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="" class="control-label">Maxmum number of children</label>
                                                <input type="number" name="child" class="form-control" id="child" value="">
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <label for="" class="control-label">Room Facilites</label>
                                                <textarea name="facil" class="form-control" id="facil" placeholder="Eg:Telvision, Fan, Ac, Shower,... "></textarea>
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <label for="" class="control-label">Room Description</label>
                                                <textarea name="descp" class="form-control" id="desc" ></textarea>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <!-- <img class="img-responsive" src="libs/img/600x500.png"> -->
                                                <input type="file" name="imgOne" class="form-control" id="imgOne" >
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <!-- <img class="img-responsive" src="libs/img/600x500.png"> -->
                                                <input type="file" name="imgTwo" class="form-control" id="imgTwo">
                                            </div>

                                            <div class="form-group col-sm-4">
                                                <label for="" class="control-label">Breakfast</label>
                                                <input type="text" name="brkfst" class="form-control" id="brkfst" value="">
                                            </div>
                                            <div class="form-group col-sm-4">
                                                <label for="" class="control-label">Rollaway Bed</label>
                                                <input type="text" name="rollaway" class="form-control" id="rollaway" value="">
                                            </div>
                                            <div class="form-group col-sm-4">
                                                <label for="" class="control-label">Extra Bed</label>
                                                <input type="text" name="extra" class="form-control" id="extra" value="">
                                            </div>


                                        </div>

                                        <div class="clearfix"></div>
                                    </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="btn-add" value="save" name="save">Save Room</button>
                                <button type="submit" class="btn btn-primary" id="btn-update" value="update" name="update" >Update Room</button>
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
          var link = document.getElementById('hotels').className='active';
          var linkChild = document.getElementById('rooms').className='active';
          /*-----------------------------------
            fir table
          -------------------------------------*/
            $(function () {
                $("#example1").DataTable();
                $('#example2').DataTable({"paging": true,"lengthChange": false,"searching": false,"ordering": true,"info": true,"autoWidth": false });
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
                $.ajax({type : 'GET',url  : 'get-room.php', data : data,
                    dataType   : 'json',
                    encode     : true,
                    success :  function(data){
                        $('#type').val(data[0]["name"]);
                        $('#meal').val(data[0]["meal_plan"]);
                        $('#rate').val(data[0]["price"]);
                        $('#qty').val(data[0]["qty"]);
                        $('#vacant').val(data[0]["vacant"]);
                        $('#adult').val(data[0]["adult"]);
                        $('#child').val(data[0]["child"]);
                        $('#facil').val(data[0]["facil"]);
                        $('#desc').val(data[0]["descp"]);
                        $('#db-img1').val(data[0]["imgOne"]);
                        $('#db-img2').val(data[0]["imgTwo"]);
                        $('#brkfst').val(data[0]["brkfst"]);
                        $('#extra').val(data[0]["extra"]);
                        $('#rollaway').val(data[0]["rollaway"]);
                        $('#edit-id').val(data[0]["id"]);

                        $('#myModalLabel').html('Update Room');
                        $('#btn-update').show();$('#btn-add').hide();
                        $("#addModal").modal('show');
                    },
                });

                //$('#edit-id').val(id);
                console.log(id);

            });

            
    
        </script>   
    </div><!-- /wrapper -->
    
  </body>
</html>  