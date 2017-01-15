var console = PHP;

function array_find(array, ev) {
    var a;
    for (var i = 0, l = array.length; i < l; i++) {
        var item = array[i];
        if (eval(ev)) {
            return item;
        }
    }
    return null;
}
function array2array(array, ev) {
    var a = [];
    array.forEach(function (item) {
        a.push(eval(ev))
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
            'app/Http/Controllers/' + base.name,
            'app/Models/' + base.name,
//			'database/factories/'+base.name,
//			'database/seeds/'+base.name,
        ]);
        for (var i in base.models) {
            base.models[i].setModule(this);
            base.models[i].install();
        }
        PHP.createFile('public/swagger/' + base.name + '.json', JSON.stringify(Swagger.generate(base.name, '1.0.0', 'localhost', this.models)));
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
                'protected $table': module.prefix + '_' + PHP.str_plural(base.name),
                'protected $fillable': array2array(base.fields, 'item.name'),
                'protected $attributes': array2object(base.fields, 'item.name', 'item.default'),
                'protected $casts': array2object(base.fields, 'item.name', 'item.type'),
            },
            methods: Object.assign({}, array2object(base.associations, 'item.name', 'item.code()'), base.methods),
        });
        PHP.createClass({
            filename: PHP.createMigration('Create' + PHP.upper_camel_case(PHP.str_plural(base.name)) + 'Table'),
            namespace: "",
            uses: [
                'Illuminate\\Support\\Facades\\Schema',
                'Illuminate\\Database\\Schema\\Blueprint',
                'Illuminate\\Database\\Migrations\\Migration',
            ],
            name: 'Create' + PHP.upper_camel_case(PHP.str_plural(base.name)) + 'Table',
            extends: 'Migration',
            traits: [],
            properties: [],
            methods: {
                'up': "    public function up()\n" +
                    "    {\n" +
                    "        Schema::create('" + module.prefix + '_' + PHP.str_plural(PHP.snake_case(base.name)) + "', function (Blueprint $table) {\n" +
                    "            $table->increments('id');\n" +
                    array2array(base.fields, 'item.migration()').join("\n") + "\n" +
                    array2array(base.associations, 'item.migration()').join("") +
                    "            $table->timestamps();\n" +
                    "            $table->softDeletes();\n" +
                    "        });\n" +
                    "    }\n",
                'down': "    public function down()\n" +
                    "    {\n" +
                    "        Schema::dropIfExists('" + PHP.snake_case(base.name) + "');\n" +
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
Module.Model.Field = function (base) {
    Element(base, this);
    var module;
    this.setModule = function (module0) {
        module = module0;
    }
    this.migration = function () {
        var code = "            $table->" + base.type + "('" + base.name + "')" +
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
            "        return $this->hasOne('App\\Models\\" + module.name + "\\" + PHP.upper_camel_case(base.model) + "');\n" +
            "    }\n";
    }
    this.migration = function () {
        return "";
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
        return "";
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
            "        return $this->belongsTo('App\\Models\\" + module.name + "\\" + PHP.upper_camel_case(base.model) + "');\n" +
            "    }\n";
    }
    this.migration = function () {
        var dd = array_find(module.models, function (item) {
            return item.name == base.model;
        });
        var foreign = PHP.snake_case(dd.name);
        return "            $table->integer('" + foreign + "_id')->unsigned()->nullable();\n";
    }
    this.foreign = function () {
        var foreign = PHP.snake_case(array_find(module.models, function (item) {
            return item.name == base.model
        }).name);
        return "            $table->foreign('" + foreign + "_id')->references('id')->on('" + PHP.snake_case(base.model) + "')->onDelete('cascade');\n";
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
            "        return $this->belongsToMany('App\\Models\\" + module.name + "\\" + PHP.upper_camel_case(base.model) + "');\n" +
            "    }\n";
    }
    this.migration = function () {
        return "";
    }
}
