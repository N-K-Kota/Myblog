<template>
  <div class="blog-header">
    <ul class="blog-header-box">
      <li>blogtop</li>
      <li class="blog-header-box__item"><a href="{{ route('myaccount') }}">記事をかく</a></li>
      <li class="blog-header-box__item modalbtn" id="modalbtn" @click="toggleusermodal">user</li>
    </ul>
    <div class="usermenu" v-show="usermodal" @click='closeusermodal'>
      <ul class="usermenu-box">
        @foreach($userblogs as blog)
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
        <li><a href="{{ route('logout') }}">ログアウト</a></li>
      </ul>
    </div>
  </div>
</template>
<script>
  export default {
    data: function() {
      return {
        usermodal: false
      };
    },
    methods: {
      toggleusermodal: function() {
        this.usermodal = !this.usermodal;
      },
      closeusermodal: function() {
        this.usermodal = false;
      }
    }
  }
</script>
<style scoped>
  .usermenu {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255,255,255,0.5);
  }
  .usermenu-box {
    position: absolute;
    top: 40px;
    right: 25%;
    width: 200px;
    height: 330px;
    background-color: #fff;
  }
</style>
