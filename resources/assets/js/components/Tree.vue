<template>
<div></div>
</template>

<script>
    export default {
        props:[
            "model",
            "text",
            "parent",
            "type",
            "types",
        ],
        methods: {
        },
        mounted: function() {
            var self = this;
            $.ajax({
                method: 'GET',
                url: this.model.url,
                dataType: 'json',
                load: function(data) {
                    var treeData=[];
                    data.data.forEach(function(row){
                        row.attributes.text = row.attributes[self.text];
                        row.attributes.parent = row.attributes[self.parent];
                        row.attributes.type = row.attributes[self.type];
                        treeData.push(row.attributes);
                    });
                    $(this.$el).jstree({
                        'core': {
                            'animation': 0,
                            'check_callback': true,
                            'data': treeData
                        },
                        'types': this.types,
                        'plugins': [
                            'search',
                            'state',
                            'types',
                            'wholerow',
                            "dnd",
                        ]
                    });
                }
            });
        }
    }
</script>
