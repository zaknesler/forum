<template>
    <input type="button" class="button button-large button-danger button-inverse" @click.prevent="deletePost" value="Delete" />
</template>

<script>
    export default {
        props: ['topic', 'post'],

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
