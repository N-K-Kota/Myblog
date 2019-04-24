<template>
  <div @click="clicktag">
    {{ tagname }}
  </div>
</template>
<script>
export default {
  methods: {
    clicktag: function() {
      this.$emit('clicktag');
    }
  },
  props: ['tagnames']
}
</script>
<style scoped>
</style>
