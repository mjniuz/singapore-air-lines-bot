<?php namespace App\Http\Controllers\Api;

use App\Bot\Repository\MessengerRepository;
use App\Bot\Repository\RequestRepository;
use App\Bot\Repository\TemplateService;
use App\Bot\Repository\UserRepository;
use App\FlightPriceReminder\PriceReminderService;
use App\Http\Controllers\Api\ApiController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessengerController extends ApiController
{
    /**
     * this function for first call function if call another function
     *
     * @param \Illuminate\Http\Request $request The request
     */
    protected $request_repository, $userRepo, $template;
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // this repository for handling request
        $this->request_repository   = new RequestRepository();
        $this->userRepo             = new UserRepository();
        $this->template             = new TemplateService();
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
        $facebook_id    = $this->getFacebookID($data);
        $isFeedBackOnly = $this->isFeedBackReadDelivery($data);

        if ($facebook_id AND !$isFeedBackOnly) {
            $msgType        = $this->getMessageType($data);

            // get detail user
            $user   = $this->userRepo->findUserByFacebookID($facebook_id);
            if(!$user){
                $user   = $this->userRepo->getDetailMember($facebook_id);
                if(is_null($user)){
                    return response()->json([
                        'message'   => 'error'
                    ]);
                }
            }
            $bot    = new MessengerRepository($user->facebook_id);

            $message        = $this->getMessage($data);
            if(!$message){
                return $bot->responseMessage([
                    $this->template->sendText("Sorry, your message is empty or not supported")
                ]);
            }

            // create log
            $this->userRepo->createActivity($user->id,$msgType, $message);

            $priceReminder          = new PriceReminderService($user, $message, $msgType);
            $priceReminderResponse  = $priceReminder->start();
            if(!empty($priceReminderResponse)){
                return $bot->responseMessage($priceReminderResponse);
            }

            // default
            return $bot->responseMessage([
                $this->template->sendText($message)
            ]);
        }
        else
        {
            return response()->json([
                'message'   => 'error'
            ]);
        }
    }

    private function getFacebookID($data){
        $facebookID = $data['entry'][0]['messaging'][0]['sender']['id'];

        // only echo
        if($facebookID == env('FACEBOOK_PAGE_USER_ID')){
            return false;
        }

        return $facebookID;
    }

    private function isFeedBackReadDelivery($data){
        // is event read
        $messaging  = !empty($data['entry'][0]['messaging']) ? $data['entry'][0]['messaging'][0] : false;

        if(!$messaging OR !empty($messaging['read']) OR !empty($messaging['delivery'])){
            return true;
        }

        return false;
    }

    private function getMessage($data){
        if($this->getMessageType($data) == 'text'){
            return $data['entry'][0]['messaging'][0]['message']['text'];
        }

        if($this->getMessageType($data) == 'postback'){
            return $data['entry'][0]['messaging'][0]['postback']['payload'];
        }

        return false;
    }

    private function getMessageType(array $data = []){
        if($this->isFeedBackReadDelivery($data) == true){
            return false;
        }

        $messaging  = $data['entry'][0]['messaging'][0];
        if(!empty($messaging['message'])){
            if(!empty($messaging['message']['text'])){
                return 'text';
            }
        }

        if(!empty($messaging['postback'])){
            return 'postback';
        }

        if(!empty($messaging['message']['attachments'])){
            return $messaging['message']['attachments'][0]['type'];
        }

        return false;
    }
}
