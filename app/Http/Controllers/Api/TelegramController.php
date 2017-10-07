<?php namespace App\Http\Controllers\Api;

use App\Bot\Repository\RequestRepository;
// use App\Bot\Repository\TelegramRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TelegramController extends Controller
{

    /**
     * this function for first call function if call another function
     *
     * @param \Illuminate\Http\Request $request The request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        // repository messenger for handle process data
        // $this->telegram_repository = new TelegramRepository();
        // this repository for handling request
        $this->request_repository = new RequestRepository();
    }

    /**
     * this function for verify token begore hit
     *
     * @param  \Illuminate\Http\Request $request The request
     * @return string
     */
    public function verifyToken(Request $request)
    {
        return "OK";
    }

    /**
     * this function for get data from facebook
     *
     * @param  \Illuminate\Http\Request   $request The request
     * @return \Illuminate\Http\Request
     */
    public function telegramBot(Request $request)
    {
        $data = $request->all();
        if (isset($data['message']['from']['id']))
        {
            $id             = $data['message']['from']['id'];
            $sender_message = $data['message']['text'];

            // check if sender messege if not empty
            if (!empty($sender_message))
            {
                $message = $this->request_repository->handlingRequest($sender_message, $id);
                if (empty($message))
                {
                    $message = $this->request_repository->handlingErrorFormat();
                }
                // $return_response = $this->telegram_repository->sendTextMessage($id, $message);

                // return messege
                return response()->json(['message' => $message], 200);
            }
        }
        else
        {
            abort(404);
        }
    }
}
