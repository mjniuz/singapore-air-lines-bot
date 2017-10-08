<?php namespace App\Bot\Repository;

use App\Bot\Services\Bot\Bot;
use App\Models\User;

class UserRepository
{

    public function __construct()
    {
        $this->bot = new Bot;
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

    public function findUserByFacebookID($fbID = "")
    {
        return User::with([])
            ->where('facebook_id', $fbID)
            ->first();
    }

    /**
     * this function for saving user telegram
     * @param  array    $data
     * @return object
     */
    public function saveUserTelegram($data)
    {
        // saving data user
        $last_name         = isset($data['last_name']) ? $data['last_name'] : null;
        $name              = $data['first_name'] . ' ' . $last_name;
        $username          = str_slug($name);
        $telegram_id       = $data['id'];
        $user              = User::firstOrNew(['username' => $username, 'telegram_id' => $telegram_id]);
        $user->username    = $username;
        $user->full_name   = $name;
        $user->telegram_id = $telegram_id;
        $user->access      = User::MEMBER;
        $user->save();
    }
}
