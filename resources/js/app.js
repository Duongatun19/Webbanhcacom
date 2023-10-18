require('./bootstrap');

window.Vue = require('vue');

import App from './components/App.vue';
import "./assets/css/demo.css";
import DashboardPlugin from './dashboard-plugin';
import Vue from 'vue';
import axios from 'axios'
import store from './store/index';
import router from './router';

import Vuelidate from 'vuelidate'
import ImageUpload from './components/layouts/upload_image'
import ToggleButton from 'vue-js-toggle-button'

import Vuesax from 'vuesax'
import 'vuesax/dist/vuesax.css'
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import 'material-icons/iconfont/material-icons.css';
import '@mdi/font/css/materialdesignicons.css';
import Notify from  '../../resources/js/mixin/notify';
import i18n from 'vue-i18n';
import locale from 'element-ui/lib/locale/lang/vi'

import VueFusionCharts from 'vue-fusioncharts';
import FusionCharts from 'fusioncharts';
import Charts from 'fusioncharts/fusioncharts.charts';
import helpers  from './help/helper.js'

//import the theme
import FusionTheme from 'fusioncharts/themes/fusioncharts.theme.fusion'
import VueAnalytics from 'vue-analytics'
Vue.use(VueAnalytics, {
    id: '208337958'
  })
const plugin = {
	install (Vue, options) {
        Vue.helpers = helpers
        Vue.prototype.$helpers = helpers
	}
};
Vue.use(plugin);
Vue.use(DashboardPlugin);
// register VueFusionCharts component
Vue.use(VueFusionCharts, FusionCharts, Charts, FusionTheme)
Vue.use(Vuesax)
Vue.use(ElementUI, { locale });
Vue.use(ToggleButton)
Vue.use(Vuelidate)
Vue.component('image-upload', ImageUpload);
Vue.mixin(Notify);
Vue.use(i18n);

const app = new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App)
});
if (!process.env.VUE_ENV)
    window.app = app;
export { app, router, store };