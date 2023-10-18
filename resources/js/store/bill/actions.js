import {HTTP} from '../../core/plugins/http'
import CONSTANTS from '../../core/utils/constants';


export const addBill = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/bill/add',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const draftBill = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/bill/draft',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const detailBill = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/bill/detail/'+ opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const changeStatus = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/bill/change-status', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const deleteBill = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/bill/delete/'+ opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};