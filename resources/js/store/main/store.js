import * as actions from './actions'
import CONSTANTS from '../../core/utils/constants';


const store = {
    state: {
        loading:false
    },

    mutations: {
       SET_LOADING(state, bol){
            state.loading = bol;
       }
    },
    actions,
    getters: {
        loading : state => state.loading
    }
};

export default store;
