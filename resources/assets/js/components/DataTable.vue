<template>
    <div>
        <table class="table table-striped table-bordered" cellspacing="0" width="100%"></table>
    </div>
</template>

<script>
    export default {
        props:[
            "model",
            "toolbar",
            "refreshWith",
            "groupBy",
            "editable",
        ],
        methods: {
            refresh: function() {
                this.table.ajax.url(this.model.$url() + '?' + this.model.$list());
                this.table.ajax.reload();
            },
            clickButton:function (index) {
                $(this.table.buttons()[index].node).click();
            },
            selectRow: function (id, data) {
                var self = this;
                self.$emit('selectrow', id, data);
            },
            redraw: function (dontDestroy) {
                var self = this;
                var toolbar = (this.toolbar=='empty') ? [] : (this.toolbar?this.toolbar:'new,search').split(",");
                var dom = ['','','rtp'];
                var buttons = [];
                var agent = navigator.userAgent.toLowerCase();
                var isAndroid = agent.indexOf("android") > -1;
                toolbar.forEach(function(button) {
                    switch(button) {
                        case 'new':
                            dom[0]='B';
                            buttons.push({
                                text: '<i class="fa fa-plus"></i> Nuevo',
                                action: function (e, dt, node, config) {
                                    self.$emit('newrecord');
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
                            if (!isAndroid) {
                                dom[0]='B';
                                buttons.push({
                                    extend: 'excelHtml5',
                                    text: '<i class="fa fa-file-excel-o"></i> Excel',
                                    exportOptions: {}
                                });
                            }
                            break;
                        case 'pdf':
                            if (!isAndroid) {
                                dom[0]='B';
                                buttons.push({
                                    extend: 'pdfHtml5',
                                    text: '<i class="fa fa-file-pdf-o"></i> PDF',
                                    exportOptions: {}
                                });
                            }
                            break;
                        case 'search':
                            dom[1]='f';
                            break;
                    }
                });
                this.buttons = buttons;
                if (!dontDestroy) {
                    var $owner = $(this.$el);
                    this.table.destroy(true);
                    $owner.html('<table class="table table-striped table-bordered" cellspacing="0" width="100%"></table>');
                }
                var columns = self.model.$columns();
                if (self.editable) {
                    columns.push({
                        "data":null,
                        "defaultContent": "<a class='btn btn-default edit-button'><i class='fa fa-pencil-square-o'></i></a>",
                    });
                }
                this.table = $(this.$el).find("table").DataTable({
                    language: {
                        url: API_SERVER+"/api/lang/datatable"
                    },
                    dom: dom.join(""),
                    responsive: true,
                    buttons: self.buttons,
                    processing: true,
                    ajax: self.model.$url() + '?' + self.model.$list()+',created_at,updated_at',
                    rowId: 'id',
                    columns: columns,
                    rowGroup: self.groupBy ? {dataSrc:self.groupBy} : undefined,
                });
            },
        },
        mounted() {
            var self = this;
            this.redraw(true);
            $(this.$el).find('tbody').on( 'click', '.edit-button', function () {
                if($(self.$el).hasClass('table-locked')) {
                    return;
                }
                $(self.$el).addClass('table-locked');
                setTimeout((function($el){return function(){$el.removeClass('table-locked');}})($(self.$el)), 1000);
                var row = self.table.row( $(this).closest("tr")[0] );
                var id = row.id();
                self.selectRow(id, row.data());
            } );
            this.model.setRefreshListCallback(function(){
                self.table.ajax.reload();
            });
            this.$root.$on('changed', function(element){
                if(typeof element.id!=='undefined') {
                    if(typeof self.refreshWith==='string' && self.refreshWith.split(",").indexOf(element.id)!==-1) {
                        self.refresh();
                    }
                }
            });
        }
    }
</script>
