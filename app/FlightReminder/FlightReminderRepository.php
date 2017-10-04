<?php
namespace App\FlightPriceReminder;

class FlightReminderRepository{

    public function findNotFinishedByUser($userID = null){
        return FlightReminder::with(['user'])
            ->where('user_id', $userID)
            ->whereNull('ready_at')
            ->first();
    }

    public function find($id = null){
        return FlightReminder::with([])
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

}