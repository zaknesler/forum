import './bootstrap';
import VueAutosize from './classes/vue-autosize';

Vue.component('topic-delete', require('./components/TopicDelete.vue'));

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
                    location.reload();
                });
        }
    }
});
