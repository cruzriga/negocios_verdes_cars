<template>
  <div id="app-site-container">
    <FormularioNegocios v-bind:propformulario="datos"/>
  </div>
</template>

<script>
// import CamposForm from 'components/CamposForm'
import FormularioNegocios from './components/FormularioNegocios'

export default {
  name: 'FormSite',
  components: { FormularioNegocios },
  data () {
    return {
      datos: {
        nombreempresa: 'Negocios Verdes',
        representantelegal: 'Negocios Verdes',
        descripcion: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type a',
        telefono: '1234567',
        municipio: 'Hatonuevo',
        direccion: 'Algún Lugar',
        email: 'negociosverdes@negocios.com',
        categoria:  { idcategoria: "2", nombre: "ECOPRODUCTOS INDUSTRIALES" },
        subcategoria: { idsubcategoria: "6", nombre: "Negocios para la restauración", idcategoria: "2" },
        tiposubcategoria: { idtiposubcategoria: "6", nombre: "Geotérmica", idsubcategoria: "1" },
        productos: [
          {
            nombre: 'Vasos',
            descripcion: 'Buenos',
            urlimagen: null,
            activo:1
          },
          {
            nombre: 'Gorras',
            descripcion: 'A mano',
            urlimagen: null,
            activo:1
          }
        ]
      }
    }
  }
}
</script>
