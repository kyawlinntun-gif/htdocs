require('./bootstrap');

window.Vue = require('vue');


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('admin-master', require('./components/admin/AdminMasterComponent.vue').default);

// Vue router
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import {routes} from "./routes";

const router = new VueRouter({
    routes // short for `routes: routes`
})

const app = new Vue({
    router,
    el: '#app',

});
