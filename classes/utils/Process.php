<?php
namespace utils;
use sender\SenderInfoDAO,broker\BrokerDAO,futures\FuturesContractDAO,program\ProgramDAO,receiver\ReceiverDao;
class Process {
    public static function admin($form){        
        $valid = Validate::admin($form);
        foreach ($valid as $key=>$value){
            switch ($key) {
                case "profile-submit":
                    return SenderInfoDAO::EditSenderInfo($valid);
                case "broker-submit":
                    return BrokerDAO::EditBrokerInfo($valid);
                case "futures-submit":
                    if($value==="update"){
                        return FuturesContractDAO::UpdateFutures($valid);
                    }elseif($value==="delete"){
                        return FuturesContractDAO::RemoveFutures($valid);
                    }else{
                        return FuturesContractDAO::NewFutures($valid);
                    }
                case "program-submit":                    
                    if($value==="update"){                        
                        return ProgramDAO::UpdateProgram($valid);
                    }elseif($value==="delete"){
                        return ProgramDAO::RemoveProgram($valid);
                    }else{
                        return ProgramDAO::NewProgram($valid);
                    }
                case "receiver_submit":
                    if($value==="update"){
                        return ReceiverDao::UpdateReceiver($valid);
                    }elseif($value==="unsubscribe"){
                        return ReceiverDao::UnsubscribeReceiver($valid);
                    }else{
                        return ReceiverDao::NewReceiver($valid);
                    }
                default:
                    break;
            }
        }
    }
}
