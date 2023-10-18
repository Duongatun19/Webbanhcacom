import Vue from 'vue';
import { mapGetters } from 'vuex';
let isFirstLoad = false;
Vue.mixin({
    computed: {
        ...mapGetters(['appSettings'])
    },
    methods: {
        getStorageUrl(val) {
            if (val) {
                if (val.startsWith('http'))
                    return val;
                return this.appSettings.storageDomain + val;
            }
            return val;
        },
        removeStorageUrl(val) {
            if (val) {
                return val.replace(this.appSettings.storageDomain, '');
            }
            return val;
        }
    }
});
