<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Chat;
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
}
