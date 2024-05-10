<?php
//Users: POST Request
require_once __DIR__.'/function.php';
require_once __DIR__.'/class/Query.php';

header("Content-Type:application/json");

if($_SERVER['REQUEST_METHOD']=='POST'){
  
	$type = post('user_type');
	if($type == "developer"){
		$type = 'user';
	}else{
		$type = 'developer';
	}
		
  $query = new Query();
  $result = $query->select('*')->table('users')->where('user_type', $type)->allrecords();
    
  
  echo json_encode([
	
		'code'=> 200,
		'message' => 'Users Found',
		'status'=> true,
		'data'=> $result,
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