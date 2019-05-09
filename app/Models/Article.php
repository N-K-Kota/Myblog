<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $fillable = ['article','title','userblog_id'];

    public function userblog()
    {
        return $this->belongsTo('App\Models\Userblog');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }

}
