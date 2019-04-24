@extends("layouts.blogslayout")
@section("content")
<div class="topheader">
  <h2>トップページ</h2>
</div>
<div class="articles">
  <ul class="articles__inner">
    @foreach($articles as $article)
    <li class="articles__list"><a href="{{ route('userblog.show', ['blog_id' => $article->userblog->id,  'entry_id' => $article->id]) }}"><p>{{ $article->title }}</p></a></li>
    @endforeach
  </ul>
</div>
<div class="topfooter">
  footer
</div>
@endsection
