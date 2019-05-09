<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Userblog;
use App\Models\Tag;
class UserblogController extends Controller
{
    private $userblogs;

    public function __construct(Userblog $userblogclass)
    {
        $this->userblogs = $userblogclass;

    }
    //
    public function index(Userblog $blog_id)
    {
        $articles = $blog_id->articles()->simplePaginate(5);
        if (Auth::check()) {
            $userblogs = Auth::user()->userblogs;
            return view('userblog.index',['userblog'=>$blog_id,'articles' => $articles, 'userblogs' => $userblogs]);
        } else {
            return view('userblog.index',['userblog'=>$blog_id,'articles' => $articles]);
        }

    }

    public function create()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $userinfo = $user->info;
            $userblog = $this->userblogs->where('id', $userinfo->userblog_id)->first();
            $tags = Tag::all();
            $userblogs = $user->userblogs;
            if($userblog === null) {
                return view('auth.createUserblog',["id" => $user->id]);
            } else {
                return view('myaccount.create',compact('userblog','tags','userblogs'));
            }

        } else {
            return redirect()->route('login');
        }

    }

    public function store(Request $request)
    {
        if (Auth::check()) {
            $posted = $request->all();
           
            $tagkeys = [];
            foreach($posted as $post) {
                if (Tag::where('name', $post)->exists()) {
                    $tagkeys[] = Tag::where('name', $post)->first()->id;
                }
            }
            $myuserinfo = Auth::user()->info;
            $user_blog = Auth::user()->userblogs()->where('id', $myuserinfo->userblog_id)->first();
            $article = $user_blog->articles()->create(['article'=>$posted['article'], 'title' => $posted['title']]);
            $article->tags()->sync($tagkeys);
            $blog_id = $user_blog->id;
            return redirect()->route('userblog.index',["blog_id" => $blog_id]);
        } else {
            return redirect()->route('login');
        }

    }

    public function show($blog_id,$entry)
    {
        $blog = $this->userblogs->where('id', $blog_id)->with('articles')->first();
        $article = $blog->articles()->find($entry);
        if(Auth::check()) {
            $userblogs = Auth::user()->userblogs;
            return view("userblog.article", ["userblog" => $blog, "entry_id" => $entry, "article" => $article, "userblogs" => $userblogs]);
        } else {
            return view("userblog.article", ["userblog" => $blog, "entry_id" => $entry, "article" => $article]);
        }
    }

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function createuserblog()
    {
        return view('auth.createUserblog',['id'=>Auth::id()]);
    }

    public function storeuserblog(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();
        $userblog = $user->userblogs()->create($data);
        $info = $user->info;
        $info->userblog_id = $userblog->id;
        $info->save();
        return redirect()->route('userblog.index',["blog_id" => $userblog->id]);
    }

    public function notice()
    {
        $user = User::find(1);
        $notices = $user->notifications;
        foreach($notices as $notice) {
            dd($notice->type);
        }
        return view('notice', ['notices' => $notices]);
    }

}
