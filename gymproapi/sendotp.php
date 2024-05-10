
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require("phpmailer/mailer/src/Exception.php");
require("phpmailer/mailer/src/PHPMailer.php");
require("phpmailer/mailer/src/SMTP.php");
require_once __DIR__.'/function.php';
require_once __DIR__.'/class/Query.php';

header("Content-Type:application/json");

if($_SERVER['REQUEST_METHOD']=='POST'){
    $count =0;
    $email = $_POST['email'];
    
    $query = new Query();
    $otp = rand(100001,999999);

    $msg="This email for the OTP Verification of GymPro, your OTP verification code is $otp. Dont Share this code to anyone.";
    $sub= "OTP Verification by GymPro";

    try{
        $check =  $query->select('*')->table('users')->where('email', $email)->allrecords();

        if(!$check){
               
       $result =  $query->select('*')->table('otpuser')->where('email', $email)->allrecords();
      if($result){
        smtp_mailer($email, $sub, $msg);
        $update = mysqli_query($conn, "UPDATE `otpuser` SET `otp` = $otp WHERE `otpuser`.`email` = '$email'");
        echo json_encode([
			
            'code'=> 200,
            'message' => 'OTP Send or Updated Successfully',
            'status'=> true,
            'data'=> [$otp],
            'error'=> false
            
        
        ],JSON_PRETTY_PRINT);
        exit;
      }

    else{
        smtp_mailer($email, $sub, $msg);
        $query->insert('otpuser',[
            'email'=> $email,
            'otp'=> $otp,
        ]);
        echo json_encode([
			
            'code'=> 200,
            'message' => 'OTP Send Successfully',
            'status'=> true,
            'data'=> [$otp],
            'error'=> false
            
        
        ],JSON_PRETTY_PRINT);
        exit;
    }
        }
        else{
            echo json_encode([
			
                'code'=> 200,
                'message' => 'This email is Already Registered',
                'status'=> false,
                'data'=> [$otp],
                'error'=> false
                
            
            ],JSON_PRETTY_PRINT);
            exit;

        }
    }
    catch(Exception $e){
        echo "Server Not Found";
    }
}else{
    echo "Invalid Method Please Provide POST Method";
}

function smtp_mailer($to,$subject, $msg){
    
	$mail = new PHPMailer(true); 
	$mail->isSMTP(); 
	$mail->SMTPDebug = 1; 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp-relay.sendinblue.com";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "sumitcomputersmzp@gmail.com";
	$mail->Password = "jqk6hRZJgT9NXyWn";
	$mail->SetFrom("SkSoft@sk.com");
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	if(!$mail->Send()){
		return 0;
	}else{
		return 1;
	}
}

?>