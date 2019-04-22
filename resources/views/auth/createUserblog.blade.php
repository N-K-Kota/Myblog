@extends('layouts.app')
@section('content')
<form action="{{ route('createuserblog.store') }}" method="post">
  @csrf
  タイトル:<input type="text" name="title">
  <input type="hidden" name="category" value="1">
  <input type="hidden" name="user_id" value="{{ $id }}">
  <input type="submit" value="送信">
</form>
@endsection
