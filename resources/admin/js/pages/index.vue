<template>
    <div id="app-admin-container">
      <panel/>
    </div>
</template>

<script>
import panel from "./panel";
export default {
    components:{ panel}
}
</script>

<style scoped lang="scss">
  #app-admin-container{
    height: calc(100vh - 100px);
    width: 100%;
  }

</style>