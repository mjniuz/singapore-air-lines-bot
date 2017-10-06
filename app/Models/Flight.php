<?php namespace App\Models;

use App\Models\BaseModel;

class Flight extends BaseModel
{
    protected $table   = 'flights';
    protected $guarded = [];
    protected $appends = ['only_date', 'only_time', 'convert_time'];

    public function getOnlyDateAttribute()
    {
        return date("Y-m-d", strtotime($this->attributes['date']));
    }

    public function getOnlyTimeAttribute()
    {
        return date("H:i", strtotime($this->attributes['date']));
    }

    public function getConvertTimeAttribute()
    {
        $format  = '%02d Hours %02d Minutes';
        $time    = $this->attributes['travel_time'];
        $hours   = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }

    public function getFormatRupiahAttribute()
    {
        return "Rp. " . number_format($this->attributes['amount_found'], 2, ',', '.');
    }

    public function getOnlyTimeArrivalAttribute()
    {
        return date("H:i", strtotime('+' . $this->attributes['travel_time'] . ' minutes', strtotime($this->getOnlyTimeAttribute())));
    }
}
