import {HTTP} from '../../core/plugins/http'
import CONSTANTS from '../../core/utils/constants';


export const addBannerads = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/createAdsbanner',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const listBannerads = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/listAdsbanner',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};

export const deleteBannerads = ({commit}, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/deleteAdsbanner/'+opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
}
export const detailBannerads = ({commit}, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/editAdsbanner/'+ opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
}