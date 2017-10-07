<?php namespace App\Http\Controllers\Admin;

use App\Activity\ActivityRepository;
use App\Bot\Repository\MessengerRepository;
use App\Bot\Repository\RequestRepository;
use App\Bot\Repository\TemplateService;
use App\Bot\Repository\UserRepository;
use App\Bot\Services\Word\WordService;
use App\CheckIn\CheckIn;
use App\CheckIn\CheckInRepository;
use App\Http\Controllers\Controller;
use App\Message\MessageService;
use App\Models\User;
use Illuminate\Http\Request;

class CheckinController extends Controller
{

    protected $request_repository, $userRepo, $template, $activity, $message;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        // this repository for handling request
        $this->request_repository = new RequestRepository();
        $this->userRepo           = new UserRepository();
        $this->template           = new TemplateService();
        $this->activity           = new ActivityRepository();
        $this->message            = new MessageService();
    }

    public function index(Request $request)
    {
        $checkins = CheckIn::orderBy('flight_number', 'desc')->paginate();

        return view('admin.checkin.index', compact('checkins'));
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
        $checkins = CheckIn::orderBy('flight_number', 'desc')->groupBy('flight_number')->pluck('flight_number', 'id');
        $checkin  = null;
        if (!empty($id))
        {
            $checkin = CheckIn::find($id);
            if (empty($checkin))
            {
                abort(404);
            }
        }
        return view('admin.checkin.form', compact('checkin', 'checkins'));
    }

    public function store(Request $request)
    {
        $users = User::where('facebook_id', '!=', null)->get();

        if (!empty($users))
        {
            foreach ($users as $key => $user)
            {
                $bot  = new MessengerRepository($user->facebook_id);
                $word = new WordService();
                if ($this->message->stringContain("sample_delay", "sample_delay"))
                {
                    $check            = new CheckInRepository();
                    $checkIn          = CheckIn::with('user')->where('id', $request->input('blash'))->first();
                    $airlineUpdate    = $word->airlineUpdateDelay($checkIn);
                    $dataDelayExample = [
                        $this->template->sendAirlineUpdate($airlineUpdate),
                    ];

                    $bot->responseMessage($dataDelayExample);
                }
            }
        }

        return redirect()->route('admin.checkins')->with('success', 'Success Save');
    }
}
