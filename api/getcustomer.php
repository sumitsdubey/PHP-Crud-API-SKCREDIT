<?php

//Users: POST Request
require_once __DIR__.'/function.php';
require_once __DIR__.'/class/Query.php';

header("Content-Type:application/json");

if($_SERVER['REQUEST_METHOD']=='POST'){
	
  $query = new Query();
  $result = $query->select('*')->table('customer')->where('created_by',post('user_id'))->allrecords();
  $txnresult = $query->select('*')->table('transaction')->where(post('user_id'))->allrecords();
  
  echo json_encode([
	
		'code'=> 200,
		'message' => 'Customer found',
		'status'=> true,
		'data'=> $result,
		'txndata'=>$txnresult,
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