<template>
    <div>
    </div>
</template>

<script>
    import BaseComponent from './BaseComponent.js';
    export default BaseComponent.extend({
        data: function () {
            return {
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
                $(self.$el).froalaEditor({
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
                });
            },
            refresh: function () {
                var self = this;
                $(self.$el).froalaEditor('html.set', self.model[self.property]);
            },
        }
    });
</script>
