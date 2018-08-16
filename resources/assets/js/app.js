// Bootsrap Settings
require('./bootstrap');

// Vue Init
window.Vue = require('vue');

// Vuesax
import ElementUI from 'element-ui';

//Vuesax styles
import 'element-ui/lib/theme-chalk/index.css';

// Vuesax Init
Vue.use(ElementUI);
// End Vuesax

// Bootstrap-vue
import BootstrapVue from 'bootstrap-vue'

// Bootstrap-vue Init
Vue.use(BootstrapVue);
// End Bootstrap-vue

// Login Compoenent
Vue.component('login', require('./components/auth/Login'));

// Cart Menu Component
Vue.component('cart-menu', require('./components/cart/CartMenu'));

// Prosucts Filter Component
Vue.component('product-sort', require('./components/products/ProductsSort'));

// Bulveyz Select
Vue.component('bulveyz-select', require('./components/select/BulveyzSelect'));
Vue.component('bulveyz-select-option', require('./components/select/BulveyzSelectOption'));

// Render Compoenents
const app = new Vue({
  el: '#app'
});
