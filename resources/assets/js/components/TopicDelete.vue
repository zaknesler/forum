<template>
    <input type="button" class="button button-large button-danger button-inverse" @click.prevent="deleteTopic" value="Delete" />
</template>

<script>
    export default {
        props: ['topic'],

        methods: {
            deleteTopic() {
                this.$http
                    .delete('/topics/' + this.topic)
                    .then((response) => {
                        window.location.replace('/');
                    });
            }
        }
    }
</script>
