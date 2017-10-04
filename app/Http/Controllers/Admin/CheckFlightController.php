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
        $checkflights = CheckFlight::orderBy('id', 'desc')->paginate();

        return view('admin.checkflight.index', compact('checkflights'));
    }
}
