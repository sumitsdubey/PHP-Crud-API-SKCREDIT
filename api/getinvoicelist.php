<?php

//Users: POST Request
require_once __DIR__.'/function.php';
require_once __DIR__.'/class/Query.php';

header("Content-Type:application/json");

if($_SERVER['REQUEST_METHOD']=='POST'){
	
  $query = new Query();
  $result = $query->select('c.id as customer_id,c.name as customer_name,c.mobile as customer_mobile,c.email as customer_email,c.address as customer_address,c.created_by as created_by,t.user_id as u_id,t.customer_id as c_id,t.amount as amount,t.type as type,t.title as title,t.description as description,t.date_time as date_time')
			->table('customer as c')
			->concate("INNER JOIN transaction as t ON")
			->concate("(c.id=t.customer_id)")
			->where('customer_id',post('id'))->allRecords();
			
  
  $query = new Query();
  $extra_txndata = $query->select('sum(amount) as amount,type')
         ->table('transaction ')
		 ->where('customer_id',post('id'))
		 ->concate('GROUP BY type')
		 ->allRecords();
		 	
  echo json_encode([
	
		'code'=> 200,
		'message' => 'Transaction Details found',
		'status'=> true, 
		'data'=> $result,
		'extra_txndata'=>$extra_txndata,
		'error'=> false,
			
	],JSON_PRETTY_PRINT);
	exit;
  
	
	
}else{
	
	echo json_encode([
	
		'code'=> 201,
		'message' => 'Invalid Request Please Send Post Request',
		'status'=> false,
		'data'=>[],
		'extra_txndata'=>[], 
		'error'=> false,
		
		
	
	],JSON_PRETTY_PRINT);
	exit;
	
}



?>