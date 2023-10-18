 <template>
 <div>
      <Spiner></Spiner>
      <div v-if="!loggedIn">
        <auth-layout></auth-layout>
      </div>
      <div v-else>
        <dashboard-layout></dashboard-layout>
      </div>
 </div>
  
</template>
 
<script>
import { mapState, mapActions } from "vuex";
import Spiner from "./layouts/cube.vue";
import PerfectScrollbar from "perfect-scrollbar";
import "perfect-scrollbar/css/perfect-scrollbar.css";
import AuthLayout from "./layouts/AuthLayout.vue"
import DashboardLayout from "./layouts/DashboardLayout.vue"
import { SlideYDownTransition, ZoomCenterTransition } from "vue2-transitions";
// import 'tinymce/icons/default';

export default {
  data: () => ({
    
    
    activeSidebar: false,
  }),
  computed: {
    // ...mapState(["loading"]),
    loggedIn() {
      return this.$store.getters.isLoggedIn;
    },
  },
  components: {
    Spiner,
    // UserMenu,
    ZoomCenterTransition,
    AuthLayout,
    DashboardLayout
  },
  methods: {},
  mounted() {},
};
</script>