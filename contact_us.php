
<?php


if(isset($_POST['field4']) && (htmlspecialchars($_POST['field4']) == "dfvh3fd5"))
{
session_start();

include ('connect.php');

$name=mysql_real_escape_string($_POST['field1']);
$email=mysql_real_escape_string($_POST['field2']);
$contact_message=mysql_real_escape_string($_POST['field3']);

//////////////////////////////////////////////////////////////////
////////////////// Database entry ////////////////////////////////
/////////////////////////////////////////////////////////////////


mysql_query("INSERT INTO contact_us (name, email, message, date,time) VALUES ('".$name."','".$email."','".$contact_message."',NOW(),NOW())");
mysql_close($dbhandle);


/////////////////////////////////////////////////////////////////
////////////////////// Send a mail///////////////////////////////
/////////////////////////////////////////////////////////////////

function email($suggestors_email,$feedback_text,$suggestors_name){


require_once 'swiftmailer/lib/swift_required.php';

// Create the mail transport configuration
$transport = Swift_SmtpTransport::newInstance('smtpout.secureserver.net',80)
 ->setUsername('feedback@documendz.com')
 ->setPassword('feedbackZofler6991')
        ;


// Create the message
$message = Swift_Message::newInstance(Subject);
$message->setTo(array(
 "feedback@documendz.com"
));

$suggestors_name = $suggestors_name."|contact-us|";

$message->setSubject($suggestors_email);
$message->setBody($feedback_text,'text/html');
$message->setFrom("feedback@documendz.com",$suggestors_name);

// Send the email
$mailer = Swift_Mailer::newInstance($transport);
$mailer->send($message);

}

email($email,$contact_message,$name);
}

else{
    
    
}

?>