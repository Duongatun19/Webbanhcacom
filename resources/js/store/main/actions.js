// import axios from '../../core/plugins/http'
import CONSTANTS from '../../core/utils/constants';
import {HTTP} from '../../core/plugins/http'

export const loadings = (context, bol) => {
        context.commit('SET_LOADING', bol);
};

export const saveBanner  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/website/banner', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const listBanner  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/website/list-banner', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const savePartner  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/website/partner', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const listPartner  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/website/list-partner', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};

export const listPrize  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/website/list-prize', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const savePrize  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/website/prize', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const listVideo  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/website/list-video', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const saveVideo  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/website/video', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const getDataChart = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/home/chart', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
}
export const getRevenue = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/home/revenue').then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
}
export const getStatisticalBill = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/home/statistical-bill').then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
}
export const getTrafficPage = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/home/analytics').then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
}
export const searchNavbar = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/home/search_navbar',opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
}
export const saveFounder  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/website/founder', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
export const listFounder  = ({commit},opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/website/list-founder', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        })
    });
};
