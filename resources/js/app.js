
import './bootstrap';

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import TodoIndex from './components/todos/Index.vue'

const routes = [
	{ path: '/', component: TodoIndex },
]

const router = new VueRouter({
	routes, // short for `routes: routes`
	mode: 'history'
})

Vue.component('example-component', require('./components/ExampleComponent.vue').default);


const app = new Vue({
    el: '#app',
    router
});
