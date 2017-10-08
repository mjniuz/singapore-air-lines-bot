<?php namespace App\Http\Controllers\Frontend;

use App\Bot\Repository\FlightRepository;
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
            $price      = $request->get('price');

            $flightRepo = new FlightRepository();
            $flights    = $flightRepo->randomData($price);
        }

        return view('frontend.site.flights', compact('flights'));
    }
}
