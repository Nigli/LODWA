<?php
include '../config.php';
use sender\SenderInfoDAO,
    user\UserDAO,
    utils\Enum,
    phpmailer\PHPMailer;

$sender = SenderInfoDAO::getSenderInfo();
$users = UserDAO::getUsers();
$email = file_get_contents("../emailtemplates/password_change.html");

function password_change($sender, $users, $email){
    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';
    $mail->isSMTP();                                        //*
    //$mail->SMTPDebug  = 2;                                  //*
    //$mail->Debugoutput = 'html';                            //*
    $mail->Host = Enum::SENDER_HOST;
    //$mail->Host = "relay-hosting.secureserver.net";         // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication*
    $mail->Username = $sender->sender_email;                 // SMTP username
    $mail->Password = Enum::SENDER_PASS;                // SMTP password*
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = Enum::SENDER_PORT;                      // TCP port to connect to

    $mail->From = $sender->sender_email;
    $mail->FromName = "Srlevel password changer";
    $mail->addReplyTo($sender->sender_email, "Srlevel password changer");
    $mail->isHTML(true);                                    // Set email format to HTML
    $mail->Subject = "Srlevel password changing";
    $mail->Body = $email; 
    $plain = $mail->html2text($mail->Body);
    $mail->AltBody = $plain;
    
    foreach ($users as $user) {
        $mail->ClearAllRecipients();
        $mail->AddAddress($user->user_email);
        if (!$mail->send()) {
            $e = "Email not sent";
            logPassChangeErr($e);
        } 
    }
    
}
function logPassChangeErr($e){
    $time = date("Y-m-d H:i:s");
    $log = $time . "|" . $e. "|"."\n";
    file_put_contents("../log/errors/passchangeerr.txt", $log, FILE_APPEND | LOCK_EX);
}

password_change($sender, $users, $email);
