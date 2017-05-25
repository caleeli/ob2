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
        ],
        methods: {
            refresh: function() {
                this.table.ajax.url(this.model.$url() + '?' + this.model.$list());
                this.table.ajax.reload();
            },
            clickButton:function (index) {
                $(this.table.buttons()[index].node).click();
            },
            selectRow: function (id) {
                var self = this;
                self.$emit('selectrow', id);
            },
        },
        mounted() {
            var self = this;
            var toolbar = (this.toolbar=='empty') ? [] : (this.toolbar?this.toolbar:'new,search').split(",");
            var dom = ['','','rtp'];
            var buttons = [];
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
                "ajax": self.model.$url() + '?' + self.model.$list(),
                rowId: 'id',
                "columns": self.model.$columns(),
            });
            this.table = table;
            $(this.$el).find('tbody').on( 'click', 'tr', function () {
                if($(self.$el).hasClass('table-locked')) {
                    return;
                }
                $(self.$el).addClass('table-locked');
                setTimeout((function($el){return function(){$el.removeClass('table-locked');}})($(self.$el)), 1000);
                var id = table.row( this ).id();
                self.selectRow(id);
            } );
            this.model.setRefreshListCallback(function(){
                table.ajax.reload();
            });
        }
    }
</script>
