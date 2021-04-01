<template>
    <q-page style="display: flex;justify-content: center;">
        <div id="app-site-container">
            <!-- <q-btn style="margin-left: 15px;" v-on:click="navigate()" outline color="teal" round icon="arrow_back" /> -->
            <PerfilNegocio v-bind:propperfil="propperfil" v-bind:idEmpresa="this.$route.params.idEmpresa" />
        </div>
    </q-page >
</template>

<script>
import PerfilNegocio from './../../../site/js/pages/PerfilNegocio'

export default {
    name: 'PerfilAdmin',
    components: { PerfilNegocio },
    props: {
        propperfil: {
            type   : Object,
            default: null
        }
    },
    data () {
        return {
            id: 0,
            msg: 'Hey Nic Raboy',
            idEmpresa:null
        }
    },
    created() {
        console.log(this.$route.params.idEmpresa)
    },
    methods: {
        navigate() {
            this.$router.go(-1);
        }
    }
}
</script>

<style lang="scss">
.q-item__section--avatar {
    min-width: 0px !important;
}
</style>