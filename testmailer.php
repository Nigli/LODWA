<?php 
require 'config.php';

$clients=ReceiverDao::GetClientsReceivers();
$email_temp=EmailTemp::GetEmailTemp();
$tr=new TradeRec(TradeRecDAO::GetLastTradeRec());
$email=new Email($clients,$tr,$email_temp);

require 'PHPMailer-master/PHPMailerAutoload.php';
ob_start();
include 'emailtemplates/rjo_temp.php';
$rjo= ob_get_clean();

ob_start();
include 'emailtemplates/confirm_temp.php';
$conf= ob_get_clean();

$mail = new PHPMailer($rjo,$email->title,$email->recipients);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'glisovicnikola@gmail.com';                 // SMTP username
$mail->Password = 'ljubivojemirjana';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->From = 'glisovicnikola@gmail.com';
$mail->FromName = 'Glisho';
$mail->addReplyTo('glisovicnikola@gmail.com', 'Glisho');
//$mail->addAddress('bodzi.boja@gmail.com', 'Bole');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addCC('cc@example.com');
foreach($email->recipients as $recipient){
    $add_and_name=  explode(',', $recipient);
    $mail->addBCC($add_and_name[0],$add_and_name[1]);
    
}
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = $email->title;
$mail->Body    = $rjo;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}