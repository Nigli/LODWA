<?php

namespace email;

use sender\SenderInfoDAO,
    broker\BrokerDAO,
    receiver\ReceiverDAO,
    email\EmailTempDAO,
    traderec\TradeRec,
    utils\Enum,
    phpmailer\PHPMailer;

class Email {

    public $tr_symbol;
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
    public $brokers = array();
    public $id_broker;
    public $broker_company;
    public $broker_name;
    public $broker_email;
    public $recipients = array();    
    public $company_website;
    public $hash_email;
    public $disclosure;

    public function __construct($tr) {
        foreach ($tr as $k => $v) {/*         * PUT TR OBJECT IN CONSTRUCTOR* */
            $this->$k = $v;
        }

        date_default_timezone_set(Enum::CHICAGO_TIME); /*         * SETTING TIME ZONE TO BE CHICAGO(constant from config file)* */
        $date_time          = new \DateTime(); /*         * CREATE NEW DATETIME OBJECT AND FORMAT IT FOR DB* */
        $this->date_time    = $date_time->format("Y-m-d H:i:s");
        $this->date         = $date_time->format("d M Y");
        $this->time         = $date_time->format("H:i");

        $sender = SenderInfoDAO::getSenderInfo();
        if ($sender) {
            foreach ($sender as $k => $v) {/*             * CREATES SENDER INFO OBJECT* */
                $this->$k = $v;
            }
        } else {
            $this->sender_email = null;
            $e = "No sender email";
            TradeRec::logTRerrors($e);
        }
        $brokers = BrokerDAO::getBrokerInfo();
        if ($brokers) {
            foreach ($brokers as $k => $v) {/*             * CREATES BROKER INFO OBJECT* */
                $this->brokers[] = $v;
                //$this->$k = $v;
            }
        } else {
            $this->broker_email = null;
        }
        
        $receivers = ReceiverDAO::getReceiversByStrat($this->fk_strategy);
        if ($receivers) {
            foreach (ReceiverDAO::getReceiversByStrat($this->fk_strategy) as $k => $v) {/*             * CREATES ARRAY OF CLIENT OBJECTS* */
                $this->recipients[] = $v->recipient;
            }
        } else {
            $this->recipients[] = null;
        }
        $this->hash_email;
        $emailtemp = EmailTempDAO::getEmailTemp();
        $emailtemp ? $this->disclosure = Email::nl2p($emailtemp->disclosure) : null; /*         * CREATES OBJECT AND APPLY nl2p function on DISCLOSURE PROPERTY* */
    }

    public function sendEmail() {
        $mail               = new PHPMailer();
        $mail->CharSet      = 'UTF-8';
        $mail->isSMTP();                                        //*
        //$mail->SMTPDebug  = 2;                                  //*
        $mail->Debugoutput  = 'html';                            //*
        $mail->Host         = Enum::SENDER_HOST;
        //$mail->Host = "relay-hosting.secureserver.net";         // Specify main and backup SMTP servers
        $mail->SMTPAuth     = true;                               // Enable SMTP authentication*
        $mail->Username     = $this->sender_email;                 // SMTP username
        $mail->Password     = Enum::SENDER_PASS;                // SMTP password*
        $mail->SMTPSecure   = 'tls';                            // Enable TLS encryption, `ssl` also accepted*
        $mail->Port         = Enum::SENDER_PORT;                      // TCP port to connect to

        $mail->From         = $this->sender_email;
        $mail->FromName     = $this->sender_name;
        $mail->addReplyTo($this->sender_email, $this->sender_name);
        $mail->isHTML(true);                                    // Set email format to HTML
        $mail->Subject      = $this->title;

        $mailclient         = clone $mail;

        
        
        if (in_array(!null, $this->brokers)&& in_array(!null, $this->recipients)) {
            //mail to broker
        
            if (in_array(!null, $this->brokers)) {
                foreach($this->brokers as $k =>$broker) {
                    $mail->ClearAllRecipients();
                    $mail->addAddress($broker->broker_email, $broker->broker_name);                
                    $mail->Body     = $this->broker_temp = $this->viewTemp()[0];
                    $plain          = $mail->html2text($mail->Body);
                    $mail->AltBody  = $plain;                  
                    if ($mail->send()) {
                        //echo $broker->broker_email;
                        //return TRUE;
                    } else {
                        $e = "Email not sent";
                        TradeRec::logTRerrors($e);
                    }
                }
            } else {
                $e = "No broker email or broker name";
                TradeRec::logTRerrors($e);
            }                

            //mail to clients
            if (in_array(!null, $this->recipients)) {
                foreach ($this->recipients as $recipient) {
                    $this->hash_email   = $recipient['hash_email'];
                    $mailclient->ClearAllRecipients();
                    $mailclient->AddAddress($recipient['email'], $recipient['first_name'] . " " . $recipient['last_name']);
                    $mailclient->Body   = $this->viewTemp()[1];
                    $plainclients       = $mailclient->html2text($mailclient->Body);
                    $mailclient->AltBody = $plainclients;
                    $mailclient->send();
//                    if ($mailclient->send()) {
//                        echo $recipient['email'];  
//                        //return TRUE;
//                    } else {
//                        $e = "Email not sent";
//                        TradeRec::logTRerrors($e);
//                    }
                }
            } else {
                $e = "No recipients";
                TradeRec::logTRerrors($e);
            }
            return TRUE;
        }    
    }

