<?php ob_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CCTECH | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="libs/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="libs/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="libs/plugins/iCheck/square/blue.css">
    <link rel="stylesheet" href="libs/css/skins/_all-skins.min.css">
    <!-- Dropzone Css -->
    <link href="libs/plugins/dropzone/dropzone.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      .a-upload{position:absolute;top:45%;left:41%;background:rgba(33, 150, 243, 0.33);padding:5px;color:#fff;   }
      .pos-rel{position:relative!important; }
      .dropzone{border: 2px solid transparent !important; background-color: #eee !important;padding:0 20px; }
      .no-padding-lr{padding-left:0px;padding-right:0px;  }
    </style>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php 
            include 'layouts/header.php'; 
            include 'layouts/sidebar.php'; 

            if(Input::get('save') ) {
              $arr=array('company_name'=>Input::get('Hname'),'stars'=>Input::get('rating'),'country'=>Input::get('country'),'city'=>Input::get('city'),'address'=>htmlspecialchars(Input::get('addr')),'landmark'=>htmlspecialchars(Input::get('landmarks')),'email'=>Input::get('email'),'telephone'=>Input::get('tel'),'established'=>Input::get('est'),'descp'=>htmlspecialchars(Input::get('descp')),'norms'=>htmlspecialchars(Input::get('norms')),'notes'=>htmlspecialchars(Input::get('gen_note')),'zip'=>htmlspecialchars(Input::get('zip')),'avag_roomPrice'=>Input::get('arp')) ;

              $mapArr = array('map'=>htmlspecialchars(Input::get('map')) );
               
              $update = DB::getInstance()->update('clients',$clientId,array('company_name'=>Input::get('Hname'),'company_details'=>json_encode($arr),'country'=>Input::get('country'),'city'=>Input::get('city'),'stars'=>Input::get('rating'),'map'=>json_encode($mapArr) ));
              if ($update) {Session::flash('saved', 'Updated successfully!. ');}else{Session::flash('failed', 'Update failed!. ');}
              //Session::flash('saved', 'Updated successfully!. ');
              Redirect::to('home.php');
            }
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <section class="content-header">
              <h1> <?php echo $userCompany->company_name ?></h1>
              <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">User profile</li>
              </ol>
            </section>
            <!-- Main content -->
            <section class="content">
              <?php
                if(Session::exists('saved')){ ?>
                  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4> <i class="icon fa fa-check"></i> Alert!<?php echo Session::flash("saved"); ?></h4> 
                  </div>
              <?php } ?>
              <?php
                if(Session::exists('failed')){ ?>
                  <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4> <i class="icon fa fa-warning"></i> Alert! <?php echo Session::flash("failed"); ?></h4>
                  </div>
              <?php } ?>
              
              <div class="row">
                <div class="col-md-3">

                  <!-- Profile Image -->
                  <div class="box box-primary">
                    <div class="box-body box-profile">
                      <img class="profile-user-img img-responsive img-circle" src="libs/img/user.png" alt="User profile picture" style="width:100px;height:100px">
                      <h3 class="profile-username text-center"><?php echo $userDetails->fullname ?></h3>
                      <p class="text-muted text-center"><?php echo $userDetails->position ?></p>

                      <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                          <b>Display Name</b> <a class="pull-right"><?php echo $userDetails->display_name ?></a>
                        </li>
                        <li class="list-group-item">
                          <b>Email</b> <a class="pull-right"><?php echo $uzer->email ?></a>
                        </li>
                        <!-- <li class="list-group-item">
                          <b>Friends</b> <a class="pull-right">13,287</a>
                        </li> -->
                      </ul>
                      <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                    </div><!-- /.box-body -->
                  </div><!-- /.box -->

                  <!-- About Me Box -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">At a glance</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="info-box bg-yellow">
                            <span class="info-box-icon"><i class="fa fa-line-chart"></i></span>
                            <div class="info-box-content">
                              <span class="info-box-text">Bookings</span>
                              <span class="info-box-number">0</span>
                              <div class="progress">
                                <div class="progress-bar" style="width: 0%"></div>
                              </div>
                              <span class="progress-description">
                                50% Increase in 30 Days
                              </span>
                            </div><!-- /.info-box-content -->
                        </div>
                        <div class="info-box bg-aqua">
                            <span class="info-box-icon"><i class="fa fa-envelope"></i></span>
                            <div class="info-box-content">
                              <span class="info-box-text">Direct Messages</span>
                              <span class="info-box-number">0</span>
                              <div class="progress">
                                <div class="progress-bar" style="width: 0%"></div>
                              </div>
                              <span class="progress-description">40% Increase in 30 Days</span>
                            </div><!-- /.info-box-content -->
                        </div>
                        <div class="info-box bg-yellow">
                            <span class="info-box-icon"><i class="fa fa-comments"></i></span>
                            <div class="info-box-content">
                              <span class="info-box-text">Reviews</span>
                              <span class="info-box-number">0</span>
                              <div class="progress">
                                <div class="progress-bar" style="width: 0%"></div>
                              </div>
                              <span class="progress-description">50% Increase in 30 Days</span>
                            </div><!-- /.info-box-content -->
                        </div>
                        <hr>
                    </div><!-- /.box-body -->
                  </div><!-- /.box -->
                </div><!-- /.col -->
                <div class="col-md-9">
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">General Info</a></li>
                      <li class=""><a href="#map" data-toggle="tab" aria-expanded="false">Map</a></li>
                      <li class=""><a href="#timeline" data-toggle="tab" aria-expanded="false">Direct Chat</a></li>
                      <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Settings</a></li>
                    </ul>
                    <div class="tab-content">
                      <form class="tab-pane active" id="activity" action="" method="post">
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="Hname" class="control-label">Hotel Name</label>
                              <input type="text" class="form-control" id="Hname" name="Hname" value="<?php echo $userCompany->company_name ?>">
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                                <label for="inputName" class="control-label">Hotel Ratings</label>
                                <select class="form-control" name="rating" >
                                  <option value="1" <?php if($userCompany->stars == 1){echo "selected";} ?> >1 Star</option>
                                  <option value="2" <?php if($userCompany->stars == 2){echo "selected";} ?> >2 Stars</option>
                                  <option value="3" <?php if($userCompany->stars == 3){echo "selected";} ?> >3 Stars</option>
                                  <option value="4" <?php if($userCompany->stars == 4){echo "selected";} ?> >4 Stars</option>
                                  <option value="5" <?php if($userCompany->stars == 5){echo "selected";} ?> >5 Stars</option>
                                  <option value="Guest House" <?php if($client->data()->stars == 'Guest House'){echo "selected";} ?> >Guest House</option>
                                  <option value="Hostel" <?php if($client->data()->stars == 'Hostel'){echo "selected";} ?> >Hostel</option>
                                </select>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label for="est" class="control-label">Date Established</label>
                              <input type="text" class="form-control" id="est" name="est" value="<?php echo $userCompany->established?>">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label for="country" class=" control-label">Country</label>
                                <input type="text" class="form-control" id="country" name="country" value="<?php echo $userCompany->country ?>">
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label for="city" class=" control-label">City</label>
                                <input type="text" class="form-control" id="city" name="city" value="<?php echo $userCompany->city ?>">
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label for="zip" class=" control-label">Zip/Postal</label>
                                <input type="text" class="form-control" id="zip" name="zip" value="<?php echo $userCompany->zip ?>">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="inputExperience" class="control-label">Address</label>
                                <textarea class="form-control" id="Address" name="addr" placeholder="Address"><?php echo $userCompany->address ?></textarea>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="inputSkills" class="control-label">Landmarks</label>
                              <textarea class="form-control" id="landmarks" name="landmarks" placeholder="Places nearby"><?php echo $userCompany->landmark ?></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label for="email" class="control-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?php echo $userCompany->email ?>">
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label for="tel" class="control-label">Telephone</label>
                                <input type="number" class="form-control" id="tel" name="tel" value="<?php echo $userCompany->telephone ?>">
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label for="tel" class="control-label">Avg Room Price</label>
                                <input type="number" class="form-control" id="arp" name="arp" value="<?php echo $userCompany->avag_roomPrice ?>">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label for="descp" class="control-label">Hotel Decription</label>
                              <textarea class="form-control" id="descp" name="descp" rows="12" placeholder="Write something about your hotel"><?php echo $userCompany->descp ?></textarea>
                            </div>
                          </div> 

                          <!-- <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Hotel Map</label>
                                <textarea name="map" id="map" class="form-control" placeholder="Please use google map to get the embed code"><?php echo $uzer->map ?></textarea>
                            </div>
                          </div> -->

                          <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Hotel Norms</label>
                                <textarea name="norms" id="norms" class="form-control" rows="7"><?php echo $userCompany->norms ?></textarea>
                            </div>
                          </div>  
                          <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">General Notification</label>
                                <textarea name="gen_note" id="gen_note" class="form-control" rows="7"><?php echo $userCompany->notes ?></textarea>
                            </div>
                          </div>  
                        </div> 
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <button type="submit" name="save" value="save" class="btn btn-success btn-md">Save Changes</button>
                            </div>
                          </div>
                        </div>

                        <div class="clearfix"></div>
                        <!-- Post -->
                        <hr>
                        
                      </form><!-- /.tab-pane -->

                      <div class="tab-pane " id="timeline" >
                        <!-- The timeline -->
                        <div class="direct-chat-messages" style="height:500px" id="timeline-inner"></div>
                        <div class="box-footer">
                          <form action="" method="post" id="frmChat">
                            <div class="input-group">
                              <input type="hidden" name="username" class="form-control" value="<?php echo $clientId; ?>"> 
                              <textarea id="message" name="message" class="form-control" style="resize: none;"  placeholder="Type Message ..."></textarea>
                              <span class="input-group-btn">
                                <button type="submit" class="btn btn-success btn-flat btn-lg" style="padding: 15px 16px;">Send</button>
                              </span>
                            </div>
                          </form>
                        </div>
                      </div><!-- /.tab-pane -->

                      <div class="tab-pane" id="settings">
                        <?php 
                          if(Input::get('update-setting') ) {
                            if(!empty(Input::get('user-password'))){
                              $salt = Hash::salt(32); $password = Hash::make(Input::get('user-password'), $salt);
                              $plain = htmlspecialchars(Input::get('user-password'));
                              $arr = array('fullname'=>htmlspecialchars(Input::get('user-name')),'display_name'=>htmlspecialchars(Input::get('user-dname')),'plain'=>$plain,'position'=>htmlspecialchars(Input::get('user-pos')));
                              $update_setting = DB::getInstance()->update('clients',$clientId,array('user_details'=>json_encode($arr),'email'=>htmlspecialchars(Input::get('user-email')),'password'=>$password,'salt'=>$salt ));
                            }else{
                              $plain = $userDetails->plain;
                              $arr = array('fullname'=>htmlspecialchars(Input::get('user-name')),'display_name'=>htmlspecialchars(Input::get('user-dname')),'plain'=>$plain,'position'=>htmlspecialchars(Input::get('user-pos')));
                              $update_setting = DB::getInstance()->update('clients',$clientId,array('user_details'=>json_encode($arr),'email'=>Input::get('user-email') ));
                            }
                            
                            if ($update_setting) {Session::flash('saved', 'Updated successfully!. ');}else{Session::flash('failed', 'Updated failed!. ');}
                            Redirect::to('home.php');
                          }

                        ?>
                        <form id="frmSettings" enctype="multipart/form-data" method="POST">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="user-name" class="control-label">Full name</label>
                              <input type="text" class="form-control" id="user-name" name="user-name" value="<?php echo $userDetails->fullname; ?>">
                            </div>
                            <div class="form-group">
                              <label for="user-pos" class="control-label">Position</label>
                              <input type="text" class="form-control" id="user-pos" name="user-pos" value="<?php echo $userDetails->position; ?>">
                            </div>
                            <div class="form-group">
                              <label for="user-dname" class="control-label">Display Name</label>
                              <input type="text" class="form-control" id="user-dname" name="user-dname" value="<?php echo $userDetails->display_name; ?>">
                            </div>
                            <div class="form-group">
                              <label for="user-email" class="control-label">Email</label>
                              <input type="email" class="form-control" id="user-email" name="user-email" value="<?php echo $uzer->email; ?>">
                            </div>
                            <div class="form-group">
                              <label for="user-password" class="control-label">Password</label>
                              <input type="password" class="form-control" id="user-password" name="user-password" value="">
                            </div>
                            <div class="form-group">
                              <label for="user-repassword" class=" control-label">Retype Password</label>
                              <input type="password" class="form-control" id="user-repassword" name="user-repassword" placeholder="">
                            </div>

                            <div class="form-group">
                              <div class="">
                                <button type="submit" class="btn btn-danger btn-md" name="update-setting" value="update-setting">Update Profile</button>
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-5">
                            
                          </div>

                          <div class="clearfix"></div>
                        </form>
                      </div><!-- /.tab-pane -->

                      <div class="tab-pane" id="map">
                        <div class="row"><div class="col-md-12" id="map-feedback"> </div> </div>
                        <!-- <form action="" method="post" id="frmMap">
                          <input type="hidden" name="id" value='<?php echo $clientId;?>'>
                          <div class="row">
                            <div class="col-md-10 col-sm-10">
                              <div class="form-group">
                                <label class="control-label">Hotel Map</label>
                                <textarea name="map" id="map" class="form-control" rows="5" placeholder="Please use google map to get the embed code"><?php echo $uzer->map ?></textarea>
                              </div>
                            </div>
                            <div class="col-md-2 col-sm-2">
                              <div class="form-group">
                                <br>
                                <button type="submit" name="saveMAP" id="saveMAP" class="btn btn-success btn-md">Save Changes</button>
                              </div>
                            </div>
                          </div>
                        </form> -->
                        <div class="row">
                          <div class="col-md-12">
                            <form action="upload-map.php" id="frmFileUpload" class="dropzone dz-clickable" method="post" enctype="multipart/form-data">
                              <input type="hidden" name="hotel_id" value="<?php echo $clientId;?>">
                              <div class="dz-message">
                              <div class="drag-icon-cph"><i class="fa fa-file"></i></div>
                                <h3>Drop files here or click to upload.</h3>
                              </div>
                            </form>
                          </div>
                        </div>  
                        <div class="clearfix" style="padding:2px"></div>
                        <d8iv class="row">
                            <div class="col-md-12">
                              <img src="<?php echo $uzer->map_image; ?>" class="img-responsive">
                              <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15882.45321866737!2d-0.074186!3d5.623967!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4ef0b8ac0563ce22!2sPaloma+Hotel+Spintex!5e0!3m2!1sen!2sgh!4v1511890630947" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe> -->
                            </div>
                        </div>
                      </div><!--- /map panel ---->

                    </div><!-- /.tab-content -->
                  </div><!-- /.nav-tabs-custom -->
                </div><!-- /.col -->
              </div><!-- /.row -->

            </section>
            <!-- /.content -->
        </div>    


        <?php include 'layouts/footer.php'; ?> 
        <script src="libs/plugins/dropzone/dropzone.js"></script>
        <script type="text/javascript">
          var link = document.getElementById('hotels').className='active';

          /*-----------------------------------------
              chat mudule
          -----------------------------------------*/
          $(document).ready(function(){
            /*-----------------sending message---------*/
            $(document).on('submit', '#frmChat', function(){
              let data = $(this).serialize(); 
              $.ajax({
                type : 'POST',
                url  : 'ajax.chat.php?mode=send',
                data : data,
                statusCode: {
                  404: function () {console.log('Error: 404: Could not contact server.'); },
                  500: function () {console.log('Error: 500: Server error occurred.'); }
                },
                success :  function(data){
                  let response = JSON.parse(data);
                  if (response[0]['error'] == false) {
                    $('#message').val('');
                    $('#message').css("background", "#fff");
                  }else{
                    $('#message').css("background", "#ccc");
                  }
                }

              }); 

              return false;
            });

            /*--------------------saving map----------------*/
            $(document).on('submit', '#frmMap', function(){
              let data = $(this).serialize(); 
              $.ajax({
                type : 'POST',
                url  : 'ajax.chat.php?mode=saveMap',
                data : data,
                success :  function(data){
                  //let response = JSON.parse(data);
                  console.log(data);
                  if (data == 1) {
                    $('#map-feedback').html('Updated successfully.');
                  }else{
                    $('#map-feedback').html('Failed to update');
                  }
                }
              }); 

              return false;
            });

          });
          /*---------------- get latest chat line ---------*/
          let lastChat = '';
          function getTimeline(){
            $.ajax({
              type : 'POST',
              url  : 'ajax.chat.php?mode=view',
              data : 'id='+<?php echo $clientId ?>,
              statusCode: {
                404: function () {console.log('Error: 404: Could not contact server.'); },
                500: function () {console.log('Error: 500: Server error occurred.'); }
              },
              success :  function(data){
                if (data !== lastChat) {
                  $('#timeline-inner').html(data);
                  //console.log(data);
                };
                lastChat = data;
              }

            }) 
          };   
          setInterval('getTimeline()',1000); 

          $('#message').focus(function(){
            $.ajax({
                type : 'GET',
                data : 'id='+<?php echo $clientId ?>,
                url  : 'ajax.chat.php?mode=removeChat',
                success :  function(data){
                    console.log(data);
                }

            })
        })


        </script>   
    </div><!-- /wrapper -->
    
  </body>
</html>  