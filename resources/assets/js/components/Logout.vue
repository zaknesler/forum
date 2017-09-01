<template>
    <a :href="path" @click.prevent="logout"><slot>Logout</slot></a>
</template>

<script>
    export default {
        props: [
            'path'
        ],

        methods: {
            logout () {
                this.$http
                    .post(this.path)
                    .then((response) => {
                        window.location.replace(response.data.redirect_uri);
                    });
            }
        }
    }
</script>
