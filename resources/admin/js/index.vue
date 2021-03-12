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
  #app-admin-container{
    height: calc(100vh - 100px);
    width: 100%;
  }

</style>