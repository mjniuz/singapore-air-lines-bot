<?php namespace App\Models;

use App\Models\BaseModel;
use Config;
use URL;

class Promotion extends BaseModel
{
    protected $table   = 'promotions';
    protected $guarded = [];
    protected $appends = ['image_file'];

    /**
     * this function fo get image
     * @return string
     */
    public function getImageFileAttribute()
    {
        if (empty($this->attributes['image']))
        {
            return asset('/assets/img/singapore-airlines.jpg');
        }
        else
        {
            if (env('STORAGE_TYPE') == 's3' && ($this->attributes['image'] != null || !empty($this->attributes['image'])))
            {
                return Storage::disk(env('STORAGE_TYPE'))->url($this->attributes['image']);
            }
            else
            {
                return URL::to('medias/' . Config::get('path.promotion') . $this->attributes['image']);
            }
        }
    }
}
