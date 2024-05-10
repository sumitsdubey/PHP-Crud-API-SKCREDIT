<?php
// required imports
require_once __DIR__.'/function.php';
require_once __DIR__.'/class/Query.php';

header("Content-Type:application/json");

if($_SERVER['REQUEST_METHOD']=='POST'){
    $query = new Query();

    try{
        $query->insert('messages', [
            'dev_id'=>post('dev_id'),
            'user_id'=>post('user_id'),
            'sender_name'=>post('sender_name'),
            'sender_email'=>post('sender_email'),
            'sender_mobile'=>post('sender_mobile'),
            'reciever_email'=>post('reciever_email'),
            'message'=>post('message')
        ]);

        $newId = $query->getId();

        echo json_encode([
            'code' => 200,
            'message'=> 'Message Send Successfully',
            'status'=> true,
            'data'=>[post('message')],
            'error'=>false
        ], JSON_PRETTY_PRINT);
        exit;
    }catch(Exception $e){
        echo json_encode([
			
            'code'=> 200,
            'message' => 'Sending Failed',
            'status'=> true,
            'data'=> [],
            'error'=> false
            
        
        ],JSON_PRETTY_PRINT);
        exit;
        
    }
}else{
    echo json_encode([
	
		'code'=> 201,
		'message' => 'Invalid Request Please Send Post Request',
		'status'=> false,
		'data'=>[],
		'error'=> false
		
	
	],JSON_PRETTY_PRINT);
	exit;
	
}
?>