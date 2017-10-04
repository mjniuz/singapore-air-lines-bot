<?php
namespace App\Bot\Repository;

use App\Bot\Services\Bot\Bot;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Support\Facades\Log;

class UserRepository{

    public function __construct() {
        $this->bot          = new Bot;
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

    public function findUserByFacebookID($fbID = ""){
        return User::with([])
            ->where('facebook_id', $fbID)
            ->first();
    }

    public function create($userID = null, $type = 'text', $message = ""){
        $activity   = new Activity();
        $activity->uuid     = $this->gen_uuid();
        $activity->user_id  = $userID;
        $activity->type     = $type;
        $activity->message  = $message;
        $activity->save();

        return $activity;

    }

    private function gen_uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

            // 16 bits for "time_mid"
            mt_rand( 0, 0xffff ),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand( 0, 0x0fff ) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand( 0, 0x3fff ) | 0x8000,

            // 48 bits for "node"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }
}