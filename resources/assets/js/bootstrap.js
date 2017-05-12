import Vue from 'vue';
import axios from 'axios';

window.Vue = Vue;

Vue.prototype.$http = axios;

Vue.prototype.$http.defaults.headers.common = {
    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]'),
    'X-Requested-With': 'XMLHttpRequest'
};
