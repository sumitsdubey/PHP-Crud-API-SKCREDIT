<?php

//Users: POST Request
require_once __DIR__.'/function.php';
require_once __DIR__.'/class/Query.php';

header("Content-Type:application/json");

if($_SERVER['REQUEST_METHOD']=='POST'){
	
	
	$query = new Query();
	
	try{
				
			$amount = [
				'debit'=> "-".post('amount'),
				'credit'=> post('amount'),
			];
			
			$amount = $amount[post('type')];
			
			$query->insert('transaction',[
				'user_id '=> post('user_id'),
				'customer_id '=> post('customer_id'),
				'amount'=> $amount,
				'type'=> post('type'),
				'title' => post('title'),
				'description'=>post('description')
			]);
			
			$newId = $query->getId();
			
			echo json_encode([
			
				'code'=> 200,
				'message' => 'transaction Added Successfully',
				'status'=> true,
				'data'=> [],
				'error'=> false
				
			
			],JSON_PRETTY_PRINT);
			exit;
	
	
	}catch(Exception $e){
	
	
		echo json_encode([
			
				'code'=> 200,
				'message' => 'Oops Try Again,Later',
				'status'=> true,
				'data'=> [],
				'error'=> $e->getMessage(),
				
			
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