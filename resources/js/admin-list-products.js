window.Vue = require('vue');
Vue.component('admin-list-products', require('./components/admin/products/index').default);
new Vue({
    el: '#app'
});

