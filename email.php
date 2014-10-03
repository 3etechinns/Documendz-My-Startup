

<?php

function email($recipient_email_id,$senders_name){
    
include("phpmailer/class.phpmailer.php");

    $mail = new PHPMailer();
    $mail->IsSMTP(); // send via SMTP
    $mail = new PHPMailer();
    $mail->IsSMTP(); // send via SMTP
//IsSMTP(); // send via SMTP
    $mail->SMTPAuth = true; // turn on SMTP authentication
    $mail->Username = "zofler6992@gmail.com"; // SMTP username
    $mail->Password = "Zofler6991"; // SMTP password
    $webmaster_email = "dave.hardik30@gmail.com"; //Reply to this email ID
    $email = "$recipient_email_id"; // Recipients email ID
    $name = "$senders_name"; // sender's's name
    $mail->From = $webmaster_email;
    $mail->FromName = $name;
//$recipients = array(                        //Array will take in the multiple addresses and send the mail to each of them
//   'dave.hardik30@gmail.com' => 'Person One',
//   'tambolisagar22@gmail.com' => 'Person Two',
//   
//);
//foreach($recipients as $email => $name)
//{
//   $mail->AddAddress($email, $name);
//}

    $mail->AddAddress($email, $name);
    $mail->AddReplyTo($webmaster_email, "Zofu");
    $mail->WordWrap = 50; // set word wrap
//$mail->AddAttachment("/var/tmp/file.tar.gz"); // attachment
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg"); // attachment
    $mail->IsHTML(true); // send as HTML
    $mail->Subject = "This is the subject";
    $mail->Body = "Hi,
This is the HTML BODY "; //HTML Body
    $mail->AltBody = "This is the body when user views in plain text format"; //Text Body
    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message has been sent";
    }
}
?>