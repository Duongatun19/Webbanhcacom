import {HTTP} from '../../core/plugins/http'


export const saveLanguage = (context,opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/language/saveLanguage',opt).then(response => {
            context.commit('GET_LANGUAGE_STATIC',response.data)
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const listLanguage = ({commit},opt) => {
    return new Promise((resolve, reject)=> {
        HTTP.post('/api/language/searchLanguage',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const detailLanguage = ({commit},opt) => {
    return new Promise((resolve, reject)=> {
        HTTP.post('/api/language/detailLanguage',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
}
export const destroyLanguage = ({commit},opt) => {
    return new Promise((resolve, reject)=> {
        HTTP.get('/api/language/deleteLanguage/'+ opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
}
export const getListLanguageStatic = ({ commit },opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/language/searchLanguageStatic',opt).then(response => {
            console.log(response.data)
            return resolve(response.data);
        }).catch(err => {
            return reject(err);
        });
    })
};
export const saveLanguageStatic = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/language/saveLanguageStatic',opt).then(response => {
            return resolve(response.data);
        }).catch(err => {
            return reject(err);
        });
    })
}
export const saveLanguageStaticByLang = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/language/saveLanguageStaticByLang',{static: opt }).then(response => {
            return resolve(response.data);
        }).catch(err => {
            return reject(err);
        });
    })
}