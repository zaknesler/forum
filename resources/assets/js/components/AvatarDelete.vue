<template>
    <a href="#" @click.prevent="deleteAvatar">Delete Avatar</a>
</template>

<script>
    export default {
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
