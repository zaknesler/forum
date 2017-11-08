<template>
    <a :href="path" :class="classes" @click.prevent="logout"><slot>Logout</slot></a>
</template>

<script>
    export default {
        props: [
            'path',
            'classes'
        ],

        methods: {
            logout () {
                this.$http
                    .post(this.path)
                    .then((response) => {
                        window.location.replace(response.data.redirect_url);
                    });
            }
        }
    }
</script>
