<template>
<div class="addtagmodal">
  {{ errmessage }}
  <input type="text" name="newtag" v-model="newtag">
  <input type="button" id="addtagbtn" v-on:click="sendtag" value="追加">
</div>
</template>
<script>
  export default {
    data: function() {
      return {
        newtag: "",
        errmessage: "",
      }
    },
    methods: {
      sendtag: function() {
        let axios = require('axios');
        let vue = this;
        axios.post('/api/newtag',{
          newtag: this.newtag
        })
        .then(function(response) {
          let res = response.data;
          vue.$emit('success', [res.message, JSON.parse(res.newtag)]);
        })
        .catch(function(err) {
          vue.errmessage = err;
          vue.$emit('fail', vue.errmessage);
        });
      }
    }
  }
</script>
<style scoped>
  .addtagmodal {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    padding: 100px 50px;
    text-align: center;
  }
</style>
