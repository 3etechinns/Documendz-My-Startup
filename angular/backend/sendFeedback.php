<?php

require_once 'functions.php';
require_once '../../swiftmailer/lib/swift_required.php';
session_start();
include 'connect.php';

$f = $_POST['msg'];
  


function email($suggestors_email,$feedback_text,$suggestors_name){




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


$message->setSubject($suggestors_email);
$message->setBody($feedback_text,'text/html');
$message->setFrom("feedback@documendz.com",$suggestors_name);

// Send the email
$mailer = Swift_Mailer::newInstance($transport);
$mailer->send($message);

}


email($_SESSION['email'],htmlentities($f),$_SESSION['Username']);





?> 