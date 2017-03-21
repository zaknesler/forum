import './bootstrap';

Vue.component('topics', require('./components/Topics.vue'));

const app = new Vue({
    el: '#root',

    methods: {
        logout() {
            this.$http
                .post('/logout')
                .then((response) => {
                    location.reload();
                });
        }
    }
});
