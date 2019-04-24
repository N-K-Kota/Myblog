<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script src="{{ asset('js/app.js') }}" defer></script>
  <title>blogs</title>
</head>
<body>
  <div id="blogslayoutapp">
    <header>
      <nav class="mynav">
        @auth
        <div class="blog-header">
          <ul class="blog-header-box">
            <li class="blog-header-box__item"><a href="{{ route('blogs.index') }}">blogtop</a></li>
            <li class="blog-header-box__item_space"></li>
            <li class="blog-header-box__item"><a href="{{ route('myaccount') }}">記事をかく</a></li>
            <li class="blog-header-box__item modalbtn" id="modalbtn" v-on:click="toggleusermodal">user</li>
          </ul>
          <div class="usermenu" v-show="usermodal" v-on:click='closeusermodal'>
            <ul class="usermenu-box">
              @foreach($userblogs as $blog)
              <li class="usermenu-box__item">
                <a href="{{ route('userblog.index',['id' => $blog->id]) }}">{{ $blog->title }}</a>
                <ul class="usermenu-box__item__pop">
                  <li>ブログトップ</li>
                  <li>記事をかく</li>
                  <li>記事の管理</li>
                  <li>コメント</li>
                  <li>アクセス解析</li>
                  <li>設定</li>
                  <li>デザイン</li>
                  <li>ブログメンバー</li>
                </ul>
              </li>
              @endforeach
              <li><a href="{{ route('myaccount.index') }}">ダッシュボード</a></li>
              <li>アカウント設定</li>
              <li>購読中のブログ</li>
              <li>ヘルプ</li>
              <li><form action="{{ route('logout') }}" method="post">@csrf<input type="submit" value="ログアウト"></form></li>
            </ul>
          </div>
        </div>
        @endauth
        @guest
        <ul class="mynav-inner">
          <li class="mynav__list__home">
            <a href="{{ route('blogs.index') }}" class="homebtn">Home</a>
          </li>
          <li class="mynav__list">
            {!! Form::open(['route' => 'login', 'method' => 'get', 'class' => 'mynav__list__btn']) !!}
            {!! Form::submit('ログイン') !!}
            {!! Form::close() !!}
          </li>
          <li class="mynav__list">
            {!! Form::open(['route' => 'register', 'method' => 'get', 'class' => 'mynav__list__btn']) !!}
            {!! Form::submit('サインイン') !!}
            {!! Form::close() !!}
          </li>
        @endguest
      </ul>
      <nav>
    </header>
    <main>
      @yield('content')
    </main>
    <footer>
    </footer>
  </div>
</body>
</html>
