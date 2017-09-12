<template>
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>{{title}}</h5><i class="base-chart-aux"></i>
            <div class="ibox-tools">
                <a v-on:click="download">
                    <i class="fa fa-download"></i>
                </a>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="fa fa-wrench"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li v-for="param in params">
                        <label style="
                               width: 32px;
                               display: inline-block;
                               ">{{param.label}}:</label>
                        <input v-model="param.value"
                               style="
                               width: 64px;
                               display: inline-block;
                               ">
                    </li>
                </ul>
                <a class="close-link" v-on:click="close">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content chart-box">
            <div class="canvasOwner" style="min-height: 300px;"></div>
            <div class="pv-data-table">
                <table class="pv-data-table-table table table-striped table-bordered">
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
    </div>
</template>

<script>
    import BaseComponent from './BaseComponent.js';
    export default BaseComponent.extend({
        data: function () {
            return {
                "chartType": this.type ? this.type : "line",
                "model_cols": this.mcols ? this.mcols : "aprobado",
                "model_rows": "",
                "params": [
                    {label:"de",value:"2003"},
                    {label:"a",value:"2016"},
                ],
                data: this.mdata ? this.mdata : {
                    x: ["ene","feb","mar"],
                    series: {
                        "presupuesto": {
                            "aprobado": [100,400,900],
                            "ejecutado": [90,380,850]
                        }
                    }
                },
                //internal:
                "xs":[],
                "ys":[],
                "xs_label":[],
                "ys_label":[],
                "rows":[],
                "cols":[],
            };
        },
        props: [
            "type",
            "id",
            "refreshWith",
            "mcols",
            "mdata",
            "title",
        ],
        computed: {
        },
        methods: {
            close: function () {
                
            },
            download: function () {
                
            },
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
            onLoadModel: function () {
                this.refresh();
            },
            init: function () {
                var self = this;
                //self.model.$on('load', self.onLoadModel, self);
            },
            colorToRgba: function (color, newAlpha) {
                var $aa = $(this.$el).find(".base-chart-aux");
                $aa.css("color", color);
                var rgb = window.getComputedStyle($aa[0], null).getPropertyValue("color");
                var colors;
                if (rgb.substr(0,4)==='rgba') {
                    colors = rgb.substr(5,rgb.length-6).split(",");
                    colors[3] = newAlpha;
                } else {
                    colors = rgb.substr(4,rgb.length-5).split(",");
                    colors.push(newAlpha);
                }
                return 'rgba('+colors.join(',')+')';
            },
            drawChart: function() {
                var self = this;
                var pieColors = [
                    '#22AA99',
                    'darkgray',
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
                var countSeries = 0;
                $(self.$el).find(".canvasOwner").html("");
                var maxNumCharts = MAX_ROWS;
                self.xs.length=0;
                self.ys.length=0;
                self.xs_label.length=0;
                self.ys_label.length=0;
                self.rows.length=0;
                self.cols.length=0;
                (self.model_cols?self.model_cols:"").split(",").forEach(function(name) {
                    if(name) self.cols.push(name);
                });
                self.rows.push('variable');
                (self.model_rows?self.model_rows:"").split(",").forEach(function(name) {
                    if(self.model_rows) self.rows.push(name);
                });
                data.x.forEach(function(names){
                    var xl=[];
                    names.split("\x1b").forEach(function(name) {
                        xl.push(name);
                    });
                    self.xs_label.push(xl);
                });
                for(var rowId in data.series) countSeries++;
                for(var rowId in data.series) {
                    addChart(rowId, countSeries>1);
                    maxNumCharts--;
                    if(maxNumCharts<=0) {
                        break;
                    }
                }
                Vue.nextTick(function () {
                    if($(self.$el).find(".pv-pivot").is(':visible')) {
                        self.refreshPivot();
                    }
                });
                /**
                 * Add a chart
                 */
                function addChart(rowId, addTitle) {
                    var $canvas = $("<canvas></canvas>");
                    var portrait = window.innerHeight > window.innerWidth;
                    if (portrait) {
                        //is Portrait
                        $canvas.attr('width',300);
                        $canvas.attr('height',350);
                    } else {
                        $canvas.attr('width',800);
                        $canvas.attr('height',600);
                    }
                    $(self.$el).find(".canvasOwner").append($canvas);
                    var ctx = $canvas[0];
                    var chartData = {
                        //labels: [],
                        datasets: []
                    };
                    chartData.labels = data.x;
                    chartData.datasets = [];
                    var colors = [];
                    for(var color in pieColors) {
                        colors.unshift(pieColors[color]);
                    }
                    var axis=["y-axis-2","y-axis-1"];
                    for(var a in data.series[rowId]) {
                        var yl=[a];
                        rowId.split("\x1b").forEach(function(name){
                            if (self.model_rows) yl.push(name);
                        });
                        self.ys.push(data.series[rowId][a]);
                        self.ys_label.push(yl);
                        var colorData = colors.pop();
                        chartData.datasets.push({
                            label: a,
                            borderColor: colorData,
                            backgroundColor: self.colorToRgba(colorData, 0.7),
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
                        maintainAspectRatio: true,
                        title:{
                            display: addTitle,
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
                                ticks: {
                                    scaleStartValue: 0,
                                    beginAtZero: true,
                                }
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
                                    ticks: {
                                        scaleStartValue: 0,
                                        beginAtZero: true,
                                    }
                                }],
                                yAxes: [{
                                    position: 'left'
                                }],
                            }
                            break;
                        case 'area':
                            chartType = 'line';
                            chartData.datasets.forEach(function(ds) {
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
                                    display: true
                                },
                                //cutoutPercentage: 50
                            };
                            chartData.datasets.forEach(function(ds) {
                                ds.borderColor = 'white';
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
                            chartData.datasets.forEach(function(ds) {
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
                            data: chartData,
                            options: options
                        });
                    } catch(e) {
                        console.log(e);
                    }
                }
            },
            refresh: function () {
                var self = this;
                $(self.$el).find(".canvasOwner").html('');
                self.drawChart();
            },
        }
    });
</script>
