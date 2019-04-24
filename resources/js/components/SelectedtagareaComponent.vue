<template>
<div class="tagarea-wrapper">
  <tag-component v-for="(name, key) in selectedtagnames" :key=key :tagid=key :tagname=name @clicktag="sendclickevent"></tag-component>
</div>
</template>
<script>
import TagComponent from './TagComponent.vue';

export default {
  data: function() {
    return {}
  },
  methods: {
    sendclickevent: function(id) {
      this.$emit('selectedtagclickevent', id);
    }
  },
  props: ['selectedtagnames']
}
</script>
<style scoped>
  .tagarea-wrapper {
    padding: 10px 30px;
    text-align: center;
  }
</style>
