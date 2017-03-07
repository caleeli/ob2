<template>
    <div>
        <div>
        </div>
        <table class="table table-striped table-bordered" cellspacing="0" width="100%"></table>
    </div>
</template>

<script>
    function DataTableGroupPath(options) {
        this.goto=function(){
            
        }
    }
    export default {
        props:[
            "model",
            "groupField",
            "root",
            "typeField",
            "nameField",
            "leafType",
            "childrenAssociation",
        ],
        table: null,
        data() {
            return {
                "currentGroup": this.root,
                "path": [new PathItem({name: this.model.$pluralName, item: null}, this)],
            };
        },
        methods: {
            open: function(id) {
                var self = this;
                self.currentGroup = id;
                self.table.ajax.url(self.model.$url() + '?' + self.model.$list() + '&filter[]=where,' + self.groupField + ',=,' + JSON.stringify(self.currentGroup));
                self.table.ajax.reload();
                self.$emit('selectrow', id);
            },
            goto: function(id, itemPath) {
                var i = this.path.indexOf(itemPath);
                this.path.splice(i + 1);
                this.open(id);
                this.$parent.focus();
            },
        },
        mounted() {
            var self = this;
            var table = $(this.$el).find("table").DataTable({
                language: {
                    url: "js/Spanish.json"
                },
                //dom: 'Bfrtilp',
                dom: 'Bfrtp',
                responsive: true,
                buttons: [
                    {
                        text: '<i class="fa fa-plus"></i> Nuevo',
                        action: function (e, dt, node, config) {
                            self.$emit('newrecord', self.currentGroup);
                        }

                    },
                    {
                        text: '<i class="fa fa-pencil-square-o"></i> Editar',
                        action: function (e, dt, node, config) {
                            self.$emit('editrecord', self.currentGroup);
                        }

                    },
                    /*{
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-copy"></i> Copiar',
                        exportOptions: {
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-table"></i> Excel',
                        exportOptions: {
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-text"></i> PDF',
                        exportOptions: {
                        }
                    }*/
                ],
                "processing": true,
                "ajax": self.model.$url() + '?' + self.model.$list() + '&filter[]=where,' + self.groupField + ',=,' + JSON.stringify(self.currentGroup),
                "rowId": 'id',
                "columns": self.model.$columns(),
            });
            self.table = table;
            $(this.$el).find('tbody').on( 'click', 'tr', function () {
                var id = table.row( this ).id();
                var data = table.row( this ).data();
                if(!data) {
                    return;
                }
                /*if(data.attributes[self.typeField] === self.leafType) {
                    self.path.push(new PathItem({
                        name: data.attributes[self.nameField],
                        item: id,
                        goto: function() {
                            self.goto(this.item, this);
                            self.$emit('selectrow', id);
                        }
                    }, self));
                    self.$emit('selectrow', id);
                } else {*/
                    self.open(id);
                    self.path.push(new PathItem({name: data.attributes[self.nameField], item: id}, self));
                //}
            } );
            this.model.setRefreshListCallback(function(){
                table.ajax.reload();
            });
        }
    }
</script>
