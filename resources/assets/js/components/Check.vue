<template>
    <span style="cursor: pointer" v-on:click="toggle">
        {{["\u2716", "\u2714", "N/A"][value]}}
    </span>
</template>

<script>
    export default {
        data: function () {
            var model = this.$parent.$attrs.model;
            window.asd = model;
            return {
                value: 0
            };
        },
        props: [
            'name',
        ],
        methods: {
            toggle: function () {
                this.value = (this.value + 1) % 3;
            }
        },
        watch: {
            value: function () {
                var model = this.$parent.$attrs.model;
                model[this.name] = this.value;
            }
        },
        mounted() {
        }
    }
</script>
