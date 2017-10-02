<?php namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Storage;
use URL;

class User extends Authenticatable
{
    use Notifiable;

    const ADMIN  = 1;
    const MEMBER = 2;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * this function for get image URL
     *
     * @return object The image path attribute.
     */
    public function getImagePathAttribute()
    {
        if (empty($this->attributes['image']) || $this->attributes['image'] == null)
        {
            return URL::to('assets/img/photo.jpg');
        }
        else
        {
            if (env('FILESYSTEM_DRIVER') == 'local')
            {
                return URL::to($this->attributes['image']);
            }
            else
            {
                return Storage::disk(env('FILESYSTEM_DRIVER'))->url($this->attributes['image']);
            }
        }
    }
}
