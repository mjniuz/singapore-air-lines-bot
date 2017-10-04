<?php
namespace App\Bot\Services\Word;

class WordService{
    public function askStartNewPriceReminderButton(){
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

    public function askStartNewPriceReminderGeneric(){
        $buttons    = [
            "title"     => "Price Reminder Airlines",
            "image"     => "https://media.mjniuz.com/dating/fd17aa4be141ff98096b5831890062de2017-10-04-15-35-33.png",
            "subtitle"  => "You can set your own budget to flight with your favourite airlines",
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