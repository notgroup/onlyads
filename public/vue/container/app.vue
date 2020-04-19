<template>
  <div id="wrapper">
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

