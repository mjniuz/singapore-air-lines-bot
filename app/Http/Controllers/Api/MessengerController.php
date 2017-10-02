<?php namespace App\Http\Controllers\Api;

use App\Bot\Repository\MessengerRepository;
use App\Bot\Repository\RequestRepository;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessengerController extends ApiController
{
    /**
     * this function for first call function if call another function
     *
     * @param \Illuminate\Http\Request $request The request
     */
    protected $request_repository, $messenger_repository;
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
        Log::error(json_encode($request->all()));

        return response($request->input('hub_challenge'), 200);
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
            $user   = $this->messenger_repository->getDetailMember($facebook_id);
            if(!is_null($user)){
                return response()->json([
                    'message'   => 'error'
                ]);
            }

            // check if sender messege if not empty
            if (!empty($sender_message))
            {
                $message = $this->request_repository->handlingRequest($sender_message, $facebook_id);
                if (empty($message))
                {
                    $message = $this->request_repository->handlingErrorFormat();
                }
                // create log
                $this->messenger_repository->create($user->id,'text', $message);
                $response = $this->messenger_repository->sendTextMessage($facebook_id, $message);
                Log::error(json_encode($user));

                // return message
                return response()->json(['message' => $message, 'response' => $response], 200);
            }
        }
        else
        {
            return response()->json([
                'message'   => 'error'
            ]);
        }
    }
}
