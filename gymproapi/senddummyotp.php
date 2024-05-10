
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

    $msg="Samajh nahi aaya";
    $sub= "Ye lello";

    try{
    //    $result =  $query->select('*')->table('otpuser')->where('email', $email)->allrecords();
    //   if($result){
        smtp_mailer($email, $sub, $msg);
        // $update = mysqli_query($conn, "UPDATE `otpuser` SET `otp` = $otp WHERE `otpuser`.`email` = '$email'");
        echo "Email Send Success";

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
	$mail->SetFrom("zackmacker420@gmail.com");
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