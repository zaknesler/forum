import './bootstrap';

import VueAutosize from './classes/vue-autosize';

import TextAreaAutosizeComponent from './components/TextAreaAutosize.vue';
import AvatarDeleteComponent from './components/AvatarDelete.vue';
import TopicDeleteComponent from './components/TopicDelete.vue';
import PostDeleteComponent from './components/PostDelete.vue';
import LogoutComponent from './components/Logout.vue';

Vue.component('textarea-autosize', TextAreaAutosizeComponent);
Vue.component('avatar-delete', AvatarDeleteComponent);
Vue.component('topic-delete', TopicDeleteComponent);
Vue.component('post-delete', PostDeleteComponent);
Vue.component('logout', LogoutComponent);

Vue.use(VueAutosize);

const app = new Vue({
    el: '#root',

    data: {
        responsiveNav: false
    }
});
