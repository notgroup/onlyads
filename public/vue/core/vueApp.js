var App = httpVueLoader('./vue/container/app.vue');
var Blank = httpVueLoader('./vue/page/blank.vue');
var BusinessAccounts = httpVueLoader('./vue/page/BusinessAccounts.vue');
var AdAccounts = httpVueLoader('./vue/page/AdAccounts.vue');
var AdAccountDetail = httpVueLoader('./vue/page/AdAccountDetail.vue');


/* LIST */
var ProductList = httpVueLoader('./vue/page/ProductList.vue');
var UserList = httpVueLoader('./vue/page/UserList.vue');
var BlogManagment = httpVueLoader('./vue/page/BlogManagment.vue');
var CargoTracking = httpVueLoader('./vue/page/CargoTracking.vue');
var DomainManagment = httpVueLoader('./vue/page/DomainManagment.vue');
var ServerManagment = httpVueLoader('./vue/page/ServerManagment.vue');
var ProductGroupList = httpVueLoader('./vue/page/ProductGroupList.vue');
var OrderList = httpVueLoader('./vue/page/OrderList.vue');
var CustomerList = httpVueLoader('./vue/page/CustomerList.vue');
var ContentTypeList = httpVueLoader('./vue/page/ContentTypeList.vue');
var RoleList = httpVueLoader('./vue/page/RoleList.vue');




/* DETAILS */
var ProductDetail = httpVueLoader('./vue/page/ProductDetail.vue');
var OrderDetail = httpVueLoader('./vue/page/OrderDetail.vue');
var CustomerDetail = httpVueLoader('./vue/page/CustomerDetail.vue');
var ContenDetail = httpVueLoader('./vue/page/ContenDetail.vue');




/* Forms for Add */
var AddRole = httpVueLoader('./vue/page/AddRole.vue');
var AddUser = httpVueLoader('./vue/page/AddUser.vue');
var AddPayment = httpVueLoader('./vue/page/AddPayment.vue');
var AddContent = httpVueLoader('./vue/page/AddContent.vue');
var AddProduct = httpVueLoader('./vue/page/AddProduct.vue');
var AddProductGroup = httpVueLoader('./vue/page/AddProductGroup.vue');
var AddCustomer = httpVueLoader('./vue/page/AddCustomer.vue');
var AddOrder = httpVueLoader('./vue/page/AddOrder.vue');



var DbManagment = httpVueLoader('./vue/page/DbManagment.vue');
var LandingBuilder = httpVueLoader('./vue/page/LandingBuilder.vue');
var RefPrefix = httpVueLoader('./vue/page/RefPrefix.vue');
var Category = httpVueLoader('./vue/page/category.vue');
var Settings = httpVueLoader('./vue/page/Settings.vue');
var Single = httpVueLoader('./vue/page/single.vue');


var Header = httpVueLoader('./vue/components/theme/header.vue')
var Sidebar = httpVueLoader('./vue/components/theme/sidebar.vue')
var HeaderSort = httpVueLoader('./vue/components/theme/header-sort.vue')
var Footer = httpVueLoader('./vue/components/theme/footer.vue')
Vue.mixin({
    components: {
        'headersort': HeaderSort,
        'header-comp': Header,
        "footer-comp": Footer,
        "sidebar-comp": Sidebar
    },
    data() {
        return {
            entityTypes: {
                "4": "Ürünler",
                "33": "Siparişler",
                "34": "Müşteriler",
                "32": "Ürün Grupları",
            },
            showLog: 0,
            userData: {

            }
        };
    },
    computed: {
        compTest() {
            return 1;
        }
    },
    methods: {
        getLast() {
            this.get('//' + apiUrl + '/last10', (response) => {
            });
        },
        checkLogin() {
            let userData = localStorage.getItem('api_token') ? JSON.parse(localStorage.getItem('userData') || {}) : {}
            if (userData.api_token && localStorage.getItem('api_token')) {
                this.userData = userData
                return true;
            } else {
                window.location = '/login.html'
            }
        },
        /* API AREA */
        post(url, pdata, cb) {
            fetch(url, this.postHeader(pdata))
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    cb(data);
                });
        },
        get(url, cb, header = {}) {
            fetch(url, Object.assign(header, this.getHeader()))
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    cb(data);
                });
        },
        getHeader() {
            return {
                credentials: 'omit',
                method: 'GET',
                headers: {
                    "Authorization": this.getTokenBearer(),
                    Accept: 'application/json, application/xml, text/plain, text/html, *.*'
                }
            };
        },
        postHeader(data = {}) {
            return {
                headers: {
                    "Authorization": this.getTokenBearer(),
                    Accept: 'application/json, application/xml, text/plain, text/html, *.*',
                    'Content-Type': 'application/json'
                },
                credentials: 'omit',
                method: 'POST',
                body: JSON.stringify(data)
            };
        },
        getTokenBearer() {
            return 'Bearer ' + localStorage.getItem('api_token') || 0;
        },
        getToken() {
            return '' + localStorage.getItem('api_token') || '0';
        }
    }
});

