<?php
namespace App\Bot\Repository;

use App\Bot\Services\Bot\Bot;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Support\Facades\Log;

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
        $this->facebookID   = $facebookID;
        $this->bot          = new Bot;
    }

    public function responseMessage(array $responses){
        if(!is_array($responses)){
            return "error";
        }

        if(env('APP_ENV') == "local"){
            return $responses;
        }

        foreach($responses as $response){
            // sleep/delay
            if($response['delay'] != 0){
                sleep($response['delay']);
            }

            switch ($response['type']){
                case 'text':
                    $this->sendTextMessage($response['response']);
                    break;
                case 'checkin':
                    $this->sendCheckInMessage($response['response']);
                    break;
                case 'image':
                    //$this->sendImage($response['response']);
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

    public function sendCheckInMessage($message){
        $params = [
            'recipient' => [
                'id' => $this->facebookID,
            ],
            'message'   => [
                'attachment' => [
                    "type"      => "template",
                    "payload"   => [
                        "template_type" => "airline_checkin",
                        "intro_message" => $message['title'],
                        "locale"        => (!empty($message['locale']) ? $message['locale'] : "en_US"),
                        "pnr_number"    => $message['pnr_number'],
                        "checkin_url"   => $message['checkin_url'],
                        "flight_info"   => [
                            "flight_number"     => $message['flight_number'],
                            "departure_airport" => [
                                "airport_code"      => $message['departure_airport']['airport_code'],
                                "city"              => $message['departure_airport']['city'],
                                "terminal"          => $message['departure_airport']['terminal'],
                                "gate"              => $message['departure_airport']['gate'],
                            ],
                            "arrival_airport" => [
                                "airport_code"      => $message['arrival_airport']['airport_code'],
                                "city"              => $message['arrival_airport']['city'],
                                "terminal"          => $message['arrival_airport']['terminal'],
                                "gate"              => $message['arrival_airport']['gate'],
                            ],
                            "flight_schedule" => [
                                "boarding_time"     => date("Y-m-dTH:m", strtotime($message['flight_schedule']['boarding_time'])),
                                "departure_time"    => date("Y-m-dTH:m", strtotime($message['flight_schedule']['departure_time'])),
                                "arrival_time"      => date("Y-m-dTH:m", strtotime($message['flight_schedule']['arrival_time']))
                            ]
                        ]
                    ]
                ]
            ],
        ];
        // return data
        return $this->bot->getFacebookReplyMessage($params);
    }

    public function sendListMessage($messages){
        $elements   = [];
        foreach ($messages as $message){
            $image      = !empty($message['image']) ? $message['image'] : false;
            $element['title']    = $message['title'];
            $element['subtitle']    = $message['subtitle'];

            if($image){
                $element['image_url']    = $image;
            }

            if(!empty($message['buttons'])){
                $element['buttons']    = $this->getButtons($message['buttons']);
            }

            $elements[] = $element;
        }

        $additionalButton   = [

        ];
        $params = [
            'recipient' => [
                'id' => $this->facebookID,
            ],
            'message'   => [
                'attachment' => [
                    "type"      => "template",
                    "payload"   => [
                        "template_type"     => "list",
                        "top_element_style" => "compact",
                        "elements"          => $elements
                    ]
                ]
            ],
        ];

        // return data
        return $this->bot->getFacebookReplyMessage($params);
    }

    public function sendGenericMessage($message){
        $elements[]    = [
            "title"     => $message['title'],
            "image_url" => $message['image'],
            "subtitle"  => $message['subtitle'],
            "buttons"   => $this->getButtons($message['buttons'])
        ];
        $params = [
            'recipient' => [
                'id' => $this->facebookID,
            ],
            'message'   => [
                'attachment' => [
                    "type"      => "template",
                    "payload"   => [
                        "template_type" => "generic",
                        "elements"      => $elements
                    ]
                ]
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
                    "type"      => "template",
                    "payload"   => [
                        "template_type" => "button",
                        "text"          => $message['title'],
                        "buttons"       => $this->getButtons($message['buttons'])
                    ]
                ]
            ],
        ];
        // return data
        return $this->bot->getFacebookReplyMessage($params);
    }

    private function getButtons($buttonsData){
        $buttons    = [];
        foreach ($buttonsData as $button){
            if($button['type']  == 'url'){
                $button =  [
                    "type"  => "web_url",
                    "url"   => $button['data'],
                    "title" => $button['label'],
                    "webview_height_ratio"  => "compact"
                ];
            }

            if($button['type']  == 'postback'){
                $button =  [
                    "type"      => "postback",
                    "payload"   => $button['data'],
                    "title"     => $button['label']
                ];
            }

            if($button['type']  == 'call'){
                $button =  [
                    "type"      => "phone_number",
                    "payload"   => $button['data'],
                    "title"     => $button['label']
                ];
            }

            $buttons[]  = $button;
        }

        return $buttons;
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

}
