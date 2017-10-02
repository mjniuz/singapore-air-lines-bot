<?php namespace App\Http\Controllers\Api;

use App\Bot\Repository\MessengerRepository;
use App\Bot\Repository\RequestRepository;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class MessengerController extends ApiController
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
        $this->messenger_repository = new MessengerRepository();
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
        if ($request->input('hub_mode') === "subscribe" && $request->input('hub_verify_token') === env('FACEBOOK_VERIFY_TOKEN'))
        {
            return response($request->input('hub_challenge'), 200);
        }
        abort(404);
    }

    /**
     * this function for get data from facebook
     *
     * @param  \Illuminate\Http\Request   $request The request
     * @return \Illuminate\Http\Request
     */
    public function messengerBot(Request $request)
    {
        $data = $request->all();
        if (isset($data['entry'][0]['messaging'][0]['sender']['id']))
        {
            $facebook_id    = $data['entry'][0]['messaging'][0]['sender']['id'];
            $sender_message = $data['entry'][0]['messaging'][0]['message']['text'];

            // get detail user
            $response = $this->messenger_repository->getDetailMember($facebook_id);

            // check if sender messege if not empty
            if (!empty($sender_message))
            {
                $message = $this->request_repository->handlingRequest($sender_message, $facebook_id);
                if (empty($message))
                {
                    $message = $this->request_repository->handlingErrorFormat();
                }
                $response = $this->messenger_repository->sendTextMessage($facebook_id, $message);

                // return messege
                return response()->json(['message' => $message, 'response' => $response], 200);
            }
        }
        else
        {
            abort(404);
        }
    }
}
