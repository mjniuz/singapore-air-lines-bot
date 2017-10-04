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

    public function askDepartureButton($departure = ""){
        $buttons    = [
            "title"     => "Is your departure " . ucfirst($departure) . " correct?",
            "buttons"   => [
                [
                    "type"      => "postback",
                    "data"      => http_build_query(["price_reminder_set_departure" => $departure]),
                    "label"     => "Yes"
                ],
                [
                    "type"      => "postback",
                    "data"      => http_build_query(["price_reminder_change_departure" => 1]),
                    "label"     => "Change Departure"
                ]
            ]
        ];

        return $buttons;
    }

    public function askDestinationButton($dest = ""){
        $buttons    = [
            "title"     => "Is your destination " . ucfirst($dest) . " correct?",
            "buttons"   => [
                [
                    "type"      => "postback",
                    "data"      => http_build_query(["price_reminder_set_destination" => $dest]),
                    "label"     => "Yes"
                ],
                [
                    "type"      => "postback",
                    "data"      => http_build_query(["price_reminder_change_destination" => 1]),
                    "label"     => "Change Destination"
                ]
            ]
        ];

        return $buttons;
    }

    public function askConfirmDateButton($date = ""){
        $buttons    = [
            "title"     => "Is your flight date " . $date . " correct?",
            "buttons"   => [
                [
                    "type"      => "postback",
                    "data"      => http_build_query(["price_reminder_set_flight_date" => $date]),
                    "label"     => "Yes"
                ],
                [
                    "type"      => "postback",
                    "data"      => http_build_query(["price_reminder_change_flight_date" => 1]),
                    "label"     => "Change Date"
                ]
            ]
        ];

        return $buttons;
    }

    public function askFinalConfirmList($flight){
        $messages[]    = [
            "title"     => "Departure - Destination",
            "subtitle"  => ucfirst($flight->from) . " - " . ucfirst($flight->to),
        ];
        $messages[]    = [
            "title"     => "Flight Date",
            "subtitle"  => date("d F Y")
        ];
        $messages[]    = [
            "title"     => "Budget Alert when Lower than",
            "subtitle"  => "SGD " . number_format($flight->amount)
        ];
        $messages[]    = [
            "title"     => "Is it correct?",
            "subtitle"  => "Please press confirm button",
            "buttons"   => [
                [
                    "type"      => "postback",
                    "data"      => http_build_query(["price_reminder_confirm_all" => 1]),
                    "label"     => "Yes Confirm"
                ],
                [
                    "type"      => "postback",
                    "data"      => http_build_query(["price_reminder_delete_all" => 1]),
                    "label"     => "Delete it"
                ]
            ]
        ];

        return $messages;
    }

    public function askConfirmDeleteButton(){
        $buttons    = [
            "title"     => "Are you sure to delete this?",
            "buttons"   => [
                [
                    "type"      => "postback",
                    "data"      => http_build_query(["price_reminder_delete_confirm" => 1]),
                    "label"     => "Yes Delete"
                ],
                [
                    "type"      => "postback",
                    "data"      => http_build_query(["price_reminder_show_final_confirm" => 1]),
                    "label"     => "No Keep it"
                ]
            ]
        ];

        return $buttons;
    }
}