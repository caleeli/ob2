<script>
    export default {
        props:[
            "id",
            "refreshWith",
        ],
        methods: {
            refresh:function(){
                throw new Exception("refresh() method not implemented.");
            },
        },
        mounted() {
            var self = this;
            self.refresh();
            this.$root.$on('changed', function(element){
                if(typeof element.id!=='undefined') {
                    if(self.refreshWith.split(',').indexOf(element.id)>-1) {
                        self.refresh();
                    }
                }
            });
        }
    }
</script>
