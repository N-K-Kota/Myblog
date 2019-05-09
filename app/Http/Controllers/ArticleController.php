<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Tag;
class ArticleController extends Controller
{
    //
    private $article;
    private $tag;
    public function __construct(Article $insertClass,Tag $anotherClass)
    {
        $this->article = $insertClass;
        $this->tag = $anotherClass;
    }

    public function index(){
      $articles = $this->article->all();
      $tags = $this->tag->all();
      return view('articles.index',['articles' => $articles, 'tags' => $tags]);
    }
    public function post(Request $request)
    {
         $article_id = $request->input('article_id');
         $tagids = $request->input('tags');
         $postedArticle = Article::find($article_id);
         $postedArticle->tags()->syncWithoutDetaching($tagids);
         return view('articles.article',['article' => $postedArticle]);
    }
    public function show(Request $request,$id)
    {
        $selectedArticle = Article::find($id);

        return view('articles.article',['article' => $selectedArticle]);
    }
}
