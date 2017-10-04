<?php
namespace App\FlightPriceReminder;

use function GuzzleHttp\Psr7\str;

class FlightReminderRepository{

    public function findNotFinishedByUser($userID = null){
        return FlightReminder::with(['user'])
            ->where('user_id', $userID)
            ->whereNull('ready_at')
            ->first();
    }

    public function getReadyAll(){
        return FlightReminder::with(['user'])
            ->whereNotNull('ready_at')
            ->whereNull('found_at')
            ->where('date_flight', '>', date("Y-m-d"))
            ->get();
    }

    public function find($id = null){
        return FlightReminder::with([])
            ->where('id', $id)
            ->first();
    }

    public function findDetail($id = null){
        return FlightReminder::with(['user'])
            ->where('id', $id)
            ->first();
    }

    public function insert($userID = null){
        $flight = new FlightReminder();
        $flight->user_id    = $userID;
        $flight->from       = "";
        $flight->to         = "";
        $flight->amount     = 0;
        $flight->airline    = "";
        $flight->date_flight    = null;
        $flight->save();

        return $flight;
    }

    public function updateDeparture($flightID = null, $departure = ""){
        $flight     = $this->find($flightID);
        $flight->from   = $departure;
        $flight->save();

        return $flight;
    }

    public function updateDestination($flightID = null, $destination = ""){
        $flight     = $this->find($flightID);
        $flight->to = $destination;
        $flight->save();

        return $flight;
    }

    public function updateDate($flightID = null, $date = ""){
        $flight                 = $this->find($flightID);
        $flight->date_flight    = date("Y-m-d", strtotime($date));
        $flight->save();

        return $flight;
    }

    public function updateAmount($flightID = null, $amount = 0){
        $flight             = $this->find($flightID);
        $flight->amount     = (float)$amount;
        $flight->save();

        return $flight;
    }

    public function updateReadyAt($flightID = null){
        $flight             = $this->find($flightID);
        $flight->ready_at   = date("Y-m-d H:i:s");
        $flight->save();

        return $flight;
    }

    public function deleteFlight($flightID = null){
        $flight             = $this->find($flightID);
        $flight->delete();

        return $flight;
    }

    public function updateFound($flightID = null, $amountFound, $airline, $flightTime){
        $flight             = $this->find($flightID);
        $flight->found_at   = date("Y-m-d H:i:s");
        $flight->amount_found   = $amountFound;
        $flight->airline        = $airline;
        $flight->flight_time    = $flightTime;
        $flight->save();

        return $flight;
    }

    public function airlinesCheckPrice($flights){
        $newFlights = [];
        foreach ($flights as $flight){
            // at least in second attempt, for fake only
            if($flight->cron_count > 1){
                $amountFound    = $this->getCostEstimation($flight);

                // update successful
                $flightTime     = date("Y-m-d", strtotime($flight->date_flight)) . " " . date("H:i:s");

                $newFlight      = $this->updateFound($flight->id, $amountFound, 'singapore airlines', $flightTime);
                $flight->amount_found   = $newFlight->amount_found;
                $flight->airline        = $newFlight->airline;
                $flight->flight_time    = $newFlight->flight_time;

                $newFlights[]   = $flight;
            }
        }

        return $newFlights;
    }

    private function getCostEstimation($flight){
        $costMin    = 20; // SGD

        if($flight->amount < $costMin){
            return false;
        }

        $random         = rand(1,10);
        $amountFound   = $flight->amount - $random;

        return $amountFound;
    }
}