<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index(Request $request)
    {
        $promotions = Promotion::orderBy('id', 'desc')->paginate();

        return view('admin.promotion.index', compact('promotions'));
    }
}
