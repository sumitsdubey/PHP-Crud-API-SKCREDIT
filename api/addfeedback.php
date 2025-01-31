<?php

//Users: POST Request
require_once __DIR__.'/function.php';
require_once __DIR__.'/class/Query.php';

header("Content-Type:application/json");

if($_SERVER['REQUEST_METHOD']=='POST'){
	
	
	$query = new Query();
	
	try{
				
			$query->insert('enquiry',[
				'user_id' => post('user_id'),
				'name'=> post('name'),
				'email'=> post('email'),
				'mobile'=> post('mobile'),
				'message'=> post('message'),
			]);
			
			$newId = $query->getId();
			
			echo json_encode([
			
				'code'=> 200,
				'message' => 'Feedback Added Successfully',
				'status'=> true,
				'data'=> [],
				'error'=> false
				
			
			],JSON_PRETTY_PRINT);
			exit;
	
	
	}catch(Exception $e){
	
	
		echo json_encode([
			
				'code'=> 200,
				'message' => 'Feedback Already Exist',
				'status'=> false,
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