<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userblog extends Model
{
    //
    protected $fillable = ['title','category','user_id'];

    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
