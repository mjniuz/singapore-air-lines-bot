<?php namespace App\Models;

use App\Models\BaseModel;

class Flight extends BaseModel
{
    protected $table   = 'flights';
    protected $guarded = [];
    protected $appends = ['only_date', 'only_time'];

    public function getOnlyDateAttribute()
    {
        return date("Y-m-d", strtotime($this->attributes['date']));
    }

    public function getOnlyTimeAttribute()
    {
        return date("H:i", strtotime($this->attributes['date']));
    }
}
