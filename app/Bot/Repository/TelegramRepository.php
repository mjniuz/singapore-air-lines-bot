<?php namespace App\Bot\Repository;

use App\Bot\Services\Bot\Bot;

class TelegramRepository extends Repository
{
    /**
     * this function for first call function if call another function
     *
     * @param \Illuminate\Http\Request $request The request
     */
    protected $bot;
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
    public function sendTextMessage($telegram_id, $message)
    {
        // return data
        return $this->bot->sendMessegeTelegram($telegram_id, $message);
    }
}
