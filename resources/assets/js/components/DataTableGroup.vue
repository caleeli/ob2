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
            "toolbar",
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
                "path": [new PathItem({name: this.model.$pluralTitle, item: null}, this)],
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
            getRow: function (id) {
                var self = this;
                var l = self.table.rows()[0].length;
                for(var i=0; i<l; i++) {
                    var d = self.table.row(i).data();
                    if (d.id===id) {
                        return d;
                    }
                }
            },
            selectRow: function (id, data) {
                var self = this;
                if (!data) {
                    data = self.getRow(id);
                }
                if (data) {
                    self.open(id);
                    self.path.push(new PathItem({name: data.attributes[self.nameField], item: id}, self));
                } else {
                    throw "Row id="+id+" not found.";
                }
            },
            clickButton:function (index) {
                $(this.table.buttons()[index].node).click();
            },
        },
        mounted() {
            var self = this;
            var toolbar = (this.toolbar=='empty') ? [] : (this.toolbar?this.toolbar:'new,edit,up,search').split(",");
            var dom = ['','','rtp'];
            var buttons = [];
            toolbar.forEach(function(button) {
                switch(button) {
                    case 'new':
                        dom[0]='B';
                        buttons.push({
                            text: '<i class="fa fa-plus"></i> Nuevo',
                            action: function (e, dt, node, config) {
                                self.$emit('newrecord', self.currentGroup);
                            }
                        });
                        break;
                    case 'edit':
                        dom[0]='B';
                        buttons.push({
                            text: '<i class="fa fa-pencil-square-o"></i> Editar',
                            action: function (e, dt, node, config) {
                                self.$emit('editrecord', self.currentGroup);
                            }
                        });
                        break;
                    case 'up':
                        dom[0]='B';
                        buttons.push({
                            text: '<i class="fa fa-arrow-up"></i>',
                            action: function (e, dt, node, config) {
                                if(self.path.length>1) {
                                    self.path.pop();
                                    self.open(self.path[self.path.length-1].item);
                                    self.path[self.path.length-1].goto();
                                }
                            }
                        });
                        break;
                    case 'copy':
                        dom[0]='B';
                        buttons.push({
                            extend: 'copyHtml5',
                            text: '<i class="fa fa-copy"></i> Copiar',
                            exportOptions: {}
                        });
                        break;
                    case 'excel':
                        dom[0]='B';
                        buttons.push({
                            extend: 'excelHtml5',
                            text: '<i class="fa fa-file-excel-o"></i> Excel',
                            exportOptions: {}
                        });
                        break;
                    case 'pdf':
                        dom[0]='B';
                        buttons.push({
                            extend: 'pdfHtml5',
                            text: '<i class="fa fa-file-pdf-o"></i> PDF',
                            exportOptions: {}
                        });
                        break;
                    case 'search':
                        dom[1]='f';
                        break;
                }
            });
            var table = $(this.$el).find("table").DataTable({
                language: {
                    url: API_SERVER+"/api/lang/datatable"
                },
                //dom: 'Bfrtilp',
                dom: dom.join(""),
                responsive: true,
                buttons: buttons,
                "processing": true,
                "ajax": self.model.$url() + '?' + self.model.$list() + '&filter[]=where,' + self.groupField + ',=,' + JSON.stringify(self.currentGroup),
                "rowId": 'id',
                "columns": self.model.$columns(),
            });
            self.table = table;
            $(this.$el).find('tbody').on( 'click', 'tr', function () {
                if($(self.$el).hasClass('table-locked')) {
                    return;
                }
                $(self.$el).addClass('table-locked');
                setTimeout((function($el){return function(){$el.removeClass('table-locked');}})($(self.$el)), 1000);
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
                    self.selectRow(id, data);
                //}
            } );
            this.model.setRefreshListCallback(function(){
                table.ajax.reload();
            });
        }
    }
</script>
