<template>
  <div class="fixed-plugin" v-click-outside="closeDropDown">
    <div class="dropdown show-dropdown" :class="{ show: isOpen }">
      <a data-toggle="dropdown">
        <i class="fa fa-cog fa-2x" @click="toggleDropDown"> </i>
      </a>
      <ul class="dropdown-menu" :class="{ show: isOpen }">
        <li class="header-title">Thay đổi màu thanh công cụ</li>
        <li class="adjustments-line text-center">
          <span
            v-for="item in sidebarColors"
            :key="item.color"
            class="badge filter"
            :class="[`badge-${item.color}`, { active: item.active }]"
            :data-color="item.color"
            @click="changeSidebarBackground(item)"
          >
          </span>
        </li>

        <li class="header-title">Thu gọn</li>
        <li class="adjustments-line d-flex justify-content-center">
          <l-switch
            on-text="ON"
            off-text="OFF"
            :value="sidebarMini"
            @input="(val) => updateValue('sidebarMini', val)"
          ></l-switch>
        </li>
        <li class="header-title d-flex justify-content-center">
          Thank you for used!
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
import Vue from "vue";

import LSwitch  from "../../../../components/layouts/Switch.vue";

import SocialSharing from "vue-social-sharing";

const VueSelect = {
  install(Vue, options) {
    Vue.component("SocialSharing", SocialSharing);
  },
};
Vue.use(VueSelect);
export default {
  components: {
    LSwitch,
  },
  props: {
    color: {
      type: String,
      default: "black",
    },
    sidebarMini: Boolean,
    fixedNavbar: Boolean,
  },
  data() {
    return {
      documentationLink:
        "https://vue-now-ui-dashboard-laravel.creative-tim.com/documentation/#/getting-started",
      shareUrl:
        "https://www.creative-tim.com/product/vue-now-ui-dashboard-laravel",
      buyUrl:
        "https://www.creative-tim.com/product/vue-now-ui-dashboard-pro-laravel",
      downloadUrl:
        "https://www.creative-tim.com/product/vue-now-ui-dashboard-laravel",
      gitLink:
        "https://github.com/creativetimofficial/vue-now-ui-dashboard-laravel",
      isOpen: false,
      sidebarColors: [
        { color: "yellow", active: false },
        { color: "blue", active: false },
        { color: "green", active: false },
        { color: "orange", active: false },
        { color: "black", active: true },
        { color: "red", active: false },
      ],
    };
  },
  methods: {
    toggleDropDown() {
      this.isOpen = !this.isOpen;
    },
    closeDropDown() {
      this.isOpen = false;
    },
    toggleList(list, itemToActivate) {
      list.forEach((listItem) => {
        listItem.active = false;
      });
      itemToActivate.active = true;
    },
    updateValue(name, val) {
      this.$emit(`update:${name}`, val);
    },
    changeSidebarBackground(item) {
      this.$emit("update:color", item.color);
      this.toggleList(this.sidebarColors, item);
    },
  },
};
</script>
<style>
.centered-row {
  display: flex;
  height: 100%;
  align-items: center;
}

.button-container .btn {
  margin-right: 10px;
}

.centered-buttons {
  display: flex;
  justify-content: center;
}
</style>
