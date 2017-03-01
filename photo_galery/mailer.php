<?php
	require_once("includes/PHPMailer/class.phpmailer.php");
	require_once("includes/PHPMailer/class.smtp.php");
	
	$to_name = "Junk mail";
	$to = "namalliv2@hotmail.com";
	$subject = "Mail Test at ".strftime("%T", time());
	$message = "This ia a test.";
	$message = wordwrap($message, 70);
	$from_name = "Noel Vallaman";
	$from = "namalliv@yahoo.com";
	
	$mail = new PHPMailer();
	$mail->FromName = $from_name;
	$mail->From = $from;
	$mail->AddAddress($to, $to_name);
	$mail->Subject = $subject;
	$mail->Body = $message;
	
	$result = $mail->Send();
	echo $result ? 'Sent' : 'Error';
	
?>