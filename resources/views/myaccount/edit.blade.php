@extends('layouts.blogslayout')
@section('content')
<div class="writearticle-wrapper">
  <div class="texts-box">
    <ul>
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
    <form action="{{ route('myaccount.updatearticle',['blogid' => $userblog->id, 'articleid' => $article->id]) }}" method="post" id="newarticleform">
      @csrf
      タイトル:<input type="text" name="title" value="{{ $article->title }}"><br>
      <textarea class="postedtext" name="article" cols="20" rows="40">{{ $article->article }}</textarea>
      <input v-for="(tagname, key) in selectedtagnames" type="hidden" :value="tagname.name" :name="tagname.name+tagname.id" :key="key">
      <input type="submit" value="編集完了" id="submitbtn">
    </form>
  </div>
  <aside class="tags-box">
  <h2>タグ</h2>
    <p>タグリストから選択してください</p>
    <div id="createtagbtn" v-on:click="opentagmodal">+新しいタグ</div>
    <addtag-component v-if=isopentagmodal v-on:success="closetagmodal"></addtag-component>
    <tagarea-component v-bind:tagnameprops="selectedtagnames" v-on:clickevent="unchaintag"></tagarea-comonent>
    <tagarea-component v-bind:tagnameprops="tagnames" v-on:clickevent="selecttag"></tagarea-comonent>
  </aside>
</div>
@endsection
