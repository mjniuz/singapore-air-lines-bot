<?php

namespace App\FlightPriceReminder;

use App\Bot\Repository\TemplateService;
use App\Bot\Services\Word\WordService;

class PriceReminderService extends FlightReminderRepository{
    protected $user, $message, $type, $template, $word;
    public function __construct($user, $message, $type = 'text') {
        $this->user     = $user;
        $this->message  = $message;
        $this->type     = $type;
        $this->template = new TemplateService();
        $this->word     = new WordService();
    }


    /**
     * this function for start price reminder
     * @return array
     */
    public function start(){
        if($this->stringContain($this->message, "price reminder create new")){
            return $this->createNew();
        }

        return [];
    }

    private function createNew(){
        $askCreateNew   = $this->word->askStartNewPriceReminder();

        return [
            $this->template->sendButton($askCreateNew)
        ];
    }

    private function stringContain($str = "", $contain = ""){
        if($str == "" OR $contain == ""){
            return false;
        }

        if (strpos($str, $contain) !== false) {
            return true;
        }

        return false;
    }
}