/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// Sweetalert2
// CommonJS
const Swal = require('sweetalert2');

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

// Progress bar
import VueProgressBar from 'vue-progressbar';

const options = {
    color: '#bffaf3',
    failedColor: '#874b4b',
    thickness: '5px',
    transition: {
      speed: '0.2s',
      opacity: '0.6s',
      termination: 300
    },
    autoRevert: true,
    location: 'left',
    inverse: false
}

Vue.use(VueProgressBar, options);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const axios = require('axios');

class EditItems{
    constructor() {
        this.items ={};
    }

    records(items)
    {
        this.items = items;
    }
}

class Items{
    constructor() {
        this.items = {};
    }

    records(items)
    {
        return this.items = items;
    }

    clear()
    {
        this.items = '';
    }
}

const app = new Vue({
    el: '#app',
    data: {
        item: {
            name: '',
            age: '',
            profession: ''
        },
        errors: false,
        items: new Items,
        editItems: new EditItems()
    },
    methods: {
        itemsCreated() {
            if (this.item.name == '' || this.item.age == '' || this.item.profession == '') {
                this.errors = true;
            } else {
                this.errors = false;

                axios.post('/storeItems', this.item)
                    .then(response => {
                        // console.log(response);
                        this.getItems();

                        this.item.name = '';
                        this.item.age= '';
                        this.item.profession = '';
                    })
                    .catch(errors => {
                        console.log(errors);
                    });
            }
            // alert('hello');
        },
        getItems() {
            axios.get('getItems')
                .then(response => {
                    // console.log(response.data);
                    // this.items = response.data;
                    this.items.records(response.data);
                })
                .catch(errors => {
                   console.log(errors);
                });
        },
        deleteItem(item) {

            //  start the progress bar
            this.$Progress.start();

            axios({
                method: 'delete',
                url: '/deleteItem',
                data: {
                    item
                }
            })
            .then(response => {
                Toast.fire({
                    icon: 'success',
                    title: 'Items was deleted successfully!'
                    })
                    
                this.getItems();

                //  finish the progress bar
                this.$Progress.finish();
            })
            .catch(errors => {
                console.log(errors);
            });
        },
        showModal(item)
        {
            $('#showModal').modal('show');
            this.editItems.records(item);
        },
        hideModal()
        {
            this.editItems.clear;
        },
        editStore()
        {
            //  start the progress bar
            this.$Progress.start();

            let editItems = this.editItems.items;

            axios({
                method: 'put',
                url: '/item/edit',
                data: {
                    editItems
                }
            })
            .then(response => {
                Toast.fire({
                    icon: 'success',
                    title: 'Items was editted successfully!'
                    })
                    
                this.getItems();
                console.log(response);

                //  finish the progress bar
                this.$Progress.finish();

                $('#showModal').modal('hide');
            })
            .catch(errors => {
                console.log(errors);
            });
        }
    },
    mounted() {
        this.getItems();
    }
});
