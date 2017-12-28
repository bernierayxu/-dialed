
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('inputComponent', require('./components/base/InputComponent.vue'));
Vue.component('selectComponent', require('./components/base/SelectComponent.vue'));


Vue.component('users', require('./components/UsersComponent.vue'));
Vue.component('paginate', require('vuejs-paginate'));
import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);

import Notifications from 'vue-notification';
Vue.use(Notifications);

import VeeValidate from 'vee-validate';
Vue.use(VeeValidate);

const app = new Vue({
    el: '#app'
});
