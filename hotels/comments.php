<?php ob_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CCTECH | Reviews</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="libs/css/font-awesome.min.css">
    <link rel="stylesheet" href="libs/plugins/datatables/dataTables.bootstrap.css">
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
                $hid = $client->data()->id;
                $add = DB::getInstance()->insert('reviews',array('reply'=>Input::get('reply-id'),'hotel'=>$hid,'comment'=>Input::get('reply-text') ));
                
                if ($add) {
                    Session::flash('saved', 'Added successfully!.');
                }else{Session::flash('failed', 'Failed!. ');}
                Redirect::to('comments.php');
            } 
            /*-----------------------------
                delete a room
            ----------------------------*/
            if(Input::get('del')){
                $file = find_by_id('media',Input::get('del'));
                $sql = DB::getInstance()->delete('reviews', array('id', '=', Input::get('del') )); 
                if ($sql) {
                    unlink($file->path);
                    Session::flash('delete', 'File deleted successfully');
                    Redirect::to('comments.php');
                } 
            }
        ?>
        <div class="content-wrapper">
            <section class="content-header">
              <h1>Guest Reviews</h1>
              <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Manage Reviews</li>
              </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class=" col-md-10 col-md-offset-1 col-xs-12">
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
                              <!-- <h3 class="box-title">All Comments</h3> -->
                              <div class="box-tools pull-right">
                                <!-- <a class="btn btn-box-tool btn-success" href="#" onclick="addMedia()" style="color:#fff;"><i class="fa fa-plus"></i> Add Media</a> -->
                              </div>
                            </div>
                            <div class="box-body">
                                <table class="table" id="tblReview">
                                    <thead><th>Comments</th> <th></th></thead>
                                    <tbody>
                                        <?php 
                                            $list = DB::getInstance()->query("SELECT * FROM reviews WHERE hotel = $clientId AND reply = 0 ");
                                            foreach ($list->results() as $key => $value) {
                                                $booking = find_by_id('booking',$value->bookId);
                                                $json = json_decode($booking->trans_details);
                                        ?>
                                        <tr class="chat">
                                            <td>
                                                <div class="item">
                                                    <img src="libs/img/user.png" alt="user image" class="online">
                                                    <p class="message">
                                                        <a href="#" class="name">
                                                           <b class="text-capitalize"><?php echo $json->name; ?></b><br>
                                                           <small class="text-muted pull-righ"><i class="fa fa-clock-o"></i> <?php echo $value->added; ?></small>
                                                        </a>
                                                        <?php echo $value->comment; ?>
                                                    </p>
                                                    <div class="attachment">
                                                        <h4>Reply:</h4>
                                                        <?php 
                                                            $replies = DB::getInstance()->query("SELECT * FROM reviews WHERE hotel = $clientId AND reply = $value->id ORDER BY id ASC LIMIT 1");
                                                            foreach ($replies->results() as $key => $reply) { ?>
                                                            <p class="filename"><?php echo $reply->comment; ?> </p>
                                                        <?php 
                                                            }
                                                        ?>
                                                      
                                                      
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="vertical-align:middle; ">
                                                <div class="btn-group">
                                                    <a href="javascript:reply('<?php echo $value->id?>')" class="btn btn-sm bg-olive"><i class="fa fa-reply"></i> Reply</a>
                                                    <a href="javascript:del('<?php echo $value->id?>')" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> Delete</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
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
                            <h4 class="modal-title" id="myModalLabel">Write a reply</h4>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <input type="hidden" name="reply-id" id="reply-id"> 
                                <input type="hidden" name="hotel-id" value="<?php echo $clientId ?>">
                                <div class="form-group">
                                    <textarea placeholder="Enter some text.." name="reply-text" id="reply-text" class="form-control" rows="7" required></textarea>
                                </div>    
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="btn-add" value="save" name="save">Reply</button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
            <!--/modal window-->
        </div>
    </div><!-- /wrapper -->
    <?php include 'layouts/footer.php'; ?> 
    <script src="libs/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="libs/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="libs/js/angular.js"></script>
    <script>
        $("#tblReview").DataTable();
        var link = document.getElementById('comments').className='active';
        function addMedia(){$("#addModal").modal('show')};
        //$('.tools .del').click(function(e)
        function del(id){
            //e.preventDefault();
            //var id = $(this).parent().attr('id') ;
            if (confirm("Are you sure you want to delete '" + id + "'"))  { window.location.href = 'comments.php?del=' + id; }
            console.log(id);
        };
        function reply(id){
            $('#reply-id').val(id);
            $("#addModal").modal('show');
        }
    </script>
  </body>
</html>  