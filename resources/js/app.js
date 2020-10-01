import Vue from 'vue'
window.axios = require('axios');
import router from './routes';
import Notifications from 'vue-notification';
import Multiselect from 'vue-multiselect'

// register globally
Vue.component('multiselect', Multiselect)


window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.withCredentials = true;
window.axios.defaults.baseURL = process.env.APP_URL;

Vue.use(Notifications)

Vue.component("admin-index", require("./components/admin/AdminIndex").default);

const app = new Vue({
    el: "#app",
    router
});
