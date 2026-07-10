<?php 
  ob_start();
  include '../cctech-admin/core/init.php';
  $client = new Client();
  if ($client->isLoggedIn()) {
   $clientId = $client->data()->id;
   $uzer = find_by_id('clients',$clientId);
   $userDetails = json_decode($client->data()->user_details);
   $userCompany = json_decode($client->data()->company_details);
  }else{
    Redirect::to('logout.php');
  }
  
  
?>
<header class="main-header">

        <!-- Logo -->
        <a href="dashboard.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>T</b>A</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>T</b>Afric</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown messages-menu" id="forChat">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-envelope-o"></i>
                  <!-- <span class="label label-success">4</span> -->
                </a>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="libs/img/user.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $userDetails->display_name; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="libs/img/user.png" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $userDetails->fullname ?>
                      <small>Member since <?php echo memb_since($uzer->created) ?></small>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <!-- <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li> -->
            </ul>
          </div>

        </nav>
      </header>