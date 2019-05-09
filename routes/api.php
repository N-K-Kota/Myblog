<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tag;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->get('/tags', function(Request $request) {
    $tags = Tag::all()->toArray();
    return response()->json($tags);
});

Route::middleware('api')->post('/newtag', function(Request $request) {
    $validated = $request->validate([
      'newtag' => 'required|max:10'
    ]);
    $newtag = $validated['newtag'];
    $tag = new Tag;
    $tag->name = $newtag;
    $tag->save();
    // DB::transaction(function()
    // {
    //     DB::table('tags')->insert([
    //       'name' => $newtag
    //     ]);
    // });
    return response()->json([
      'message' => "tag is saved",
      'newtag' => $tag->toJson()
    ]);
});
