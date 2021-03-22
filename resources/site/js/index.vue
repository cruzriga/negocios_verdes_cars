<template>
  <layout>
    <router-view />
  </layout>
</template>

<script>
import layout from "./layouts/layout";
export default {
    components:{ layout}
}
</script>

<style scoped lang="scss">
  #app-site-container{
    height: calc(100vh - 100px);
    width: 100%;
  }
  #sp-main-body{
    padding:0 !important;
  }

</style>