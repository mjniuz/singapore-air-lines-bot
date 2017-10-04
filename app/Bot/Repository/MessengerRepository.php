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
            return false;
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
                case 'confirm':
                    //$this->sendConfirm($response['response']);
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
                case 'carousel':
                    //$this->sendCarousels($response['response']);
                    break;
                case 'button':
                    //$this->sendButton($response['response']);
                    break;
                default:
                    $this->sendTextMessage($response['response']);
                    break;
            }
        }

        return true;
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
