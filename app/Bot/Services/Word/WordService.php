<?php
namespace App\Bot\Services\Word;

class WordService{
    public function askStartNewPriceReminder(){
        $buttons    = [
            "title"     => "Price Reminder Airlines",
            "buttons"   => [
                [
                    "type"      => "postback",
                    "data"      => http_build_query(["price_reminder_start_confirm" => 1]),
                    "label"     => "Create New"
                ]
            ]
        ];

        return $buttons;
    }
}