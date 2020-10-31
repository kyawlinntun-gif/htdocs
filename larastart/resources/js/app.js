require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'

Vue.use(VueRouter)

// Component
const Dashboard = require('./components/Dashboard.vue').default;
const Profile = require('./components/Profile.vue').default;
const Users = require('./components/Users.vue').default;
const Developer = require('./components/Developer.vue').default;

const routes = [{
        path: '/dashboard',
        component: Dashboard
    },
    {
        path: '/profile',
        component: Profile
    },
    {
        path: '/users',
        component: Users
    },
    {
        path: '/developer',
        component: Developer
    }
]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})

import { Form, HasError, AlertError } from 'vform'

window.Form = Form

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.filter('capitalize', function (value) {
    if (!value) return ''
    value = value.toString()
    return value.charAt(0).toUpperCase() + value.slice(1)
})

import moment from 'moment';

Vue.filter('humanDate', function (value) {
    if (!value) return ''
    value = value.toString()
    return moment(value).format('MMMM Do YYYY');
})

import VueProgressBar from 'vue-progressbar'

Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
})

// ES6 Modules or TypeScript
import Swal from 'sweetalert2'
window.Swal = Swal

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

window.Toast = Toast
  
window.Fire = new Vue();

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);


const app = new Vue({
    el: '#app',
    router,
    computed: {
        currentPage() {
            return this.$route.path;
        }
    },
});
