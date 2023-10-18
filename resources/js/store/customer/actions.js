// import axios from '../../core/plugins/http'
import CONSTANTS from '../../core/utils/constants';
import {HTTP} from '../../core/plugins/http'

export const listCustomer  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/customer/list', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const addCustomer  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/customer/add', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const getEditCustomer  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/customer/edit/'+opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const activeCustomer  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/customer/active', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const disableAccount  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/customer/changeStatus', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const EditProfile  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/customer/edit-profile', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};