<?php
include 'connect.php';
require_once 'functions.php';
session_start();

function email($recipient_email_id,$senders_name,$receiver_name){


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


$message->setSubject("File update notification");
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
									<td>Hello '.$receiver_name.',</td>
								</tr>
								<tr>&nbsp;</tr>
								<tr>
									<td>A shared file has been updated by '.$senders_name.'.</td>	
								</tr>
                                                                <tr>
                                                                        <td>Kindly visit www.documendz.com to view it.</td>
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
$message->setFrom("no-reply@documendz.com", "Documendz");

// Send the email
$mailer = Swift_Mailer::newInstance($transport);
$mailer->send($message);



}

$shared_id=  mysql_real_escape_string($_GET['shared_id']);
$last_reviewer_id = mysql_real_escape_string($_GET['last_reviewer_id']);
date_default_timezone_set('Asia/Kolkata');
$time = mysql_real_escape_string(time()); // This is in seconds


mysql_query("UPDATE shared_files SET last_edit ='".$time."',review_state=1, last_reviewer_id=".$last_reviewer_id." WHERE shared_id=".$shared_id);


/*Mailing notification */


$sql="select * from shared_files WHERE shared_id=".$shared_id;
$result = mysql_query($sql);
$row = mysql_fetch_array($result,MYSQLI_ASSOC); 

if($row['sender_id'] == $last_reviewer_id){
    
    
    email($row['receiver_email'],$row['sender_name'],$row['receiver_name']);
    
    
}

else{
    
 $sql="select emailid from signup WHERE userid=".$row['sender_id'];
$result1 = mysql_query($sql);
$row1= mysql_fetch_array($result1,MYSQLI_ASSOC);   

email($row1['emailid'],$row['receiver_name'],$row['sender_name']);
    
    
}

mysql_close($dbhandle);

/* redirect_to('profile_page.php') */
?>
