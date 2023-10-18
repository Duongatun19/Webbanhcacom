import Vue from 'vue'
import Vuex from 'vuex'
import { app } from '../app'

var modules = {};
var context = require.context(".", true, /store\.js$/);

context.keys().forEach(function (key) {
    var m = key.replace('./', '').replace('/store.js', '');
    modules[m] = context(key).default;
});

Vue.use(Vuex);

const store = new Vuex.Store({
    modules: modules
});

export default store;