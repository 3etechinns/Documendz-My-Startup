<?php
session_start();

function email($recipient_email_id,$senders_name){


require_once '../../swiftmailer/lib/swift_required.php';

// Create the mail transport configuration
$transport = Swift_SmtpTransport::newInstance('smtpout.secureserver.net',80)
 ->setUsername('no-reply@documendz.com')
 ->setPassword('no-replyZofler6991')
        ;

$encode_email = urlencode($recipient_email_id);
// Create the message
$message = Swift_Message::newInstance(Subject);
$message->setTo(array(
 $recipient_email_id
));

$uname="$un";
$url = $link;

$message->setSubject("Document shared for review");
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
									<td>'.$_SESSION[Username].'&nbsp;has shared a document with you to review.</br>
									Please click on the link below to access it<b>'.$pass.'</td>	
								</tr>

							</table>
						</td>
					</tr>
					<tr>
						<td bgcolor="#ffffff" style="padding: 10px 10px 10px 10px;">

							
								<table border="0" cellpadding="0" cellspacing="0" width="100%">
									<tr bgcolor="#ee4c50" height="37">
										<td align="center" style="font-size: 15px;"><a style="text-decoration:none; color:#fff; font-weight:bold; display:block;padding: 10px 0px;" href="localhost/local_documendz/home.html?em='.$encode_email.'">Click here</a></td>
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



if (!$mailer) {
		
		
	} else {
		
		/* session_start();
		$_SESSION['uname']=$uname;
		echo "<script>setTimeout(\"location.href = '$path';\",2000);</script>"; */
	}
}			
			

			email($argv[1], $_SESSION['Username']);

			?>