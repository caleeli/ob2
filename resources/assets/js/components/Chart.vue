<template>
    <div>
        <div class="btn-toolbar">
            <div class="btn-group">
                <a v-for="chart in chartTypes" href="javascript:void(0)" v-on:click="setType(chart)" :class="classType(chart.type)"><i :class="chart.icon"></i></a>
                <a href="javascript:void(0)" v-on:click="toggleConfig()" class="btn btn-info visible-xs-inline visible-sm-inline visible-md-inline"><i class="fa fa-cog"></i></a>
                <a v-for="source in sources" v-bind:href="source.url" target="_blank" v-bind:title="source.name" class="btn btn-info"><i class="fa fa-file-excel-o"></i></a>
            </div>
        </div>
        <div class="div-ajax-loader" style='display: none;'>
            <br><i class="ajax-loader"></i>
        </div>
        <div class="canvasOwner">
            <canvas></canvas>
        </div>
        <div class="pv-data-table collapse">
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
        <div class="pv-pivot collapse"></div>
    </div>
</template>

                    
<script>
    /**
     * para los aros, cambiar los valores mostrados a %
     * falta titulos de las columnas de variables y dimensiones
     * 
     * color para las filas: rgb(186, 235, 225)
     */
    export default {
        data:function() {
            return {
                "sources": [],
                "chartType": "line",
                "xs":[],
                "ys":[],
                "xs_label":[],
                "ys_label":[],
                "rows":[],
                "cols":[],
            chartTypes: {
                "bar": {
                    type:"bar",
                    element: "canvasOwner",
                    icon: "fa fa-bar-chart",
                },
                "bar2": {
                    type: "bar2",
                    element: "canvasOwner",
                    icon: "na na-chart-staked-column",
                },
                "horizontalBar": {
                    type: "horizontalBar",
                    element: "canvasOwner",
                    icon: "na na-chart-horizontal-bar",
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
                /*"table": {
                    type: "table",
                    element: "pv-data-table",
                    icon: "fa fa-table",
                },*/
                "pivot": {
                    type: "pivot",
                    element: "pv-pivot",
                    icon: "fa fa-table",
                },
            }
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
            loadSources: function () {
                var self = this;
                self.sources.splice(0);
                self.model.$methods.listVariables(self.model.variables, function (list) {
                    list.forEach(function (variable) {
                        if (variable.file) {
                            self.sources.push(variable.file);
                        }
                    });
                });
            },
            toggleConfig: function () {
                $("#configChart").toggleClass($("#configChart").attr("data-toggle"));
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
            setType: function(chart) {
                this.model.chart_type=chart.type;
                this.chartType=chart.type;
                $(this.$el).find('.canvasOwner').addClass("collapse");
                $(this.$el).find('.pv-data-table').addClass("collapse");
                $(this.$el).find('.pv-pivot').addClass("collapse");
                $(this.$el).find('.'+chart.element).removeClass("collapse");
                if (chart.element==='canvasOwner') {
                    if(!$(this.$el).find(".div-ajax-loader").is(':visible')) {
                        this.drawChart();
                    }
                }
                if(chart.element==='pv-data-table') {

                }
                if(chart.element==='pv-pivot') {
                    this.refreshPivot();
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
                (self.model.cols?self.model.cols:"").split(",").forEach(function(name) {
                    if(name) self.cols.push(name);
                });
                self.rows.push('variable');
                (self.model.rows?self.model.rows:"").split(",").forEach(function(name) {
                    if(self.model.rows) self.rows.push(name);
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
                Vue.nextTick(function () {
                    if($(self.$el).find(".pv-pivot").is(':visible')) {
                        self.refreshPivot();
                    }
                });
                /**
                 * Add a chart
                 */
                function addChart(rowId) {
                    var $canvas = $("<canvas></canvas>");
                    $(self.$el).find(".canvasOwner").append($canvas);
                    var ctx = $canvas[0];
                    var chartData = {
                        //labels: [],
                        datasets: []
                    };
                    chartData.labels = data.x;
                    chartData.datasets = [];
                    var colors = [];
                    for(var color in window.chartColors) {
                        colors.push(color);
                    }
                    var axis=["y-axis-2","y-axis-1"];
                    for(var a in data.series[rowId]) {
                        var yl=[a];
                        rowId.split("\x1b").forEach(function(name){
                            if (self.model.rows) yl.push(name);
                        });
                        self.ys.push(data.series[rowId][a]);
                        self.ys_label.push(yl);
                        chartData.datasets.push({
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
                                cutoutPercentage: 50
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

                    }
                }
            },
            /**
             * Generate Datatable from table
             */
            refreshPivot: function () {
                    var self = this;
                    var html = $(self.$el).find(".pv-data-table").html();
                    $(self.$el).find(".pv-pivot").html(html);
                    var table = $(self.$el).find(".pv-pivot table").DataTable( {
                        scrollY: "300px",
                        scrollX: true,
                        scrollCollapse: true,
                        paging: false,
                        fixedColumns: {leftColumns: self.rows.length},
                        language: {
                            url: API_SERVER+"/api/lang/datatable"
                        },
                        "dom": 'Bt',
                        buttons: [
                            {
                                extend: 'excelHtml5',
                                text: '<i class="fa fa-file-excel-o"></i> Excel',
                                title: self.model.name,
                                download: 'open',
                                orientation:'landscape',
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                            /*{
                                extend: 'pdfHtml5',
                                text: '<i class="fa fa-file-pdf-o"></i> PDF',
                                title: self.model.name,
                                download: 'open',
                                orientation:'landscape',
                                exportOptions: {
                                    columns: ':visible'
                                }
                            }*/
                        ]
                    } );
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
                this.loadSources();
                $(this.$el).find(".canvasOwner").html('');
                try {
                    var listCols = self.toList(model.cols);
                    var listVars = self.toList(model.variables);
                    if (
                      !model.aggregator || !listCols || listCols==='null' ||
                      !listVars || listVars==='null'
                    ) {
                        return;
                    }
                    $(this.$el).find(".div-ajax-loader").show();
                    $.ajax({
                        url: API_SERVER+'/api/pivot/valores_produccion/'+
                          model.aggregator+'/defecto_valor_cargado/'+
                          self.toList(model.rows)+'/'+listCols+'/'+
                          listVars + '?filter='+model.filter,
                        dataType: 'json',
                        success:function(data) {
                            $(self.$el).find(".div-ajax-loader").hide();
                            self.data = data;
                            if (self.model.chart_type) {
                                self.setType(self.chartTypes[self.model.chart_type]);
                            } else {
                                self.drawChart();
                            }
                        },
                    });
                } catch(e) {
                    
                } 
            },
        },
        ready() {
            console.log("READY", $(this.$el).find(".pv-data-table").html());
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
