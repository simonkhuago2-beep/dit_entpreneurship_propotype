<?php
ob_start();
include '../cctech-admin/core/init.php';
    

    if(Input::get('view')){
    
        header('Content-Type: application/json');
        $start = Input::get('start'); 
        $end = Input::get('end'); 
        $hotelId = Input::get('view');
        
        $result = DB::getInstance()->query("SELECT * FROM availability WHERE hId = $hotelId AND (date(start) >= '$start' AND date(start) <= '$end')");
        foreach ($result->results() as $key => $value) {
            $events[] = $value;
        }
        echo json_encode($events);
        exit;
    }
    elseif(Input::get('action') == "add") 
    {   
        
        $add = DB::getInstance()->insert('availability',array('hId'=>Input::get('hotelId'),'rId'=>Input::get('roomId'),'title'=>Input::get('title'),'start'=>Input::get('start'),'ending'=>Input::get('end') ) );
        header('Content-Type: application/json');
        if($add){echo '{"id":"1"}'; }
        exit;
    }
    elseif(Input::get('action') == "update") 
    {
        
        DB::getInstance()->update('availability',Input::get('id'),
            array(
            'start'=>date('Y-m-d H:i:s',strtotime(Input::get('start'))),
            'ending'=>date('Y-m-d H:i:s',strtotime(Input::get('end')))
            ) 
            );
        exit;
    }
    elseif(Input::get('action') == "delete")
    {
        $sql = DB::getInstance()->delete('availability',array('id', '=', Input::get('id') ));
        if ($sql) {
            echo "1";
        }
        exit;
    }


?>