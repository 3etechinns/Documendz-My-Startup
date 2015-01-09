<?php
// forgot password send mail with new password



///////// defining functions ///////


function email($recipient_email_id,$senders_name){


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




$message->setSubject("New and exciting features in 2015");
$message->setBody(
'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Email</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>


<body style="margin: 0; padding: 0; font-size: 16px; color: #736262; font-family: "Arial Rounded MT Bold", "Helvetica Rounded", Arial, sans-serif";>
	<div>frerfe</div>
</body>

</html>','text/html');
$message->setFrom("no-reply@documendz.com", $senders_name);

// Send the email
$mailer = Swift_Mailer::newInstance($transport);
$mailer->send($message);



}






$sn = "Documendz"; // sender name
$emaillist = array("tambolisagar22@gmail.com","dave.hardik30@gmail.com");
email($emaillist,$sn);

?>


