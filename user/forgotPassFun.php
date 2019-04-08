<?php

function UserID($email)
{
	global $con;
	
	$query = mysqli_query($con, "SELECT uId FROM users WHERE uEmail = '$email'");
	$row = mysqli_fetch_assoc($query);
	
	return $row['uId'];
}

function generateRandomString($length = 20) {
	// This function has taken from stackoverflow.com

	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return md5($randomString);
}

function send_mail($to, $token)
{
	require '../PHPMailer/PHPMailerAutoload.php';
	
	$mail = new PHPMailer;
	
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'raoinfotechp@gmail.com';
	$mail->Password = 'raoinfotech@123';
	$mail->SMTPSecure = 'ssl';
	$mail->Port = 465;
	
	$mail->From = 'raoinfotechp@gmail.com';
	$mail->FromName = 'Rao Infotech';
	$mail->addAddress($to);
	$mail->addReplyTo('raoinfotechp@gmail.com', 'Reply');
	
	$mail->isHTML(true);
	
	$mail->Subject = 'Demo: Password Recovery Instruction';
	$link = 'http://localhost/Bhavik/Projects/musicApp/user/resetPasswordPage.php?email='.$to.'&token='.$token;
	$mail->Body    = "<b>Hello</b><br><br>You have requested for your password recovery. <a href='$link' target='_blank'>Click here</a> to reset your password. If you are unable to click the link then copy the below link and paste in your browser to reset your password.<br><i>". $link."</i>";
	
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
	if(!$mail->send()) {
		return 'fail';
	} else {
		return 'success';
	}
}

function verifytoken($userID, $token)
{	
	global $con;
	
	$query = mysqli_query($con, "SELECT tokenValid FROM users WHERE uId = $userID AND token = '$token'");
	$row = mysqli_fetch_assoc($query);
	if(mysqli_num_rows($query) > 0)
	{
		if($row['tokenValid'] == 1)
		{
			return 1;
		}else
		{
			return 0;
		}
	}else
	{
		return 0;
	}
	
}


?>