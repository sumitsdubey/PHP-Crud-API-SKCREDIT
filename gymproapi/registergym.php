<?php


require_once __DIR__.'/function.php';
require_once __DIR__.'/class/Query.php';
require_once __DIR__.'/mymailer.php';


header("Content-Type:application/json");

if($_SERVER['REQUEST_METHOD']=='POST'){
     
    $query = new Query();

    $email = post('email');
    $mobile = post('mobile');

    $subject = "GymPro Regiser Success";
    $msg = "Welcome! You have successfully registered in GymPro.
     Please note your userid and password.
        Your userid is $email and password is- $mobile  ";

    try{
    $datasend = $query->insert('users',[
        'email'=> $email,
        'gym_name'=> post('gym_name'),
        'address'=> post('address'),
        'mobile'=> post('mobile'),
        'password'=> md5(post('mobile'))
    ]);
    $datarecieve = $query->select("*")->table('users')->where('email',$email)->AllRecords();
    mymailer($email,$subject,$msg);

    echo json_encode([
        'code' => 200,
        'message'=> 'Gym Registerd Successfully',
        'status' => true,
        'data'=> $datarecieve

    ],JSON_PRETTY_PRINT);
    exit;
    }catch(Exception $e){
        echo json_encode([
            'code' => 200,
            'message'=> 'User Already Exist',
            'status' => false,
            'data'=> []
    
        ],JSON_PRETTY_PRINT);
        exit;
    }

}else{

    echo json_encode([
        'code' => 201,
        'message'=> 'Invalid Request Please Send POST request.',
        'status' => false,
        'data'=> [],
        'error'=> false

    ],JSON_PRETTY_PRINT);
    exit;
}



?>