@extends('layouts.adminlayout')
@section('content')
  <table class="manage-table">
    <thead>
        <th>□</th>
        <th>記事タイトル</th>
        <th></th>
        <th>作成者</th>
        <th>タグ</th>
        <th>投稿時間</th>
        <th></th>
    </thead>
    @foreach($articles as $article)
      <tr>
        <td>□</td>
        <td><a href="{{ route('userblog.show',['blog_id'=>$userblog->id,'entry_id'=>$article->id]) }}">{{ $article->title }}</a></td>
        <td><a href="{{ route('myaccount.edit',['blogid' => $userblog->id,'articleid' => $article->id]) }}">編集</a></td>
        <td>{{ $userblog->user->name }}</td>
        <td><ul>@foreach($article->tags as $tag)<li>{{ $tag->name }}</li>@endforeach</ul></td>
        <td>{{ $article->created_at }}</td>
        <td><a href="{{ route('userblog.show',['blog_id'=>$userblog->id,'entry_id'=>$article->id]) }}">記事</a></td>
      </tr>
    @endforeach
  </table>
@endsection
