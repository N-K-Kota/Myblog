<template>
<div>
  <div class="usermenu" v-show="usermodal" v-on:click='closeusermodal'>
    <ul class="usermenu-box">
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
.mytitle {
  font-size: 40px;
  color: #ffa500;
}
</style>
