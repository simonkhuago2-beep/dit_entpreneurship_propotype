<?php
ob_start();
include '../cctech-admin/core/init.php';
$client = new Client();
$clientId = $client->data()->id;

if (Input::get('mode')=='send') {
	$send = DB::getInstance()->insert('chat',array('user_send'=>$clientId,'user_rec'=>1,'msg'=>Input::get('message')));
	if ($send) {echo '[{"error": false}]'; }else{ echo '[{"error": true}]'; }
	exit;
}elseif (Input::get('mode')=='view') {
	$getMsg = DB::getInstance()->query("SELECT * FROM chat WHERE user_send = $clientId UNION SELECT * FROM chat WHERE user_rec = $clientId ORDER BY tym ASC ");
    foreach ($getMsg->results() as $key => $line): 
    	$sendInfo = find_by_id('clients',$line->user_send);
    	$recInfo = find_by_id('users',$line->user_send);
?>
		<div class="direct-chat-msg <?php if($line->user_send == $clientId){echo 'right';}else{echo 'left';} ?>">
            <div class="direct-chat-info clearfix">
                <span class="direct-chat-name <?php if($line->user_send == $clientId){echo 'pull-right';}else{echo 'pull-left';} ?>">
                	<?php if($line->user_send == $clientId){echo 'You'/*$sendInfo->username*/;}else{echo $recInfo->username;} ?>
                </span>
                <span class="direct-chat-timestamp <?php if($line->user_send == $clientId){echo 'pull-left';}else{echo 'pull-right';} ?>">
                	<?php echo chat_date($line->tym); ?>
                </span>
            </div>
            <img class="direct-chat-img" src="libs/img/user.png" alt="message user image">
            <div class="direct-chat-text <?php if($line->user_send == $clientId){echo '';}else{echo 'bg-light-blue disabled';} ?>"> <?php echo $line->msg ?></div>
        </div>
<?php 
	endforeach;
}elseif (Input::get('mode')=='notifier') {
    $allNewChat = DB::getInstance()->query("SELECT * FROM chat WHERE status = 0 AND user_rec = $clientId ");
?>
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-envelope-o"></i>
        <?php if($allNewChat->count()>0){ ?>
        <span class="label label-success"><?php echo $allNewChat->count(); ?></span>
        <?php } ?>
    </a>
<?php
}elseif (Input::get('mode') == 'removeChat') {
    $id = Input::get('id');
    DB::getInstance()->query("UPDATE chat SET status = 1 WHERE user_rec = $id ");
}elseif (Input::get('mode')=='saveMap') {
   $id  = Input::get('id');
   $map  = htmlentities(Input::get('map'));
   $sql = DB::getInstance()->update("clients",$id,array("map"=>"$map"));
   if ($sql) {
        $response = 1;//array('status'=>1);
   }else{
        $response =0; //array('status'=>2);
   }
   echo $response;
}
    

?>