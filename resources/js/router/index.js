import Vue from 'vue';
import VueRouter from 'vue-router';

const _import = require('./_import_sync');
import store from '../store/index';
import CONSTANTS from '../core/utils/constants';
import ENUM from "../../config/enum";

Vue.use(VueRouter); 
let _routers = [
            {
                name:'login',
                path:'/login',
                component: _import('auth/login'),
                meta:{
                    requiresVisitor: true,
                }
            },
            {
                name: 'register',
                path: '/register',
                component: _import('auth/register'),
                meta: {
                    requiresVisitor: true,
                }
            },
            {
                name: 'home',
                path: '/',
                component: _import('home'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'list_category',
                path: '/product/category',
                component: _import('cate/list'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'add_category',
                path: '/product/category/add',
                component: _import('cate/add'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'edit_category',
                path: '/product/category/edit/:id',
                component: _import('cate/edit'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'list_type_cate',
                path: '/product/type',
                component: _import('typeProduct/list'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'edit_type_cate',
                path: '/product/type/edit/:quiz_cate/:language',
                component: _import('typeProduct/edit'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'add_type_cate',
                path: '/product/type/add',
                component: _import('typeProduct/add'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'listProductBrands',
                path: '/product-brands',
                component: _import('product-brand/list'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'createEditProductBrands',
                path: '/product-brands/edit/:id',
                component: _import('product-brand/addEdit'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'listProductCombo',
                path: '/product-combo',
                component: _import('product-combo/list'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'createEditProductCombo',
                path: '/product-combo/edit/:id',
                component: _import('product-combo/addEdit'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'listProduct',
                path: '/product',
                component: _import('products/list'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'edit_product',
                path: '/product/edit/:id_construction',
                component: _import('products/edit'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'createProduct',
                path: '/product/create',
                component: _import('products/add'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'listBlogs',
                path: '/blogs',
                component: _import('blogs/list'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'addBlogs',
                path: '/blog/add',
                component: _import('blogs/add'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'editBlog',
                path: '/blog/edit/:id',
                component: _import('blogs/edit'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'listCateBlog',
                path: '/blog/category',
                component: _import('blogs/category/list'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'editCateBlog',
                path: '/blog/category/edit/:id',
                component: _import('blogs/category/edit'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'editTypeBlog',
                path: '/blog/type/edit/:id',
                component: _import('blogs/type/edit'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'video',
                path: '/video',
                component: _import('website/video'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'listTypeBlog',
                path: '/blog/type',
                component: _import('blogs/type/list'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'language',
                path: '/language',
                component: _import('language/language'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'languageKeyword',
                path: '/language/keyword',
                component: _import('language/keyword'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'pageContent',
                path: '/pagecontent',
                component: _import('pagecontent/list'),
                meta: {
                    requiresAuth: true,
                }
            },
             {
                name: 'pageContentAdd',
                path: '/pagecontent/add',
                component: _import('pagecontent/add'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'pageContentEdit',
                path: '/pagecontent/edit/:quiz_id/:language',
                component: _import('pagecontent/edit'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'banner',
                path: '/banner',
                component: _import('website/banner'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'founder',
                path: '/founder',
                component: _import('website/founder'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'partner',
                path: '/partner',
                component: _import('website/partner'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'prize',
                path: '/prize',
                component: _import('website/prize'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'setting',
                path: '/setting',
                component: _import('website/setting'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'customer',
                path: '/customer',
                component: _import('customer/list'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'customerAdd',
                path: '/customer/add',
                component: _import('customer/add'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'customerEdit',
                path: '/customer/edit/:id_customer',
                component: _import('customer/edit'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'billAdd',
                path: '/bill/add',
                component: _import('bill/add'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'billDetail',
                path: '/bill/detail/:code_bill',
                component: _import('bill/detail'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'billDraft',
                path: '/bill/draft',
                component: _import('bill/draft'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'billPaymented',
                path: '/bill/paymented',
                component: _import('bill/paymented'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'billUnPayment',
                path: '/bill/Unpayment',
                component: _import('bill/unpayment'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'listPromotion',
                path: '/promotion',
                component: _import('promotion/list'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'addPromotion',
                path: '/promotion/add',
                component: _import('promotion/add'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'editPromotion',
                path: '/promotion/edit/:id',
                component: _import('promotion/edit'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'listMessContact',
                path: '/messcontact',
                component: _import('messcontact/list'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'listService',
                path: '/service',
                component: _import('service/list'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'addService',
                path: '/service/add',
                component: _import('service/add'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'editService',
                path: '/service/edit/:id',
                component: _import('service/edit'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'listReviewCus',
                path: '/reviewCus',
                component: _import('reviewcus/list'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'addReviewCus',
                path: '/reviewCus/add',
                component: _import('reviewcus/add'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'editReviewCus',
                path: '/reviewCus/edit/:id',
                component: _import('reviewcus/edit'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'list_type_two',
                path: '/product/typetwo',
                component: _import('typetwo/list'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'add_type_two',
                path: '/product/typetwo/add',
                component: _import('typetwo/add'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'edit_type_two',
                path: '/product/typetwo/edit/:id',
                component: _import('typetwo/edit'),
                meta: {
                    requiresAuth: true,
                }
            },
            
            {
                name: 'listBannerads',
                path: '/bannerads',
                component: _import('bannerads/list'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'addBannerads',
                path: '/bannerads/add',
                component: _import('bannerads/add'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                name: 'editBannerads',
                path: '/bannerads/edit/:id',
                component: _import('bannerads/edit'),
                meta: {
                    requiresAuth: true,
                }
            },
];
const router = new VueRouter({
    errorHandler(to, from, next, error) {
    },
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition
        } else {
            return {x: 0, y: 0}
        }
    },
    routes: _routers
});
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!store.getters.isLoggedIn) {
            next({
                name: 'login'
            })
        } else {
            next()
        }
    } else if (to.matched.some(record => record.meta.requiresVisitor)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (store.getters.isLoggedIn) {
            next({
                name: 'home'
            })
        } else {
            next()
        }
    } else {
        next() // make sure to always call next()!
    }
})

export default router;
