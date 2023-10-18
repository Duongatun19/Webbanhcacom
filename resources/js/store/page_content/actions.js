import {HTTP} from '../../core/plugins/http'
import CONSTANTS from '../../core/utils/constants';


export const savePageContent = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/page_content/create',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const listPageContent = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/page_content/list',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const getInfoPagecontent  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/page_content/edit/'+ opt.quiz_id + '/' + opt.language).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const deletePageContent  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/page_content/delete/'+ opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const listMessContact = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/messcontact/list',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const deleteMessContact = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/messcontact/delete/' + opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};