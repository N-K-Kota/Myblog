<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Tag extends Model
{
    //
    use Notifiable;
    
    protected $fillable = ['name'];
    public function articles()
    {
        return $this->belongsToMany('App\Models\Article');
    }
    public function getName($value)
    {
        return ucfirst($value);
    }
    public function setName($value){
        $this->attributes['name'] = ucfirst($value);
    }
}
