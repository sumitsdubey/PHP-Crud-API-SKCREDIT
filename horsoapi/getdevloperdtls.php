<?php
//Users: POST Request
require_once __DIR__.'/function.php';
require_once __DIR__.'/class/Query.php';

header("Content-Type:application/json");

if($_SERVER['REQUEST_METHOD']=='POST'){
		
  $query = new Query();
  $result = $query->select('*')->table('users')->where('id', post('dev_id'))->allrecords();
    
  
  echo json_encode([
	
		'code'=> 200,
		'message' => 'Developer Found',
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