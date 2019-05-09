<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
class RedisController extends Controller
{
    //
    private $count;
    public function __construct()
    {
        if(!Redis::command('EXISTS', ['mykey'])) {
            Redis::command('SET', ['mykey', 1]);
        } 
        $this->count = Redis::command('GET', ['mykey']);
    }

    public function index()
    {
        var_dump($this->count);
        return view('countredis', ['count' => $this->count]);
    }

    public function update()
    {
        $this->count += 1;
        Redis::command('SET', ['mykey', $this->count]);
        return redirect()->route('countbyredis');
    }
}
