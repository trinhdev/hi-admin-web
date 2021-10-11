/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

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

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('check-otp-component', require('./components/hicustomer/CheckOTP.vue').default);
Vue.component('manage-otp-component', require('./components/hicustomer/ManageOTP.vue').default);
Vue.component('role-management', require('./components/user-management/RoleList.vue').default);
Vue.component('permission-list', require('./components/user-management/PermissionList.vue').default);
Vue.component('role-detail', require('./components/user-management/RoleDetail.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import vuetify from 'vuetify';
const app = new Vue({
    vuetify,
    el: '#app'
});
app.$mount('#app');