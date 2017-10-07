<?php namespace App\CheckIn;

class CheckInRepository
{

    public function findNotFinishedByUser($userID = null)
    {
        return CheckIn::with(['user'])
            ->where('user_id', $userID)
            ->whereNull('ready_at')
            ->first();
    }

    public function updateBookingNumber($checkID = null, $bookNum = "")
    {
        $check                 = $this->find($checkID);
        $check->booking_number = $bookNum;
        $check->save();

        return $check;
    }

    public function updateLastName($checkID = null, $lastName = "")
    {
        $check            = $this->find($checkID);
        $check->last_name = $lastName;
        $check->save();

        return $check;
    }

    public function find($id = null)
    {
        return CheckIn::with([])
            ->where('id', $id)
            ->first();
    }

    public function findByToken($token = "")
    {
        return CheckIn::with(['user'])
            ->where('token', $token)
            ->first();
    }

    public function updateSeat($token = "", $seat = "")
    {
        $check        = $this->findByToken($token);
        $check->seats = json_encode([$seat]);
        $check->save();

        return $check;
    }

    public function findDetail($id = null)
    {
        return CheckIn::with(['user'])
            ->where('id', $id)
            ->first();
    }

    public function insertNew($userID = null)
    {
        $checkIn          = new CheckIn();
        $checkIn->user_id = $userID;
        $checkIn->save();

        return $checkIn;
    }

    public function updateReadyAt($userID = null)
    {
        $checkIn           = $this->find($userID);
        $checkIn->ready_at = date("Y-m-d H:i:s");
        $checkIn->save();

        return $checkIn;
    }

    public function delete($checkID = null)
    {
        $checkIn = $this->find($checkID);
        $checkIn->delete();

        return $checkIn;
    }

    public function updateFinal($checkInID = null)
    {
        $check        = $this->find($checkInID);
        $flightNumber = $this->findFlightNumberToday($check->ready_at);

        $check->token      = md5($checkInID . $check->last_name);
        $check->is_valid   = 1;
        $check->pnr_number = "SG" . rand(100, 999);

        $check->flight_number          = ($flightNumber and $flightNumber->flight_number != "") ? $flightNumber->flight_number : ("SQ" . rand(100, 999));
        $check->departure_airport_code = "CGK";
        $check->departure_city         = "Jakarta";
        $check->departure_terminal     = "T3";
        $check->departure_gate         = "G6";

        $check->arrival_airport_code = "SIN";
        $check->arrival_city         = "Singapore";
        $check->arrival_terminal     = "T1";
        $check->arrival_gate         = "G1";

        $check->flight_schedule_boarding  = date("Y-m-d H:i:s", strtotime("+1 day"));
        $check->flight_schedule_departure = date("Y-m-d H:i:s", strtotime("+1 day +40 minutes"));
        $check->flight_schedule_arrival   = date("Y-m-d H:i:s", strtotime("+1 day +1 hour +30 minutes"));
        $check->save();

        return $check;
    }

    public function findRandom()
    {
        return CheckIn::with([])
            ->whereNotNull('ready_at')
            ->where('is_valid', 1)
            ->where('seats', '<>', '')
            ->first();
    }

    public function findFlightNumberToday($date = "")
    {
        return CheckIn::with([])
            ->where("ready_at", '>', date("Y-m-d 00:00:00", strtotime($date)))
            ->where("ready_at", '<', date("Y-m-d 23:59:59", strtotime($date)))
            ->first();
    }

    public function generateDummySeat($seats = [])
    {
        $arr = [];
        for ($i = 0; $i < 10; $i++)
        {
            $row = [];
            for ($a = 0; $a < 6; $a++)
            {
                $id    = ($i + 1) . $this->getChar($a);
                $row[] = [
                    "id"          => $id,
                    "is_disabled" => $this->randomTrueFalse($id, $seats),
                ];
            }
            $arr[]['numbers'] = $row;
        }

        return json_decode(json_encode($arr));
    }

    private function randomTrueFalse($id, $seats, $percentage = 75)
    {
        if (!is_null($seats) and in_array(strtolower($id), $seats))
        {
            return true;
        }

        $p = rand(0, 99);
        if ($p < $percentage)
        {
            return false;
        }

        return true;
    }

    private function getChar($num)
    {
        switch ($num)
        {
            case 0:
                return "A";
            case 1:
                return "B";
            case 2:
                return "C";
            case 3:
                return "D";
            case 4:
                return "E";
            case 5:
                return "F";
            default:
                return "G";
        }
    }
}
