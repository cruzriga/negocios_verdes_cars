<template>
<div>
    <!-- {{url}}
    {{urlImg}} -->
    <croppa v-model="croppa"
        :width="width!=null?width:250"
        :height="height!=null?height:250"
        placeholder="Seleccione Imagen"
        canvas-color="#eeeeee"
        :placeholder-font-size="19"
        :show-loading="true"
        :loading-size="50"
        :disable-drag-and-drop="false"
        :disable-drag-to-move="moveimg!=true?false:moveimg"
        accept=".jpeg,.png"
        initial-size="cover"
        initial-position="center"
        :show-remove-button="true"
        remove-button-color="black"
        :remove-button-size="40">
        <img v-if="urlImg!=null" crossOrigin="anonymous" :src="url" slot="initial">
    </croppa>
    <!-- :initial-image="urlImg!=null?urlImg:'https://zhanziyang.github.io/vue-croppa/static/500.jpeg'"-->
    <input v-if="!moveimg" color="primary" type="range" @input="onSliderChange" :min="sliderMin" :max="sliderMax" step=".001" v-model="sliderVal">
    <!-- <q-slider @input ="onSliderChange" v-model="sliderVal" :min="sliderMin" :max="sliderMax" step="0.001"/> -->
    <!-- <button @click="croppa.zoomIn()">zoom in</button>
    <button @click="croppa.zoomOut()">zoom out</button> -->
</div>
</template>

<script>
export default {
    name: 'EmpresaAvatar',
    props: {
        urlImg: {
            type: String
        },
        width: {
            type: Number
        },
        height: {
            type: Number
        },
        moveimg: {
            type: Boolean
        }
    },
    data() {
        return {
            croppa: {},
            sliderVal: 0,
            sliderMin: 0,
            sliderMax: 0,
            url:null
        }
    },
    updated (){
        // console.log(this.urlImg)
        // this.url =this.urlImg!=null?'http://'+document.location.host+'/'+this.urlImg:null;
        // console.log(this.urlImg)
        this.url =this.urlImg!=null?'http://'+document.location.host+'/'+this.urlImg:null;

        // var image = new Image()
        // // Notice: it's necessary to set "crossorigin" attribute before "src" attribute.
        // image.setAttribute('crossorigin', 'anonymous')
        // image.src = this.url!=null?this.url:'https://zhanziyang.github.io/vue-croppa/static/500.jpeg'
        
        // this.url = image
        this.croppa.refresh()
    },
    created (){
        // console.log(this.urlImg)
        // console.log(document.location.host)
        // this.url =this.urlImg!=null?'http://'+document.location.host+'/'+this.urlImg:null;
    },
    beforeMount() {
    },
    methods: {
         onInit() {
            this.croppa.addClipPlugin(function (ctx, x, y, w, h) {
                /*
                * ctx: canvas context
                * x: start point (top-left corner) x coordination
                * y: start point (top-left corner) y coordination
                * w: croppa width
                * h: croppa height
                */
                console.log(x, y, w, h)
                ctx.beginPath()
                ctx.arc(x + w / 2, y + h / 2, w / 2, 0, 2 * Math.PI, true)
                ctx.closePath()
            })
        },
        onNewImage() {
            this.sliderVal = this.croppa.scaleRatio
            this.sliderMin = this.croppa.scaleRatio / 2
            this.sliderMax = this.croppa.scaleRatio * 2
        },

        onSliderChange(evt) {
            // console.log(evt);
            var increment = evt.target.value
            this.croppa.scaleRatio = +increment
        },

        onZoom() {
            // To prevent zooming out of range when using scrolling to zoom
            // if (this.sliderMax && this.croppa.scaleRatio >= this.sliderMax) {
            //   this.croppa.scaleRatio = this.sliderMax
            // } else if (this.sliderMin && this.croppa.scaleRatio <= this.sliderMin) {
            //   this.croppa.scaleRatio = this.sliderMin
            // }

            this.sliderVal = this.croppa.scaleRatio
        }
    }
}
</script>

<style lang="sass" scoped>
input[type=range]
  width: 100%
</style>
