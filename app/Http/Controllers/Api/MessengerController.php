<?php namespace App\Http\Controllers\Api;

use App\Activity\ActivityRepository;
use App\Bot\Repository\MessengerRepository;
use App\Bot\Repository\RequestRepository;
use App\Bot\Repository\TemplateService;
use App\Bot\Repository\UserRepository;
use App\Bot\Services\Word\WordService;
use App\CheckIn\CheckInRepository;
use App\CheckIn\CheckInService;
use App\FlightPriceReminder\FlightReminderRepository;
use App\FlightPriceReminder\PriceReminderService;
use App\Http\Controllers\Api\ApiController;
use App\Message\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessengerController extends ApiController
{
    /**
     * this function for first call function if call another function
     *
     * @param \Illuminate\Http\Request $request The request
     */
    protected $request_repository, $userRepo, $template, $activity, $message;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        // this repository for handling request
        $this->request_repository = new RequestRepository();
        $this->userRepo           = new UserRepository();
        $this->template           = new TemplateService();
        $this->activity           = new ActivityRepository();
        $this->message            = new MessageService();
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
     * @param  \Illuminate\Http\Request $request The request
     * @return string
     */
    public function messengerBot(Request $request)
    {
        $data           = $request->all();
        $isFeedBackOnly = $this->message->isFeedBackReadDelivery($data);

        if (!$isFeedBackOnly)
        {
            $facebook_id = $this->message->getFacebookID($data);
            $msgType     = $this->message->getMessageType($data);

            // get detail user
            $user = $this->userRepo->findUserByFacebookID($facebook_id);
            if (!$user)
            {
                $user = $this->userRepo->getDetailMember($facebook_id);
                if (is_null($user))
                {
                    return response()->json(['message' => 'error']);
                }
            }
            $bot = new MessengerRepository($user->facebook_id);

            $message = $this->message->getMessage($data);
            if (!$message)
            {
                return $bot->responseMessage([$this->template->sendText("Sorry, your message is empty or not supported")]);
            }

            // create log
            $this->activity->createActivity($user->id, $msgType, $message);

            // check handling request form users
            $sender_message = $this->request_repository->handlingRequest($facebook_id, $message);
            if (!empty($sender_message))
            {
                // get message
                $response_message = $sender_message['message'];

                // check status
                if ($sender_message['status'] != 1)
                {
                    // send message to messenger
                    $return_response = $bot->sendTextMessage($response_message);
                }
                else
                {
                    // send message to messenger
                    $return_response = $bot->sendDataFlights($response_message, $user);
                }

                // return message
                return $bot->responseMessage([$this->template->sendText($response_message)]);
            }


            /*
             * Flight Reminder Logic
             */
            $priceReminderRepo    = new FlightReminderRepository();
            $hasNonFinishedFlight = $priceReminderRepo->findNotFinishedByUser($user->id);
            $priceReminder = new PriceReminderService($user, $message, $msgType, $hasNonFinishedFlight);
            if ($hasNonFinishedFlight OR $this->message->stringContain($message, "price reminder") or $this->message->stringContain($message, "price_reminder"))
            {
                $priceReminderResponse = $priceReminder->start();

                if (!empty($priceReminderResponse))
                {
                    return $bot->responseMessage($priceReminderResponse);
                }
            }


            /*
             * Check In Logic
             */
            $checkInRepo            = new CheckInRepository();
            $hasNonFinishedCheckIn  = $checkInRepo->findNotFinishedByUser($user->id);
            if ($hasNonFinishedCheckIn OR $this->message->stringContain($message, "check in"))
            {
                $checkIn        = new CheckInService($user, $message, $msgType, $hasNonFinishedCheckIn);
                $response       = $checkIn->start();
                if($checkIn){
                    return $bot->responseMessage($response);
                }
            }

            // default
            return $bot->responseMessage([$this->template->sendText($message)]);
        }
        else
        {
            return response()->json(['message' => 'error']);
        }
    }
}
