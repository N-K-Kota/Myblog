@extends('layouts.app')
@section('content')
<h1>記事のページ</h1>
<h2>{{ __('message.toptitle') }}</h2>
@foreach($articles as $article)
<section>
  <p>{{ $article->article }}</p>
  <form action="/articles" method="post">
    @csrf
    @foreach($tags as $tag)
    <input type="checkbox" name="tags[]" value="{{ $tag->id }}">{{ $tag->tag }}
    @endforeach
    <input type="hidden" name="article_id" value="{{ $article->id }}">
    <input type="submit" value="送信">
  </form>
  <a href="/articles/{{ $article->id }}">記事ページ</a>
@endforeach
</section>
@endsection
