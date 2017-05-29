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
function object2object(object, key0, value0) {
    var a = {};
    for (var key in object) {
        var item = object[key];
        a[eval(key0)] = eval(value0);
    }
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
    Module.instances[base.name] = this;
    Element(base, this);
    this.template = PHP.template;
    this.register = function () {
        for (var i in base.models) {
            base.models[i].setModule(this);
        }
    }
    this.install = function () {
        PHP.createFolders([
            'app/Models/' + base.name,
        ]);
        for (var i in base.models) {
            base.models[i].install();
        }
        PHP.createFile('public/swagger/' + base.name + '.json', JSON.stringify(Swagger.generate(base.name, '1.0.0', 'localhost', this.models)));
        PHP.createFile('resources/assets/js/modules/' + base.name + '.vue', VueComponent.generate(base, base.views, base.data, this.template));
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
    this.$models=function(name) {
        return this.models.find(function(model){return model.name==name});
    }
    this.register();
    //this.install();
}
Module.instances={};
Module.Model = function (base) {
    var self=this;
    Element(base, this);
    var module;
    this.setModule = function (module0) {
        module = module0;
    }
    this.install = function () {
        for (var i in base.associations) {
            base.associations[i].setModule(module);
        }
        if (base.events) for(var eventName in base.events) {
            var $properties = {};
            $properties['public $' + PHP.camel_case(base.name)] = null;
            PHP.createClass({
                filename: 'app/Events/' + module.name + '/' + PHP.upper_camel_case(base.name) + PHP.upper_camel_case(eventName) + '.php',
                namespace: 'App\\Events\\' + module.name,
                uses: [
                    'Illuminate\\Broadcasting\\Channel',
                    'Illuminate\\Queue\\SerializesModels',
                    'Illuminate\\Broadcasting\\PrivateChannel',
                    'Illuminate\\Broadcasting\\InteractsWithSockets',
                    'Illuminate\\Contracts\\Broadcasting\\ShouldBroadcast',
                    'App\\Models\\'+module.name+'\\'+PHP.upper_camel_case(base.name),
                ],
                name: PHP.upper_camel_case(base.name) + PHP.upper_camel_case(eventName),
                extends: '',
                implements: ['ShouldBroadcast'],
                traits: ['InteractsWithSockets'/*, 'SerializesModels'*/],
                properties: $properties,
                methods: {
                    '__construct': "public function __construct("+PHP.upper_camel_case(base.name)+" $model){$this->"+PHP.camel_case(base.name)+"=$model;}",
                    'broadcastOn': "public function broadcastOn(){return new PrivateChannel('channel-name');}",
                },
            });
            PHP.createClass({
                filename: 'app/Listeners/' + module.name + '/' + PHP.upper_camel_case(base.name) + PHP.upper_camel_case(eventName) + 'Listener.php',
                namespace: 'App\\Listeners\\' + module.name,
                uses: [
                    'Illuminate\\Queue\\InteractsWithQueue',
                    'Illuminate\\Contracts\\Queue\\ShouldQueue',
                    'App\\Models\\'+module.name+'\\'+PHP.upper_camel_case(base.name),
                    'App\\Events\\'+module.name+'\\'+PHP.upper_camel_case(base.name)+ PHP.upper_camel_case(eventName),
                ],
                name: PHP.upper_camel_case(base.name) + PHP.upper_camel_case(eventName)+'Listener',
                extends: '',
                implements: [],
                traits: [],
                properties: $properties,
                methods: {
                    'handle': "public function handle"+base.events[eventName].trim().substr(8),
                },
            });
            PHP.registerListener(
                'App\\Events\\' + module.name + '\\' + PHP.upper_camel_case(base.name) + PHP.upper_camel_case(eventName),
                'App\\Listeners\\' + module.name + '\\' + PHP.upper_camel_case(base.name) + PHP.upper_camel_case(eventName)+'Listener'
            );
        }
        PHP.createClass({
            filename: 'app/Models/' + module.name + '/' + PHP.upper_camel_case(base.name) + '.php',
            namespace: 'App\\Models\\' + module.name,
            uses: [
                'Illuminate\\Database\\Eloquent\\Model',
                'Illuminate\\Database\\Eloquent\\SoftDeletes',
                'Illuminate\\Notifications\\Notifiable',
            ],
            name: PHP.upper_camel_case(base.name),
            extends: 'Model',
            traits: ['SoftDeletes','Notifiable'],
            properties: {
                'protected $table': Module.Model.getTableName(module, base),
                'protected $fillable': array2array(base.fields, 'item.name').concat(array2array(base.associations, 'item.getFillableName()')),
                'protected $attributes': array2object(base.fields, 'item.name', 'item.default'),
                'protected $casts': array2object(base.fields, 'item.name', 'item.type'),
                'protected $events': object2object(base.events, 'key', JSON.stringify('App\\Events\\'+module.name + '\\' + PHP.upper_camel_case(base.name)) + " + PHP.upper_camel_case(key)"),
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
                  array2array(base.fields, 'item.migration("'+self.name+'")').join("\n") + "\n" +
                  array2array(base.associations, 'item.migration("'+self.name+'")').join("") +
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
                type="text";
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
          "        return $this->belongsTo('App\\Models\\" + (base.module?base.module:module.name) + "\\" + PHP.upper_camel_case(base.model) + "'" +
          (typeof base.columns === 'undefined' ? '' : ',' + PHP.var_export(base.references) + ',' + PHP.var_export(base.columns) + ");\n") +
          ");\n" +
          "    }\n";
    }
    this.migration = function (modelName) {
        var foreign = PHP.snake_case(base.name);
        var foreignModule = base.module?Module.instances[base.module]:module;
        console.log("Schema::table('"+Module.Model.getTableName(module, module.$models(modelName))+"', function (Blueprint $table) {\n            $table->foreign('" + foreign + "_id')->references('id')->on('" +
            Module.Model.getTableName(foreignModule, foreignModule.$models(base.model)) +
            "')->onDelete('" + (base.nullable?'set null':'cascade') + "');\n});");
        
        return "            $table->integer('" + foreign + "_id')->unsigned()"+
            (base.nullable?'->nullable()':'') + ";\n" /*+
            "            $table->foreign('" + foreign + "_id')->references('id')->on('" +
            Module.Model.getTableName(foreignModule, foreignModule.$models(base.model)) +
            "')->onDelete('" + (base.nullable?'set null':'cascade') + "');\n"*/;
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
        var urlFn = !url ? '' : 'function(){try{var url="/api/' + url.replace(/\{([^}]+)\}/g, function (ma0, ma1) {
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
