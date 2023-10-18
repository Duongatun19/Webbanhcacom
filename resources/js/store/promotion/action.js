import {HTTP} from '../../core/plugins/http'
import CONSTANTS from '../../core/utils/constants';


export const addPromotion = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/promotion/create',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const listPromotion = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/promotion/list',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const deletePromotion = ({commit}, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/promotion/delete/'+opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
}
export const detailPromotion = ({commit}, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/promotion/edit/'+ opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
}
