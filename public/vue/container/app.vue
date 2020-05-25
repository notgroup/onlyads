<template>
  <div id="wrapper" v-if="this.$root.clientInit.productsGroup">
    <header-comp> </header-comp>
    <sidebar-comp> </sidebar-comp>
    <div class="content-page">
    <router-view></router-view>
  </div>
    <footer-comp></footer-comp>
  </div>
</template>

<script>

  module.exports = {
    name: "home",
    methods: {},
    components: {},
  }
</script>

<style>

</style>

