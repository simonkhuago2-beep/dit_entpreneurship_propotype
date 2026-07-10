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
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
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

            if(Input::get('save') ) {
                $date = make_date();
                $one = $_FILES["imgOne"]["name"]; $imgPath1 = 'libs/profiles/'.$one;
                $two = $_FILES["imgTwo"]["name"]; $imgPath2 = 'libs/profiles/'.$two;
                $add = DB::getInstance()->insert('rooms',array(
                'hid'=>Input::get('id'),'name'=>Input::get('type'),'qty'=>Input::get('qty'),'brkfst'=>Input::get('brkfst'),'adult'=>Input::get('adult'),
                'rollaway'=>Input::get('rollaway'),'extra'=>Input::get('extra'),'descp'=>Input::get('descp'),'facil'=>Input::get('facil'),'child'=>Input::get('child'),
                'date'=>$date,'imgOne'=>$imgPath1,'imgTwo'=>$imgPath2,'price'=>Input::get('rate')
                ) 
                );
                if ($add) {
                    Session::flash('saved', 'Added successfully!. ');
                    move_uploaded_file( $_FILES['imgOne']['tmp_name'], $imgPath1);
                    move_uploaded_file( $_FILES['imgTwo']['tmp_name'], $imgPath2);
                }else{Session::flash('failed', 'Failed!. ');}
                  //Session::flash('saved', 'Updated successfully!. ');
                Redirect::to('rooms.php');
            } 
            /*-----------update a room --------------*/
            if(Input::get('update') ) {
              $date = make_date();
              $user_dir = 'libs/profiles';
              $one = $_FILES["imgOne"]["name"]; $filename1 = $one['basename'];
              $two = $_FILES["imgTwo"]["name"]; $filename2 = $two['basename'];
              if (!empty(is_uploaded_file($_FILES['imgOne']['tmp_name']))) {$imgPath1 = $user_dir.'/'.$filename1;}else{$imgPath1 = Input::get('db-img1');}
              if (!empty(is_uploaded_file($_FILES['imgTwo']['tmp_name']))) {$imgPath2 = $user_dir.'/'.$filename2;}else{$imgPath1 = Input::get('db-img2');} 

              $add = DB::getInstance()->update('rooms',Input::get('edit-id'),array(
                'name'=>Input::get('type'),'qty'=>Input::get('qty'),'vacant'=>Input::get('vacant'),'brkfst'=>Input::get('brkfst'),'adult'=>Input::get('adult'),
                'rollaway'=>Input::get('rollaway'),'extra'=>Input::get('extra'),'descp'=>Input::get('descp'),'facil'=>Input::get('facil'),'child'=>Input::get('child'),
                'imgOne'=>$imgPath1,'imgTwo'=>$imgPath2,'price'=>Input::get('rate')
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
              <h1> <?php echo $client->data()->name ?></h1>
              <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Availability</li>
              </ol>
            </section>
            <!-- Main content -->
            <section class="content">
              <div class="row">
                <div class="col-sm-12 box">
                  <div id='calendar'></div>
                </div>
              </div><!-- /.row -->
            </section>
            <!-- /.content -->
            <!-- calendar modal -->
            <div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">

                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">New Calendar Entry</h4>
                  </div>
                  <div class="modal-body">
                    <div id="testmodal" style="padding: 5px 20px;">
                      <form id="antoform" class="form-horizontal calender" role="form">
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Title</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="title" name="title">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Description</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" style="height:55px;" id="descr" name="descr"></textarea>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary antosubmit">Save changes</button>
                  </div>
                </div>
              </div>
            </div>
            <div id="CalenderModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">

                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel2">Edit Calendar Entry</h4>
                  </div>
                  <div class="modal-body">

                    <div id="testmodal2" style="padding: 5px 20px;">
                      <form id="antoform2" class="form-horizontal calender" role="form">
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Title</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="title2" name="title2">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Description</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" style="height:55px;" id="descr2" name="descr"></textarea>
                          </div>
                        </div>

                      </form>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary antosubmit2">Save changes</button>
                  </div>
                </div>
              </div>
            </div>

            <div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
            <div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>
            <!-- /calendar modal -->
        </div> 
        <?php include 'layouts/footer.php'; ?> 
        <!-- DataTables -->
        <script src="libs/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="libs/plugins/datatables/dataTables.bootstrap.min.js"></script>
        <script src="libs/js/angular.js"></script>
        <script src="libs/plugins/moment/min/moment.min.js"></script>
        <script src="libs/plugins/fullcalendar/fullcalendar.min.js"></script>
        <script>
          var date = new Date(),
                d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear(),
                started,
                categoryClass;


          var link = document.getElementById('avaibility').className='active';
          var ourRequest = new XMLHttpRequest();
          ourRequest.open('GET', 'checkdate.php');
          ourRequest.onload = function(){
            //var ourData = JSON.parse('[{"title":"kennedy","position":"ceo"}]');
            var ourData = ourRequest.responseText;

            var calendar = $('#calendar').fullCalendar({
              header: {
              left: 'prev,next today',
              center: 'title',
              right: 'month'/*,agendaWeek,agendaDay*/
              },
              selectable: true,
              selectHelper: true,
              select: function(start, end, allDay) {
                $('#fc_create').click();

                started = start;
                ended = end;

                $(".antosubmit").on("click", function() {
                  var title = $("#title").val();
                  if (end) {
                    ended = end;
                  }

                  categoryClass = $("#event_type").val();

                  if (title) {
                    calendar.fullCalendar('renderEvent', {
                        title: title,
                        start: started,
                        end: end,
                        allDay: allDay
                      },
                      true // make the event "stick"
                    );
                  }

                  $('#title').val('');

                  calendar.fullCalendar('unselect');

                  $('.antoclose').click();

                  return false;
                });
              },
              eventClick: function(calEvent, jsEvent, view) {
                $('#fc_edit').click();
                $('#title2').val(calEvent.title);

                categoryClass = $("#event_type").val();

                $(".antosubmit2").on("click", function() {
                  calEvent.title = $("#title2").val();

                  calendar.fullCalendar('updateEvent', calEvent);
                  $('.antoclose2').click();
                });

                calendar.fullCalendar('unselect');
              },
              editable: true, //event draggable
              events: ourData
            });
            console.log(ourData)
          };
           ourRequest.send();
        </script>   
        <!-- FullCalendar -->
        <script>
          $(window).load(function() {
            /*var date = new Date(),
                d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear(),
                started,
                categoryClass;

            var calendar = $('#calendar').fullCalendar({
              header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
              },
              selectable: true,
              selectHelper: true,
              select: function(start, end, allDay) {
                $('#fc_create').click();

                started = start;
                ended = end;

                $(".antosubmit").on("click", function() {
                  var title = $("#title").val();
                  if (end) {
                    ended = end;
                  }

                  categoryClass = $("#event_type").val();

                  if (title) {
                    calendar.fullCalendar('renderEvent', {
                        title: title,
                        start: started,
                        end: end,
                        allDay: allDay
                      },
                      true // make the event "stick"
                    );
                  }

                  $('#title').val('');

                  calendar.fullCalendar('unselect');

                  $('.antoclose').click();

                  return false;
                });
              },
              eventClick: function(calEvent, jsEvent, view) {
                $('#fc_edit').click();
                $('#title2').val(calEvent.title);

                categoryClass = $("#event_type").val();

                $(".antosubmit2").on("click", function() {
                  calEvent.title = $("#title2").val();

                  calendar.fullCalendar('updateEvent', calEvent);
                  $('.antoclose2').click();
                });

                calendar.fullCalendar('unselect');
              },
              editable: true, //event draggable
              events: ourData
            });*/
            
          });
        </script>
    <!-- /FullCalendar -->
    </div><!-- /wrapper -->
    
  </body>
</html>  