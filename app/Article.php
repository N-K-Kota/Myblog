<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $fillable = ['article','title','userblog_id'];

    public function userblog()
    {
        return $this->belongsTo('App\Userblog');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

}
