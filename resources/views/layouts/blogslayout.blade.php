<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <title>blogs</title>
</head>
<body>
  <header>
    <nav class="mynav">
    <ul class="mynav-inner">
      <li class="mynav__list__home">
        <a href="{{ route('blogs.index') }}" class="homebtn">Home</a>
      </li>
      @auth
      <li class="mynav__list">
        <a href="{{ route('myaccount') }}" class="mynav__list__btn">記事をかく</a>
      </li>
      <li>
        <a href="{{ route('myaccount.index',['blogid'=>1]) }}" class="mynav__list__btn">管理</a>
      </li>
      <li class="mynav__list">
        {!! Form::open(['route' => 'logout','class'=>'mynav__list__btn']) !!}
        {!! Form::submit("ログアウト") !!}
        {!! Form::close() !!}
      </li>

      @endauth
      @guest
      <li class="mynav__list">
        {!! Form::open(['route' => 'login', 'method' => 'get', 'class' => 'mynav__list__btn']) !!}
        {!! Form::submit('ログイン') !!}
        {!! Form::close() !!}
      </li>
      <li class="mynav__list">
        {!! Form::open(['route' => 'register', 'method' => 'get', 'class' => 'mynav__list__btn']) !!}
        {!! Form::submit('登録') !!}
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
</body>
</html>
