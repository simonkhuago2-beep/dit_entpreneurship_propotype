<?php include("core/init.php"); 
$user = new User();
$adminId = $user->data()->id;
?>
<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="glyphicon glyphicon-knight"></i> <span>Kcaesy!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <!-- <div class="profile">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
            </div> -->
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="home.php"><i class="fa fa-home"></i> Dashboard <!-- <span class="fa fa-chevron-down"></span> --></a></li>
                  
                  <!-- <li><a><i class="glyphicon glyphicon-pushpin"></i> Posts <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="posts.php">Manage Post</a></li>
                      <li><a href="add-posts.php">Add New</a></li>
                      <li><a href="category.php">Category</a></li>
                    </ul>
                  </li>
                  <li><a href="service-category.php"><i class="glyphicon glyphicon-comment"></i> Category </a></li>
                  <li><a href="comments.php"><i class="glyphicon glyphicon-comment"></i> Comments </a></li> -->
                  <li><a href="agency.php"><i class="glyphicon glyphicon-user"></i> Agencies </a></li>
                  <li><a><i class="glyphicon glyphicon-globe"></i> Excusrion <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="manage-excursions.php">Manage </a></li>
                      <li><a href="add-excursion.php">Add New</a></li>
                      <li><a href="excursion-booking.php">Bookings</a></li>
                    </ul>
                  </li>
                  <li><a><i class="glyphicon glyphicon-globe"></i> Events <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="manage-events.php">Manage </a></li>
                      <li><a href="add-events.php">Add New</a></li>
                      <li><a href="events-booking.php">Bookings</a></li>
                    </ul>
                  </li>
                  <li><a><i class="glyphicon glyphicon-home"></i> Hotels <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="manage-hotels.php">Manage </a></li>
                      <li><a href="hotels-booking.php">Bookings</a></li>
                    </ul>
                  </li>
                  <li><a ><i class="fa fa-car"></i> Tranfers <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="transfer-daily.php">Manage </a></li>
                      <li><a href="add-transfer.php">Add </a></li>
                      <li><a href="transfer-booking.php">Bookings</a></li>
                    </ul>
                  </li>
                  <li><a><i class="glyphicon glyphicon-globe"></i> Tours <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="manage-tours.php">Manage </a></li>
                      <li><a href="add-tours.php">Add New</a></li>
                      <li><a href="tour-booking.php">Bookings</a></li>
                    </ul>
                  </li>
                  <li><a href="accounts.php"><i class="fa fa-line-chart"></i> Accounts</a></li>
                  
                    
                </ul>
              </div>
              

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen" >
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>