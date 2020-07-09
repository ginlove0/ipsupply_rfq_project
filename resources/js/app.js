/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue'
import VueResource from 'vue-resource'
import VueRouter from 'vue-router'
// import router from './router'
require('./bootstrap');

window.Vue = require('vue');

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


// const createNewList = require('./pages/admin/InputListModel.vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */



Vue.use(VueResource)
Vue.use(VueRouter)

// const routers = [
//     {path: '/admin/createNewList', component: createNewList}
// ];
//
// const router = new VueResource({
//     routers
// })

Vue.component('create-new-btn', require('./components/CreateNewBtn.vue').default);
Vue.component('create-wtb-page', require('./pages/admin/CreateWtbPage').default);
Vue.component('collection-page', require('./pages/CollectionPage').default);

const app = new Vue({
    el: '#app'
});
