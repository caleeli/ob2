<template>
    <div style="height:100%">
    </div>
</template>

<script>
    import BaseComponent from './BaseComponent.js';
    export default BaseComponent.extend({
        data: function () {
            return {
                tinymceId:'',
            };
        },
        props: [
            "id",
            "refreshWith",
            "model",
            "property",
            "noinline"
        ],
        computed: {
        },
        methods: {
            initialize: function () {
                var self = this;
                self.editorPromise=tinymce.init({
                    plugins: "textcolor colorpicker contextmenu lists link autoresize",
                    menubar: 'edit insert format table tools',
                    toolbar: "bold italic forecolor backcolor | alignleft aligncenter alignright | numlist bullist outdent indent | link",
                    target: self.$el,
                    inline: !self.noinline,
                    setup : function(editor) {
                        editor.on('change', function(e) {
                            var html = e.target.getContent();
                            self.model[self.property] = html;
                            self.$emit('change');
                        });
                    },
                });
            },
            refresh: function () {
                var self = this;
                self.editorPromise.then(function(editor){
                    try {
                        editor[0].setContent(self.model[self.property]);
                        editor[0].undoManager.clear();
                    } catch(e) {}
                });
            },
        }
    });
</script>
