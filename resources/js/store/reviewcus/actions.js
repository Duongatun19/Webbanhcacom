import {HTTP} from '../../core/plugins/http'
import CONSTANTS from '../../core/utils/constants';


export const addReviewCus = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/reviewCus/create',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const listReviewCus = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/reviewCus/list',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};

export const deleteReviewCus = ({commit}, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/reviewCus/delete/'+opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
}
export const detailReviewCus = ({commit}, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/reviewCus/edit/'+ opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
}