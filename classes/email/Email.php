<?php

namespace email;

use sender\SenderInfoDAO,
    broker\BrokerDAO,
    receiver\ReceiverDao,
    email\EmailTempDAO,
    utils\Render,
        utils\Enum,
    phpmailer\PHPMailer;

class Email {

    public $fk_tr_type;
    public $tr_type_name;
    public $rpl_price;
    public $title;
    public $date_time;
    public $date;
    public $time;
    public $fk_strategy;
    public $strategy_name;
    public $month;
    public $futures_name;
    public $entry_choice;
    public $op_entry_choice;
    public $duration;
    public $entry_price;
    public $price_target;
    public $stop_loss;
    public $description;
    public $num_contr;
    public $id_sender;
    public $company_name;
    public $sender_name;
    public $sender_host;
    public $sender_email;
    public $sender_pass;
    public $sender_port;
    public $sender_address;
    public $id_broker;
    public $broker_company;
    public $company_website;
    public $broker_name;
    public $broker_email;
    public $id_receiver;
    public $hash_email;
    public $recipients = array();
    public $disclosure;
    public $broker_temp;
    public $client_temp;

    public function __construct($tr) {
        foreach ($tr as $k => $v) {/*         * PUT OBJECT IN CONSTRUCT(TR OBJECT)* */
            $this->$k = $v;
        }

        date_default_timezone_set(CHICAGO_TIME); /*         * SETTING TIME ZONE TO BE CHICAGO(constant from config file)* */
        $date_time = new \DateTime(); /*         * CREATE NEW DATETIME OBJECT AND FORMAT IT FOR DB* */
        $this->date_time = $date_time->format("Y-m-d H:i:s");
        $this->date = $date_time->format("d M Y");
        $this->time = $date_time->format("H:i");

        foreach (SenderInfoDAO::getSenderInfo() as $k => $v) {/*         * CREATES SENDER INFO OBJECT* */
            $this->$k = $v;
        }
        foreach (BrokerDAO::getBrokerInfo() as $k => $v) {/*         * CREATES BROKER INFO OBJECT* */
            $this->$k = $v;
        }
        foreach (ReceiverDao::getReceiversByStrat($this->fk_strategy) as $k => $v) {/*         * CREATES ARRAY OF CLIENT OBJECTS* */
            $this->hash_email = $v->hash_email;
            $this->id_receiver = $v->id_receiver;
            $this->recipients[] = $v->recipient;
        }

        $this->disclosure = Email::nl2p(EmailTempDAO::getEmailTemp()->disclosure); /*         * CREATES OBJECT AND APPLY nl2p function on DISCLOSURE PROPERTY* */
        $temps = Render::viewTemp($this);
        $this->broker_temp = $temps[0];
        $this->client_temp = $temps[1];
    }

    private static function nl2p($text) {/*     * SET ALL LETTERS UPPER AND REPLACE \n WITH <p> TAGS* */
        $uptext = strtoupper($text);
        return "<p>" . str_replace("\n", "</p><p>", $uptext) . "</p>";
    }

    public function sendEmail($email) {
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();                                        //*
        //$mail->SMTPDebug  = 2;                                  //*
        $mail->Host = Enum::SENDER_HOST;
        //$mail->Host = "relay-hosting.secureserver.net";         // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication*
        $mail->Username = $email->sender_email;                 // SMTP username
        $mail->Password = Enum::SENDER_PASS;                // SMTP password*
        //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = Enum::SENDER_PORT;                      // TCP port to connect to

        $mail->From = $email->sender_email;
        $mail->FromName = $email->sender_name;
        $mail->addReplyTo($email->sender_email, $email->sender_name);
        $mail->isHTML(true);                                    // Set email format to HTML
        $mail->Subject = $email->title;

        $mailclient = clone $mail;

        //mail to broker
        $mail->addAddress($email->broker_email, $email->broker_name);
        $mail->Body = $email->broker_temp;
        $plain = $mail->html2text($mail->Body);
        $mail->AltBody = $plain;
        //mail to clients
        foreach ($email->recipients as $recipient) {
            $add_and_name = explode(',', $recipient);
            $mailclient->addBCC($add_and_name[0], $add_and_name[1]);
        }
        $mailclient->Body = $email->client_temp;
        $plainclients = $mailclient->html2text($mailclient->Body);
        $mailclient->AltBody = $plainclients;
        if ($mailclient->send() && $mail->send()) {
            return true;
        } else {
            return false;
        }
    }

}
