<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PromotionRequest;
use App\Models\Promotion;
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
        $promotions = Promotion::orderBy('id', 'desc')->paginate();

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
                $image_storage->deleteImage($promotion, 'promotion');
            }
        }
        // create and update data
        if ($id == '' || empty($id))
        {
            Promotion::create($data);
        }
        else
        {
            Promotion::firstOrCreate(['id' => $id])
                ->update($data);
        }

        return redirect()->route('admin.promotions')->with('success', 'Success save promotion');
    }
}
