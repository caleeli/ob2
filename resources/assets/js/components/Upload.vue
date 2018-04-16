<template>
    <div class="form-file-progress" v-bind:style="'width: 100%;height: 100%;position: absolute;left: 0px;top: 0px;' + style">
        <input type="file" style="
               width: 100%;
               height: 100%;
               position: absolute;
               left: 0px;
               top: 0px;
               opacity: 0;"
               v-on:change="changeFile($event, multiplefile)"
               v-bind:multiple="multiplefile">
    </div>
</template>

<script>
    export default {
        props: {
            "value": String,
            "target": String,
            "multiplefile": Boolean
        },
        data() {
            return {
                style: "background-size: 0% 100%!important"
            };
        },
        methods: {
            changeFile: function (event, multiple) {
                var self = this;
                var data = new FormData();
                for (var i = 0, l = event.target.files.length; i < l; i++) {
                    data.append('file' + (multiple ? '[]' : ''), event.target.files[i]);
                }
                $.ajax({
                    url: API_SERVER + (self.target ? "/api/uploaddocument/" + self.target : "/api/uploadfile"),
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function (json) {
                        self.$emit('input', JSON.stringify(json));
                        self.$emit('change', json);
                        self.style = "background-size: 0% 100%!important";
                    },
                    error: function (json) {
                        self.style = "background-size: 0% 100%!important";
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                }).uploadProgress(function (data) {
                    if (data.lengthComputable) {
                        var progress = parseInt(((data.loaded / data.total) * 100), 10);
                        self.style = "background-size: " + progress + "% 100%!important";
                    }
                });
            },
        },
        mounted() {
        }
    }
</script>
