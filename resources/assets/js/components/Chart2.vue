<template>
    <canvas></canvas>
</template>

<script>
    export default {
        data:function() {
            return {
            };
        },
        props:[
            "type",
            "model",
            "method",
            "refreshWith",
        ],
        computed: {
            rotateClass: function () {
                var i=this.templates.indexOf(this.currentTemplate)+1;
                return 'rotate-template-'+i;
            }
        },
        methods: {
            rotateTemplate: function() {
                var i=this.templates.indexOf(this.currentTemplate)+this.direction;
                if(i>=this.templates.length || i<0) {
                    this.direction=-this.direction;
                    i=this.templates.indexOf(this.currentTemplate)+this.direction;
                }
                this.currentTemplate = this.templates[i];
                $("#template-tuner").attr("href", "bower_components/bootswatch/"+this.templates[i]+"/bootstrap.min.css");
            },
            refresh:function(){
                var self = this;
                var ctx = this.$el;
                //console.log(model, this.model);
                //var model = this.model;
                var lineChartData = {
                    //labels: [],
                    datasets: []
                };
                //console.log(this.model,this.model.$methods, this.method);
                this.model.$methods[this.method](0, function(data){
                        var colors = [
                                        "#FF6384",
                                        "#4BC0C0",
                                        "#FFCE56",
                                        "#E7E9ED",
                                        "#36A2EB"
                                    ];
                        var axis = ["y-axis-2","y-axis-1"];
                        var scales;
                        lineChartData.labels = data.x;
                        lineChartData.datasets = [];
                        switch(self.type) {
                            case 'pie':
                                scales = {};
                                break;
                            default:
                                scales = {
                                    xAxes: [{
                                        //type: 'linear',
                                        position: 'bottom'
                                    }],
                                    yAxes: [{
                                        type: "linear",
                                        display: true,
                                        position: "left",
                                        id: "y-axis-1",
                                    },],
                                };
                        }
                        for(var a in data.series) {
                            lineChartData.datasets.push({
                                label: a,
                                borderColor: "black",
                                backgroundColor: colors,
                                fill: false,
                                data: data.series[a],
                                yAxisID: axis[1],
                            });
                        }
                        self.chart = new Chart(ctx, {
                            type: self.type,
                            data: lineChartData,
                            options: {
                                responsive: true,
                                hoverMode: 'index',
                                stacked: false,
                                title:{
                                    display: true,
                                    //text:'Reporte 4'
                                },
                                scales: scales
                            }
                        });
                    
                });
            },
        },
        mounted() {
            var self = this;
            self.refresh();
            this.$root.$on('changed', function(element){
                if(typeof element.id!=='undefined') {
                    if(element.id===self.refreshWith) {
                        self.refresh();
                    }
                }
            });
        }
    }
</script>
