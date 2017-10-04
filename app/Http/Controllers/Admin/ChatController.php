<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChatRequest;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * this function for get all data chat
     * @param  Request $request
     * @return array
     */
    public function index(Request $request)
    {
        $chats = Chat::orderBy('id', 'desc')->paginate();

        return view('admin.chat.index', compact('chats'));
    }

    /**
     * this function for return data to form in view
     *
     * @param  \Illuminate\Http\Request $request The request
     * @param  string                   $id      The identifier
     * @return object
     */
    public function form(Request $request, $id = '')
    {
        $chat = null;
        if (!empty($id))
        {
            $chat = Chat::find($id);

            if (empty($chat))
            {
                abort(404);
            }
        }
        return view('admin.chat.form', compact('chat'));
    }

    /**
     * this function for create or update data brand
     *
     * @param  \App\Webapp\Requests\BrandRequest $request The request
     * @param  string                            $id      The identifier
     * @return object
     */
    public function store(ChatRequest $request, $id = '')
    {
        $format_chat = $request->input('format_chat');
        $explode     = explode('_', $format_chat);
        $count_chat  = count($explode);

        $data = [
            'format_chat'  => $format_chat,
            'example_chat' => $request->input('example_chat'),
            'count_chat'   => $count_chat,
        ];

        // get data chat
        $chat = Chat::find($id);

        if (empty($chat) && $id != '')
        {
            return redirect()->back();
        }

        // create and update data
        if ($id == '' || empty($id))
        {
            Chat::create($data);
        }
        else
        {
            Chat::firstOrCreate(['id' => $id])
                ->update($data);
        }

        return redirect()->route('admin.chats')->with('success', 'Success save chat');
    }
}
