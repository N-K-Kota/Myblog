<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Userblog extends Model
{
    //
    protected $fillable = ['title','category','user_id'];

    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function tags()
    {
        return $this->hasManyThrough('App\Models\Tag', 'App\Models\Article');
    }
}
