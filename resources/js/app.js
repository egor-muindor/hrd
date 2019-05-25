require('./bootstrap');

window.Vue = require('vue');

import VueResource from 'vue-resource'
import Croppa from 'vue-croppa';
import 'vue-croppa/dist/vue-croppa.css'
import VueTheMask from 'vue-the-mask'

Vue.use(Croppa);
Vue.use(VueTheMask);
Vue.use(VueResource);
Vue.component('apps', require('./components/App').default);

const app = new Vue({
    el: '#app'
});
