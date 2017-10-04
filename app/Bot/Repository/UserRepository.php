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
}