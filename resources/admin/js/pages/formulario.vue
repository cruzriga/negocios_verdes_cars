<template>
    <q-page style="display: flex;justify-content: center;">
        <div id="app-site-container">
            <q-btn style="margin-left: 15px;" v-on:click="navigate()" outline color="teal" round icon="arrow_back" />
            <FormularioNegocios v-bind:propformulario="prop" v-bind:admiurl="true" v-bind:thisadminroute="this.$router"/>
        </div>
    </q-page >
</template>

<script>
import FormularioNegocios from './../../../site/js/components/FormularioNegocios'

export default {
    name: 'FormSite',
    components: { FormularioNegocios },
    props: {
        prop: {
            type: Object
            // default: () => {}
        }
    },
    data () {
        return {
            id: 0,
            msg: 'Hey Nic Raboy'
        }
    },
    // created() {
    //     this.id = this.$route.params.id;
    // },
    methods: {
        navigate() {
            this.$router.go(-1);
        }
    }
}
</script>

<style lang="sass" scoped>
</style>