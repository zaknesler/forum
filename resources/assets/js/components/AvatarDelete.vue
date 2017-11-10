<template>
    <a href="#" :class="classes" @click.prevent="deleteAvatar"><slot>Delete Avatar</slot></a>
</template>

<script>
    export default {
        props: ['classes'],
        methods: {
            deleteAvatar() {
                this.$http
                    .delete('/settings/avatar')
                    .then((response) => {
                        window.location.replace(response.data.redirect_url);
                    });
            }
        }
    }
</script>
