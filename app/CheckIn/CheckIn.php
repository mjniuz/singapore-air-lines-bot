<?php
namespace App\CheckIn;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckIn extends Model
{
    use SoftDeletes;
    protected $table   = 'check_in';
    protected $timestamp    = true;

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
