import {HTTP} from '../../core/plugins/http'
import CONSTANTS from '../../core/utils/constants';


export const listCate = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/product/category/list',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};

export const destroyCate  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/product/category/delete/'+ opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};

export const getInfoCate  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/product/category/edit/'+ opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};

export const saveCategory = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/product/category/add',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};