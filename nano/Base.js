function array_find(array, ev){
	var a;
	array.forEach(function(item){
		if(eval(ev)) return a=item;
	});
	return a;
}
function array2array(array, ev){
	var a=[];
	array.forEach(function(item){
		a.push(eval(ev))
	});
	return a;
}
function array2object(array, key, value){
	var a={};
	array.forEach(function(item){
		a[eval(key)]=eval(value);
	});
	return a;
}
var Element=function(base, me){
	for(var a in base) {
		me[a]=base[a];
	}
}
var Module=function(base){
	Element(base, this);
	this.install=function(){
	//	var module=PHP.createModule(base);
		PHP.createFolders([
			'app/Http/Controllers/'+base.name,
			'app/Models/'+base.name,
//			'database/factories/'+base.name,
//			'database/seeds/'+base.name,
		]);
		for(var i in base.models){
			base.models[i].setModule(this);
			base.models[i].install();
		}
	}
	this.create();
}
Module.Model=function(base){
	Element(base, this);
	var module;
	this.setModule=function(module0){
		module=module0;
	}
	this.install=function(){
		for(var i in base.associations){
			base.associations[i].setModule(this);
		}
		//Create Model
		PHP.createClass({
			filename:'app/Models/'+module.name+'/'+PHP.upper_camel_case(base.name)+'.php',
			namespace: 'App\\Models\\'+module.name,
			uses: [
				'Illuminate\\Database\\Eloquent\\Model',
				'Illuminate\\Database\\Eloquent\\SoftDeletes',
			],
			name: PHP.upper_camel_case(base.name),
			extends: 'Model',
			traits: ['SoftDeletes'],
			properties: [
				'table': PHP.str_plural(base.name),
				'fillable': array2array(base.fields,'item.name'),
				'attributes': array2object(base.fields,'item.name','item.default'),
				'casts': array2object(base.fields,'item.name','item.type'),
			],
			methods: array2object(base.associations,'item.name','item.code()'),
		});
		//Create Migration
		PHP.createClass({
			filename: PHP.createMigration(base.name),
			namespace: "",
			uses: [
				'Illuminate\\Support\\Facades\\Schema',
				'Illuminate\\Database\\Schema\\Blueprint',
				'Illuminate\\Database\\Migrations\\Migration',
			],
			name: 'Create'+PHP.upper_camel_case(PHP.pluralize(base.name))+'Table',
			extends: 'Migration',
			traits: [],
			properties: [],
			methods: [
				'up': "    public function up()\n"+
					"    {\n"+
					"        Schema::create('"+PHP.snake_case(base.name)+"', function (Blueprint $table) {\n"+
					"            $table->increments('id');\n"+
					array2array(base.fields,'item.migration()').join("\n")+
					array2array(base.associations,'item.migration()').join("")+
					"            $table->timestamps();\n"+
					"            $table->softDeletes();\n"+
					"        });\n"+
					"    }\n",
				'down': "    public function down()\n"+
					"    {\n"+
					"        Schema::dropIfExists('"+PHP.snake_case(base.name)+"');\n"+
					"    }\n"
			],
		});
		//Create Controller
		PHP.createClass({
			filename:'app/Http/Controllers/'+module.name+'/'+PHP.upper_camel_case(base.name)+'.php',
			namespace: 'App\\Http\\Controllers\\'+module.name,
			uses: [
				'Illuminate\\Database\\Eloquent\\Model',
				'Illuminate\\Database\\Eloquent\\SoftDeletes',
			],
			name: PHP.upper_camel_case(base.name),
			extends: 'Model',
			traits: ['SoftDeletes'],
			properties: [
				'table': PHP.str_plural(base.name),
				'fillable': array2array(base.fields,'item.name'),
				'attributes': array2object(base.fields,'item.name','item.default'),
				'casts': array2object(base.fields,'item.name','item.type'),
			],
			methods: array2object(base.associations,'item.name','item.code()'),
		});
	}
}
Module.Model.Field=function(base){
	Element(base, this);
	var module;
	this.setModule=function(module0){
		module=module0;
	}
	this.migration=function(){
		var code = "            $table->"+base.type+"('"+base.name+"');" +
			(base.required?'':'->nullable()');
		return code;
	}
}
Module.Model.HasOne=function(base){
	Element(base, this);
	var module;
	this.setModule=function(module0){
		module=module0;
	}
	this.code=function(){
		return "    public function "+base.name+"()\n"+
		"    {\n"+
		"        return $this->hasOne('App\\Model\\"+module.name+"\\"+PHP.upper_camel_case(basem.model)+"');\n"+
		"    }\n";
	}
	this.migration=function(){
		return "";
	}
}
Module.Model.HasMany=function(base){
	Element(base, this);
	var module;
	this.setModule=function(module0){
		module=module0;
	}
	this.code=function(){
		return "    public function "+base.name+"()\n"+
		"    {\n"+
		"        return $this->hasMany('App\\Model\\"+module.name+"\\"+PHP.upper_camel_case(basem.model)+"');\n"+
		"    }\n";
	}
	this.migration=function(){
		return "";
	}
}
Module.Model.BelongsTo=function(base){
	Element(base, this);
	var module;
	this.setModule=function(module0){
		module=module0;
	}
	this.code=function(){
		return "    public function "+base.name+"()\n"+
		"    {\n"+
		"        return $this->belongsTo('App\\Model\\"+module.name+"\\"+PHP.upper_camel_case(basem.model)+"');\n"+
		"    }\n";
	}
	this.migration=function(){
		var foreign = PHP.snake_case(array_find(module.models,function(item){return item.name==base.model}).name);
		return "            $table->integer('"+foreign+"_id')->unsigned()->nullable()\n";
	}
	this.foreign=function(){
		var foreign = PHP.snake_case(array_find(module.models,function(item){return item.name==base.model}).name);
		return "            $table->foreign('"+foreign+"_id')->references('id')->on('"+PHP.snake_case(base.model)+"')->onDelete('cascade');\n";
	}
}
Module.Model.BelongsToMany=function(base){
	Element(base, this);
	var module;
	this.setModule=function(module0){
		module=module0;
	}
	this.code=function(){
		return "    public function "+base.name+"()\n"+
		"    {\n"+
		"        return $this->belongsToMany('App\\Model\\"+module.name+"\\"+PHP.upper_camel_case(basem.model)+"');\n"+
		"    }\n";
	}
	this.migration=function(){
		return "";
	}
}

