<?php namespace App\FlightPriceReminder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlightReminder extends Model
{
    use SoftDeletes;

    protected $table     = 'flight_reminder';
    protected $timestamp = true;

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
