import {HTTP} from '../../core/plugins/http'
import CONSTANTS from '../../core/utils/constants';


export const listProduct = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/product/list',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const listProductBrand = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/product/product_brand/list',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const editProductBrand = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/product/product_brand/edit/' +opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const saveProductBrand = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/product/product_brand/add' ,opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const deleteProductBrand = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/product/product_brand/delete/' +opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const listProductCombo = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/product/product_combo/list',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const editProductCombo = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/product/product_combo/edit/' +opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const saveProductCombo = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/product/product_combo/add' ,opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const deleteProductCombo = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/product/product_combo/delete/' +opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const deleteId = ({commit},opt) => {
    console.log(opt);
    return new Promise((resolve, reject) => {
        HTTP.get('/api/product/delete/'+ opt.id_item).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};

export const editId = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/product/edit/'+ opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};

export const saveProduct = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/product/create',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const changeComboId = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/product/change-combo/' +opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
