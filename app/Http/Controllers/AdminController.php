<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Userblog;
use App\User;
use App\Tag;
use App\Article;
class AdminController extends Controller
{
    //

    public function __construct(Userblog $userblogclass)
    {
        $this->middleware('auth');
    }

    public function index()
    {
      $user = Auth::user();
      $userblogs = $user->userblogs;
      return view('myaccount.index', ['userblogs' => $userblogs]);
    }

    public function reading()
    {

    }

    public function manage($blogid)
    {
        $user = Auth::user();
        $userblog = $user->userblogs()->where('id', $user->info->userblog_id)->first();
        $articles = $userblog->articles;
        return view('myaccount.manage', ['userblog' => $userblog, 'articles' => $articles]);
    }

    public function edit($blogid,$articleid)
    {
        $user = Auth::user();
        $userblog = $user->userblogs()->where('id', $user->info->userblog_id)->first();
        $article = $userblog->articles()->find($articleid);
        $tags = Tag::all();
        $syncedTag = $article->tags;
        return view('myaccount.edit', ['article' => $article, 'userblog' => $userblog, 'tags' => $tags, 'syncedTag' => $syncedTag]);
    }

    public function updatearticle(Request $request,$blogid,$articleid)
      {
        $request->flashOnly(['article']);
        $errmessages = [
          'max' => ':attribute は :max　より少なくしてね',
        ];
        $validatedata = Validator::make($request->all(), [
          'title' => 'required|max:254'
        ],$errmessages);
        if ($validatedata->fails()) {
            return redirect()->route('myaccount.edit', ['blogid' => $blogid, 'articleid'=>$articleid])->withErrors($validatedata);
        }
        $posted = $request->all();
        if (isset($posted['newtagnames'])){
            $newtags = explode(',', $posted['newtagnames']);
            foreach($newtags as $newtag) {
                Tag::create(['name' => $newtag]);
            }
        }
        $tagkeys = [];
        foreach($posted as $post) {
            if (Tag::where('name', $post)->exists()) {
                $tagkeys[] = Tag::where('name', $post)->first()->id;
            }
        }

        $blogid = Auth::user()->info->userblog_id;
        $article = Article::find($articleid);
        $article->tags()->sync($tagkeys);
        $article->update(['title' => $request->title,'article' => $request->article]);
        return redirect()->route('userblog.show',['blog_id' => $blogid,'entry_id' => $articleid]);
    }

    public function changeblog(Request $request)
    {
        $posted = $request->all();
        $user = Auth::user();
        $user->info()->update(['userblog_id' => $posted['userblog_id']]);
        return redirect()->route('userblog.index',['id' => $posted['userblog_id']]);
    }

}
