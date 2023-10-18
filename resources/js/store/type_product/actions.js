import {HTTP} from '../../core/plugins/http'
import CONSTANTS from '../../core/utils/constants';


export const listTypeCate = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/product/product_type/list',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};

export const destroyTypeCate  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/product/product_type/delete/'+ opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};

export const getInfoTypeCate  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/product/product_type/edit/'+ opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};

export const saveTypeCate = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/product/product_type/add',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const findTypeCate = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/product/product_type/findCateType/'+ opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};