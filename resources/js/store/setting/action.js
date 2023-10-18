import {HTTP} from '../../core/plugins/http'
import CONSTANTS from '../../core/utils/constants';


export const getSetting = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/website/setting').then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const postSetting = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/website/save-setting',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
