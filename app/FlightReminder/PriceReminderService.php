<?php

namespace App\FlightPriceReminder;

use App\Bot\Repository\TemplateService;

class PriceReminderService extends FlightReminderRepository{
    protected $user, $message, $type, $template;
    public function __construct($user, $message, $type = 'text') {
        $this->user     = $user;
        $this->message  = $message;
        $this->type     = $type;
        $this->template = new TemplateService();
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

        return [
            $this->template->sendText("Ini response buat baru")
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