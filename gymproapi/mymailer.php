<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require("phpmailer/mailer/src/Exception.php");
require("phpmailer/mailer/src/PHPMailer.php");
require("phpmailer/mailer/src/SMTP.php");

function mymailer($to,$sub,$msg){
    smtp_mailer($to,$sub, $msg);
    return true;
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

