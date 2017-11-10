<template>
    <a href="#" @click.prevent="deleteTopic" :class="classes"><slot>Delete</slot></a>
</template>

<script>
    export default {
        props: ['topic', 'classes'],

        methods: {
            deleteTopic() {
                this.$http
                    .delete('/topics/' + this.topic)
                    .then((response) => {
                        window.location.replace(response.data.redirect_url);
                    });
            }
        }
    }
</script>
