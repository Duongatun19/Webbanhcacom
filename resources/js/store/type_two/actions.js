import {HTTP} from '../../core/plugins/http'
import CONSTANTS from '../../core/utils/constants';


export const listTypeTwo = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/product/type_two/list',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};

export const destroyTypeTwo  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/product/type_two/delete/'+ opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};

export const getInfoTypeTwo  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/product/type_two/edit/'+ opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};

export const saveTypeTwo = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/product/type_two/add',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const findTypeCateTwo = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/product/type_two/findCateType/'+ opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};