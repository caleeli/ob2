//PHP: Objeto que ejecuta código en el servidor
//JS: Objeto que ejecuta código en el cliente ?? o siempre sera
//API: Objeto que ejecuta código a traves de REST API

Module.Activity = function (base) {
    base = Object({
        "name": "element",
        "fields": [
            new Module.Model.Field({
                "name": "name",
                "type": "string",
                "default": "",
                "required": true
            }),
            new Module.Model.Field({
                "name": "type",
                "type": "string",
                "default": "ACTIVITY",
                "required": false
            }),
            new Module.Model.Field({
                "name": "script",
                "type": "string",
                "default": "",
                "required": false
            }),
        ],
        "associations": [
            new Module.Model.HasMany({
                "name": "incomings",
                "model": "activity"
            }),
            new Module.Model.HasMany({
                "name": "outgoings",
                "model": "activity"
            }),
        ],
        "methods": {
        }
    }, base);
    Module.Model(base);
}
Module.Activity.prototype = Object.create(Module.Model.prototype);
Module.Activity.prototype.constructor = Module.Activity;


var module = new Module({
    "name": "Machine",
    "title": "Activity Machine",
    "models": [
        new Module.Model({
            "name": "element",
            "fields": [
                new Module.Model.Field({
                    "name": "name",
                    "type": "string",
                    "default": "",
                    "required": true
                }),
                new Module.Model.Field({
                    "name": "type",
                    "type": "string",
                    "default": "ACTIVITY",
                    "enum": ["ACTIVITY", "GATEWAY", "EVENT"],
                    "required": false
                }),
                new Module.Model.Field({
                    "name": "script",
                    "type": "string",
                    "default": "",
                    "required": false
                }),
            ],
            "associations": [
                new Module.Model.BelongsToMany({
                    "name": "incomings",
                    "model": "activity",
                    "pivot": "flow",
                    "withPivot": [
                        new Module.Model.Field({
                            "name": "condition",
                            "type": "string",
                            "default": "",
                            "required": false
                        }),
                    ],
                }),
                new Module.Model.BelongsToMany({
                    "name": "outgoings",
                    "model": "activity",
                    "pivot": "flow",
                    "withPivot": [
                        new Module.Model.Field({
                            "name": "condition",
                            "type": "string",
                            "default": "",
                            "required": false
                        }),
                    ],
                }),
            ],
            "methods": {
                "nextElements": "function nextElements($instance){\n\
                    foreach($this->outgoings() as $out){\n\
                        if($instance->evaluate($out->contidion)){\n\
                            $out->first()->tokens()->create([\n\
                                'instance_id'=>$instance->id,\n\
                            ]);\n\
                        }\n\
                    }\n\
                }"
            }
        }),
        new Module.Model({
            "name": "instance",
            "fields": [
                new Module.Model.Field({
                    "name": "status",
                    "type": "string",
                    "default": "ACTIVE",
                    "required": true,
                    "enum": ["ACTIVE", "DONE"]
                })
            ],
            "associations": [
                new Module.Model.HasMany({
                    "name": "tokens",
                    "model": "token"
                }),
                new Module.Model.BelongsTo({
                    "name": "process",
                    "model": "process"
                }),
            ],
            "methods": {
                "evaluate": "function evaluate($expression){\n\
                }",
            }
        }),
        new Module.Model({
            "name": "token",
            "fields": [
                new Module.Model.Field({
                    "name": "status",
                    "type": "string",
                    "default": "ACTIVE",
                    "required": true,
                    "enum": ["ACTIVE", "DONE"]
                })
            ],
            "associations": [
                new Module.Model.BelongsTo({
                    "name": "instance",
                    "model": "instance"
                }),
                new Module.Model.BelongsTo({
                    "name": "element",
                    "model": "element"
                }),
            ],
            "methods": {
                "done": "function done(){\n\
                    $this->status='DONE';\n\
                    $this->save();\n\
                    $this->element()->nextElements($this->instance());\n\
                }",
            }
        }),
    ]
});

