<template>
    <div>
        <table class="table table-striped table-bordered" cellspacing="0" width="100%"></table>
    </div>
</template>

<script>
    export default {
        props:[
            "model",
        ],
        methods: {
            refresh: function() {
                this.table.ajax.url(this.model.$url() + '?' + this.model.$list());
                this.table.ajax.reload();
            },
        },
        mounted() {
            var self = this;
            var table = $(this.$el).find("table").DataTable({
                language: {
                    url: API_SERVER+"/api/lang/datatable"
                },
                //dom: 'Bfrtilp',
                dom: 'Bfrtp',
                responsive: true,
                buttons: [
                    {
                        text: '<i class="fa fa-plus"></i> Nuevo',
                        //className: "btn btn-primary",
                        action: function (e, dt, node, config) {
                            self.$emit('newrecord');
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
                        exportOptions: {http://githook.callizaya.com/deploy/githook
                        }
                    }*/
                ],
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
                self.$emit('selectrow', id);
            } );
            this.model.setRefreshListCallback(function(){
                table.ajax.reload();
            });
        }
    }
</script>
