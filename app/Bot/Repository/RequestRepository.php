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
        if (!empty($request_message))
        {
            $chat = Chat::orderBy('id', 'desc')->first();
            if (!empty($chat))
            {
                $get_format_chat = explode("_", $chat->format_chat);
                if ($get_format_chat[0] == $request_message[0])
                {
                    $check_date_format = Helper::checkFormatDate($request_message[1]);
                    if ($check_date_format)
                    {
                        dd('here');
                    }
                    else
                    {
                        return "your format is not correect format date is yyyy-mm-dd, example : 2017-12-12";
                    }
                }
            }
        }

        // return null if not same
        return null;
    }
}
