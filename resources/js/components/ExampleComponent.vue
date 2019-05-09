<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <a v-on:click="sendrequest">おせ</a>
                          {{ res }}
                        <a v-on:click="testres">thistest</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
          sendrequest: function() {
            let axios = require('axios');
            let vue = this;
            axios.get('/api/tags').then(function(response){
                vue.res = response.data;
                console.log(response.data);
            }).catch(function(err){
                vue.res = err;
                console.log(response.data);
            });
          },
          testres: function() {
            console.log(this);
          }
        },
        data: function() {
          return {
            res: ""
          }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
