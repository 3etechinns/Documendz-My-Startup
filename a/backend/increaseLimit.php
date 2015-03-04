<?php

require_once 'functions.php';
require_once '../../swiftmailer/lib/swift_required.php';
session_start();
include 'connect.php';

$p = $_GET['p'];

function email($suggestors_email,$suggestors_name,$for){




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


$message->setSubject("Increase limit for ".$for);
$message->setBody("userEmail:".$suggestors_email."<br>Name:".$suggestors_name."<br> For:".$for,'text/html');
$message->setFrom("feedback@documendz.com",$suggestors_name);

// Send the email
$mailer = Swift_Mailer::newInstance($transport);
$mailer->send($message);

}


email($_SESSION['email'],$_SESSION['Username'],$p);





?> 