@extends('layouts.app')
@section('content')
<div>
  <h1>articleページ</h1>
  <p>{{ $article->article }}</p>
  <ul>
    @foreach($article->tags as $tag)
      <li>{{ $tag->tag }}</li>
    @endforeach
  </ul>
</div>
@endsection
