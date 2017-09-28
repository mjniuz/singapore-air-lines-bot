<?php namespace App\Bot\Repository;

use App\Bot\Services\Bot\Bot;

class MessengerRepository extends Repository
{

    /**
     * this function for first call function if call another function
     *
     * @param \Illuminate\Http\Request $request The request
     */
    public function __construct()
    {
        // repository messenger for handle process data
        $this->bot = new Bot;
    }

    /**
     * this function for hit api facebook for chatbot
     *
     * @param integer $id      The identifier
     * @param string  $message The message
     */
    public function sendTextMessage($id, $message)
    {
        $params = [
            'recipient' => [
                'id' => $id,
            ],
            'message'   => [
                'text' => $message,
            ],
        ];
        // return data
        return $this->bot->hitFacebookReplyMessege($params);
    }
}
