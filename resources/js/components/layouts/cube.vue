<template>
  <div v-if="loading == true">
    <div class="backg">
      <div class="pos-spiner">
        <scale-loader :loading="loading" :color="color"></scale-loader>
      </div>
    </div>
  </div>
</template>

<script>
import { Stretch } from "vue-loading-spinner";
import ScaleLoader from "vue-spinner/src/ScaleLoader.vue";
import { mapState , mapGetters } from "vuex";
export default {
    data(){
        return {
            color:"#c67bff",
            height:"",
            width:""
        }
    },
  components: {
    Stretch,
    ScaleLoader
  },
  computed: {
    ...mapGetters(['loading'])
  }
};
</script>
<style>
html, body {height: 100%; width: 100%} 
.pos-spiner {
  position: absolute;
  top: 50%;
  left: 50%;
}
.backg {
  width: 100%;
  height: 100%;
  background: #feffffb8;
  z-index: 99999;
  position: absolute;
  top: 0;
}
</style>