<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    //
    protected $fillable = ['user_id','userblog_id'];

    public function user()
    {
        return belongsTo('App\user');
    }
}
