/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


import Vue from 'vue'
import {PaginationPlugin, BPagination,BootstrapVue, IconsPlugin} from 'bootstrap-vue'
import store from './store'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import Form from 'vform'
import {AlertError, HasError} from 'vform/src/components/bootstrap4'
import 'selectize/dist/css/selectize.css'
import VSelectize from '@isneezy/vue-selectize'
import VueProgressBar from 'vue-progressbar'
import App from './App'

/**
 * Routes imports and assigning
 */
import router from './router';

// window.Vue = require('vue').default;

require('./bootstrap');

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

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




new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App)
})
