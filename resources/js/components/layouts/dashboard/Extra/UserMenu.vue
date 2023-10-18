<template>
  <div class="user user__menu">
    <div class="photo">
      <img src="/img/placeholder.jpg" alt="avatar" />
    </div>
    <div class="info">
      <a
        data-toggle="collapse"
        :aria-expanded="!isClosed"
        @click.stop="toggleMenu"
        href="#"
      >
        <span>
          {{ title }}
          <b class="caret"></b>
        </span>
      </a>
      <div class="clearfix"></div>
      <div>
        <collapse-transition>
          <ul class="nav user-menu__nav" v-show="!isClosed">
            <slot>

              <li>
                <a href="javascript:;" class="twhite" @click="logout" >
                  <span class="sidebar-mini-icon">L</span>
                  <span class="sidebar-normal">Logout</span>
                </a>
              </li>
            </slot>
          </ul>
        </collapse-transition>
      </div>
    </div>
  </div>
</template>
<script>
import { CollapseTransition } from "vue2-transitions";
import {mapActions} from 'vuex'

export default {
  name: "user-menu",
  components: {
    CollapseTransition,
  },
  data() {
    return {
      isClosed: true,
      title: "Profile",
    };
  },
  methods: {
    ...mapActions(['destroyToken','loadings','getNotification','profileUserCms']),
    logout() {
      this.loadings(true);
      this.destroyToken().then(response => {
        this.loadings(false)
        this.$router.push({ name: "login" })
      }).catch(error => {
        this.loadings(false);
        this.$router.push({ name: "login" })
        this.$error('Đăng nhập thất bại');
      })
    },
    toggleMenu() {
      this.isClosed = !this.isClosed;
    }
  },
};
</script>
<style>
.user__menu ul.user-menu__nav {
  margin-top: 0;
  padding-top: 20px;
}
a.twhite:hover {
  color: white !important;
}
</style>
