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
            "model",
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
                var model = self.model;
                var lineChartData = {
                    //labels: [],
                    datasets: []
                };
                try {
                $.ajax({
                    url: '/api/pivot/valores/'+model.aggregator+'/defecto_valor_cargado/'+(model.rows?model.rows:'null')+'/'+(model.cols?model.cols:'null')+'/'+model.variables,
                    dataType: 'json',
                    success:function(data) {
                        lineChartData.labels = data.x;
                        lineChartData.datasets = [];
                        var colors = [];
                        for(var color in window.chartColors) {
                            colors.push(color);
                        }
                        var axis=["y-axis-2","y-axis-1"];
                        for(var a in data.series) {
                            lineChartData.datasets.push({
                                label: a,
                                borderColor: colors.pop(),
                                backgroundColor: colors.pop(),
                                fill: false,
                                data: data.series[a],
                                yAxisID: axis[1],
                            });
                        }
                        self.chart = Chart.Bar(ctx, {
                            type: 'horizontalBar',
                            data: lineChartData,
                            options: {
                                responsive: true,
                                hoverMode: 'index',
                                stacked: false,
                                title:{
                                    display: false,
                                },
                                scales: {
                                    xAxes: [{
                //type: 'linear',
                position: 'bottom'
            }],
                                    yAxes: [{
                                        type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                                        display: true,
                                        position: "left",
                                        id: "y-axis-1",
                                    }, /*{
                                        type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                                        display: true,
                                        position: "right",
                                        id: "y-axis-2",
                                        // grid line settings
                                        gridLines: {
                                            drawOnChartArea: false, // only want the grid lines for one axis to show up
                                        },
                                    }*/],
                                }
                            }
                        });
                    },
                });
                } catch(e) {
                    
                } 
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
