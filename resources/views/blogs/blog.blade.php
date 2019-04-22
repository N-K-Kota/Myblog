@extends('layouts.app')
@section('content')
@if(isset($article))
<div>
  <h1>{{ $article->title }}</h1>
  <p>
  {{ $article->article }}
  </p>
</div>
@endif
@endsection