var routes = [
    {
        path: '/',
        name: 'Dashboard',
        component: BusinessAccounts
    },
    {
        path: '/AddProduct',
        name: 'AddProduct',
        component: AddProduct
    },
    {
        path: '/AddContent/:contentTypeId',
        props: true,
        name: 'AddContent',
        component: AddContent
    },
    {
        path: '/AddUser/:userId?',
        props: true,
        name: 'AddUser',
        component: AddUser
    },
    {
        path: '/UserDetail/:userId?',
        props: true,
        name: 'UserDetail',
        component: AddUser
    },
    {
        path: '/AddContent/:contentTypeId/:primaryId',
        props: true,
        name: 'AddContent',
        component: AddContent
    },
    {
        path: '/AddProductGroup',
        props:true,
        name: 'AddProductGroup',
        component: AddProductGroup
    },
    {
        path: '/AddCustomer',
        props:true,
        name: 'AddCustomer',
        component: AddCustomer
    },
    {
        path: '/AddPayment',
        props:true,
        name: 'AddPayment',
        component: AddPayment
    },
    {
        path: '/AddOrder',
        props:true,
        name: 'AddOrder',
        component: AddOrder
    },
    {
        path: '/AddRole/:primaryId',
        props:true,
        name: 'AddRole',
        component: AddRole
    },
    {
        path: '/RoleList',
        props:true,
        name: 'RoleList',
        component: RoleList
    },
    {
        path: '/LandingBuilder',
        name: 'LandingBuilder',
        component: LandingBuilder
    },
    {
        path: '/category',
        name: 'category',
        component: Category
    },
    {
        path: '/business-accounts',
        name: 'BusinessAccounts',
        component: Blank
    },
    {
        path: '/ref-prefix',
        name: 'RefPrefix',
        component: RefPrefix
    },
    {
        path: '/Settings',
        name: 'Settings',
        component: Settings
    },
    {
        path: '/DomainManagment',
        name: 'DomainManagment',
        component: DomainManagment
    },
    {
        path: '/CargoTracking',
        name: 'CargoTracking',
        component: CargoTracking
    },
    {
        path: '/BlogManagment',
        name: 'BlogManagment',
        component: BlogManagment
    },
    {
        path: '/DbManagment',
        name: 'DbManagment',
        component: DbManagment
    },
    {
        path: '/ServerManagment',
        name: 'ServerManagment',
        props: true,
        component: ServerManagment
    },
    {
        path: '/ad-accounts',
        name: 'AdAccounts',
        component: AdAccounts
    },
    {
        path: '/ad-account-detail/:accountId',
        name: 'AdAccountDetail',
        props: true,
        component: AdAccountDetail
    },
    {
        path: '/ProductList',
        name: 'ProductList',
        props: true,
        component: ProductList
    },
    {
        path: '/ProductGroupList',
        name: 'ProductGroupList',
        props: true,
        component: ProductGroupList
    },
    {
        path: '/OrderList',
        name: 'OrderList',
        props: true,
        component: OrderList
    },
    {
        path: '/CustomerList',
        name: 'CustomerList',
        props: true,
        component: CustomerList
    },
    {
        path: '/ProductDetail/:primaryId',
        name: 'ProductDetail',
        props: true,
        component: ProductDetail
    },
    {
        path: '/OrderDetail/:primaryId',
        name: 'OrderDetail',
        props: true,
        component: OrderDetail
    },
    {
        path: '/CustomerDetail/:primaryId',
        name: 'CustomerDetail',
        props: true,
        component: CustomerDetail
    },
    {
        path: '/ContentTypeList/:typeId',
        name: 'ContentTypeList',
        props: true,
        component: ContentTypeList
    },
    {
        path: '/UserList',
        name: 'UserList',
        props: true,
        component: UserList
    },
    {
        path: '/ContenDetail/:contentTypeId/:primaryId',
        name: 'ContenDetail',
        props: true,
        component: AddContent
    }
];

var router = new VueRouter({
    //mode: 'history',
    routes: routes,
    scrollBehavior(to, from) {
        return {
            x: 0,
            y: 0
        };
    }
});

router.beforeEach((to, from, next) => {
    next();
});

router.afterEach((to, from) => { });
var vueApp = new Vue({
    el: "#app",
    router: router,
    template: "<App/>",
    data() {
        return {};
    },
    mixins: [],
    components: {
        App
    },
    beforeCreate() { },
    created() {
        this.$root.checkLogin();
    },
    mounted() {



    },
    methods: {}
});
