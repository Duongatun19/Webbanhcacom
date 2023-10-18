import * as actions from './actions'
import CONSTANTS from '../../core/utils/constants';

// let initUser = null;
// if (typeof (localStorage) !== 'undefined') {
//     try {
//         initUser = JSON.parse(localStorage.getItem(CONSTANTS.CURRENT_USER) || null);
//     } catch (e) {

//     }
// }

const store = {
    state: {
        token: localStorage.getItem(CONSTANTS.ACCESS_TOKEN) || null,
        isLoggedIn: false,
        currentUser:"",
        userID:0,
        unreadNotify:[]
    },

    mutations: {
        RETRIEVE_TOKEN(state, token) {
            state.token = token
        },
        DESTROY_TOKEN(state) {
            state.token = null
        },
        LOGGED_IN (state, payload){
            state.isLoggedIn = payload != null;
        },
        CURREN_USER(state, payload){
            state.currentUser = payload;
        },
        LOGGED_IN_ERROR: (state, payload) => {

        },
        USER_ID:(state, payload) => {
            state.userID = payload;
        },
        UNREAD_NOTIFY:(state, payload)=>{
            state.unreadNotify = payload;
        }
    },
    actions,
    getters: {
        isLoggedIn(state) {
            return state.token !== null
        },
        userId(state){
            return state.userID
        }
    }
};

export default store;
