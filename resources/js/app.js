
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import TagareaComponent from './components/TagareaComponent.vue';
import AddtagComponent from './components/AddtagComponent.vue';
window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#blogslayoutapp',
    components: {
      TagareaComponent,
      AddtagComponent
    },
    data: {
        usermodal: false,
        tagnames: [],
        selectedtagnames: [],
        responsejson: {},
        isopentagmodal: false
    },
    methods: {
      toggleusermodal: function() {
        this.usermodal = !this.usermodal;
      },
      closeusermodal: function() {
        this.usermodal = false;
      },
      selecttag: function(id) {
          if(!this.selectedtagnames.find( element => element == this.tagnames[id])
            ){
                this.selectedtagnames.push(this.tagnames[id]);
            }
      },
      unchaintag: function(id) {
          this.selectedtagnames.splice(id, 1);
      },
      closetagmodal: function(success) {
          this.tagnames.push(success[1]);
          this.isopentagmodal = false;
      },
      opentagmodal: function() {
          this.isopentagmodal = true;
      }
    },
    created:  function() {
        let axios = require('axios');
        let vue = this;
        axios.get('/api/tags').then(function(response){
            vue.tagnames = response.data;
        }).catch(function(err){
            vue.responsejson = err;
        });
    }

});
