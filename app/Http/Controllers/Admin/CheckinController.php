<?php namespace App\Http\Controllers\Admin;

use App\CheckIn\CheckIn;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckinController extends Controller
{
    public function index(Request $request)
    {
        // $checkins = CheckIn::orderBy('flight_number', 'desc')->groupBy('flight_number')->paginate();
        $checkins = CheckIn::orderBy('flight_number', 'desc')->paginate();

        return view('admin.checkin.index', compact('checkins'));
    }
}
