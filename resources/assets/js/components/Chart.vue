<template>
    <div>
        <div class="btn-toolbar">
            <div class="btn-group">
                <a href="javascript:void(0)" v-on:click="setType('bar')" :class="classType('bar')"><i class="fa fa-bar-chart"></i></a>
                <a href="javascript:void(0)" v-on:click="setType('bar2')" :class="classType('bar2')"><i class="fa fa-bar-chart"></i></a>
                <a href="javascript:void(0)" v-on:click="setType('horizontalBar')" :class="classType('horizontalBar')"><i class="fa fa-bars"></i></a>
                <a href="javascript:void(0)" v-on:click="setType('area')" :class="classType('area')"><i class="fa fa-area-chart"></i></a>
                <a href="javascript:void(0)" v-on:click="setType('line')" :class="classType('line')"><i class="fa fa-line-chart"></i></a>
                <a href="javascript:void(0)" v-on:click="setType('pie')" :class="classType('pie')"><i class="fa fa-pie-chart"></i></a>
                <a href="javascript:void(0)" v-on:click="setType('polarArea')" :class="classType('polarArea')"><i class="glyphicon glyphicon-cd"></i></a>
                <a href="javascript:void(0)" v-on:click="setType('table')" :class="classType('table')"><i class="fa fa-table"></i></a>
            </div>
        </div>
        <div class="canvasOwner">
            <canvas></canvas>
        </div>
    </div>
</template>

<script>
    export default {
        data:function() {
            return {
                "chartType": "line",
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
            setType: function(type) {
                this.chartType=type;
                this.drawChart();
            },
            classType: function(type) {
                return this.chartType===type?'btn btn-primary':'btn btn-default';
            },
            setChartType: function(type) {
                this.chartType=type;
            },
            rotateTemplate: function() {
                var i=this.templates.indexOf(this.currentTemplate)+this.direction;
                if(i>=this.templates.length || i<0) {
                    this.direction=-this.direction;
                    i=this.templates.indexOf(this.currentTemplate)+this.direction;
                }
                this.currentTemplate = this.templates[i];
                $("#template-tuner").attr("href", "bower_components/bootswatch/"+this.templates[i]+"/bootstrap.min.css");
            },
            drawChart: function() {
                $(this.$el).find(".canvasOwner").html("<canvas></canvas>");
                var self = this;
                var ctx = $(this.$el).find("canvas")[0];
                var pieColors = [
                    '#3366CC',
                    '#DC3912',
                    '#FF9900',
                    '#109618',
                    '#990099',
                    '#3B3EAC',
                    '#0099C6',
                    '#DD4477',
                    '#66AA00',
                    '#B82E2E',
                    '#316395',
                    '#994499',
                    '#22AA99',
                    '#AAAA11',
                    '#6633CC',
                    '#E67300',
                    '#8B0707',
                    '#329262',
                    '#5574A6',
                    '#3B3EAC',
                ];
                var lineChartData = {
                    //labels: [],
                    datasets: []
                };
                var data = this.data;
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
                        //yAxisID: axis[1],
                    });
                }
                var chartType = 'bar';
                var options = {
                    responsive: true,
                    hoverMode: 'index',
                    stacked: false,
                    title:{
                        display: false,
                    },
                    scales: {
                        xAxes: [{
                            position: 'bottom'
                        }],
                        yAxes: [{
                            type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                            display: true,
                            position: "left",
                            id: "y-axis-1",
                        }],
                    }
                };
                switch (self.chartType) {
                    case 'bar':
                    case 'line':
                        chartType = self.chartType;
                        break;
                    case 'bar2':
                        chartType = 'bar';
                        options.scales.xAxes.forEach(function(axe) {
                            axe.stacked = true;
                        })
                        options.scales.yAxes.forEach(function(axe) {
                            axe.stacked = true;
                        })
                        break;
                    case 'horizontalBar':
                        chartType = self.chartType;
                        options.scales = {
                            xAxes: [{
                                type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                                display: true,
                                position: "bottom",
                                id: "y-axis-1",
                            }],
                            yAxes: [{
                                position: 'left'
                            }],
                        }
                        break;
                    case 'area':
                        chartType = 'line';
                        lineChartData.datasets.forEach(function(ds) {
                            ds.fill = true;
                        });
                        options.scales.xAxes.forEach(function(axe) {
                            axe.stacked = true;
                        })
                        options.scales.yAxes.forEach(function(axe) {
                            axe.stacked = true;
                        })
                        break;
                    case 'pie':
                        chartType = self.chartType;
                        options = {
                            legend: {
                                display: false
                            },
                            cutoutPercentage: 50
                        };
                        lineChartData.datasets.forEach(function(ds) {
                            ds.backgroundColor = [];
                            ds.data.forEach(function(data, i) {
                                ds.backgroundColor.push(
                                    pieColors[i % pieColors.length]
                                );
                            });
                        });
                        break;
                    case 'polarArea':
                        chartType = self.chartType;
                        options = {
                            legend: {
                                display: false
                            },
                            scale: {
                                reverse: true,
                                    ticks: {
                                    beginAtZero: true
                                }
                            }
                        };
                        lineChartData.datasets.forEach(function(ds) {
                            ds.backgroundColor = [];
                            ds.data.forEach(function(data, i) {
                                ds.backgroundColor.push(
                                    pieColors[i % pieColors.length]
                                );
                            });
                        });
                        break;
                    case 'table':
                        break;
                    default:
                        chartType = self.chartType;
                }
                try {
                    self.chart = new Chart(ctx, {
                        type: chartType,
                        data: lineChartData,
                        options: options
                    });
                } catch(e) {

                }
            },
            refresh:function(){
                var self = this;
                var model = self.model;
                $(this.$el).find(".canvasOwner").html("<img src='/images/ajax-loader2.gif'>");
                try {
                    $.ajax({
                        url: '/api/pivot/valores/'+model.aggregator+'/defecto_valor_cargado/'+(model.rows?model.rows:'null')+'/'+(model.cols?model.cols:'null')+'/'+model.variables,
                        dataType: 'json',
                        success:function(data) {
                            self.data = data;
                            self.drawChart();
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