    private function nl2p($text) {/*     * SET ALL LETTERS UPPER AND REPLACE \n WITH <p> TAGS* */
        $uptext = strtoupper($text);
        return "<p>" . str_replace("\n", "</p><p>", $uptext) . "</p>";
    }

    private function viewTemp() {
        /*         * RENDER EMAIL OBJECT TO EMAIL TEMPLATES* */

        if ($this->fk_tr_type != 1) {/*         * CHECK IF EMAIL IS NOT REGULAR TR AND THEN ADD COLOR TO CHANGING TITLE AND PRICE* */
            $color_title = 'color:red';
            if ($this->rpl_price == "stop_loss") {
                $color_stop_loss    = 'color:red';
                $color_price_target = '';
            } elseif ($this->rpl_price == "price_target") {
                $color_stop_loss    = '';
                $color_price_target = 'color:red';
            } else {
                $color_stop_loss    = '';
                $color_price_target = '';
            }
        } else {
            $color_title        = '';
            $color_stop_loss    = '';
            $color_price_target = '';
        }

        $elements = array(/*             * ARRAY KEYS ARE STRINGS IN TEMPLATE AND VALUES OF ARRAY ELEMENTS HAS TO BE REPLACED WITH THOSE STRINGS* */
            '[TR_NUM]'              => $this->tr_symbol,
            '[TITLE]'               => $this->title,
            '[COLOR_TRADE_TITLE]'   => $color_title,
            '[COLOR_STOP_LOSS]'     => $color_stop_loss,
            '[COLOR_TARGET]'        => $color_price_target,
            '[TRADE_TYPE]'          => $this->tr_type_name,
            '[DATE]'                => $this->date,
            '[TIME]'                => $this->time,
            '[STRATEGY]'            => $this->strategy_name,
            '[CONTRACTS]'           => $this->num_contr,
            '[MONTH]'               => $this->month,
            '[FUTURE]'              => $this->futures_name,
            '[ENTRY_CHOICE]'        => $this->entry_choice,
            '[OP_ENTRY_CHOICE]'     => $this->op_entry_choice,
            '[DURATION]'            => $this->duration,
            '[ENTRY_PRICE]'         => $this->entry_price,
            '[PRICE_TARGET]'        => $this->price_target,
            '[STOP_LOSS]'           => $this->stop_loss,
            '[DESCRIPTION]'         => $this->description,
            '[DISCLOSURE]'          => $this->disclosure,
            '[SENDER_EMAIL]'        => $this->sender_email,
            '[COMPANY_WEBSITE]'     => $this->company_website,
            '[COMPANY_NAME]'        => $this->company_name,
            '[ADDRESS]'             => $this->sender_address,
            '[SUBS_ID]'             => $this->hash_email
        );
        $elements_in        = array_values($elements); /*         * GROUP BY KEYS AND VALUES* */
        $elements_out       = array_keys($elements);

        $broker_temp_view   = file_get_contents('emailtemplates/broker_temp.php'); /*         * REPLACING KEY WITH VALUES IN TEMPLATE* */
        $broker_temp        = str_replace($elements_out, $elements_in, $broker_temp_view);

        $client_temp_view   = file_get_contents('emailtemplates/client_temp.php');
        $client_temp        = str_replace($elements_out, $elements_in, $client_temp_view);
        return $temps       = array($broker_temp, $client_temp);
    }

}
