<template>
<div class="tagarea-wrapper">
  <tag-component v-for="(tag, key) in tagnameprops" v-bind:key="key" v-bind:tagid="key" v-bind:tagname="tag" v-on:clicktag="sendclickevent">
  </tag-component>
  <slot></slot>
</div>
</template>
<script>
import TagComponent from './TagComponent.vue';

export default {
  methods: {
    sendclickevent: function(id) {
      this.$emit('clickevent', id);
    }
  },
  components: {
    TagComponent
  },
  props: ['tagnameprops']
}
</script>
<style scoped>
  .tagarea-wrapper {
    padding: 10px 30px;
    text-align: center;
  }
</style>
