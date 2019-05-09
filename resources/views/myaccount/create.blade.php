@extends('layouts.blogslayout')
@section('content')
<div class="writearticle-wrapper">
  <div class="texts-box">
    <form action="{{ route('myaccount.post') }}" method="post" id="newarticleform">
      @csrf
      タイトル:<input type="text" name="title"><br>
      <textarea class="postedtext" name="article" cols="20" rows="40"></textarea>
      <input type="hidden" name="category" value="1">
      <input v-for="(tagname, key) in selectedtagnames" type="hidden" :value="tagname.name" :name="tagname.name+tagname.id" :key="key">
      <input type="submit" value="投稿する" id="submitbtn">
    </form>

  </div>
  <!-- <aside class="tags-box">
    <h2>タグ</h2>
    <p>タグリストから選択して下さい</p>
    <div class="selectedtags"><ul id="selectedtags-content"></ul></div>
    <div id="createtagbtn">+新しいタグ</div>
    <div id="tagmodal" class="hide">タグの名前<input type="text" name="newtag" id="newtag"><button id="putnewtag">追加</button></div>
    <ul class="tags-content">
      @foreach($tags as $tag)
        <li class="tags-content__list" id="tag{{ $tag->id }}" data-tagname="{{ $tag->name }}" data-id="{{ $tag->id }}">{{ $tag->name }}</li>
      @endforeach
    </ul>
  </aside> -->
  <aside class="tags-box">
    <h2>タグ</h2>
    <p>タグリストから選択してください</p>
    <div id="createtagbtn" v-on:click="opentagmodal">+新しいタグ</div>
    <addtag-component v-if=isopentagmodal v-on:success="closetagmodal"></addtag-component>
    <tagarea-component v-bind:tagnameprops="selectedtagnames" v-on:clickevent="unchaintag"></tagarea-comonent>
    <tagarea-component v-bind:tagnameprops="tagnames" v-on:clickevent="selecttag"></tagarea-comonent>
  </aside>
</div>
<!-- <script type="text/javascript">

  let tagsbox = document.querySelector('.tags-content');
  console.log(tagsbox);
  let tags = tagsbox.children;
  let content = document.querySelector('#selectedtags-content');
  console.log(content);
  let taglist = [];
  let tagnames = [];

  for (var i=0;i<tags.length;i++) {   //全てのタグの名前を取得、　タグの重複作成を防ぐために使う
    tagnames.push(tags[i].innerText);
  }

  tagsbox.addEventListener('click', function(e){
    if (e.target && e.target.matches('li.tags-content__list')) {
      if (!e.target.classList.contains('selected')) {
        let lielm = e.target.cloneNode(true);
        e.target.classList.add('selected');
        lielm.classList.replace('tags-content__list', 'selectedtags-content__list');
        taglist.push({name:e.target.dataset.tagname, id:e.target.dataset.id});
        content.append(lielm);
      }
    }
  });

  content.addEventListener('click', function(e) {
    if (e.target && e.target.matches("li.selectedtags-content__list")) {
      taglist = taglist.filter(n => (n.name !== e.target.dataset.tagname && n.id !== e.target.dataset.id) );
      let removedtagID = e.target.dataset.id;
      let tagsboxlist = tagsbox.children;
      for (var i=0;i<tagsboxlist.length;i++) {
        if (tagsboxlist[i].dataset.id == removedtagID) {
          tagsboxlist[i].classList.remove('selected');
          break;
        }
      }

      // let selecttag = e.target.cloneNode(true);
      // selecttag.classList.remove('selectedtags-content__list');
      // selecttag.classList.add('tags-content__list');
      // tagsbox.append(selecttag);
      e.target.remove();
    }
  });


  let newbtn = document.querySelector('#createtagbtn');
  newbtn.onclick = function() {
    let tagmodal = document.querySelector('#tagmodal');
    tagmodal.classList.remove('hide');
  };


  let putnewtagbtn = document.querySelector('#putnewtag');
  putnewtagbtn.onclick = function(e){
    let puttagname = document.querySelector('#newtag').value;
    if(tagnames.find(function(elm){   //同じタグがすでに存在しないかチェック
      if (elm === puttagname) {
        return true;
      }
    })) {

    } else {

      let lielm = document.createElement('li');
      lielm.innerText = puttagname;
      lielm.classList.add('tags-content__list');
      lielm.setAttribute('data-tagname', puttagname);
      lielm.setAttribute('data-id', 'newtag');
      tagnames.push(puttagname);
      tagsbox.append(lielm);
      document.querySelector('#tagmodal').classList.add('hide');
    }
  };

  let form = document.querySelector('#newarticleform');
  form.onsubmit = function(e) {
    let newtagstext = "";
    for (var i=0;i<taglist.length;i++) {
      let input = document.createElement('input');
      input.setAttribute('type', 'hidden');
      input.setAttribute('name', "id"+taglist[i].id);
      input.setAttribute('value', taglist[i].name);
      if( taglist[i].id === 'newtag'  ) {
        newtagstext += taglist[i].name+',';
      }
      form.append(input);
    }
    newtagstext = newtagstext.slice(0, -1);
    let newinput = document.createElement('input');
    newinput.setAttribute('type', 'hidden');
    newinput.setAttribute('name', 'newtagnames');
    newinput.setAttribute('value', newtagstext);
    form.append(newinput);
    return true;
  }

</script> -->
@endsection
