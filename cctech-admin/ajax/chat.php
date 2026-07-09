<?php
ob_start();
include '../core/init.php';
$user = new User();
$adminId = $user->data()->id;

if (Input::get('mode')=='send') {
	$username = Input::get('username');
	$send = DB::getInstance()->insert('chat',array('user_send'=>$adminId,'user_rec'=>$username,'msg'=>Input::get('message')));
	if ($send) {echo '[{"error": false}]'; }else{ echo '[{"error": true}]'; }
	exit;
}elseif (Input::get('mode')=='view') {
	$receId = Input::get('id');
	$getMsg = DB::getInstance()->query("SELECT * FROM chat WHERE user_send = $adminId AND user_rec = $receId UNION SELECT * FROM chat WHERE user_send = $receId ORDER BY tym ASC ");
    foreach ($getMsg->results() as $key => $line): 
    	$sendInfo = find_by_id('clients',$adminId);
    	$recInfo = find_by_id('clients',$receId);
        $jsonRep = json_decode($recInfo->user_details);
?>
		<div class="direct-chat-msg <?php if($line->user_send == $adminId){echo 'right';}else{echo 'left';} ?>" style="width:100%; ">
            <div class="direct-chat-info clearfix">
                <span class="direct-chat-name <?php if($line->user_send == $adminId){echo 'pull-right';}else{echo 'pull-left';} ?>">
                	<?php if($line->user_send == $adminId){echo 'You'/*$sendInfo->username*/;}else{echo $jsonRep->display_name;} ?>
                </span>
                <span class="direct-chat-timestamp <?php if($line->user_send == $adminId){echo 'pull-left';}else{echo 'pull-right';} ?>">
                	<?php echo chat_date($line->tym); ?>
                </span>
            </div>
            <img class="direct-chat-img" src="images/user.png" alt="message user image">
            <div class="direct-chat-text" style="<?php if($line->user_send == $adminId){echo 'background:#c7f3ea ';}else{echo '';} ?>"> <?php echo $line->msg ?></div>
        </div>
<?php 
	endforeach;
}

?>
