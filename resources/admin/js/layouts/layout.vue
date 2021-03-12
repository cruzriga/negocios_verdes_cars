<template>
  <div id="app-admin-container">
    <q-layout view="hHh lpR fFf"  container>

      <q-header elevated class="bg-white text-grey">
        <q-toolbar>
          <q-btn dense flat round icon="menu" @click="left = !left" />

          <q-toolbar-title>
            Negocios verdes Corpoguajira
          </q-toolbar-title>
        </q-toolbar>
      </q-header>

      <q-drawer show-if-above v-model="left" side="left" behavior="desktop" bordered>
        <!-- drawer content -->
        <q-scroll-area class="fit">
          <q-list>

            <template v-for="(menuItem, index) in menuList">
              <q-item :key="index" clickable :active="menuItem.label === 'Outbox'" v-ripple>
                <q-item-section avatar>
                  <q-icon :name="menuItem.icon" />
                </q-item-section>
                <q-item-section>
                  {{ menuItem.label }}
                </q-item-section>
              </q-item>
              <q-separator :key="'sep' + index" v-if="menuItem.separator" />
            </template>

          </q-list>
        </q-scroll-area>
      </q-drawer>

      <q-page-container style="height: calc(100vh - 100px); overflow-y: auto">
        <q-page style="padding: 20px">
          <slot></slot>
        </q-page>
      </q-page-container>

    </q-layout>
  </div>
</template>

<script>
export default {
  data(){
      return {
        left: true,
        menuList : [
          {
            icon: 'inbox',
            label: 'Inbox',
            separator: true
          },
          {
            icon: 'send',
            label: 'Outbox',
            separator: false
          },
          {
            icon: 'delete',
            label: 'Trash',
            separator: false
          },
          {
            icon: 'error',
            label: 'Spam',
            separator: true
          },
          {
            icon: 'settings',
            label: 'Settings',
            separator: false
          },
          {
            icon: 'feedback',
            label: 'Send Feedback',
            separator: false
          },
          {
            icon: 'help',
            iconColor: 'primary',
            label: 'Help',
            separator: false
          }
        ]
      }
  }
}
</script>

<style scoped>
  #app-admin-container, .full-main {
    height: calc(100vh - 150px);
    overflow: hidden;
  }

</style>
