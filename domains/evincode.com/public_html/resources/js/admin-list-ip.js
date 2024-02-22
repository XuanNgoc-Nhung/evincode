window.Vue = require('vue');
Vue.component('admin-list-ip', require('./components/admin/ipConfig/index').default);
new Vue({
    el: '#app'
});

