<footer>
    <div class="pull-right">
        Kcaesy! - Bootstrap Admin Template <!-- by <a href="https://colorlib.com">Colorlib</a> -->
    </div>
    <div class="clearfix"></div>
</footer>
<script type="text/javascript">
	var lastSet = '';
	function getNotification(){
        $.ajax({
            type : 'GET',
            url  : 'ajax/notificationManager.php?notifier=others',
            success :  function(data){
                if (data !== lastSet) {
                  $('#forOthers').html(data);
                  //console.log(data);
                };
                lastSet = data;
            }

        })
    };   
    setInterval('getNotification()',1000); 
    var lastChatNotifier = '';
	function getChatNotification(){
        $.ajax({
              type : 'GET',
              url  : 'ajax/notificationManager.php?notifier=chats',
              success :  function(data){
                if (data !== lastChatNotifier) {
                  $('#forChat').html(data);
                  //console.log(data);
                };
                lastChatNotifier = data;
              }

            })
    };   
    setInterval('getChatNotification()',1000); 
</script>