<?php
namespace App\Http\Controllers\Api;

use App\Bot\Repository\MessengerRepository;
use App\Bot\Repository\TemplateService;
use App\Bot\Services\Word\WordService;
use App\FlightPriceReminder\FlightReminderRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CronController extends Controller {
    protected $price, $word, $template;
    public function __construct(Request $request) {
        parent::__construct($request);

        $this->price    = new FlightReminderRepository();
        $this->word     = new WordService();
        $this->template = new TemplateService();
    }

    public function priceReminder(){
        $flights    = $this->price->getReadyAll();
        $results    = false;

        if($flights AND $flights->count() > 0){
            // check to airlines, dummy for now
            $newFlights = $this->price->airlinesCheckPrice($flights);

            // start notify to user
            $results    = $this->_startBroadCast($newFlights);
        }


        return response()->json([
            'status'   => $results
        ]);
    }

    private function _startBroadCast($flights){
        foreach ($flights as $flight){
            $bot    = new MessengerRepository($flight->user->facebook_id);
            /*$amountFound    = $flight->amount_found;
            $airline        = $flight->airline;
            $flightTime     = $flight->flight_time;*/

            $askGenericNew  = $this->word->askFoundPriceReminderGeneric($flight->id);


            $bot->responseMessage([
                $this->template->sendGeneric($askGenericNew)
            ]);

            return true;
        }

        return false;
    }
}