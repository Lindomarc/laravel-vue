/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


import Vue from 'vue'
import {PaginationPlugin, BPagination,BootstrapVue, IconsPlugin} from 'bootstrap-vue'
// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import VueAdminLte from '@cookieseater/vue-adminlte3';

import Form from 'vform'
import {AlertError, HasError} from 'vform/src/components/bootstrap4'
import 'selectize/dist/css/selectize.css'
import VSelectize from '@isneezy/vue-selectize'
import VueProgressBar from 'vue-progressbar'

/**
 * Routes imports and assigning
 */
import router from './routes/index.js';

// window.Vue = require('vue').default;

require('./bootstrap');

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)
Vue.use(VueAdminLte, {/* options */});

window.Form = Form;

Vue.component(HasError.name,HasError);
Vue.component(AlertError.name,AlertError);

// import vSelect from 'vue-select'
// Vue.component('v-select', vSelect)
// import 'vue-select/dist/vue-select.css';
// const selectize = require('vue-selectize');
Vue.component('v-selectize', VSelectize);


Vue.use(VueProgressBar, {
    color: 'green',
    failedColor: 'red'
})


// Routes End

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue({
    el: '#app',
    router
});
