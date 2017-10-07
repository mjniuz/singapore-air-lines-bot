<?php namespace App\Bot\Repository;

use App\Bot\Repository\TemplateService;
use App\Bot\Services\Bot\Bot;
use App\Bot\Services\Word\WordService;
use App\FlightPriceReminder\FlightReminderRepository;
use App\Message\MessageService;

class PriceRepository
{
    protected $price, $word, $template, $message;

    public function __construct()
    {
        $this->price    = new FlightReminderRepository();
        $this->word     = new WordService();
        $this->template = new TemplateService();
        $this->message  = new MessageService();
    }

    public function priceReminder()
    {
        $flights = $this->price->getReadyAll();
        $results = false;

        if ($flights and $flights->count() > 0)
        {
            // check to airlines, dummy for now
            $newFlights = $this->price->airlinesCheckPrice($flights);

            // start notify to user
            $results = $this->message->startCast($newFlights);
        }
        return $results;
    }
}
