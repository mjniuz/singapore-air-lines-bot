<?php namespace App\Bot\Repository;

use App\Bot\Helper\Helper;
use App\Models\Chat;
use App\Models\Flight;

/**
 * this class for handling request message
 */
class RequestRepository extends Repository
{
    /**
     * this function for handling request
     *
     * @param  integer $id The identifier
     * @return array
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
                    // get count message
                    $count_message = count($request_message);

                    // check count message
                    if ($count_message < $chat->count_chat)
                    {
                        return [
                            "status"  => 2,
                            "message" => "your format is not correct, format chat is " . $chat->format_chat . ", ex: is " . $chat->example_chat,
                        ];
                    }

                    // set messege request
                    $date   = $request_message[1];
                    $depart = $request_message[2];
                    $arrive = $request_message[3];

                    // check format date
                    $check_date_format = Helper::checkFormatDate($date);
                    if ($check_date_format)
                    {
                        // get all data flights
                        $flights = Flight::where('date', 'LIKE', '%' . $date . '%')->where('from_location', 'LIKE', '%' . $depart . '%')->where('to_location', 'LIKE', '%' . $arrive . '%')->get()->toArray();

                        if (!empty($flights))
                        {
                            // return data
                            return [
                                "status"  => 1,
                                "message" => [
                                    "flights" => $flights,
                                    "data"    => [
                                        "date"   => $date,
                                        "depart" => $depart,
                                        "arrive" => $arrive,
                                    ],
                                ],
                            ];
                        }
                        else
                        {
                            return [
                                "status"  => 2,
                                "message" => "Data Not Found",
                            ];
                        }
                    }
                    else
                    {
                        return [
                            "status"  => 2,
                            "message" => "your format date is not correct, format date is yyyy-mm-dd, ex: 2017-12-12",
                        ];
                    }
                }
            }
        }

        // return null if not same
        return null;
    }
}
