<template>
  <div v-on:click="clicktag">
    {{ tagname.name }}
  </div>
</template>
<script>
export default {
  methods: {
    clicktag: function() {
      this.$emit('clicktag', this.tagid);
    }
  },
  props: ['tagname', 'tagid']
}
</script>
<style scoped>
</style>
