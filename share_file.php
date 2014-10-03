<?php

require_once 'functions.php';

session_start();
include 'connect.php';
include 'unique_random_alphanumeric.php';

if($_GET['token'] != $_SESSION['userid'] ){
	
	echo '999';
}
else if(filter_var($_POST['Emailid_to_be_sent'], FILTER_VALIDATE_EMAIL)){


$em = mysql_real_escape_string($_POST['Emailid_to_be_sent']);	
	// echo $_POST['Emailid_to_be_sent'];
	//echo $_POST['file_name'];
	//Extract the userid of the person to whom the file is to be shared with based on the entered email.
	//If the receiver is registered already, the id will be available and the file can be sent to that user's received folder.
	//If not, the file should be sent to a pending folder and sent to the receiver, when he registers

	$extract_user_id_from_email = mysql_query("SELECT userid,username FROM signup WHERE emailid ='" . $em . "'");
	$extract_user_id_from_email = mysql_fetch_array($extract_user_id_from_email, MYSQL_ASSOC);       
	//var_dump ($extract_user_id_from_email['userid']);
	//Taking file_id of the file to be shared and the id is to be updated in shared_files table

	 
	if ($extract_user_id_from_email['userid'] == $_SESSION['userid']){
		 
		echo "self_sending";
	}
	else{

		$extract_file_id_from_filename = mysql_query("SELECT file_id FROM uploaded_files WHERE unique_filename = '" . $_POST['unique_filename'] . "'");
		$extract_file_id_from_filename = mysql_fetch_array($extract_file_id_from_filename, MYSQL_ASSOC);

		$random_json_filename = getToken(6);

		$shared_json_file = "uploaded/jhg76".$_SESSION['userid']."kd84/" . $random_json_filename;
		$handle = fopen($shared_json_file, w);
		
		
		fclose($handle);

		 if ($extract_user_id_from_email['userid'] != NULL){
		
		$receiver_user_id = $extract_user_id_from_email['userid'];
		$receiver_username = $extract_user_id_from_email['username'];
		 }
		 else{
		
		$receiver_user_id = 0;
		$receiver_username = $em;	
			
		 }
		
		$a = mysql_real_escape_string($extract_file_id_from_filename['file_id']);
		$b = mysql_real_escape_string($_SESSION['userid']); 	
		$c = mysql_real_escape_string($_SESSION['Username']); 
		$d = mysql_real_escape_string($receiver_user_id);	
		$e = mysql_real_escape_string($receiver_username);
		$f = mysql_real_escape_string($em);
		$g = mysql_real_escape_string($_POST['file_name']);
		$h = mysql_real_escape_string($_POST['unique_filename']);
		$i = mysql_real_escape_string("uploaded/jhg76".$_SESSION['userid']."kd84/" . $_POST['unique_filename'] . ".html");
		$j = mysql_real_escape_string($random_json_filename);
		$k = mysql_real_escape_string(date('M')." ".date('d'));
		
			//copy('uploaded/uploaded_files_'.$_SESSION[userid].'_html/'.$_POST['file_name'],'received/received_files_'.$extract_user_id_from_email['userid'].'/'.$_POST['file_name']);
		
mysql_query("INSERT INTO shared_files (file_id,sender_id,sender_name,receiver_id,receiver_name,receiver_email,file_name,unique_filename,uploaded_file_location,json_file_name,share_dt,last_edit)"
."VALUES(" .$a. ",". $b. ",'". $c. "',". $d . ",'". $e."','". $f."','". $g . "','". $h."','". $i."',". "'".$j."','".$k."',-1)");

			
$result = mysql_fetch_array(mysql_query("SELECT * from shared_files WHERE json_file_name ='".$random_json_filename."'"),MYSQL_ASSOC);

mysql_query("INSERT INTO file_access (shared_id,file_id,access_status,changer_userid) VALUES(".$result['shared_id'].",". $extract_file_id_from_filename['file_id'] .",0,-1)");	
			//algo for share summary script function call

			$row['username'] = $receiver_username;
			$row['href_path'] = "uploaded/jhg76".$_SESSION['userid']."kd84/".$_POST['unique_filename'].".html?jp=".$random_json_filename."&si=".$result['shared_id']."&file=".$_POST['file_name']."&auth=".$result['sender_id']."&key=1";
			$row['share_dt'] = $result['share_dt'];
			$row['shared_id'] = $result['shared_id'];
			$row['unique_filename'] = $result['unique_filename'];
			
			echo json_encode($row) ;

		 if ($extract_user_id_from_email['userid'] == NULL)  {

			// send mail to his email id of unregistered user
			
function email($recipient_email_id,$senders_name){


require_once 'swiftmailer/lib/swift_required.php';

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

							<a href="localhost/local_documendz/home.html?em='.$encode_email.'">
								<table border="0" cellpadding="0" cellspacing="0" width="100%">
									<tr bgcolor="#ee4c50" height="37">
										<td align="center" style="color: white;font-weight: bold;font-size: 15px;">Click here</td>
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
		
		/* session_start();
		$_SESSION['uname']=$uname;
		echo "<script>setTimeout(\"location.href = '$path';\",2000);</script>"; */
	}
}			
			
email($em, $_SESSION['Username']);


			
		}
	}
	

	mysql_close($mysql_conn);
}
else {
	echo '998';
}
?>