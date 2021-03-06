<?php
namespace App\Bot\Repository;

use App\Bot\Services\Bot\Bot;

class MessengerRepository extends Repository
{
    /**
     * this function for first call function if call another function
     *
     * @param \Illuminate\Http\Request $request The request
     */
    protected $bot, $facebookID;
    public function __construct($facebookID = "")
    {
        // repository messenger for handle process data
        $this->facebookID = $facebookID;
        $this->bot        = new Bot;
    }

    public function responseMessage(array $responses)
    {
        if (!is_array($responses))
        {
            return "error";
        }

        if (env('APP_ENV') == "local")
        {
            return $responses;
        }

        foreach ($responses as $response)
        {
            // sleep/delay
            if ($response['delay'] != 0)
            {
                sleep($response['delay']);
            }

            switch ($response['type'])
            {
                case 'text':
                    $this->sendTextMessage($response['response']);
                    break;
                case 'checkin':
                    $this->sendCheckInMessage($response['response']);
                    break;
                case 'airline_update':
                    $this->sendAirlineUpdateMessage($response['response']);
                    break;
                case 'boarding':
                    $this->sendBoardingMessage($response['response']);
                    break;
                case 'sticker':
                    //$this->sendSticker($response['response']);
                    break;
                case 'audio':
                    //$this->sendAudio($response['response']);
                    break;
                case 'list':
                    $this->sendListMessage($response['response']);
                    break;
                case 'generic':
                    $this->sendGenericMessage($response['response']);
                    break;
                case 'button':
                    $this->sendButtonMessage($response['response']);
                    break;
                default:
                    $this->sendTextMessage($response['response']);
                    break;
            }
        }

        return "success";
    }

