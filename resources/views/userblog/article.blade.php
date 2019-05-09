@extends('layouts.blogslayout')
@section('content')
<div class="main-wrapper">
  <div class="main-inner">
    <div class="blog-header">
      <h1><a href="{{ route('userblog.index',['userblog_id' => $userblog->id])}}">{{ $userblog->title }}</a></h1>
      <div class="blog-header-advertise">
        <p>ここはブログトップの広告</p>
      </div>
    </div>

    <div class="main-content">
      <article class="main-content-blog">
        <h2 class="blog-content__title">{{ $article->title }}</h2>
        <section class="blog-content__body">{{ $article->article }}</section>
      </article>
      <div class="main-content-relations">

      </div>
    </div>
    <aside class="side-content">
      <div class="side-content-advertise">
        <p>ここはサイドバーの広告</p>
      </div>
      <div class="side-content-profile">

      </div>
      <div class="side-content-feature-articles">

      </div>
      <div class="side-content-new-articles">
        <h3>最新記事</h3>
        <ul class="side-content-new-articles-box">
          @foreach($userblog->articles()->paginate(5) as $newarticle)
            <li class="side-content-new-articles-box__list"><a href="{{ route('userblog.show',['blog_id' => $userblog->id, 'entry_id' => $newarticle->id]) }}">{{ $newarticle->title }}</a></li>
          @endforeach
        </ul>
        {{ $userblog->articles()->paginate(5)->links('vendor.pagination.default') }}
      </div>
      <div class="side-content-category">
      <h3>ここはタグリスト</h3>
        <ul>
        @foreach($article->tags as $tag)
          <li>{{ $tag->name }}</li>
        @endforeach
        </ul>
      </div>
    </aside>
 </div>
</div>
@endsection
