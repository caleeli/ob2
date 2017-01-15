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
        mounted() {
            var self = this;
            var table = $(this.$el).find("table").DataTable({
                language: {
                    url: "js/Spanish.json"
                },
                dom: 'Bfrtilp',
                responsive: true,
                buttons: [
                    {
                        text: '<i class="fa fa-plus"></i> Nuevo',
                        //className: "btn btn-primary",
                        action: function (e, dt, node, config) {
                            self.$emit('newrecord');
                        }

                    },
                    {
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
                    }
                ],
                "processing": true,
                "ajax": "/api/UserAdministration/users?fields=username,firstname,lastname",
                rowId: 'id',
                columns: [
                    { "data": "attributes.username", "title": "Username" },
                    { "data": "attributes.firstname", "title": "Nombre" },
                    { "data": "attributes.lastname", "title": "Apellido" },
                ]
            });
            $(this.$el).find('tbody').on( 'click', 'tr', function () {
                var id = table.row( this ).id();
                self.$emit('selectrow', id);
            } );
            this.model.setRefreshListCallback(function(){
                table.ajax.reload();
            });
        }
    }
</script>
