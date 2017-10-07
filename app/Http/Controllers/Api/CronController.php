<?php namespace App\Http\Controllers\Api;

use App\Bot\Repository\PriceRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CronController extends Controller
{
    protected $price_repository;
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->price_repository = new PriceRepository();
    }

    public function priceReminder()
    {
        $results = $this->price_repository->priceReminder();

        return response()->json([
            'status' => $results,
        ]);
    }
}
