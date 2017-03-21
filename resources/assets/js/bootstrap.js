import Vue from 'vue';
import axios from 'axios';

window.Vue = Vue;

Vue.prototype.$http = axios;

Vue.prototype.$http.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};
