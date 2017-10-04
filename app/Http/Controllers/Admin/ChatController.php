<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $chats = Chat::orderBy('id', 'desc')->paginate();

        return view('admin.chat.index', compact('chats'));
    }
}
