<?php

namespace App\Message;

use App\Bot\Repository\MessengerRepository;
use App\Bot\Repository\TemplateService;
use App\Bot\Services\Word\WordService;

class MessageService{

    public function getFacebookID($data){
        $facebookID = $data['entry'][0]['messaging'][0]['sender']['id'];

        // only echo
        if($facebookID == env('FACEBOOK_PAGE_USER_ID')){
            return false;
        }

        return $facebookID;
    }

    public function isFeedBackReadDelivery($data){
        // is event read
        $messaging  = !empty($data['entry'][0]['messaging']) ? $data['entry'][0]['messaging'][0] : false;

        if(!$messaging OR !empty($messaging['read']) OR !empty($messaging['delivery'])
            OR (!empty($messaging['message']) AND !empty($messaging['message']['is_echo']))){
            return true;
        }

        return false;
    }

    public function getMessage($data){
        if($this->getMessageType($data) == 'text'){
            return $data['entry'][0]['messaging'][0]['message']['text'];
        }

        if($this->getMessageType($data) == 'postback'){
            return $data['entry'][0]['messaging'][0]['postback']['payload'];
        }

        return false;
    }

    public function getMessageType(array $data = []){
        if($this->isFeedBackReadDelivery($data) == true){
            return false;
        }

        $messaging  = $data['entry'][0]['messaging'][0];
        if(!empty($messaging['message'])){
            if(!empty($messaging['message']['text'])){
                return 'text';
            }
        }

        if(!empty($messaging['postback'])){
            return 'postback';
        }

        if(!empty($messaging['message']['attachments'])){
            return $messaging['message']['attachments'][0]['type'];
        }

        return false;
    }

    public function stringContain($str = "", $contain = ""){
        if($str == ""){
            return false;
        }

        if(is_array($contain)){
            foreach ($contain as $value){
                if (strpos($str, $value) !== false) {
                    return true;
                }
            }

            return false;
        }

        if (strpos($str, $contain) !== false) {
            return true;
        }

        return false;
    }


    public function startCast($flights){
        $word       = new WordService();
        $template   = new TemplateService();

        foreach ($flights as $flight){
            $bot    = new MessengerRepository($flight->user->facebook_id);
            /*$amountFound    = $flight->amount_found;
            $airline        = $flight->airline;
            $flightTime     = $flight->flight_time;*/

            $askGenericNew  = $word->askFoundPriceReminderGeneric($flight->id);


            $bot->responseMessage([
                $template->sendGeneric($askGenericNew)
            ]);

            return true;
        }

        return false;
    }
}