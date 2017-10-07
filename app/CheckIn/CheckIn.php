<?php namespace App\CheckIn;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckIn extends Model
{
    use SoftDeletes;

    protected $table     = 'check_in';
    protected $timestamp = true;

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function getSeatAttribute()
    {
        $seats = $this->seats;
        if ($seats == "")
        {
            return null;
        }

        if (!$this->isJson($seats))
        {
            return $this->seats;
        }

        $seatsArr = json_decode($seats);

        return (!empty($seatsArr[0]) ? $seatsArr[0] : null);
    }

    private function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

}
