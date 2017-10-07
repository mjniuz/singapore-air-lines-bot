<?php namespace App\Http\Controllers\Api;

use App\Bot\Repository\TemplateService;
use App\Bot\Services\Word\WordService;
use App\FlightPriceReminder\FlightReminderRepository;
use App\Http\Controllers\Controller;
use App\Message\MessageService;
use Illuminate\Http\Request;

class CronController extends Controller
{
    protected $price, $word, $template, $message;
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->price    = new FlightReminderRepository();
        $this->word     = new WordService();
        $this->template = new TemplateService();
        $this->message  = new MessageService();
    }

    public function priceReminder()
    {
        $flights = $this->price->getReadyAll();
        $results = false;

        if($flights AND $flights->count() > 0){
            // check to airlines, dummy for now
            $newFlights = $this->price->airlinesCheckPrice($flights);

            // start notify to user
            $results = $this->message->startCast($newFlights);
        }

        return response()->json([
            'status' => $results,
        ]);
    }
}
