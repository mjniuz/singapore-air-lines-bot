<?php

namespace App\CheckIn;

use App\Bot\Repository\MessengerRepository;
use App\Bot\Repository\TemplateService;
use App\Bot\Services\Word\WordService;

class CheckInInjectService extends CheckInRepository{
    protected $template, $word;
    public function __construct() {
        $this->template = new TemplateService();
        $this->word     = new WordService();
    }

    public function sendBoardingPass($user = null, $checkID = null){
        $check  = $this->find($checkID);
        if(!$check OR is_null($check->ready_at)){
            return [
                $this->template->sendText("Sorry your boarding pass not found or not ready, pleasetry again later")
            ];
        }

        $boardingData   = $this->word->boardingPassDetail($check);

        $response       = [
            $this->template->sendBoarding($boardingData)
        ];

        return $this->_send($user, $response);
    }

    private function _send($user, $message = []){
        $bot = new MessengerRepository($user->facebook_id);
        return $bot->responseMessage($message);
    }
}