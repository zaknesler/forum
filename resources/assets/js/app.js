import './bootstrap';

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
