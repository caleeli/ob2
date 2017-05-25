var VueComponent = {};

VueComponent.generate = function (module, views, data, template) {
    module.models.forEach(function (model) {
        var modelName = PHP.upper_camel_case(model.name);
        if (typeof views[modelName] === 'undefined') {
            var list = [];
            var fields = [];
            var columns = [];
            var methods = [];
            model.fields.forEach(function (field) {
                if (typeof field.form === 'undefined' || field.form) {
                    fields.push({
                        name: field.name,
                        label: typeof field.label === 'undefined' ? field.name : field.label,
                        type: typeof field.ui === 'undefined' ? 'text' : field.ui,
                        enum: typeof field.enum === 'undefined' ? [] : field.enum,
                        source: field.source,
                        textField: field.textField,
                        value: field.name,
                        isAssociation: false,
                    });
                }
                if (typeof field.list === 'undefined' || field.list) {
                    list.push(field.name);
                    var columnDef = {
                        title: typeof field.label === 'undefined' ? field.name : field.label,
                        data: "attributes." + field.name,
                    };
                    if (typeof field.textField==='function') {
                        columnDef.render = field.textField;
                    } else if (typeof field.textField!=='undefined') {
                        columnDef.data = field.textField;
                    }
                    columns.push(columnDef);
                }
            });
            model.associations.forEach(function (field) {
                if (typeof field.form !== 'undefined' && field.form) {
                    var def = {
                        name: field.name,
                        label: typeof field.label === 'undefined' ? field.name : field.label,
                        type: typeof field.ui === 'undefined' ? 'text' : field.ui,
                        enum: typeof field.enum === 'undefined' ? [] : field.enum,
                        source: field.source,
                        textField: field.textField,
                        value: field.name,
                        isAssociation: true,
                        isMultiple: field instanceof Module.Model.HasMany ||
                            field instanceof Module.Model.BelongsToMany,
                    };
                    if(typeof field.position!=="undefined") {
                        fields.splice(field.position, 0, def);
                    } else {
                        fields.push(def);
                    }
                }
                if (typeof field.list !== 'undefined' && field.list) {
                    if (typeof field.textField === 'undefined') {
                        throw new Exception("'textField' is required for " + model.name + "." + field.name);
                    }
                    var def = {
                        title: typeof field.label === 'undefined' ? field.name : field.label,
                        data: "relationships." + field.name + ".attributes." + field.textField,
                        render: function (data, type, full, meta) {
                            return data ? data : '';
                        }
                    };
                    if(typeof field.position!=="undefined") {
                        columns.splice(field.position, 0, def);
                        list.splice(field.position, 0, field.name);
                    } else {
                        columns.push(def);
                        list.push(field.name);
                    }
                }
            });
            if (typeof model.methods !== 'undefined') {
                for (var m in model.methods) {
                    var method = m.split('(')[0];
                    var params = m.split('(')[1].split(')')[0].split(',');
                    if(method.substr(0,1)==='-') {
                        continue;
                    }
                    if(params[0]==='') {
                        params.pop();
                    }
                    var paramsCall = [];
                    params.forEach(function (p) {
                        paramsCall.push('"' + p.trim() + '":' + p.trim());
                    });
                    params.push('methodCallback');
                    params.push('childrenAssociation');
                    if (typeof model.methods[m]==='function') {
                        methods.push(method + ": " + model.methods[m].toString());
                    } else {
                        methods.push(method + ":function(" + params.join(',') + "){self.$call(" + JSON.stringify(method) + ",{" + paramsCall.join(',') + "}, childrenAssociation, methodCallback)}");
                    }
                }
            }
            var modelConfig = {
                model: module.name + '.' + model.name,
                title: model.title?model.title:model.name,
                pluralTitle: model.pluralTitle ? model.pluralTitle : PHP.str_plural(model.name),
                list: "fields=" + list.join(","),
                fields: fields,
                columns: columns,
                methods: methods,
            };
            views[modelName] = new Module.View.Model(modelConfig);
        }
    });
    return template +
        '\n<script>' +
        '\n    var module;' +
        '\n    var Model = require("../models/Model.js").default;' +
        '\n    var ' + module.name + ' = {};' +
        '\n    window.' + module.name + ' = ' + module.name + ';' +
        '\n    ' + object2array(views, "item.getCode('" + module.name + ".'+key)").join("\n") +
        '\n    export default {' +
        '\n        props:[' +
        '\n        ],' +
        '\n        methods: {' +
        (module.methods?'\n' + object2array(module.methods, '"            "+JSON.stringify(key)+":"+item.toString()+","').join("\n"):'')+
        '\n        },' +
        '\n        data: function () {' +
        '\n            module = this;' +
        '\n            return {' +
        '\n                path: [],' +
        '\n                ' + object2array(data, "key+': '+item.getCode()+','").join("\n") +
        '\n            }' +
        '\n        },' +
        '\n        mounted: function() {' +
        '\n            var self = this;' +
        '\n            this.path = this.$children[0].path;' +
        '\n            if (this.$children[1] && this.$children[1].path) this.path.push(this.$children[1].path);' +
        '\n        }' +
        '\n    }' +
        '\n</script>';
}
