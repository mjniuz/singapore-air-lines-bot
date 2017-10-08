<?php namespace App\Http\Controllers\Api;

use App\Bot\Repository\RequestRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LineController extends Controller
{

    /**
     * this function for first call function if call another function
     *
     * @param \Illuminate\Http\Request $request The request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        // this repository for handling request
        $this->request_repository = new RequestRepository();
    }

    /**
     * this function for verify token begore hit
     *
     * @param  \Illuminate\Http\Request $request The request
     * @return string
     */
    public function verifyToken(Request $request)
    {
        return "OK";
    }

    /**
     * this function for get data from facebook
     *
     * @param  \Illuminate\Http\Request   $request The request
     * @return \Illuminate\Http\Request
     */
    public function lineBot(Request $request)
    {
        $data = $request->all();
        if (isset($data['events'][0]['replyToken']))
        {
            foreach ($data['events'] as $key => $value)
            {
                $id              = $value['replyToken'];
                $sender_message  = isset($value['message']['text']) ? $value['message']['text'] : null;
                $return_response = null;
                $message         = null;

                // check if sender messege if not empty
                if (!empty($sender_message))
                {
                    $message = $this->request_repository->handlingRequest($sender_message, $id);
                    if (empty($message))
                    {
                        $message = $this->request_repository->handlingErrorFormat();
                    }
                    $return_response = "berhasil";
                }

                // return messege
                return response()->json(['message' => $message, 'response' => $return_response], 200);
            }
        }
        else
        {
            abort(404);
        }
    }
}
