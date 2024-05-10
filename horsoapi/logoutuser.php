<?php

//Users: POST Request
require_once __DIR__.'/function.php';
require_once __DIR__.'/class/Query.php';

header("Content-Type:application/json");
if($_SERVER['REQUEST_METHOD']=='POST'){

$token = post('token');
$query = new Query();
$result = $query->select('*')
         ->table('users')
		 ->where('token',$token)
		 ->first();
	
  if($result){
	  
	  $query = new Query();
	  
	  if($query->update('users',[
		'is_login'=> '0',
		'token'=>''
	  ])->commit()){
		  
		echo json_encode([
	
		'code'=> 200,
		'message' => 'User Logout Successfully',
		'status'=> true,
		'data'=>[],
		'error'=> false
		
	
	],JSON_PRETTY_PRINT);
	exit;
	  
		  
	  }
	  
  }else{
	  
	  echo json_encode([
	
		'code'=> 200,
		'message' => 'Invalid token supplied',
		'status'=> false,
		'data'=>[],
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