<?php
//Users: POST Request
require_once __DIR__.'/function.php';
require_once __DIR__.'/class/Query.php';

header("Content-Type:application/json");

if($_SERVER['REQUEST_METHOD']=='POST'){
		
  $query = new Query();
  $result = $query->select('*')->table('messages')->where(
	[
		'dev_id' =>post('dev_id'),
   		'user_id'=>post('user_id'),
		// 'sender_email'=>post('sender_email'),
		// 'reciever_email'=>post('reciever_email')
		])->allrecords();
	if(empty($result)){
		$result = [];
	}
	// $result1 = $query->select('*')->table('messages')->where(
	// 		[
	// 			'dev_id' =>post('dev_id'),
	// 			'user_id'=>post('user_id'),
	// 			'sender_email'=>post('reciever_email'),
	// 			'reciever_email'=>post('sender_email')
	// 			])->allrecords();
				
	// if(empty($result1)){
	// 	$result1 = [];
	// }
  echo json_encode([
	
		'code'=> 200,
		'message' => 'Messages Found',
		'status'=> true,
		'senddata'=> $result,
		// 'recievedata'=> $result1,
		'error'=> false
		
	],JSON_PRETTY_PRINT);
	exit;


	
   
	
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