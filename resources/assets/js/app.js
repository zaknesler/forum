import './bootstrap';
import VueAutosize from './classes/vue-autosize';

import AvatarDelete from './components/AvatarDelete.vue';
import TopicDelete from './components/TopicDelete.vue';
import PostDelete from './components/PostDelete.vue';
import Logout from './components/Logout.vue';

Vue.component('avatar-delete', AvatarDelete);
Vue.component('topic-delete', TopicDelete);
Vue.component('post-delete', PostDelete);
Vue.component('logout', Logout);

Vue.use(VueAutosize);

const app = new Vue({
    el: '#root',

    data: {
        responsiveNavVisible: false
    }
});
