<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function searchFlights(Request $request)
    {
        // set request data
        $searchlocationfrom = $request->input('searchlocationfrom');
        $searchlocationto   = $request->input('searchlocationto');
        $searchdate         = $request->input('searchdate');
        $flights            = Flight::orderBy('id', 'desc');

        // check location from
        if (!empty($searchlocationfrom))
        {
            $flights = $flights->where('from_location', 'LIKE', '%' . $searchlocationfrom . '%');
        }

        // check location to
        if (!empty($searchlocationto))
        {
            $flights = $flights->where('to_location', 'LIKE', '%' . $searchlocationto . '%');
        }

        // check date
        if (!empty($searchdate))
        {
            $flights = $flights->where('date', 'LIKE', '%' . $searchdate . '%');
        }

        $flights = $flights->paginate();
        //dd($flights);

        if($flights->count() == 0){
            $price  = $request->get('price');
            $flights    = $this->randomData($price);
        }

        return view('frontend.site.flights', compact('flights'));
    }

    private function randomData($price = 0){
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
        if($price == 0){
            $price  = 100;
        }
        $data   = [];
        for($i = 1; $i < 6; $i++){
            if($i != 1){
                $price  = ($price + $i + rand(1,10));
            }
            $data[] =   [
                "id"    => $i,
                "from_location" => "Jakarta",
                "from_code"     => "CGK",
                "from_airport"  => "Soekarno–Hatta International Airport",
                "to_location"   => "Singapore",
                "to_code"       => "SIN",
                "to_airport"    => "Changi Airport",
                "amount_found"  => $price,
                "only_time"     => date("H:i", strtotime("+" . $i . " hours")),
                "only_time_arrival" => date("H:i", strtotime("+" . ($i + 1) . " hours")),
                "convert_time"  => "01 Hours"
            ];
        }

        return json_decode(json_encode($data));
    }
}
