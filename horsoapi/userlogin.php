<?php

//Users: POST Request
require_once __DIR__.'/function.php';
require_once __DIR__.'/class/Query.php';

header("Content-Type:application/json");
if($_SERVER['REQUEST_METHOD']=='POST'){

  $email = post('email');	
  $password = md5(post('password'));
  
  
  $query = new Query();
  
  $result = $query->select('*')->table('users')->where([
	'email'=>$email,
	'password'=>$password
  ])->first();
  
  if($result == false){
	  
	  echo json_encode([	
		'code'=> 200,
		'message' => 'Invalid Email or Password',
		'status'=> false,
		'data'=>[],
		'error'=> false
	],JSON_PRETTY_PRINT);
	exit;
	 
	  
  }else{
	  
	  $token = md5(uniqid(time()));
	  
	  $query = new Query();
	  
	  if($query->update('users',[
		'is_login'=> '1',
		'token'=>$token,
	  ])->where('email',$email)->commit()){
		  
			 $result = $query->select('*')->table('users')->where([
				'email'=>$email,
				'password'=>$password
			])->first();
			
			
			echo json_encode([	
				'code'=> 200,
				'message' => 'Login Successfully',
				'status'=> true,
				'data'=>[$result],
				'error'=> false
			],JSON_PRETTY_PRINT);
			exit;
		  
	  } 
	
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