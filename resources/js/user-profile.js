window.Vue = require('vue');
Vue.component('user-profile', require('./components/user/profile').default);
new Vue({
    el: '#profile'
});

