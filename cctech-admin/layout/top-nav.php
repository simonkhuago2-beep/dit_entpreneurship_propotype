<?php include_once("dbConfig_manual.php");?>

<div class="top_nav">
          <div class="nav_menu">
            <nav class="" role="navigation">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/user.png" alt=""><?php echo $user->data()->user_details; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <!-- <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li> -->
                    <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <!-- msg notification -->
                <li role="presentation" class="dropdown" id="forChat">
                  
                </li>

                <!-- other notification -->
                <li role="presentation" class="dropdown" id="forOthers">
                </li>

                <li class="">
                   
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="fa fa-bell" id="live-update">
                        
                        <?php
                        $unread_noti = "SELECT * FROM Notifications WHERE status = 'unread'";
                        $unread_result = mysqli_query($db, $unread_noti);
                        $total_no=mysqli_num_rows($unread_result);
                        echo  $total_no;
                        
                        ?>
                    </span>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    
                    <?php
                    $query = "SELECT * FROM Notifications WHERE status = 'unread'";
                    $result = $db->query($query);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <li class="notification" data-id="<?=$row['id']?>"><a href="read-notification.php?notification_id=<?=$row['id']?>"><?=$row['reference']?></a></li>
                        <?php
                        }
                       
                    } 
                    
                    
                    
                    else {
                        echo "No new notifications.";
                    }

                    ?>
                    
                  </ul>
                </li>





              </ul>
            </nav>
          </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.notification').forEach(notification => {
                    notification.addEventListener('click', function() {
                        const notificationId = this.getAttribute('data-id');
                        fetch('read-notification.php', {
                            method: 'POST',
                            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                            body: 'notification_id=' + encodeURIComponent(notificationId)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                // Optionally remove or hide the notification
                                this.style.display = 'none';
                            } else {
                                console.error(data.message);
                            }
                        })
                        .catch(error => console.error('Error:', error));
                    });
                });
            });
            
            
        setInterval(function() {
          document.getElementByID("live-update").innerHTML="<?php
                    $query = "SELECT * FROM Notifications WHERE status = 'unread'";
                    $result = $db->query($query);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <li class="notification" data-id="<?=$row['id']?>"><span style='color:red;'><a href="read-notification.php?notification_id=<?=$row['id']?>"><?=$row['reference']?></a></span></li>
                        <?php
                        }
                       
                    } 
                    
                    
                    
                    else {
                        echo "No new notifications.";
                    }

                    ?>"; 
        },5000);
       
</script>