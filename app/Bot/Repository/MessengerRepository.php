<?php namespace App\Bot\Repository;

use App\Bot\Services\Bot\Bot;
use App\Models\User;
use App\Models\Activity;

class MessengerRepository extends Repository
{

    /**
     * this function for first call function if call another function
     *
     * @param \Illuminate\Http\Request $request The request
     */
    protected $bot, $activity;
    public function __construct()
    {
        // repository messenger for handle process data
        $this->bot = new Bot;
        $this->activity = new Activity();
    }

    /**
     * this function for hit api facebook for chatbot
     *
     * @param integer $id      The identifier
     * @param string  $message The message
     */
    public function sendTextMessage($id, $message)
    {
        $params = [
            'recipient' => [
                'id' => $id,
            ],
            'message'   => [
                'text' => $message,
            ],
        ];
        // return data
        return $this->bot->getFacebookReplyMessege($params);
    }

    /**
     * this function for save member facebook id
     * @param  integer  $facebook_id
     * @return object
     */
    public function getDetailMember($facebook_id)
    {
        // hit api facebok for get detail user
        $get_facebook_detail = $this->bot->getUserFacebookDetail($facebook_id);
        // check http code
        if ($get_facebook_detail['http_code'] == 200)
        {
            // saving data user
            $data                  = $get_facebook_detail['message'];
            $name                  = $data->first_name . ' ' . $data->last_name;
            $username              = str_slug($name);
            $user                  = User::firstOrNew(['username' => $username, 'facebook_id' => $facebook_id]);
            $user->username        = $username;
            $user->full_name       = $name;
            $user->facebook_id     = $facebook_id;
            $user->profile_picture = $data->profile_pic;
            $user->access          = User::MEMBER;
            $user->save();

            return $user;
        }
        return null;
    }

    public function create($userID = null, $type = 'text', $message = ""){
        $activity   = new Activity();
        $activity->user_id  = $userID;
        $activity->type     = $type;
        $activity->message  = $message;
        $activity->save();

        return $activity;

    }
}
