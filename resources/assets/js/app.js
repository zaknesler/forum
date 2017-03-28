import './bootstrap';

Vue.component('topic-delete', require('./components/TopicDelete.vue'));

const app = new Vue({
    el: '#root',

    data: {
        responsiveNavVisible: false,
    },

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
