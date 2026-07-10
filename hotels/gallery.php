<?php ob_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CCTECH | Media</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="libs/css/font-awesome.min.css">
   
    <!-- Theme style -->
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
            /*---------add media -----------*/
            if(Input::get('save') ) {
                $one = $_FILES["media"]["name"]; 
                $imgPath1 = 'libs/gallery/'.$one;
                $hid = $client->data()->id;
                $add = DB::getInstance()->insert('media',array('hid'=>$hid,'file_type'=>Input::get('file_type'),'path'=>$imgPath1) );
                
                if ($add) {
                    Session::flash('saved', 'Added successfully!. ');
                    move_uploaded_file( $_FILES['media']['tmp_name'], $imgPath1);
                }else{Session::flash('failed', 'Failed!. ');}
                Redirect::to('gallery.php');
            } 
            /*-----------------------------
                delete a room
            ----------------------------*/
            if(Input::get('del')){
                $file = find_by_id('media',Input::get('del'));
                $sql = DB::getInstance()->delete('media', array('id', '=', Input::get('del') )); 
                if ($sql) {
                    unlink($file->path);
                    Session::flash('delete', 'File deleted successfully');
                    Redirect::to('gallery.php');
                } 
            }
        ?>
        <div class="content-wrapper">
            <section class="content-header">
              <h1>Gallery</h1>
              <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Manage Gallery</li>
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
                        <div class="box box-primary">
                            <div class="box-header">
                              <h3 class="box-title">All Gallery</h3>
                              <div class="box-tools pull-right">
                                <a class="btn btn-box-tool btn-success" href="#" onclick="addMedia()" style="color:#fff;"><i class="fa fa-plus"></i> Add Media</a>
                              </div>
                            </div>
                            <div class="box-body">
                                <?php $all_media = DB::getInstance()->query("SELECT * FROM media WHERE hid = $clientId"); 
                                    foreach ($all_media->results() as $key => $value):
                                ?>
                                <div class="col-md-2">
                                    <div class="thumbnail">
                                      <div class="image view view-first">
                                        <img style="width: 100%; display: block;" src="<?php echo $value->path ?>" alt="image">
                                        <div class="mask">
                                          <p>Your Text</p>
                                          <div class="tools tools-bottom" id="<?php echo $value->id ?>">
                                            <!-- <a href="#"><i class="fa fa-link"></i></a>
                                            <a href="#"><i class="fa fa-pencil"></i></a> -->
                                            <a href="#" class="del"><i class="fa fa-times"></i></a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!--modal window-->
            <div class="modal modal-large fade" id="addModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">Upload your file</h4>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data" >
                        <div class="modal-body">
                            <div class="form-group">
                                <label>File</label>
                                <input type="file" name="media" class="form-control" required>
                            </div>    
                            <div class="form-group">
                                <label>File Type</label>
                                <input type="text" name="file_type" class="form-control" readonly value="image">
                            </div>    
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="btn-add" value="save" name="save">Save Media</button>
                        </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
            <!--/modal window-->
        </div>
    </div><!-- /wrapper -->
    <?php include 'layouts/footer.php'; ?> 
        
    <script src="libs/js/angular.js"></script>
    <script>
        var link = document.getElementById('gal').className='active';
        function addMedia(){$("#addModal").modal('show')};
        $('.tools .del').click(function(e){
            e.preventDefault();
            var id = $(this).parent().attr('id') ;
            if (confirm("Are you sure you want to delete '" + id + "'"))  { window.location.href = 'gallery.php?del=' + id; }
            console.log(id);
        });
    </script>
  </body>
</html>  