    public function sendBoardingMessage($message)
    {
        $params = [
            'recipient' => [
                'id' => $this->facebookID,
            ],
            'message'   => [
                'attachment' => [
                    "type"    => "template",
                    "payload" => [
                        "template_type" => "airline_boardingpass",
                        "intro_message" => $message['title'],
                        "locale"        => (!empty($message['locale']) ? $message['locale'] : "en_US"),
                        "boarding_pass" => [
                            [
                                "passenger_name"   => "John " . $message['last_name'],
                                "pnr_number"       => $message['pnr_number'],
                                "seat"             => $message['seat'],
                                "logo_image_url"   => "https://www.singaporeair.com/saar5/images/logo-footer-singaporeairlines.png",
                                "qr_code"          => (!empty($message['qr_code']) ? $message['qr_code'] : ("M1SMITH\/" . $message['last_name'] . "  CG4X7U nawouehgawgnapwi3jfa0wfh")),
                                "auxiliary_fields" => [
                                    [
                                        "label" => "Terminal",
                                        "value" => $message['departure_airport']['terminal'],
                                    ],
                                    [
                                        "label" => "Departure",
                                        "value" => $message['flight_schedule_departure'],
                                    ],
                                ],
                                "secondary_fields" => [
                                    [
                                        "label" => "Boarding",
                                        "value" => $message['flight_schedule_boarding'],
                                    ],
                                    [
                                        "label" => "Gate",
                                        "value" => $message['departure_airport']['gate'],
                                    ],
                                ],
                                "flight_info"      => [
                                    "flight_number"     => $message['flight_number'],
                                    "departure_airport" => [
                                        "airport_code" => $message['departure_airport']['airport_code'],
                                        "city"         => $message['departure_airport']['city'],
                                        "terminal"     => $message['departure_airport']['terminal'],
                                        "gate"         => $message['departure_airport']['gate'],
                                    ],
                                    "arrival_airport"   => [
                                        "airport_code" => $message['arrival_airport']['airport_code'],
                                        "city"         => $message['arrival_airport']['city'],
                                        "terminal"     => $message['arrival_airport']['terminal'],
                                        "gate"         => $message['arrival_airport']['gate'],
                                    ],
                                    "flight_schedule"   => [
                                        "departure_time" => date("Y-m-d", strtotime($message['flight_schedule']['departure_time'])) . "T" . date("H:m", strtotime($message['flight_schedule']['departure_time'])),
                                        "arrival_time"   => date("Y-m-d", strtotime($message['flight_schedule']['arrival_time'])) . "T" . date("H:m", strtotime($message['flight_schedule']['arrival_time'])),
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        // return data
        return $this->bot->getFacebookReplyMessage($params);
    }

    public function sendAirlineUpdateMessage($message)
    {
        $params = [
            'recipient' => [
                'id' => $this->facebookID,
            ],
            'message'   => [
                'attachment' => [
                    "type"    => "template",
                    "payload" => [
                        "template_type" => "airline_update",
                        "intro_message" => $message['title'],
                        "locale"        => (!empty($message['locale']) ? $message['locale'] : "en_US"),
                        "update_type"   => (!empty($message['type']) ? $message['type'] : "delay"),
                        "pnr_number"    => $message['pnr_number'],
                        "update_flight_info"   => [
                            "flight_number"     => $message['flight_number'],
                            "departure_airport" => [
                                "airport_code" => $message['departure_airport']['airport_code'],
                                "city"         => $message['departure_airport']['city'],
                                "terminal"     => $message['departure_airport']['terminal'],
                                "gate"         => $message['departure_airport']['gate'],
                            ],
                            "arrival_airport"   => [
                                "airport_code" => $message['arrival_airport']['airport_code'],
                                "city"         => $message['arrival_airport']['city'],
                                "terminal"     => $message['arrival_airport']['terminal'],
                                "gate"         => $message['arrival_airport']['gate'],
                            ],
                            "flight_schedule"   => [
                                "boarding_time"  => date("Y-m-d", strtotime($message['flight_schedule']['boarding_time'])) . "T" . date("H:m", strtotime($message['flight_schedule']['boarding_time'])),
                                "departure_time" => date("Y-m-d", strtotime($message['flight_schedule']['departure_time'])) . "T" . date("H:m", strtotime($message['flight_schedule']['departure_time'])),
                                "arrival_time"   => date("Y-m-d", strtotime($message['flight_schedule']['arrival_time'])) . "T" . date("H:m", strtotime($message['flight_schedule']['arrival_time'])),
                            ],
                        ],
                    ],
                ],
            ],
        ];
        // return data
        return $this->bot->getFacebookReplyMessage($params);
    }

    public function sendCheckInMessage($message)
    {
        $params = [
            'recipient' => [
                'id' => $this->facebookID,
            ],
            'message'   => [
                'attachment' => [
                    "type"    => "template",
                    "payload" => [
                        "template_type" => "airline_checkin",
                        "intro_message" => $message['title'],
                        "locale"        => (!empty($message['locale']) ? $message['locale'] : "en_US"),
                        "pnr_number"    => $message['pnr_number'],
                        "checkin_url"   => $message['checkin_url'],
                        "flight_info"   => [
                            [
                                "flight_number"     => $message['flight_number'],
                                "departure_airport" => [
                                    "airport_code" => $message['departure_airport']['airport_code'],
                                    "city"         => $message['departure_airport']['city'],
                                    "terminal"     => $message['departure_airport']['terminal'],
                                    "gate"         => $message['departure_airport']['gate'],
                                ],
                                "arrival_airport"   => [
                                    "airport_code" => $message['arrival_airport']['airport_code'],
                                    "city"         => $message['arrival_airport']['city'],
                                    "terminal"     => $message['arrival_airport']['terminal'],
                                    "gate"         => $message['arrival_airport']['gate'],
                                ],
                                "flight_schedule"   => [
                                    "boarding_time"  => date("Y-m-d", strtotime($message['flight_schedule']['boarding_time'])) . "T" . date("H:m", strtotime($message['flight_schedule']['boarding_time'])),
                                    "departure_time" => date("Y-m-d", strtotime($message['flight_schedule']['departure_time'])) . "T" . date("H:m", strtotime($message['flight_schedule']['departure_time'])),
                                    "arrival_time"   => date("Y-m-d", strtotime($message['flight_schedule']['arrival_time'])) . "T" . date("H:m", strtotime($message['flight_schedule']['arrival_time'])),
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        // return data
        return $this->bot->getFacebookReplyMessage($params);
    }

    public function sendListMessage($messages)
    {
        $elements = [];
        foreach ($messages as $message)
        {
            $image               = !empty($message['image']) ? $message['image'] : false;
            $element['title']    = $message['title'];
            $element['subtitle'] = $message['subtitle'];

            if ($image)
            {
                $element['image_url'] = $image;
            }

            if (!empty($message['buttons']))
            {
                $element['buttons'] = $this->getButtons($message['buttons']);
            }

            $elements[] = $element;
        }

        $additionalButton = [

        ];
        $params = [
            'recipient' => [
                'id' => $this->facebookID,
            ],
            'message'   => [
                'attachment' => [
                    "type"    => "template",
                    "payload" => [
                        "template_type"     => "list",
                        "top_element_style" => "compact",
                        "elements"          => $elements,
                    ],
                ],
            ],
        ];

        // return data
        return $this->bot->getFacebookReplyMessage($params);
    }

    public function sendGenericMessage($message)
    {
        $elements[] = [
            "title"     => $message['title'],
            "image_url" => $message['image'],
            "subtitle"  => $message['subtitle'],
            "buttons"   => $this->getButtons($message['buttons']),
        ];
        $params = [
            'recipient' => [
                'id' => $this->facebookID,
            ],
            'message'   => [
                'attachment' => [
                    "type"    => "template",
                    "payload" => [
                        "template_type" => "generic",
                        "elements"      => $elements,
                    ],
                ],
            ],
        ];

        // return data
        return $this->bot->getFacebookReplyMessage($params);
    }

    public function sendButtonMessage($message)
    {
        $params = [
            'recipient' => [
                'id' => $this->facebookID,
            ],
            'message'   => [
                'attachment' => [
                    "type"    => "template",
                    "payload" => [
                        "template_type" => "button",
                        "text"          => $message['title'],
                        "buttons"       => $this->getButtons($message['buttons']),
                    ],
                ],
            ],
        ];
        // return data
        return $this->bot->getFacebookReplyMessage($params);
    }

    private function getButtons($buttonsData)
    {
        $buttons = [];
        foreach ($buttonsData as $button)
        {
            if ($button['type'] == 'url')
            {
                $button = [
                    "type"                 => "web_url",
                    "url"                  => $button['data'],
                    "title"                => $button['label'],
                    "webview_height_ratio" => "compact",
                ];
            }

            if ($button['type'] == 'postback')
            {
                $button = [
                    "type"    => "postback",
                    "payload" => $button['data'],
                    "title"   => $button['label'],
                ];
            }

            if ($button['type'] == 'call')
            {
                $button = [
                    "type"    => "phone_number",
                    "payload" => $button['data'],
                    "title"   => $button['label'],
                ];
            }

            $buttons[] = $button;
        }

        return $buttons;
    }

    /**
     * this function for send data flights to messenger
     * @param  array    $flights
     * @param  object   $user
     * @return object
     */
    public function sendDataFlights($flights, $user)
    {
        $flights = $this->setFlight($flights);
        $price   = $flights['price_all'] + 500;
        $params  = [
            'recipient' => [
                'id' => $this->facebookID,
            ],
            'message'   => [
                'attachment' => [
                    "type"    => "template",
                    "payload" => [
                        "template_type"          => "airline_itinerary",
                        "intro_message"          => "Data Of Flights",
                        "locale"                 => "en_US",
                        "pnr_number"             => "ABCDEF",
                        "passenger_info"         => [
                            [
                                'name'          => $user->full_name,
                                'ticket_number' => "CGK-DEBORA",
                                'passenger_id'  => $user->facebook_id,
                            ],
                        ],
                        "flight_info"            => $flights['flights'],
                        "passenger_segment_info" => [
                            [
                                "segment_id"   => "SA002",
                                "passenger_id" => $user->facebook_id,
                                "seat"         => "34D",
                                "seat_type"    => "Business",
                                "product_info" => [
                                    [
                                        "title" => "Price",
                                        "value" => "3,500,000",
                                    ],
                                ],
                            ],
                            [
                                "segment_id"   => "SA002",
                                "passenger_id" => $user->facebook_id,
                                "seat"         => "21D",
                                "seat_type"    => "World Business",
                                "product_info" => [
                                    [
                                        "title" => "Price",
                                        "value" => "4,500,000",
                                    ],
                                    [
                                        "title" => "Lounge",
                                        "value" => "Complimentary lounge access",
                                    ],
                                    [
                                        "title" => "Baggage",
                                        "value" => "1 extra bag 50lbs",
                                    ],
                                ],
                            ],
                        ],
                        "price_info"             => [
                            [
                                "title"    => "Fuel surcharge",
                                "amount"   => "1597",
                                "currency" => "SGD",
                            ],
                        ],
                        "base_price"             => "{$flights['price_all']}",
                        "tax"                    => "200",
                        "total_price"            => "{$price}",
                        "currency"               => "SGD",
                    ],
                ],
            ],
        ];

        // return data
        return $this->bot->getFacebookReplyMessage($params);
    }

    /**
     * this function for set all flights data
     * @param array $flights
     */
    public function setFlight($flights)
    {
        // set price all
        $price_all = 0;
        foreach ($flights as $key => $flight)
        {
            // save price all
            $price_all = $flight['amount_found'] + $price_all;

            // set depature airport
            $departure_airport = $flight['only_date'] . "T" . $flight['only_time'];

            // set arrival airport
            $arrival_airport = $flight['only_date'] . "T" . $flight['only_time_arrival'];

            // set flights
            $set_flights[] = [
                "connection_id"     => "SA001",
                "segment_id"        => "SA002",
                "flight_number"     => "KL9123",
                "aircraft_type"     => "Boeing 737",
                "travel_class"      => "Business",
                "departure_airport" => [
                    "airport_code" => $flight['from_code'],
                    "city"         => $flight['from_location'],
                    "terminal"     => "2B",
                    "gate"         => "G8",
                ],
                "arrival_airport"   => [
                    "airport_code" => $flight['to_code'],
                    "city"         => $flight['to_location'],
                    "terminal"     => "T4",
                    "gate"         => "6C",
                ],
                "flight_schedule"   => [
                    "departure_time" => $departure_airport,
                    "arrival_time"   => $arrival_airport,
                ],
            ];
        }
        // set price all
        $params['price_all'] = $price_all;
        $params['flights']   = $set_flights;

        return $params;
    }

    /**
     * this function for hit api facebook for chatbot
     *
     * @param integer $id      The identifier
     * @param string  $message The message
     */
    public function sendTextMessage($message)
    {
        $params = [
            'recipient' => [
                'id' => $this->facebookID,
            ],
            'message'   => [
                'text' => $message,
            ],
        ];
        // return data
        return $this->bot->getFacebookReplyMessage($params);
    }

    /**
     * this function for send image to user
     * @param  object   $message
     * @return object
     */
    public function sendImageMessage($image_url)
    {
        $params = [
            'recipient' => [
                'id' => $this->facebookID,
            ],
            'message'   => [
                'attachment' => [
                    'type'    => 'image',
                    'payload' => [
                        'url' => $image_url,
                    ],
                ],
            ],
        ];
        // return data
        return $this->bot->getFacebookReplyMessage($params);
    }

}
