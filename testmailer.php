<?php 
//require 'PHPMailer-master/PHPMailerAutoload.php';
require 'config.php';
$tr=new TradeRec(TradeRecDAO::GetLastTradeRec());//comes from form
$email=new Email($tr);

ob_start();
include 'emailtemplates/rjo_temp.php';
$rjo= ob_get_clean();

ob_start();
include 'emailtemplates/confirm_temp.php';
$conf= ob_get_clean();

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = $email->na_host;  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = $email->na_email;                 // SMTP username
$mail->Password = $email->na_pass;                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = $email->na_port;                                    // TCP port to connect to

$mail->From = $email->na_email;
$mail->FromName = $email->na_from;
$mail->addReplyTo($email->na_email, $email->na_from);
foreach($email->recipients as $recipient){
    $add_and_name=  explode(',', $recipient);
    $mail->addBCC($add_and_name[0],$add_and_name[1]);    
}

$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = $email->title;
$mail->Body    = $rjo;
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//if(!$mail->send()) {
//    echo 'Message could not be sent.';
//    echo 'Mailer Error: ' . $mail->ErrorInfo;
//} else {
//    echo 'Message has been sent';
//}
