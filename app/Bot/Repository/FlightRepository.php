<?php namespace App\Bot\Repository;

use App\Bot\Helper\Helper;

class FlightRepository extends Repository
{
    public function randomData($price = 0)
    {
        /*
         "id" => 10
          "from_location" => "jakarta"
          "from_code" => "CGK"
          "from_airport" => "Soekarno–Hatta International Airport"
          "to_location" => "Singapore"
          "to_code" => "SIN"
          "to_airport" => "Changi Airport"
          "date" => "2017-10-13 20:00:00"
          "amount_found" => 440000
          "travel_time" => 290
          "created_at" => null
          "updated_at" => null
         */
        if ($price == 0)
        {
            $price = 100;
        }
        $data = [];
        for ($i = 1; $i < 6; $i++)
        {
            if ($i != 1)
            {
                $price = ($price + $i + rand(1, 10));
            }
            $data[] = [
                "id"                => $i,
                "from_location"     => "Jakarta",
                "from_code"         => "CGK",
                "from_airport"      => "Soekarno–Hatta International Airport",
                "to_location"       => "Singapore",
                "to_code"           => "SIN",
                "to_airport"        => "Changi Airport",
                "amount_found"      => $price,
                "only_time"         => date("H:i", strtotime("+" . $i . " hours")),
                "only_time_arrival" => date("H:i", strtotime("+" . ($i + 1) . " hours")),
                "convert_time"      => "01 Hours",
                "image_logo"        => Helper::randomLinkAirlines(),
            ];
        }

        return json_decode(json_encode($data));
    }
    public function randomDataMessage($date = "")
    {
        /*
         "id" => 10
          "from_location" => "jakarta"
          "from_code" => "CGK"
          "from_airport" => "Soekarno–Hatta International Airport"
          "to_location" => "Singapore"
          "to_code" => "SIN"
          "to_airport" => "Changi Airport"
          "date" => "2017-10-13 20:00:00"
          "amount_found" => 440000
          "travel_time" => 290
          "created_at" => null
          "updated_at" => null
         */

        $price = 100;
        $data  = [];
        for ($i = 1; $i < 4; $i++)
        {
            if ($i != 1)
            {
                $price = ($price + $i + rand(1, 10));
            }
            $data[] = [
                "id"                => $i,
                "from_location"     => "Jakarta",
                "from_code"         => "CGK",
                "from_airport"      => "Soekarno–Hatta International Airport",
                "to_location"       => "Singapore",
                "to_code"           => "SIN",
                "to_airport"        => "Changi Airport",
                "amount_found"      => $price,
                "only_date"         => $date,
                "only_time"         => date("H:i", strtotime("+" . $i . " hours")),
                "only_time_arrival" => date("H:i", strtotime("+" . ($i + 1) . " hours")),
                "date"              => ($date . " " . date("H:i:s", strtotime("+" . $i . " hours"))),
                "travel_time"       => date("H:i", strtotime("+" . $i . " hours")),
                "convert_time"      => "01 Hours",
            ];
        }

        return $data;
    }
}
