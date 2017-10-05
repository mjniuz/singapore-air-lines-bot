<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * this function for get all data chat
     * @param  Request $request
     * @return array
     */
    public function index(Request $request)
    {
        $chats = Chat::orderBy('id', 'desc')->get();

        return view('frontend.site.index', compact('chats'));
    }

    /**
     * this function for get all data chat
     * @param  Request $request
     * @return array
     */
    public function formatChat(Request $request)
    {
        $chats = Chat::orderBy('id', 'desc')->get();

        return view('frontend.site.formatchat', compact('chats'));
    }

    /**
     * this function for get promotions data
     * @param  Request  $request
     * @param  string   $slug
     * @return object
     */
    public function promotion(Request $request, $slug = '')
    {
        // get now
        $now = Carbon::now();

        // get data promotions
        $promotion = Promotion::where('slug', 'LIKE', '%' . $slug . '%')->where('expired_at', '>', $now->toDateString())->first();

        // check if empty data promotion
        if (empty($promotion))
        {
            abort(404);
        }

        return view('frontend.site.promotion', compact('promotion'));
    }
}
