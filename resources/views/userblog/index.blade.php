@extends('layouts.blogslayout')
@section('content')
<h1>{{ $userblog->title }}</h1>
<div class="byblog-wrapper">
  @foreach($articles as $article)
  <section class="myblog-item">
    <h2><a href="{{ route('userblog.show',['blog_id' => $userblog->id, 'entry_id' => $article->id]) }}">{{ $article->title }}</a></h2>
    {{ $article->article }}
  </section>
  @endforeach
  {{ $articles->links() }}
</div>
@endsection
