<template>
  <div>
    <navbar :show-navbar="showMenu">
      <div class="navbar-wrapper">
        <div class="navbar-toggle" :class="{ toggled: showMenu }">
          <navbar-toggle-button @click.native="toggleNavbar">
          </navbar-toggle-button>
        </div>
        <a class="navbar-brand" href="/login">
           <img width="100" src="/img/logowhite.png" alt="" />
        </a>
      </div>
    </navbar>
    <div class="wrapper wrapper-full-page">
      <div
        class="full-page section-image"
        :class="pageClass"
        filter-color="black"
        data-image="/img/bg13.jpg"
      >
        <div class="content">
          <div class="container">
            <zoom-center-transition
              :duration="pageTransitionDuration"
              mode="out-in"
            >
              <router-view></router-view>
            </zoom-center-transition>
          </div>
        </div>
        <footer class="footer">
          <div class="container-fluid">
            <nav>
              <ul>
                <li class="nav-item">
                  <a
                    href="javascript:;"
                    target="_blank"
                    rel="noopener"
                    >ABOUT US</a
                  >
                </li>
                <li class="nav-item">
                  <a
                    href="javascript:;"
                    target="_blank"
                    rel="noopener"
                    >BLOG</a
                  >
                </li>
                <li class="nav-item">
                  <a
                    href="javascript:;"
                    target="_blank"
                    rel="noopener"
                    >LICENSES</a
                  >
                </li>
              </ul>
            </nav>
            <div class="copyright">
              © {{ year }}, made with <i class="fa fa-heart heart"></i> by<a
                href="javascript:;"
                class="font-weight-bold ml-1"
                target="_blank"
                rel="noopener"
                >CuBon Webdesign</a
              >
            </div>
          </div>
        </footer>

        <div
          class="full-page-background"
          style="background-image: url('/img/bg13.jpg')"
        ></div>
      </div>
    </div>
  </div>
</template>
<script> 
import  Navbar from "../../components/Navbar/Navbar.vue";
import  NavbarToggleButton from "../../components/Navbar/NavbarToggleButton";
import { ZoomCenterTransition } from "vue2-transitions";

export default {
  components: {
    Navbar,
    NavbarToggleButton,
    ZoomCenterTransition,
  },
  props: {
    backgroundColor: {
      type: String,
      default: "black",
    },
  },
  data() {
    return {
      showMenu: false,
      menuTransitionDuration: 250,
      pageTransitionDuration: 200,
      year: new Date().getFullYear(),
      pageClass: "login-page",
    };
  },
  methods: {
    toggleNavbar() {
      document.body.classList.toggle("nav-open");
      this.showMenu = !this.showMenu;
    },
    closeMenu() {
      document.body.classList.remove("nav-open");
      this.showMenu = false;
    },
    setPageClass() {
      this.pageClass = `${this.$route.name}-page`.toLowerCase();
    },
  },
  beforeDestroy() {
    this.closeMenu();
  },
  beforeRouteUpdate(to, from, next) {
    // Close the mobile menu first then transition to next page
    if (this.showMenu) {
      this.closeMenu();
      setTimeout(() => {
        next();
      }, this.menuTransitionDuration);
    } else {
      next();
    }
  },
  watch: {
    $route() {
      this.setPageClass();
    },
  },
};
</script>
<style lang="scss">
$scaleSize: 0.8;
@keyframes zoomIn8 {
  from {
    opacity: 0;
    transform: scale3d($scaleSize, $scaleSize, $scaleSize);
  }
  100% {
    opacity: 1;
  }
}
.wrapper-full-page .zoomIn {
  animation-name: zoomIn8;
}
@keyframes zoomOut8 {
  from {
    opacity: 1;
  }
  to {
    opacity: 0;
    transform: scale3d($scaleSize, $scaleSize, $scaleSize);
  }
}
.wrapper-full-page .zoomOut {
  animation-name: zoomOut8;
}
</style>
