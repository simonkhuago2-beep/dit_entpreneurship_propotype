<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TravelAfric | Services</title>
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
            $arr='';
            if(Input::get('add') ) {
              $arr = '{"WIFI":"'.Input::get('WIFI').'","COFFEE":"'.Input::get('COFFEE').'","FRIDGE":"'.Input::get('FRIDGE').'","ENTERTAINMENT":"'.Input::get('ENTERTAINMENT').'","ROOM_SERVICE":"'.Input::get('ROOM_SERVICE').'","COMPLIMENTARY_BREAKFAST":"'.Input::get('COMPLIMENTARY_BREAKFAST').'","FIRE_PLACE":"'.Input::get('FIRE_PLACE').'","PICK_AND_DROP":"'.Input::get('PICK_AND_DROP').'","HOT_TUB":"'.Input::get('HOT_TUB').'","SWIMMING_POOL":"'.Input::get('SWIMMING_POOL').'","AIR_CONDITIONING":"'.Input::get('AIR_CONDITIONING').'","WINE_BAR":"'.Input::get('WINE_BAR').'","SECURE_VAULT":"'.Input::get('SECURE_VAULT').'","PETS_ALLOWED":"'.Input::get('PETS_ALLOWED').'","FREE_PARKING":"'.Input::get('FREE_PARKING').'","HANDICAP_ACCESSIBLE":"'.Input::get('HANDICAP_ACCESSIBLE').'","ELEVATOR":"'.Input::get('ELEVATOR').'","TELEVISION":"'.Input::get('TELEVISION').'","FITNESS_FACILITY":"'.Input::get('FITNESS_FACILITY').'","SMOKING_ALLOWED":"'.Input::get('SMOKING_ALLOWED').'","PICK_DROP":"'.Input::get('PICK_DROP').'","PLAY_PLACE":"'.Input::get('PLAY_PLACE').'","CONFERENCE_ROOM":"'.Input::get('CONFERENCE_ROOM').'","DOORMAN":"'.Input::get('DOORMAN').'","SUITABLE_EVENTS":"'.Input::get('SUITABLE_EVENTS').'"}';

              $add = DB::getInstance()->query("INSERT INTO facilities (`hotel_id`,`facil`) VALUES ($clientId,'{$arr}') ON DUPLICATE KEY UPDATE facil='{$arr}' ");
              if ($add) {Session::flash('saved', 'Added successfully!.');}
              else{Session::flash('failed', 'Failed!.');}
              Redirect::to('services.php');
            } 
            
      ?>
        <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
            <section class="content-header">
              <h1> <?php echo $userCompany->company_name ?></h1>
              <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Facilites</li>
              </ol>
            </section>
            <!-- Main content -->
            <section class="content">
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

                <div class="row">
                  <div class="col-md-12"> 
                    <div class="box box-primary">
                      <div class="box-header"><h3 class="box-title">Add Facilities</h3></div>
                      <div class="box-body">
                        <form method="post" action=""  >
                          <?php $new=find_by('facilities','hotel_id',$clientId);if(empty($new->facil)){ ?>
                          <table class="table table-bordered">
                            <tbody>
                              <tr>
                                <td><label><input type="checkbox" name="WIFI"> WI-FI</label></td>
                                <td><label><input type="checkbox" name="COFFEE"> COFFEE</label></td>
                                <td><label><input type="checkbox" name="FRIDGE"> FRIDGE</label></td>
                                <td><label><input type="checkbox" name="ENTERTAINMENT"> ENTERTAINMENT</label></td>
                                <td><label><input type="checkbox" name="ROOM_SERVICE"> ROOM SERVICE</label></td>
                              </tr>
                              <tr>
                                <td><label><input type="checkbox" name="COMPLIMENTARY_BREAKFAST"> COMPLIMENTARY BREAKFAST</label></td>
                                <td><label><input type="checkbox" name="FIRE_PLACE"> FIRE PLACE</label></td>
                                <td><label><input type="checkbox" name="PICK_AND_DROP"> PICK AND DROP</label></td>
                                <td><label><input type="checkbox" name="HOT_TUB"> HOT TUB</label></td>
                                <td><label><input type="checkbox" name="SWIMMING_POOL"> SWIMMING POOL</label></td>
                              </tr>
                              <tr>
                                <td><label><input type="checkbox" name="AIR_CONDITIONING"> AIR CONDITIONING</label></td>
                                <td><label><input type="checkbox" name="WINE_BAR"> WINE BAR</label></td>
                                <td><label><input type="checkbox" name="SECURE_VAULT"> SECURE VAULT</label></td>
                                <td><label><input type="checkbox" name="PETS_ALLOWED"> PETS ALLOWED</label></td>
                                <td><label><input type="checkbox" name="FREE_PARKING"> FREE PARKING</label></td>
                              </tr>
                              <tr>
                                <td><label><input type="checkbox" name="HANDICAP_ACCESSIBLE"> HANDICAP ACCESSIBLE</label></td>
                                <td><label><input type="checkbox" name="ELEVATOR"> ELEVATOR IN BUILDING</label></td>
                                <td><label><input type="checkbox" name="TELEVISION"> TELEVISION</label></td>
                                <td><label><input type="checkbox" name="FITNESS_FACILITY"> FITNESS FACILITY</label></td>
                                <td><label><input type="checkbox" name="SMOKING_ALLOWED"> SMOKING ALLOWED</label></td>
                              </tr>
                              <tr>
                                <td><label><input type="checkbox" name="PICK_DROP"> PICK AND DROP</label></td>
                                <td><label><input type="checkbox" name="PLAY_PLACE"> PLAY PLACE</label></td>
                                <td><label><input type="checkbox" name="CONFERENCE_ROOM"> CONFERENCE ROOM</label></td>
                                <td><label><input type="checkbox" name="DOORMAN"> DOORMAN</label></td>
                                <td><label><input type="checkbox" name="SUITABLE_EVENTS"> SUITABLE FOR EVENTS</label></td>
                              </tr>
                              <tr>
                                <td><button type="submit" class="btn btn-success" name="add" value="add">ADD FACILITIES</button></td>
                              </tr>
                            </tbody>
                          </table>
                          <?php }else{ $json = json_decode($new->facil); ?>
                            <table class="table table-bordered">
                              <tbody>
                                <tr>
                                  <td><label><input type="checkbox" name="WIFI" <?php if($json->WIFI=='on'){echo "checked";} ?>> WI-FI</label></td>
                                  <td><label><input type="checkbox" name="COFFEE" <?php if($json->COFFEE=='on'){echo "checked";} ?>> COFFEE</label></td>
                                  <td><label><input type="checkbox" name="FRIDGE" <?php if($json->FRIDGE=='on'){echo "checked";} ?>> FRIDGE</label></td>
                                  <td><label><input type="checkbox" name="ENTERTAINMENT" <?php if($json->ENTERTAINMENT=='on'){echo "checked";} ?>> ENTERTAINMENT</label></td>
                                  <td><label><input type="checkbox" name="ROOM_SERVICE" <?php if($json->ROOM_SERVICE=='on'){echo "checked";} ?>> ROOM SERVICE</label></td>
                                </tr>
                                <tr>
                                  <td><label><input type="checkbox" name="COMPLIMENTARY_BREAKFAST" <?php if($json->COMPLIMENTARY_BREAKFAST=='on'){echo "checked";} ?>> COMPLIMENTARY BREAKFAST</label></td>
                                  <td><label><input type="checkbox" name="FIRE_PLACE" <?php if($json->FIRE_PLACE=='on'){echo "checked";} ?>> FIRE PLACE</label></td>
                                  <td><label><input type="checkbox" name="PICK_AND_DROP" <?php if($json->PICK_AND_DROP=='on'){echo "checked";} ?>> PICK AND DROP</label></td>
                                  <td><label><input type="checkbox" name="HOT_TUB" <?php if($json->HOT_TUB=='on'){echo "checked";} ?>> HOT TUB</label></td>
                                  <td><label><input type="checkbox" name="SWIMMING_POOL" <?php if($json->SWIMMING_POOL=='on'){echo "checked";} ?>> SWIMMING POOL</label></td>
                                </tr>
                                <tr>
                                  <td><label><input type="checkbox" name="AIR_CONDITIONING" <?php if($json->AIR_CONDITIONING=='on'){echo "checked";} ?>> AIR CONDITIONING</label></td>
                                  <td><label><input type="checkbox" name="WINE_BAR" <?php if($json->WINE_BAR=='on'){echo "checked";} ?>> WINE BAR</label></td>
                                  <td><label><input type="checkbox" name="SECURE_VAULT" <?php if($json->SECURE_VAULT=='on'){echo "checked";} ?>> SECURE VAULT</label></td>
                                  <td><label><input type="checkbox" name="PETS_ALLOWED" <?php if($json->PETS_ALLOWED=='on'){echo "checked";} ?>> PETS ALLOWED</label></td>
                                  <td><label><input type="checkbox" name="FREE_PARKING" <?php if($json->FREE_PARKING=='on'){echo "checked";} ?>> FREE PARKING</label></td>
                                </tr>
                                <tr>
                                  <td><label><input type="checkbox" name="HANDICAP_ACCESSIBLE" <?php if($json->HANDICAP_ACCESSIBLE=='on'){echo "checked";} ?>> HANDICAP ACCESSIBLE</label></td>
                                  <td><label><input type="checkbox" name="ELEVATOR" <?php if($json->ELEVATOR=='on'){echo "checked";} ?>> ELEVATOR IN BUILDING</label></td>
                                  <td><label><input type="checkbox" name="TELEVISION" <?php if($json->TELEVISION=='on'){echo "checked";} ?>> TELEVISION</label></td>
                                  <td><label><input type="checkbox" name="FITNESS_FACILITY" <?php if($json->FITNESS_FACILITY=='on'){echo "checked";} ?>> FITNESS FACILITY</label></td>
                                  <td><label><input type="checkbox" name="SMOKING_ALLOWED" <?php if($json->SMOKING_ALLOWED=='on'){echo "checked";} ?>> SMOKING ALLOWED</label></td>
                                </tr>
                                <tr>
                                  <td><label><input type="checkbox" name="PICK_DROP" <?php if($json->PICK_DROP=='on'){echo "checked";} ?>> PICK AND DROP</label></td>
                                  <td><label><input type="checkbox" name="PLAY_PLACE" <?php if($json->PLAY_PLACE=='on'){echo "checked";} ?>> PLAY PLACE</label></td>
                                  <td><label><input type="checkbox" name="CONFERENCE_ROOM" <?php if($json->CONFERENCE_ROOM=='on'){echo "checked";} ?>> CONFERENCE ROOM</label></td>
                                  <td><label><input type="checkbox" name="DOORMAN" <?php if($json->DOORMAN=='on'){echo "checked";} ?>> DOORMAN</label></td>
                                  <td><label><input type="checkbox" name="SUITABLE_EVENTS" <?php if($json->SUITABLE_EVENTS=='on'){echo "checked";} ?>> SUITABLE FOR EVENTS</label></td>
                                </tr>
                                <tr>
                                  <td><button type="submit" class="btn btn-success" name="add" value="add">ADD FACILITIES</button></td>
                                </tr>
                              </tbody>
                            </table>
                          <?php } ?>
                        </form>
                      </div>  
                    </div>
                  </div>
                </div>
            </section>
            <!-- /.content -->
      </div>
      <?php include 'layouts/footer.php'; ?> 
        <script>
          var link = document.getElementById('hotels').className='active';
          var linkChild = document.getElementById('services').className='active';
        </script> 
    </div><!-- /wrapper -->
    
  </body>
</html>  