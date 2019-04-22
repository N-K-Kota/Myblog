@extends('layouts.adminlayout')
@section('content')
  <div class="admin-top-wrapper">
    <div class="admin-top-content">
      <section class="admin-top-content-blogs">
        <h3>マイブログ</h3>
        <ul class="admin-top-content-blogs-box">
          @foreach($userblogs as $userblog)
            <li class="admin-top-content-blogs-box__item"><a href="{{ route('userblog.index',['id' => $userblog->id]) }}">{{ $userblog->title }}</a>
              <form action="{{ route('myaccount.changeblog') }}" method="post">
                @csrf
                <input type="hidden" value="{{ $userblog->id }}" name="userblog_id">
                <input type="submit" value="選択">
              </form></li>
          @endforeach
        </ul>
        <a href="{{ route('createuserblog.index') }}">新しいブログを作成</a>
      </section>
      <section class="admin-top-content-readings">
        <h2>購読中のブログ</h2>
      </section>
    </div>
    <div class="admin-top-aside">
      <section>ここにはインフォメーションが入る</section>
    </dic>
  </div>
@endsection
