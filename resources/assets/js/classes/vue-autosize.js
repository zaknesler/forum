import autosize from 'autosize';

export default {
    install: function(Vue, options) {

        Vue.directive('autosize', {
            bind(el) {
                Vue.nextTick(function() {
                    autosize(el);
                });
            },
            update(el) {
                Vue.nextTick(function() {
                    autosize.update(el);
                });
            },
            unbind(el) {
                autosize.destroy(el);
            }
        });
    }
};
