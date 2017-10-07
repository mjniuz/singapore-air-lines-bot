<?php namespace App\Http\Controllers\Frontend;

use App\CheckIn\CheckInInjectService;
use App\CheckIn\CheckInRepository;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    protected $checkIn;
    public function __construct(Request $request) {
        parent::__construct($request);

        $this->checkIn  = new CheckInRepository();
    }

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

    public function checkInIndex($token = "", Request $request){
        $checkIn    = $this->checkIn->findByToken($token);
        if(!$checkIn){
            return redirect(url(''));
        }
        $seats  = $this->checkIn->generateDummySeat(json_decode($checkIn->seats));

        return view('frontend.site.check-in', compact('checkIn','seats'));
    }

    public function checkInSave($token = "", Request $request){
        $seats      = $request->get('seats');
        $checkIn    = $this->checkIn->updateSeat($token, $seats);
        if(!$checkIn){
            return redirect(url(''));
        }

        //success inject to messanger
        $check      = $this->checkIn->findByToken($token);

        $inject = new CheckInInjectService();
        $inject->sendBoardingPass($check->user, $check->id);
        $request->session()->flash('message', 'Check In Success, please check your messenger to see the boarding pass detail');

        return redirect(url('check-in/' . $checkIn->token));
    }
}
