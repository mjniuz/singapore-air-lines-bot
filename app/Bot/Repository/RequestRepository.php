<?php namespace App\Bot\Repository;

use App\Bot\Helper\Helper;
use App\Models\Chat;

/**
 * this class for handling request message
 */
class RequestRepository extends Repository
{
    /**
     * this function for handling request
     *
     * @param  integer  $id The identifier
     * @return string
     */
    public function handlingRequest($id, $message)
    {
        $request_message = explode("_", $message);
        // check if not empty request message
        if (!empty($request_message))
        {
            // get data chat first
            $chat = Chat::orderBy('id', 'desc')->first();

            // check if not empty chat data
            if (!empty($chat))
            {
                // split format chat
                $get_format_chat = explode("_", $chat->format_chat);

                // check format chat
                if ($get_format_chat[0] == $request_message[0])
                {
                    // get count messege
                    $count_messege = count($request_message);

                    // check count messege
                    if ($count_messege < $chat->count_chat)
                    {
                        return "your format is not correct, format chat is " . $chat->format_chat . ", ex: is " . $chat->example_chat;
                    }

                    // check format date
                    $check_date_format = Helper::checkFormatDate($request_message[1]);
                    if ($check_date_format)
                    {
                        dd($get_format_chat);
                    }
                    else
                    {
                        return "your format date is not correct, format date is yyyy-mm-dd, example : 2017-12-12";
                    }
                }
            }
        }

        // return null if not same
        return null;
    }
}
