import {HTTP} from '../../core/plugins/http'
import CONSTANTS from '../../core/utils/constants';


export const addBlog = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/blog/create',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const listBlog = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/blog/list',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const destroyCateBLog  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/blog/category/delete/'+ opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const deleteBlog = ({commit}, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/blog/delete/'+opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
}
export const detailBlog = ({commit}, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/blog/edit/'+ opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
}
export const listCateBlog = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/blog/category/list',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};

export const destroyCateBlog  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/blog/category/delete/'+ opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};

export const getInfoCateBlog  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/blog/category/edit/'+ opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};

export const saveCategoryBlog = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/blog/category/add',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const listTypelog = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/blog/type/list',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const saveTypeCateBlog = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/blog/type/add',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const getInfoTypeBlog  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/blog/type/edit/'+ opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const destroyTypeBLog  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/blog/type/delete/'+ opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const findTypeCateBlog = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/blog/type/findtype/'+ opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};