<?php
require 'PHPMailer-master/PHPMailerAutoload.php';

$title = "title";
$body = file_get_contents("emailtemplates/rjo_temp.php");
        
//$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'relay-hosting.secureserver.net';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'nikola@northernadvisors.com';                 // SMTP username
$mail->Password = 'ngna321';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->From = 'nikola@northernadvisors.com';
$mail->FromName = 'Glisho';
//$mail->addAddress('bodzi.boja@gmail.com', 'Bole');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo('glisovicnikola@gmail.com', 'Glisho');
//$mail->addCC('cc@example.com');
$mail->addBCC('glisovicnikola@gmail.com', 'Glisho');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $title;
$mail->Body    = $body;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
