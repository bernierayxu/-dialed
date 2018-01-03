
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
Vue.component('userTypes', require('./components/UserTypesComponent.vue'));
Vue.component('unitOfMeasures', require('./components/UnitOfMeasureComponent.vue'));
Vue.component('styleTypes', require('./components/StyleTypeComponent.vue'));
Vue.component('styleLocations', require('./components/StyleLocationComponent.vue'));
Vue.component('sizes', require('./components/SizeComponent.vue'));
Vue.component('salesPersonTypes', require('./components/SalesPersonTypeComponent.vue'));
Vue.component('salesPersons', require('./components/SalesPersonComponent.vue'));
Vue.component('priceTypes', require('./components/PriceTypeComponent.vue'));
Vue.component('priceSteps', require('./components/PriceStepComponent.vue'));
Vue.component('priceOptions', require('./components/PriceOptionComponent.vue'));
Vue.component('prices', require('./components/PriceComponent.vue'));
Vue.component('organizationTypes', require('./components/OrganizationTypeComponent.vue'));
Vue.component('organizations', require('./components/OrganizationComponent.vue'));
Vue.component('lengths', require('./components/LengthComponent.vue'));
Vue.component('currencys', require('./components/CurrencyComponent.vue'));
Vue.component('contactTypes', require('./components/ContactTypeComponent.vue'));
Vue.component('componentTypes', require('./components/ComponentTypeComponent.vue'));

import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);


import VueGoodTable from 'vue-good-table';
Vue.use(VueGoodTable);

import Notifications from 'vue-notification';
Vue.use(Notifications);

import VeeValidate from 'vee-validate';
Vue.use(VeeValidate);

const app = new Vue({
    el: '#app',
    methods: {
        tests() {
            this.sidebarCollapse = !this.sidebarCollapse;
        },
    },
    data() {
    	return {
    		sidebarCollapse: false
    	}
    },
    computed: {
    	sidebarClass: function() {
    		return {
    			'col-sm-3': !this.sidebarCollapse,
    			'col-md-2': !this.sidebarCollapse,
    			'sidebar-collapse': this.sidebarCollapse,
    		}
    	},
    	contentClass: function() {
    		return {
    			'col-sm-9': !this.sidebarCollapse,
    			'col-sm-offset-3': !this.sidebarCollapse,
    			'col-md-10': !this.sidebarCollapse,
    			'col-md-offset-2': !this.sidebarCollapse,
    		}
    	}
    }
});
