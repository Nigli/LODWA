<?php
use phpmailer\PHPMailer;
function phpmailer($email){
    $mail=new PHPMailer();
    $mail->CharSet = 'UTF-8';
    $mail->isSMTP();                                        //*
    //$mail->SMTPDebug  = 2;                                  //*
    $mail->Host = $email->sender_host; 
    //$mail->Host = "relay-hosting.secureserver.net";         // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication*
    $mail->Username = $email->sender_email;                 // SMTP username
    $mail->Password = $email->sender_pass;                // SMTP password*
    //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = $email->sender_port;                      // TCP port to connect to
    
    $mail->From = $email->sender_email;
    $mail->FromName = $email->sender_name;
    $mail->addReplyTo($email->sender_email, $email->sender_name);    
    $mail->isHTML(true);                                    // Set email format to HTML
    $mail->Subject = $email->title;
    
    $mailclient = clone $mail;
    
    //mail to broker
    $mail->addAddress($email->broker_email, $email->broker_name); 
    $mail->Body    = $email->broker_temp;
    $plain = $mail->html2text($mail->Body);
    $mail->AltBody = $plain;
    //mail to clients
    foreach($email->recipients as $recipient){
        $add_and_name=  explode(',', $recipient);
        $mailclient->addBCC($add_and_name[0],$add_and_name[1]);    
    }    
    $mailclient->Body    = $email->client_temp;
    $plainclients = $mailclient->html2text($mailclient->Body);
    $mailclient->AltBody = $plainclients;
    if($mailclient->send() && $mail->send()){
        return true;
    }else {
        return false;
    }
}
