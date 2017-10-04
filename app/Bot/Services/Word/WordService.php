<?php
namespace App\Bot\Services\Word;

use function GuzzleHttp\Psr7\str;

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

    public function askFoundPriceReminderGeneric($flightID){
        $buttons    = [
            "title"     => "Price Reminder Airlines",
            "image"     => "https://media.mjniuz.com/dating/d0976fd8b348eb56f9f15911709f85c02017-10-04-22-01-09.jpeg",
            "subtitle"  => "We found the airline ticket prices that fit with your budget, hurry up!!",
            "buttons"   => [
                [
                    "type"      => "postback",
                    "data"      => http_build_query(["price_reminder_found_detail" => $flightID]),
                    "label"     => "See Detail"
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

    public function askConfirmBudgetButton($budget = 0){
        $buttons    = [
            "title"     => "Is your budget SGD " . number_format($budget,0) . " correct?",
            "buttons"   => [
                [
                    "type"      => "postback",
                    "data"      => http_build_query(["price_reminder_set_amount" => $budget]),
                    "label"     => "Yes"
                ],
                [
                    "type"      => "postback",
                    "data"      => http_build_query(["price_reminder_change_amount" => 1]),
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
                    "type"      => "url",
                    "data"      => http_build_query(["price_reminder_confirm_all" => 1]),
                    "label"     => "Yes Confirm"
                ]
            ]
        ];

        return $messages;
    }

    public function askFoundDetailList($flight){
        $messages[]    = [
            "title"     => "Departure - Destination",
            "subtitle"  => ucfirst($flight->from) . " - " . ucfirst($flight->to),
        ];
        $messages[]    = [
            "title"     => "Found Flight Date",
            "subtitle"  => date("d F Y H:i", strtotime($flight->flight_time))
        ];
        $messages[]    = [
            "title"     => "Airline",
            "subtitle"  => ucfirst($flight->airline)
        ];
        $messages[]    = [
            "title"     => "Your Budget - Found Airfare",
            "subtitle"  => "SGD" . number_format($flight->amount) . ' - ' . "SGD" . number_format($flight->amount_found),
            "buttons"   => [
                [
                    "type"      => "url",
                    "data"      => "https://www.singaporeair.com/en_UK/id/home",
                    "label"     => "Book Now"
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

    public function askFlightCheckIn(){
        return [
            "title"         => "Check-in is available now",
            "pnr_number"    => "XYZ",
            "checkin_url"   => url('checking/XYZ'),
            "flight_number" => "F212",
            "departure_airport" => [
                "airport_code"      => "CGK",
                "city"              => "Jakarta",
                "terminal"          => "T1",
                "gate"              => "G6"
            ],
            "arrival_airport" => [
                "airport_code"      => "SIN",
                "city"              => "Singapore",
                "terminal"          => "T2",
                "gate"              => "G12"
            ],
            "flight_schedule"   => [
                "boarding_time"     => date("Y-m-d H:i:s", strtotime("+1 day")),
                "departure_time"    => date("Y-m-d H:i:s", strtotime("+1 day +40 minutes")),
                "arrival_time"      => date("Y-m-d H:i:s", strtotime("+1 day +1 hour +30 minutes"))
            ]
        ];
    }
}