<template>
    <q-page style="display: flex;justify-content: center;">
        <div id="app-site-container">
                <q-btn
                    v-on:click="navigate()"
                    size="22px"
                    class="q-px-xl q-py-xs"
                    color="primary"
                    label="Atras"
                />
            <FormularioNegocios v-bind:propformulario="prop"/>
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