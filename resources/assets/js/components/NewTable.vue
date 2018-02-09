<template>
    <div>
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <h3>{{title}}</h3>
            </div>
            <div class="col-md-2 col-xs-4" style="text-align: right;">
                Buscar:
            </div>
            <div class="col-md-4 col-xs-8">
                <input class="form-control" v-model='filterText' v-on:keyup='filter'>
            </div>
        </div>
        <table class="table table-striped table-hover ">
            <thead>
                <tr>
                    <th v-for="group in groupByFields"></th>
                    <th v-for="header in headers">{{header}}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for='row in pageRows' v-bind:class="rowClass(row)" v-if="isVisible(row)">
                    <td v-for="group in groupByFields"><a href="javascript:void(0)" v-on:click="openCloseRow(row)"><i v-bind:class="groupClass(row, group)"></i></a></td>
                    <td v-for="field in fields" v-on:click="selectRow(row)" style="cursor: pointer;">{{format(row, field)}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props:[
            "model",
            "toolbar",
            "refreshWith",
            "group",
            "open",
            "title",
            "id_field",
//            {name:"page", type: Number},
//            {name:"rows", type: Number},
        ],
        data: function () {
            return {
                data: [],
                page: 0,
                rows: 300,
                opened: [this.open?this.open.split(","):[]],
                filterText: '',
            };
        },
        computed: {
            pageRows: function () {
                var self = this;
                var clone = [];
                var filter = self.filterText.toLowerCase();
                var lastParent = null;
                var lastParentOk = true;
                for(var i=self.page*self.rows,
                    l=Math.min(self.page*self.rows+self.rows, self.data.length);
                    i<l;
                    i++
                ) {
                    var ok = true;
                    if (filter) {
                        ok = false;
                        var columns = self.model.$columns();
                        for (var a in self.data[i].attributes) {
                            if (columns.find(function(e){return "attributes."+a===e.data})===undefined) {
                                continue;
                            }
                            var text = String(self.data[i].attributes[a]);
                            if (text.toLowerCase().indexOf(filter)>-1) {
                                ok = true;
                                break;
                            }
                        }
                        if (self.isParent(self.data[i])) {
                            lastParent = self.data[i];
                            lastParentOk = ok;
                        }
                        if (ok && self.isChildOf(self.data[i], lastParent) && !lastParentOk) {
                            clone.push(lastParent);
                            lastParentOk = true;
                            if (!self.isOpened(lastParent)) {
                                self.openCloseRow(lastParent)
                            }
                        }
                    }
                    ok ? clone.push(self.data[i]) : undefined;
                }
                return clone;
            },
            groupByFields: function () {
                var self = this;
                return self.group ? self.group.split(",") : [];
            },
            headers: function () {
                var headers = [];
                this.model.$columns().forEach(function (field) {
                    headers.push(field.title);
                });
                return headers;
            },
            fields: function () {
                var fields = [];
                this.model.$columns().forEach(function (field) {
                    fields.push(field.data);
                });
                return fields;
            }
        },
        methods: {
            getGroupKey: function (row) {
                var self = this;
                var keys = self.groupByFields;
                var values = [];
                keys.forEach(function (key) {
                    var keyCode = row.attributes[key].split(".");
                    values.push(keyCode.length==1 || keyCode[1]=='0' ? 0 : keyCode[0]);
                });
                return values;
            },
            rowClass: function (row) {
                return "";
            },
            findOpened: function (key) {
                var self = this;
                key = key.join(",");
                return self.opened.find(function (k) {
                        return k.join(",")===key;
                    });
            },
            isOpened: function (row) {
                var self = this;
                var key = [row.attributes[self.id_field]];
                return self.findOpened(key) !== undefined;
            },
            isChildOf: function (row, parent) {
                var self = this;
                var parentKey = [parent.attributes[self.id_field]].join(",");
                var key = self.getGroupKey(row).join(",");
                return parentKey === key;
            },
            isVisible: function (row) {
                var self = this;
                var key = self.getGroupKey(row);
                return self.findOpened(key) !== undefined;
            },
            isParent: function (row) {
                var self = this;
                var keys = self.getGroupKey(row);
                return keys.length===1 && keys[0]==0 && (row.attributes.es_principal*1);
            },
            groupClass: function (row, group) {
                var self = this;
                return !self.isParent(row) ? "" : self.isOpened(row) ? "fa fa-minus-circle":"fa fa-plus-circle";
            },
            format: function (row, field) {
                var script = '';
                for(var a in row) {
                    script+="var "+a+"=row['"+a+"'];";
                }
                script+=field;
                return eval(script);
            },
            openCloseRow: function (row) {
                var self = this;
                var key = [row.attributes[self.id_field]];
                var opened = self.findOpened(key);
                if (opened===undefined) {
                    self.opened.push(key);
                } else {
                    self.opened.splice(self.opened.indexOf(opened), 1);
                }
            },
            filter: function () {
                
            },
            selectRow: function (row) {
                var self = this;
                self.model.$load(row.id, function () {
                    self.$emit('selectrow', row.id, row);
                });
            }
        },
        mounted() {
            var self = this;
            self.model.$select(function (rows) {
                self.data.splice(0);
                rows.data.forEach(function (row) {
                    self.data.push(row);
                });
            }, {
                sort: self.group
            });
        }
    }
</script>
