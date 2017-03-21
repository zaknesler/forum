<template>
    <div>
        <div v-show="topics.length" class="list-group">
            <div v-for="topic in topics" class="list-group-item">
                <strong><a :href="topic.uri">{{ topic.title }}</a></strong>
                <br />
                by <a href="#">{{ topic.user.data.username }}</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                topics: []
            }
        },

        mounted() {
            this.getTopics();
        },

        methods: {
            getTopics() {
                this.$http
                    .get('/api/topics')
                    .then((response) => {
                        this.topics = response.data.data;
                    });
            }
        }
    }
</script>
