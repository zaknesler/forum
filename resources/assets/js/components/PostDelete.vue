<template>
    <a href="#" @click.prevent="deletePost" :class="classes"><slot>Delete</slot></a>
</template>

<script>
    export default {
        props: ['topic', 'post', 'classes'],

        methods: {
            deletePost() {
                this.$http
                    .delete('/topics/' + this.topic + '/posts/' + this.post)
                    .then((response) => {
                        window.location.replace(response.data.redirect_url);
                    });
            }
        }
    }
</script>
