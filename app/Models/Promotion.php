<?php namespace App\Models;

use App\Models\BaseModel;
use Config;
use URL;

class Promotion extends BaseModel
{
    protected $table   = 'promotions';
    protected $guarded = [];
    protected $appends = ['image_file', 'start', 'expired'];

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

    /**
     * this function change format start at
     * @return date
     */
    public function getStartAttribute()
    {
        return date("Y-m-d", strtotime($this->attributes['start_at']));
    }

    /**
     * this function change format start at
     * @return date
     */
    public function getExpiredAttribute()
    {
        return date("Y-m-d", strtotime($this->attributes['expired_at']));
    }

    /**
     * this function for save slug in promotions
     * @param  array    $options
     * @return object
     */
    public function save(array $options = [])
    {
        $this->slug = str_slug($this->title);
        parent::save();
    }
}
