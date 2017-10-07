<?php namespace App\Http\Controllers\Api;

use App\Bot\Repository\RequestRepository;
use App\Bot\Repository\TelegramRepository;
use App\Bot\Repository\TemplateService;
use App\Bot\Repository\UserRepository;
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
        $this->telegram_repository = new TelegramRepository();
        // repository users
        $this->user_repository = new UserRepository();
        // this repository for handling request
        $this->request_repository = new RequestRepository();
        $this->template           = new TemplateService();
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
            $id      = $data['message']['from']['id'];
            $message = $data['message']['text'];
            // check if sender messege if not empty
            if (!empty($message))
            {
                $user_repository = $this->user_repository->saveUserTelegram($data['message']['from']);
                $sender_message  = $this->request_repository->handlingRequest($id, $message);

                // check sender message
                if (!empty($sender_message))
                {
                    // get message
                    $response_message = $sender_message['message'];

                    // check status
                    if ($sender_message['status'] != 1)
                    {
                        // send message to messenger
                        $this->telegram_repository->sendTextMessage($id, $response_message);

                    }
                    else
                    {
                        $flights = $response_message['flights'];
                        foreach ($flights as $key => $flight)
                        {
                            $data[] = $flight['only_time'] . " > " . $flight['only_time_arrival'] . " price : " . $flight['amount_found'];
                        }
                        $route = route('frontend.flights') . "?searchdate=" . $response_message['data']['date'] . "&searchlocationfrom=" . $response_message['data']['depart'] . "&searchlocationto=" . $response_message['data']['arrive'];

                        $params = urlencode($response_message['data']['date'] . ", " . $response_message['data']['depart'] . " > " . $response_message['data']['arrive'] . "\n\n" . $data[0] . "\n\n" . $data[1] . "\n\n" . "check this link for detail " . $route);
                        $this->telegram_repository->sendTextMessage($id, $params);
                    }

                    // return message
                    return $this->template->sendText($response_message);
                }

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
