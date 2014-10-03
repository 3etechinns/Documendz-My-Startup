 <?php

 
$un = $_POST['uname'];
$pw = md5($_POST['pwd']."kubrv653nerf");
$em = $_POST['email'];



if(strlen($un)!=0 && strlen($pw)!=0 && strlen($em)!=0)

{
	
include ('connect.php');

$un = mysql_real_escape_string($un);
$pw = mysql_real_escape_string($pw);
$em = mysql_real_escape_string($em);


	
$sql = "INSERT INTO signup ".
		"(username, password, emailid) ".
		"VALUES('$un','$pw','$em')";
		
		

$retval = mysql_query( $sql, $dbhandle );

if(! $retval )
{
	die('Could not enter data: ' . mysql_error());
}

$result = mysql_query("SELECT userid FROM signup WHERE UserName='$un'");
$row = mysql_fetch_assoc($result);
$uid=$row['userid'];
mysql_query("INSERT INTO remaining (UID) VALUES ('$uid')");


$secret = "61oeix1=-4#%e03mo";
$email = urlencode($em);
$hash = MD5($em.$secret);
$link = "http://www.documendz.com/t_verification.php?email=$email&hash=$hash&user=$un";

email($em,"Documendz",$un,$link);

}//closure for if(strlen........) 

else 
{
	echo "Something went wrong, Please try again";
	
}

//} //closure for if(isset_post)

/* else echo"no post"; */





function email($recipient_email_id,$senders_name,$un,$link){


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

$uname="$un";
$url = $link;


$message->setSubject("Email verification");
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
									<td>Hello,</td>
									
								</tr>
								<tr>&nbsp;</tr>
								<tr>
									<td>Welcome to Documendz! To get started, please confirm your email address</td>	
								</tr>

							</table>
						</td>
					</tr>
					<tr>
						<td bgcolor="#ffffff" style="padding: 10px 10px 10px 10px;">

							<a href="'.$url.'">
								<table border="0" cellpadding="0" cellspacing="0" width="100%">
									<tr bgcolor="#ee4c50" height="37">
										<td align="center" style="color: white;font-weight: bold;font-size: 15px;">Confirm Email</td>
									</tr>

								</table>
						</a>
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



if (!$mailer) {
		echo "Mailer Error: " . $mailer->ErrorInfo;
		
	} else {
		echo "You have registered successfully. A verification link has been sent to your email id. Please verify to start using Documendz.";
		/* session_start();
		$_SESSION['uname']=$uname;
		echo "<script>setTimeout(\"location.href = '$path';\",2000);</script>"; */
	}
}

mysql_close($dbhandle); // closing database connection

?>
