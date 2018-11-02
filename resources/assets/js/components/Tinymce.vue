<template>
    <div v-bind:style="{height:getHeight()}">
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                innerValue: ''
            };
        },
        props: {
            'value': String,
            'plugins': String,
            'height': String,
            'inline': Boolean
        },
        watch: {
            'value': function (value) {
                var self = this;
                if (value===self.innerValue) return;
                self.innerValue = value;
                self.editorPromise.then(function(editor){
                    try {
                        editor[0].setContent(value);
                        editor[0].undoManager.clear();
                    } catch(e) {}
                });
            }
        },
        methods: {
            getHeight: function () {
                return this.height ? this.height : '100%';
            }
        },
        /*updated: function () {
            self.$nextTick(function () {
            });
        },*/
        mounted: function () {
            var self = this;
            self.editorPromise=tinymce.init({
                plugins: "textcolor colorpicker contextmenu lists link autoresize" + (self.plugins ? ' ' + self.plugins:''),
                menubar: 'edit insert format table tools',
                toolbar: "bold italic forecolor backcolor | alignleft aligncenter alignright | numlist bullist outdent indent | link",
                target: self.$el,
                inline: !!self.inline,
                setup : function(editor) {
                    editor.on('change', function(e) {
                        var html = e.target.getContent();
                        self.innerValue = html;
                        self.$emit('input', html);
                        self.$emit('change', html);
                    });
                },
            });
            self.editorPromise.then(function(editor){
                try {
                    editor[0].setContent(self.value);
                    self.innerValue = self.value;
                    editor[0].undoManager.clear();
                } catch(e) {}
            });
        }
    };
</script>
