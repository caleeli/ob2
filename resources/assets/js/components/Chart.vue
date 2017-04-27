<template>
    <div>
        <div class="btn-toolbar">
            <div class="btn-group">
                <a v-for="chart in chartTypes" href="javascript:void(0)" v-on:click="setType(chart)" :class="classType(chart.type)"><i :class="chart.icon"></i></a>
            </div>
        </div>
        <div class="canvasOwner">
            <canvas></canvas>
        </div>
        <div class="pv-data-table collapse">
            <table>
                <thead>
                <tr v-for="(col,colI) in cols">
                    <th v-for="row in rows"></th>
                    <th v-for="(x,xi) in xs_label" v-if="isDifferentCol(xs_label, xi, colI)" :colspan="colspan(xs_label, xi, colI)">{{x[colI]}}</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(yi,i) in ys">
                    <th v-for="yLabel in ys_label[i]">{{yLabel}}</th>
                    <td v-for="y in yi">{{Number(y).toLocaleString('es-419')}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data:function() {
            return {
                "chartType": "line",
                "xs":[],
                "ys":[],
                "xs_label":[],
                "ys_label":[],
                "rows":[],
                "cols":[],
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
            isDifferentCol: function (xs_label, i, colI) {
                return i==0 ? true : xs_label[i][colI]!=xs_label[i-1][colI];
            },
            colspan: function (xs_label, i, colI) {
                var colspan=0;
                for(var j=i,l=xs_label.length;j<l;j++) {
                    if (xs_label[j][colI]==xs_label[i][colI]) {
                        colspan++;
                    } else {
                        return colspan;
                    }
                }
                return colspan;
            },
            setType: function(chart) {
                $(this.$el).find('.canvasOwner').addClass("collapse");
                $(this.$el).find('.pv-data-table').addClass("collapse");
                $(this.$el).find('.'+chart.element).removeClass("collapse");
                if (chart.element==='canvasOwner') {
                    this.chartType=chart.type;
                    this.drawChart();
                }
                if(chart.element==='pv-data-table') {
                    
                }
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
                var self = this;
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
                var MAX_ROWS=10;
                var data = self.data;
                $(self.$el).find(".canvasOwner").html("");
                var maxNumCharts = MAX_ROWS;
                self.xs.length=0;
                self.ys.length=0;
                self.xs_label.length=0;
                self.ys_label.length=0;
                self.rows.length=0;
                self.cols.length=0;
                self.model.cols.split(",").forEach(function(name) {
                    if(name) self.cols.push(name);
                });
                self.rows.push('variable');
                self.model.rows.split(",").forEach(function(name) {
                    if(name) self.rows.push(name);
                });
                data.x.forEach(function(names){
                    var xl=[];
                    names.split("\x1b").forEach(function(name) {
                        xl.push(name);
                    });
                    self.xs_label.push(xl);
                });
                for(var rowId in data.series) {
                    addChart(rowId);
                    maxNumCharts--;
                    if(maxNumCharts<=0) {
                        break;
                    }
                }
                function addChart(rowId) {
                    var $canvas = $("<canvas></canvas>");
                    $(self.$el).find(".canvasOwner").append($canvas);
                    var ctx = $canvas[0];
                    var lineChartData = {
                        //labels: [],
                        datasets: []
                    };
                    lineChartData.labels = data.x;
                    lineChartData.datasets = [];
                    var colors = [];
                    for(var color in window.chartColors) {
                        colors.push(color);
                    }
                    var axis=["y-axis-2","y-axis-1"];
                    for(var a in data.series[rowId]) {
                        var yl=[a];
                        rowId.split("\x1b").forEach(function(name){
                            yl.push(name);
                        });
                        self.ys.push(data.series[rowId][a]);
                        self.ys_label.push(yl);
                        lineChartData.datasets.push({
                            label: a,
                            borderColor: colors.pop(),
                            backgroundColor: colors.pop(),
                            fill: false,
                            data: data.series[rowId][a],
                            //yAxisID: axis[1],
                        });
                    }
                    var chartType = 'bar';
                    var options = {
                        responsive: true,
                        hoverMode: 'index',
                        stacked: false,
                        title:{
                            display: true,
                            text: rowId,
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
                                title:{
                                    display: true,
                                    text: rowId,
                                },
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
                                title:{
                                    display: true,
                                    text: rowId,
                                },
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
                }
            },
            toList: function (input) {
                if (!input) {
                    return 'null';
                } else if (typeof input==='string') {
                    return input;
                } else {
                    var list = [];
                    input.forEach(function (item) {
                        list.push(item.id);
                    });
                    return list.join(",");
                }
            },
            refresh: function (){
                var self = this;
                var model = self.model;
                $(this.$el).find(".canvasOwner").html('<i class="ajax-loader"></i>');
                try {
                    $.ajax({
                        url: API_SERVER+'/api/pivot/valores_produccion/'+model.aggregator+'/defecto_valor_cargado/'+self.toList(model.rows)+'/'+self.toList(model.cols)+'/'+self.toList(model.variables)+'?filter='+model.filter,
                        dataType: 'json',
                        success:function(data) {
                            self.data = data;
                            self.drawChart();
                        },
                    });
                } catch(e) {
                    
                } 
            },
            /*refreshTable: function () {
                var data=[];
                for(var serie in self.data.series) {
                    for(var a in data.series[serie]) {
                        data.push([]);
                        lineChartData.datasets.push({
                            label: a,
                            borderColor: colors.pop(),
                            backgroundColor: colors.pop(),
                            fill: false,
                            data: data.series[rowId][a],
                            //yAxisID: axis[1],
                        });
                    }
                }
                $(this.$el).find('table').DataTable( {
                    data: data,
                    destroy: true,
                    columns: [
                        { title: "Name" },
                        { title: "Position" },
                        { title: "Office" },
                        { title: "Extn." },
                        { title: "Start date" },
                        { title: "Salary" }
                    ]
                } );
            },*/
        },
        mounted() {
            var self = this;
            self.chartTypes = {
                "bar": {
                    type:"bar",
                    element: "canvasOwner",
                    icon: "fa fa-bar-chart",
                },
                "bar2": {
                    type: "bar2",
                    element: "canvasOwner",
                    icon: "fa fa-bar-chart",
                },
                "horizontalBar": {
                    type: "horizontalBar",
                    element: "canvasOwner",
                    icon: "fa fa-bars",
                },
                "area": {
                    type: "area",
                    element: "canvasOwner",
                    icon: "fa fa-area-chart",
                },
                "line": {
                    type: "line",
                    element: "canvasOwner",
                    icon: "fa fa-line-chart",
                },
                "pie": {
                    type: "pie",
                    element: "canvasOwner",
                    icon: "fa fa-pie-chart",
                },
                "polarArea": {
                    type: "polarArea",
                    element: "canvasOwner",
                    icon: "glyphicon glyphicon-cd",
                },
                "table": {
                    type: "table",
                    element: "pv-data-table",
                    icon: "fa fa-table",
                },
            };
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
