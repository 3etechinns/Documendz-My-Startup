<?php
// forgot password send mail with new password

if($_POST['useremail'] != ""){


///////// defining functions ///////


function email($recipient_email_id,$senders_name,$pass,$un){


require_once 'swiftmailer/lib/swift_required.php';

// Create the mail transport configuration
$transport = Swift_SmtpTransport::newInstance('smtpout.secureserver.net',80)
 ->setUsername('no-reply@documendz.com')
 ->setPassword('no-replyZofler6991')
        ;


// Create the message
$message = Swift_Message::newInstance(Subject);
$message->setTo(array(
 $recipient_email_id
));

$salt = 'change me cause im not secure';
    $path = '/t_changepass.php';
    $timestamp = time() + (30 * 24 * 60 * 60); // one month valid
    $hash = md5($salt . $timestamp); // order isn't important at all... just do the same when verifying
    $url = "https://www.zofler.com/enterprise{$path}?a=url&b=0&s={$hash}&t={$timestamp}&em=".md5($recipient_email_id);


$message->setSubject("Forgot password");
$message->setBody(
'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Email</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>


<body style="margin: 0; padding: 0; font-size: 16px; color: #736262; font-family: "Arial Rounded MT Bold", "Helvetica Rounded", Arial, sans-serif";>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td>
				<table align="center" cellpadding="0" cellspacing="0"
					width="600" style="border-collapse: collapse; border-collapse: collapse;border: 1px solid #cecaca;color: #363535;">
					<tr>
						<td align="center" bgcolor="#F5F5F5" style="padding: 10px 0 10px 0;"><img
							src="https://s3-ap-southeast-1.amazonaws.com/documendz-public/documendz_logo.gif" alt="logo"
							width="150" height="37.5" style="display: block;" /></td>
					</tr>
					<tr>
						<td bgcolor="#ffffff" style="padding: 10px 10px 10px 10px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td>Hello '.$un.',</td>
								</tr>
								<tr>&nbsp;</tr>
								<tr>
									<td>A password reset request was made for this email id.</br>
									Your new password is <b>'.$pass.'</b></td>	
								</tr>
								<tr>
								<td> Please click below to change your password</td>
								</tr>

							</table>
						</td>
					</tr>
					<tr>
						<td bgcolor="#ffffff" style="padding: 10px 10px 10px 10px;">

							
								<table border="0" cellpadding="0" cellspacing="0" width="100%">
									<tr bgcolor="#ee4c50" height="37">
										<td align="center" style="font-size: 15px;"><a style="text-decoration:none; color:#fff; font-weight:bold; display:block; padding: 10px 0px;" href="'.$url.'">Click here to reset password</a></td>
									</tr>

								</table>
						
						</td>
					</tr>
					<tr>
						<td style="padding: 10px 10px 10px 10px;">
						<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td>Thanks,</td>
								</tr>
								<tr>
									<td>Documendz Team</td>
								</tr>

							</table>
						
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>

</html>','text/html');
$message->setFrom("no-reply@documendz.com", $senders_name);

// Send the email
$mailer = Swift_Mailer::newInstance($transport);
$mailer->send($message);



}




	function generateRandomString($length) { // geterate 6 letter random password
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $randomString;
}




$sn = "Documendz"; // sender name
$ue = $_POST['useremail']; // username or email id
/* $ch = $_POST['pwd']; // contains em or un for what user entered */

 // if submit is set
	
	include('connect.php');

	$ue = mysql_real_escape_string($ue);
	
	//execute the SQL query and return records
	$result = mysql_query("SELECT  emailid, password, username FROM signup WHERE emailid='".$ue."'");
	
	$num=mysql_num_rows($result);
	if($num==0) // no email matched
	{
		echo "Email-id not yet registered";
	
	}
	
	else{
	$pwd = generateRandomString(6); // generate new random password
	

		while ($row = mysql_fetch_array($result)) {
			$e = trim($ue);
			if($row['emailid']==$e) // email id matched
			{
				$p=md5($pwd."kubrv653nerf");
				mysql_query("UPDATE signup SET password='$p', flag=1 WHERE emailid='$e'");// send new pwd and set flag to 1
				echo "An email has been sent for password reset";
			    email($row['emailid'],$sn,$pwd,$row['username']); 
			    
			    break;
			}
		}
		
	}

mysql_close($dbhandle);
}
?>
