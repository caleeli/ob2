<template>
    <div class='input-group date'>
        <input type='text' v-model="innerValue" class="form-control" />
        <span class="input-group-addon" v-on:click="datepick">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
    </div>
</template>

<script>
    export default {
        props: {
            value: String
        },
        data: function () {
            return {
                innerValue: this.value
            };
        },
        methods: {
            datepick: function () {
                var self = this;
                Vue.nextTick(function () {
                    $(self.$el).datepicker({autoclose: true, format: 'yyyy-mm-dd', language: 'es'});
                    $(self.$el).datepicker('show');
                    $(self.$el).on("changeDate", function (e) {
                        self.innerValue = $(self.$el).find("input").val();
                    });
                });
            },
        },
        watch: {
            'innerValue': function (value) {
                this.$emit('input', value);
            },
            'value': function (value) {
                this.innerValue = value;
            }
        },
        updated: function () {
            var self = this;
            self.$nextTick(function () {
                $(self.$el).datepicker({autoclose: true, format: 'yyyy-mm-dd', language: 'es'});
                $(self.$el).datepicker('show');
                $(self.$el).on("changeDate", function (e) {
                    self.innerValue = $(self.$el).find("input").val();
                });
            });
        }
    }
</script>
