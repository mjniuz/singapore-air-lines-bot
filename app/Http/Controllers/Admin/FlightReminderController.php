<?php namespace App\Http\Controllers\Admin;

use App\FlightPriceReminder\FlightReminder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FlightReminderController extends Controller
{
    public function index(Request $request)
    {
        $flights = FlightReminder::orderBy('id', 'desc')->paginate();

        return view('admin.flightreminder.index', compact('flights'));
    }
}
