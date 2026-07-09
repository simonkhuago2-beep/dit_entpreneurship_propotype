<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.3.0
    </div>
    <strong>Copyright &copy; 2016 <a href="http://CROWNCITYTECHNOLOGIES.com">CROWNCITY TECHNOLOGIES</a>.</strong> All rights reserved.
</footer>
<script src="libs/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="libs/bootstrap/js/bootstrap.min.js"></script>
<script src="libs/js/app.min.js"></script>
<script src="libs/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
<script src="libs/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE for demo purposes -->
<script src="libs/js/demo.js"></script>
<script type="text/javascript">
	var lastChatNotifier = '';
	function getChatNotification(){
        $.ajax({
              type : 'GET',
              url  : 'ajax.chat.php?mode=notifier',
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

