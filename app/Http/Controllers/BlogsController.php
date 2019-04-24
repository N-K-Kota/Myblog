<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use Illuminate\Support\Facades\Auth;
class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     private $article;
     public function __construct(Article $insertClass)
     {
         $this->article = $insertClass;
     }
    public function index()
    {
        //
        $articles = $this->article->get();
        if(Auth::check()) {
            $userblogs = Auth::user()->userblogs;
            return view('blogs.index',["articles" => $articles, "userblogs" => $userblogs]);
        } else {
            return view('blogs.index',["articles" => $articles]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $posted = $request->all();
        //$postdata = ['title' => $posted['title'],'article' => $posted['textarea']];
        $this->article->fill($posted)->save();
        return redirect()->route("blogs.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = $this->article->where('id',$id)->get();
        if (Auth::check()) {
            $userblogs = Auth::user()->userblogs;
            return view('blogs.blog',['article' => $data[0], 'userblogs' => $userblogs]);
        } else {
            return view('blogs.blog',['article'=>$data[0]]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
}
