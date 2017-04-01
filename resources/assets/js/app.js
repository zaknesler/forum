import './bootstrap';
import VueAutosize from './classes/vue-autosize';

Vue.component('topic-delete', require('./components/TopicDelete.vue'));
Vue.component('post-delete', require('./components/PostDelete.vue'));

Vue.use(VueAutosize);

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
                    window.location.replace(response.data.redirect_url);
                });
        }
    }
});
