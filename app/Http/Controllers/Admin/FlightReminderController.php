<?php namespace App\Http\Controllers\Admin;

use App\Bot\Repository\PriceRepository;
use App\FlightPriceReminder\FlightReminder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FlightReminderController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->price_repository = new PriceRepository();
    }

    public function index(Request $request)
    {
        $flights = FlightReminder::orderBy('id', 'desc')->paginate();

        return view('admin.flightreminder.index', compact('flights'));
    }

    public function store(Request $request)
    {
        $results = $this->price_repository->priceReminder();

        return redirect()->route('admin.flightreminders')->with('success', 'Success Reminder');
    }
}
