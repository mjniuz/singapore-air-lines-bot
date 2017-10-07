<?php
namespace App\Bot\Services\Word;

use function GuzzleHttp\Psr7\str;

class WordService{
    public function introList(){
        $messages[]    = [
            "title"     => "Flight Check In",
            "subtitle"  => "You can easily check in through your flight by just chat with us",
            "buttons"   => [
                [
                    "type"      => "postback",
                    "data"      => "check in create new",
                    "label"     => "Check In"
                ]
            ]
        ];
        $messages[]    = [
            "title"     => "Flight with your own Budget",
            "subtitle"  => "Now you can set your own budget to flight to anywhere and anytime you want",
            "buttons"   => [
                [
                    "type"      => "postback",
                    "data"      => "price reminder create new",
                    "label"     => "Learn More"
                ]
            ]
        ];
        $messages[]    = [
            "title"     => "Flight Booking",
            "subtitle"  => "Book your ticket in here and get the priority notif about the flight status",
            "buttons"   => [
                [
                    "type"      => "postback",
                    "data"      => "booking create new",
                    "label"     => "Booking Now"
                ]
            ]
        ];
        $messages[]    = [
            "title"     => "About Us",
            "subtitle"  => "We are chat bot platform that can help you to manage your flight to be better",
            "buttons"   => [
                [
                    "type"      => "url",
                    "data"      => "http://singairline.azurewebsites.net/",
                    "label"     => "Learn More"
                ]
            ]
        ];

        return $messages;
    }

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

    public function askStartNewCheckInGeneric(){
        $buttons    = [
            "title"     => "Check In Singapore Airlines",
            "image"     => "https://media.mjniuz.com/dating/6f90b969c7ef862ec0239fd5eb1399742017-10-06-18-55-05.jpeg",
            "subtitle"  => "You can Check In your flight in here with only view step",
            "buttons"   => [
                [
                    "type"      => "postback",
                    "data"      => http_build_query(["check_in_start_confirm" => 1]),
                    "label"     => "Configure CheckIn"
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

    public function askBookingNumberButton($bookNum = ""){
        $buttons    = [
            "title"     => "Is your booking number " . strtoupper($bookNum) . " correct?",
            "buttons"   => [
                [
                    "type"      => "postback",
                    "data"      => http_build_query(["check_in_set_booking_number" => strtoupper($bookNum)]),
                    "label"     => "Yes"
                ],
                [
                    "type"      => "postback",
                    "data"      => http_build_query(["check_in_change_booking_number" => 1]),
                    "label"     => "Change It"
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

    public function askCheckInLastNameButton($lastName = ""){
        $buttons    = [
            "title"     => "Is your last name " . ucfirst($lastName) . " correct?",
            "buttons"   => [
                [
                    "type"      => "postback",
                    "data"      => http_build_query(["check_in_set_last_name" => ucfirst($lastName)]),
                    "label"     => "Yes"
                ],
                [
                    "type"      => "postback",
                    "data"      => http_build_query(["check_in_change_last_name" => 1]),
                    "label"     => "Change It"
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
                    "type"      => "postback",
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

    public function askConfirmDeleteCheckInButton(){
        $buttons    = [
            "title"     => "Are you sure to delete this?",
            "buttons"   => [
                [
                    "type"      => "postback",
                    "data"      => http_build_query(["check_in_delete_confirm" => 1]),
                    "label"     => "Yes Delete"
                ],
                [
                    "type"      => "postback",
                    "data"      => http_build_query(["check_in_show_final_confirm" => 1]),
                    "label"     => "No Keep it"
                ]
            ]
        ];

        return $buttons;
    }

    public function askFlightCheckIn($checkIn){
        return [
            "title"         => "Check-in is available now",
            "pnr_number"    => $checkIn->pnr_number,
            "checkin_url"   => url('check-in/' . $checkIn->token),
            "flight_number" => $checkIn->flight_number,
            "departure_airport" => [
                "airport_code"      => $checkIn->departure_airport_code,
                "city"              => $checkIn->departure_city,
                "terminal"          => $checkIn->departure_terminal,
                "gate"              => $checkIn->departure_gate
            ],
            "arrival_airport" => [
                "airport_code"      => $checkIn->arrival_airport_code,
                "city"              => $checkIn->arrival_city,
                "terminal"          => $checkIn->arrival_terminal,
                "gate"              => $checkIn->arrival_gate
            ],
            "flight_schedule"   => [
                "boarding_time"     => $checkIn->flight_schedule_boarding,
                "departure_time"    => $checkIn->flight_schedule_departure,
                "arrival_time"      => $checkIn->flight_schedule_arrival
            ]
        ];
    }

    public function boardingPassDetail($checkIn){
        return [
            "title"         => "You are checked in.",
            "last_name"     => $checkIn->last_name,
            "pnr_number"    => $checkIn->pnr_number,
            "seat"          => $checkIn->seat,
            "flight_number" => $checkIn->flight_number,
            "flight_schedule_departure" => date("mF H:i", strtotime($checkIn->flight_schedule_departure)),
            "flight_schedule_boarding"  => date("H:i", strtotime($checkIn->flight_schedule_boarding)),
            "departure_airport" => [
                "airport_code"      => $checkIn->departure_airport_code,
                "city"              => $checkIn->departure_city,
                "terminal"          => $checkIn->departure_terminal,
                "gate"              => $checkIn->departure_gate
            ],
            "arrival_airport" => [
                "airport_code"      => $checkIn->arrival_airport_code,
                "city"              => $checkIn->arrival_city,
                "terminal"          => $checkIn->arrival_terminal,
                "gate"              => $checkIn->arrival_gate
            ],
            "flight_schedule"   => [
                "boarding_time"     => $checkIn->flight_schedule_boarding,
                "departure_time"    => $checkIn->flight_schedule_departure,
                "arrival_time"      => $checkIn->flight_schedule_arrival
            ]
        ];
    }

    public function askFinalConfirmCheckInList($checkIn){
        $messages[]    = [
            "title"     => "Booking Number",
            "subtitle"  => strtoupper($checkIn->booking_number),
        ];
        $messages[]    = [
            "title"     => "Last Name",
            "subtitle"  => ucfirst($checkIn->last_name)
        ];
        $messages[]    = [
            "title"     => "Is it correct?",
            "subtitle"  => "Please press confirm button",
            "buttons"   => [
                [
                    "type"      => "postback",
                    "data"      => http_build_query(["check_in_confirm_all" => 1]),
                    "label"     => "Yes Confirm"
                ]
            ]
        ];

        return $messages;
    }

}