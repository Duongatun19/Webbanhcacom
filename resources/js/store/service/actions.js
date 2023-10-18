import {HTTP} from '../../core/plugins/http'
import CONSTANTS from '../../core/utils/constants';


export const addService = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/service/create',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const listService = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/service/list',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};

export const deleteService = ({commit}, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/service/delete/'+opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
}
export const detailService = ({commit}, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/service/edit/'+ opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
}