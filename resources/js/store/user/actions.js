import {HTTP} from '../../core/plugins/http'
import CONSTANTS from '../../core/utils/constants';

export const destroyToken = (context, opts) => {
    if(context.getters.isLoggedIn){
        return new Promise((resolve, reject) => {
            HTTP.post('/api/logout').then(response => {
                localStorage.removeItem(CONSTANTS.ACCESS_TOKEN);
                context.commit('DESTROY_TOKEN');
                return resolve(response);
            }).catch(error => {
                localStorage.removeItem(CONSTANTS.ACCESS_TOKEN);
                context.commit('DESTROY_TOKEN');
                return reject(error);
            })
        })
    }
    
};
export const retrieveToken = ({commit}, opts) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/login',opts).then((response) => {
            const token = response.data.data.access_token;
            commit('RETRIEVE_TOKEN', token);
            commit("CURREN_USER", response.data.user);
            commit("LOGGED_IN", true);
            if (typeof (localStorage) !== 'undefined') {
                localStorage.setItem(CONSTANTS.ACCESS_TOKEN, token);
            }
            return resolve(response);
        }).catch(error => {
            commit("LOGGED_IN_ERROR");
            return reject(error)
        })
    })
};
export const getNotification = ({commit}, opts) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/getNotification').then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    })
};
export const profileUserCms = ({commit}, opts) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/profile').then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    })
};


