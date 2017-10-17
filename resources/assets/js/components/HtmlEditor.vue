<template>
    <div>
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
        ],
        computed: {
        },
        methods: {
            initialize: function () {
                var self = this;
                /*$(self.$el).froalaEditor({
                    toolbarInline: true,
                    charCounterCount: false,
                    toolbarButtons: [
                        'bold',
                        'italic',
                        'underline',
                        'strikeThrough',
                        'color',
                        'inlineStyle',
                        'subscript',
                        'superscript',
                        '-',
                        'paragraphFormat',
                        'align',
                        'formatOL',
                        'formatUL',
                        'indent',
                        'outdent',
                        'insertHR',
                        '-',
                        'specialCharacters',
                        'insertTable',
                        'insertImage',
                        'insertLink',
                        'clearFormatting',
                        'html',
                        'undo',
                        'redo'
                    ],
                    toolbarVisibleWithoutSelection: true
                });
                $(self.$el).on('froalaEditor.contentChanged', function (e, editor) {
                    var html = $(self.$el).froalaEditor('html.get');
                    self.model[self.property] = html;
                    self.$emit('change');
                });*/
                self.editorPromise=tinymce.init({
                    plugins: "table textcolor colorpicker",
                    target: self.$el,
                    inline: true,
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
