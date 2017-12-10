<template>
    <textarea type="text" :class="classes" v-autosize v-model="text"></textarea>
</template>

<script>
    export default {
        props: ['classes', 'value'],

        data () {
            return {
                text: this.value
            }
        }
    }
</script>
