var App = httpVueLoader('./vue/container/app.vue');
var Blank = httpVueLoader('./vue/page/blank.vue');
var BusinessAccounts = httpVueLoader('./vue/page/BusinessAccounts.vue');
var AdAccounts = httpVueLoader('./vue/page/AdAccounts.vue');
var RefPrefix = httpVueLoader('./vue/page/RefPrefix.vue');
var Category = httpVueLoader('./vue/page/category.vue');
var Settings = httpVueLoader('./vue/page/Settings.vue');
var Single = httpVueLoader('./vue/page/single.vue');
var Compare = httpVueLoader('./vue/page/compare.vue');
var Classified = httpVueLoader('./vue/page/classified.vue');

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
        return {};
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
            let data = localStorage.getItem('userData') ? JSON.parse(localStorage.getItem('userData')) : {}
            if (data.api_token) {
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
        get(url, cb) {
            fetch(url, this.getHeader())
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
                    //"Authorization": this.getToken(),
                    Accept: 'application/json, application/xml, text/plain, text/html, *.*'
                }
            };
        },
        postHeader(data = {}) {
            return {
                headers: {
                    //"Authorization": this.getToken(),
                    Accept: 'application/json, application/xml, text/plain, text/html, *.*',
                    'Content-Type': 'application/json'
                },
                credentials: 'omit',
                method: 'POST',
                body: JSON.stringify(data)
            };
        },
        getToken() {
            return 'Bearer ' + JSON.parse(localStorage.getItem('api_token'));
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
        path: '/settings',
        name: 'Settings',
        component: Settings
    },
    {
        path: '/ad-accounts',
        name: 'AdAccounts',
        component: AdAccounts
    },
    {
        path: '/compare/:itemId?',
        name: 'Compare',
        component: Compare
    },
    {
        path: '/classified/:itemId?',
        name: 'Classified',
        component: Classified
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
