<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CheckFlight;
use Illuminate\Http\Request;

class CheckFlightController extends Controller
{
    /**
     * this function for get all data check flight
     * @param  Request $request
     * @return array
     */
    public function index(Request $request)
    {
        // set request data
        $searchlocationfrom = $request->input('searchlocationfrom');
        $searchlocationto   = $request->input('searchlocationto');
        $searchdate         = $request->input('searchdate');
        $checkflights       = CheckFlight::orderBy('id', 'desc');

        // check location from
        if (!empty($searchlocationfrom))
        {
            $checkflights = $checkflights->where('from_location', 'LIKE', '%' . $searchlocationfrom . '%');
        }

        // check location to
        if (!empty($searchlocationto))
        {
            $checkflights = $checkflights->where('to_location', 'LIKE', '%' . $searchlocationto . '%');
        }

        // check date
        if (!empty($searchdate))
        {
            $checkflights = $checkflights->where('date', 'LIKE', '%' . $searchdate . '%');
        }

        $checkflights = $checkflights->paginate();

        return view('admin.checkflight.index', compact('checkflights'));
    }
}
