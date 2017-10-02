<?php namespace App\Bot\Repository;

use App\Bot\Services\Bot\Bot;
use App\Models\User;

class MessengerRepository extends Repository
{

    /**
     * this function for first call function if call another function
     *
     * @param \Illuminate\Http\Request $request The request
     */
    protected $bot;
    public function __construct()
    {
        // repository messenger for handle process data
        $this->bot = new Bot;
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
     * @return array
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
        }
        return $get_facebook_detail;
    }
}
