<?php namespace App\Http\Controllers\Admin;

use App\Bot\Repository\MessengerRepository;
use App\Bot\Repository\TelegramRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PromotionRequest;
use App\Models\Promotion;
use App\Models\User;
use Config;
use Illuminate\Http\Request;
use Storage;

class PromotionController extends Controller
{
    /**
     * this function for get all data promotion and return to view
     * @param  Request $request
     * @return array
     */
    public function index(Request $request)
    {
        // set request data
        $searchtitle     = $request->input('searchtitle');
        $searchstartat   = $request->input('searchstartat');
        $searchexpiredat = $request->input('searchexpiredat');
        $promotions      = Promotion::orderBy('id', 'desc');

        // check title
        if (!empty($searchtitle))
        {
            $promotions = $promotions->where('title', 'LIKE', '%' . $searchtitle . '%');
        }

        // check start at
        if (!empty($searchstartat))
        {
            $promotions = $promotions->where('start_at', '>', $searchstartat . ' 00:00:00');
        }

        // check expired at
        if (!empty($searchexpiredat))
        {
            $promotions = $promotions->where('expired_at', '<', $searchexpiredat . ' 23:59:59');
        }

        // set paginations
        $promotions = $promotions->paginate();

        return view('admin.promotion.index', compact('promotions'));
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
        $promotion = null;
        if (!empty($id))
        {
            $promotion = Promotion::find($id);

            if (empty($promotion))
            {
                abort(404);
            }
        }
        return view('admin.promotion.form', compact('promotion'));
    }

    /**
     * this function for create or update data brand
     *
     * @param  \App\Webapp\Requests\BrandRequest $request The request
     * @param  string                            $id      The identifier
     * @return object
     */
    public function store(PromotionRequest $request, $id = '')
    {
        $data = [
            'title'       => $request->input('title'),
            'description' => $request->input('description'),
            'start_at'    => $request->input('start_at'),
            'expired_at'  => $request->input('expired_at'),
        ];

        // get data promotion
        $promotion = Promotion::find($id);

        if (empty($promotion) && $id != '')
        {
            return redirect()->back();
        }

        // check data image
        if ($request->hasFile('image'))
        {
            $file     = $request->file('image');
            $fileName = str_random(24) . '.' . $file->getClientOriginalExtension();
            Storage::put(Config::get('path.promotion') . $fileName, file_get_contents($file->getRealPath()), 'public');
            $data['image'] = $fileName;

            // check data if id not empty
            if ($id != '')
            {
                Storage::delete(Config::get('path.promotion') . $promotion->image);
            }
        }
        // create and update data
        if ($id == '' || empty($id))
        {
            $promotion = Promotion::create($data);
        }
        else
        {
            Promotion::firstOrNew(['id' => $id])
                ->update($data);
            $promotion = Promotion::find($id);
        }

        // get all data users
        $users = User::orderBy('id', 'desc')->get();

        // check users is not empty
        if (!empty($users))
        {
            // looping data users
            foreach ($users as $key => $user)
            {
                // check facebook id is not empty
                if (!empty($user->facebook_id))
                {
                    $type = $request->input('type');
                    $bot  = new MessengerRepository($user->facebook_id);

                    // send message to messenger
                    if ($type != 1)
                    {
                        $return_response = $bot->sendTextMessage($promotion->title . " " . route('frontend.promotion', $promotion->slug));
                    }
                    else
                    {
                        $return_response = $bot->sendImageMessage($promotion->image_file);
                        $params          = [
                            'title'   => $promotion->title,
                            'buttons' => [
                                [
                                    'type'  => 'url',
                                    'data'  => route('frontend.promotion', $promotion->slug),
                                    'label' => 'Click Here!!!',
                                ],
                            ],
                        ];
                        $return_response = $bot->sendButtonMessage($params);
                    }
                }

                // check telegram id is not empty
                if (!empty($user->telegram_id))
                {
                    $telegram_bot    = new TelegramRepository;
                    $return_response = $telegram_bot->sendTextMessage($user->telegram_id, $promotion->title . " " . route('frontend.promotion', $promotion->slug));

                }
            }
        }

        return redirect()->route('admin.promotions')->with('success', 'Success save promotion');
    }

    /**
     * this function for delete data base on id
     *
     * @param  \Illuminate\Http\Request $request The request
     * @param  string                   $id      The identifier
     * @return object                   \
     */
    public function delete(Request $request, $id = '')
    {
        // find promotion
        $promotion = Promotion::find($id);
        // if promotion empty redirect promotion
        if (empty($promotion))
        {
            return redirect()->back();
        }
        // check if promotion image is not empty
        if ($promotion->image != '')
        {
            if (Storage::exists($promotion->image))
            {
                Storage::delete($promotion->image);
            }
        }
        // promotion delete
        $promotion->delete();
        // return back
        return redirect()->back()->with('success', 'Success delete promotion');
    }
}
