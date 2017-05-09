var console = PHP;

function array_find(array, ev) {
    var a;
    for (var i = 0, l = array.length; i < l; i++) {
        var item = array[i];
        if (ev(item)) {
            return item;
        }
    }
    return null;
}
function array2array(array, ev) {
    var a = [];
    array.forEach(function (item) {
        var e = eval(ev);
        if (e !== undefined) {
            a.push(e)
        }
    });
    return a;
}
function array2object(array, key, value) {
    var a = {};
    array.forEach(function (item) {
        a[eval(key)] = eval(value);
    });
    return a;
}
function object2array(object, ev) {
    var a = [];
    for (var key in object) {
        item = object[key];
        a.push(eval(ev))
    }
    return a;
}
var Element = function (base, me) {
    for (var a in base) {
        me[a] = base[a];
    }
}
var Module = function (base) {
    Element(base, this);
    this.install = function () {
        //	var module=PHP.createModule(base);
        PHP.createFolders([
//            'app/Http/Controllers/' + base.name,
            'app/Models/' + base.name,
//			'database/factories/'+base.name,
//			'database/seeds/'+base.name,
        ]);
        for (var i in base.models) {
            base.models[i].setModule(this);
            base.models[i].install();
        }
        for (var i in base.models) {
            base.models[i].setModule(this);
            base.models[i].install();
        }
        PHP.createFile('public/swagger/' + base.name + '.json', JSON.stringify(Swagger.generate(base.name, '1.0.0', 'localhost', this.models)));
        PHP.createFile('resources/assets/js/modules/' + base.name + '.vue', VueComponent.generate(base, base.views, base.data, PHP.template));
        PHP.registerMenu(
            {
                path: base.menu,
                name: base.name,
                text: base.title,
                icon: base.icon,
            },
            base.name
        );
    }
    this.install();
}
Module.Model = function (base) {
    Element(base, this);
    var module;
    this.setModule = function (module0) {
        module = module0;
    }
    this.install = function () {
        for (var i in base.associations) {
            base.associations[i].setModule(module);
        }
        PHP.createClass({
            filename: 'app/Models/' + module.name + '/' + PHP.upper_camel_case(base.name) + '.php',
            namespace: 'App\\Models\\' + module.name,
            uses: [
                'Illuminate\\Database\\Eloquent\\Model',
                'Illuminate\\Database\\Eloquent\\SoftDeletes',
            ],
            name: PHP.upper_camel_case(base.name),
            extends: 'Model',
            traits: ['SoftDeletes'],
            properties: {
                'protected $table': Module.Model.getTableName(module, base),
                'protected $fillable': array2array(base.fields, 'item.name').concat(array2array(base.associations, 'item.getFillableName()')),
                'protected $attributes': array2object(base.fields, 'item.name', 'item.default'),
                'protected $casts': array2object(base.fields, 'item.name', 'item.type'),
            },
            methods: Object.assign({}, array2object(base.associations, 'item.name', 'item.code()'), base.methods),
        });
        PHP.createClass({
            filename: PHP.createMigration('Create' + PHP.upper_camel_case(module.prefix) + PHP.upper_camel_case(PHP.str_plural(base.name)) + 'Table'),
            namespace: "",
            uses: [
                'Illuminate\\Support\\Facades\\Schema',
                'Illuminate\\Database\\Schema\\Blueprint',
                'Illuminate\\Database\\Migrations\\Migration',
            ],
            name: 'Create' + PHP.upper_camel_case(module.prefix) + PHP.upper_camel_case(PHP.str_plural(base.name)) + 'Table',
            extends: 'Migration',
            traits: [],
            properties: [],
            methods: {
                'up': "    public function up()\n" +
                  "    {\n" +
                  "        Schema::create('" + Module.Model.getTableName(module, base) + "', function (Blueprint $table) {\n" +
                  "            $table->increments('id');\n" +
                  array2array(base.fields, 'item.migration()').join("\n") + "\n" +
                  array2array(base.associations, 'item.migration()').join("") +
                  "            $table->timestamps();\n" +
                  "            $table->softDeletes();\n" +
                  "        });\n" +
                  "    }\n",
                'down': "    public function down()\n" +
                  "    {\n" +
                  "        Schema::dropIfExists('" + Module.Model.getTableName(module, base) + "');\n" +
                  "    }\n"
            },
        });
    }
    this.swaggerDefinition = function () {
        var properties;
        for (var i in base.associations) {
            base.associations[i].setModule(this);
        }
        properties = array2object(base.fields, 'item.name', 'item.swaggerDefinition()');
        properties.created_at = {
            "$ref": "#/definitions/DateTime"
        };
        properties.updated_at = {
            "$ref": "#/definitions/DateTime"
        };
        return {
            "type": "object",
            "required": [
                "type"
            ],
            "properties": {
                "id": {
                    "type": "string",
                    "example": "1001"
                },
                "type": {
                    "default": this.name,
                    "type": "string",
                    "example": this.name
                },
                "attributes": {
                    "required": [
                    ],
                    "type": "object",
                    "properties": properties
                }
            }
        };
    }
    this.plural = function () {
        return PHP.str_plural(this.name);
    }
    this.Plural = function () {
        var str = this.plural();
        return str.charAt(0).toUpperCase() + str.slice(1);
    }
    this.upperCamelCase = function () {
        return PHP.upper_camel_case(this.name);
    }
}
Module.Model.addIndex = function (table, type, columns) {
    return "            Schema::table('" + table + "', function (Blueprint $table) {\n" +
      "                $table->" + type + "(" + JSON.stringify(columns) + ");\n" +
      "            });\n";
}
Module.Model.getTableName = function (module, model) {
    return !model.table ? module.prefix + '_' + PHP.str_plural(PHP.snake_case(model.name)) : model.table;
}
Module.Model.Field = function (base) {
    Element(base, this);
    var module;
    this.setModule = function (module0) {
        module = module0;
    }
    this.migration = function () {
        var type=base.type;
        switch(base.type) {
            case 'array':
                type="string";
                break;
        }
        var code = "            $table->" + type + "('" + base.name + "')" +
          (base.required ? '' : '->nullable()') + ";";
        return code;
    }
    this.swaggerDefinition = function () {
        return base;
    }
}
Module.Model.HasOne = function (base) {
    Element(base, this);
    var module;
    this.setModule = function (module0) {
        module = module0;
    }
    this.code = function () {
        return "    public function " + base.name + "()\n" +
          "    {\n" +
          "        return $this->hasOne('App\\Models\\" + module.name + "\\" + PHP.upper_camel_case(base.model) + "'" +
          (typeof base.columns === 'undefined' ? '' : ',' + JSON.stringify(base.references) + ',' + JSON.stringify(base.columns)) + ");\n" +
          "    }\n";
    }
    this.migration = function () {
        var mig = "";
        if (typeof base.columns !== 'undefined') {
            var fmodel = array_find(module.models, function (item) {
                return item.name == base.model;
            });
            mig += Module.Model.addIndex(Module.Model.getTableName(module, fmodel), "index", base.references);
            mig += "            $table->foreign(" + JSON.stringify(base.columns) + ")->references(" + JSON.stringify(base.references) + ")->on('" + Module.Model.getTableName(module, fmodel) + "')->onDelete('cascade');\n";
        }
        return mig;
    }
    this.getFillableName = function () {
        return undefined;
    }
}
Module.Model.HasMany = function (base) {
    Element(base, this);
    var module;
    this.setModule = function (module0) {
        module = module0;
    }
    this.code = function () {
        return "    public function " + base.name + "()\n" +
          "    {\n" +
          "        return $this->hasMany('App\\Models\\" + module.name + "\\" + PHP.upper_camel_case(base.model) + "');\n" +
          "    }\n";
    }
    this.migration = function () {
        var mig = "";
        return mig;
    }
    this.getFillableName = function () {
        return undefined;
    }
}
Module.Model.BelongsTo = function (base) {
    Element(base, this);
    var module;
    this.setModule = function (module0) {
        module = module0;
    }
    this.code = function () {
        return "    public function " + base.name + "()\n" +
          "    {\n" +
          "        return $this->belongsTo('App\\Models\\" + module.name + "\\" + PHP.upper_camel_case(base.model) + "'" +
          (typeof base.columns === 'undefined' ? '' : ',' + PHP.var_export(base.references) + ',' + PHP.var_export(base.columns) + ");\n") +
          ");\n" +
          "    }\n";
    }
    this.migration = function () {
        var foreign = PHP.snake_case(base.name);
        return "            $table->integer('" + foreign + "_id')->unsigned()->nullable();\n";
    }
    this.foreign = function () {
        var fmodel = array_find(module.models, function (item) {
            return item.name == base.model;
        });
        var foreign = PHP.snake_case(fmodel.name);
        return "            $table->foreign('" + foreign + "_id')->references('id')->on('" + Module.Model.getTableName(module, fmodel) + "')->onDelete('cascade');\n";
    }
    this.getFillableName = function () {
        return base.name + '_id';
    }
}
Module.Model.BelongsToMany = function (base) {
    Element(base, this);
    var module;
    this.setModule = function (module0) {
        module = module0;
    }
    this.code = function () {
        
        return "    public function " + base.name + "()\n" +
          "    {\n" +
          "        return $this->belongsToMany('App\\Models\\" + (base.module?base.module:module.name) + "\\" + PHP.upper_camel_case(base.model) + "');\n" +
          "    }\n";
    }
    this.migration = function () {
        return "";
    }
    this.getFillableName = function () {
        return undefined;
    }
}
//////
Module.stringify = function (o) {
    if (typeof o === 'function') {
        return o.toString();
    } else if (o === null) {
        return 'null';
    } else if (typeof o === 'object' && typeof o.getCode === 'function') {
        return o.getCode();
    } else if (typeof o === 'object' && typeof o.forEach === 'function') {
        var r = [];
        o.forEach(function (v) {
            r.push(Module.stringify(v));
        });
        return "[" + r.join(",") + "]";
    } else if (typeof o === 'object') {
        var r = [];
        for (var a in o) {
            r.push(JSON.stringify(a) + ":" + Module.stringify(o[a]));
        }
        return "{" + r.join(",") + "}";
    } else {
        return JSON.stringify(o);
    }
}
//////View
Module.View = function () {

}
Module.View.Model = function (base) {
    Element(base, this);
    this.getCode = function (name) {
        return name + ' = function (url, id) {\n'
          + '    var self = this;\n'
          + '    this.$defaultUrl = ' + JSON.stringify("/api/" + PHP.str_plural(this.model).split('.').join('/')) + ';\n'
          + '    Model.call(this, url, id, ' + JSON.stringify(name) + ');\n'
          + '    this.$list = function () {\n'
          + '        return ' + Module.stringify(this.list) + ';\n'
          + '    };\n'
          + '    this.$name = ' + JSON.stringify(name.split('.').pop()) + ';\n'
          + '    this.$pluralName = ' + JSON.stringify(PHP.str_plural(name.split('.').pop())) + ';\n'
          + '    this.$title = ' + JSON.stringify(base.title) + ';\n'
          + '    this.$pluralTitle = ' + JSON.stringify(base.pluralTitle) + ';\n'
          + '    this.$ = ' + Module.stringify(array2object(this.fields, 'item.name', 'item')) + ';\n'
          + '    this.$fields = function () {\n'
          + '        return this.object2array(this.$, "item");\n'
          + '    };\n'
          + '    this.$columns = function () {\n'
          + '        return ' + Module.stringify(this.columns) + ';\n'
          + '    };\n'
          + '    this.$methods = {\n'
          + (typeof base.methods !== 'undefined' ? base.methods.join(',\n        ') : '')
          + '    };\n'
          + '    this.$initFields();\n'
          + '    if(id) {\n'
          + '        this.$load(id);\n'
          + '    }\n'
          + '}\n'
          + name + '.prototype = Object.create(Model.prototype);\n'
          + name + '.prototype.constructor = Model;\n'
          + '';
    }
}
Module.View.ModelInstance = function (base, url, id) {
    var self = this;
    this.getCode = function () {
        var urlFn = !url ? '' : 'function(){try{var url="/api/' + url.replace(/\{([^}]+)\}/, function (ma0, ma1) {
            return '"+(' + ma1 + '?' + ma1 + ':"¡@!")+"'
        }) + '";return API_SERVER+(url.indexOf("¡@!")===-1?url:this.$defaultUrl);}catch(err){return API_SERVER+this.$defaultUrl;}}';
        return 'new ' + base + '(' + urlFn + (id ? ',' + id : '') + ')';
    }
    this.callMethod = function (methodName, params, childrenAssociation) {
        return {
            getCode: function () {
                return '(' + self.getCode() + ').$selectFrom(' +
                  Module.stringify(methodName) +
                  ', ' + Module.stringify(params) +
                  ', ' + Module.stringify(childrenAssociation) + ')';
            }
        }
    }
}
Module.View.Code = function (fn) {
    this.getCode = function () {
        return '(' + fn.toString() + ')()';
    }
}

/**
 * Helper definitions
 */
Module.Model.Field.UI = {
    SELECT: "select",
    TEXT: "text",
    PASSWORD: "password",
    TAGS: "tags",
};
Module.Model.Field.TYPE = {
    STRING: "string",
    NUMBER: "number",
    DOUBLE: "double",
};
