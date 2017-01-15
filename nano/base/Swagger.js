var Swagger = {};
Swagger.tags = ["nano2"];
Swagger.generate = function (title, version, host, models) {
    var paths = {};
    var definitions = {
        "ResultSuccess": {
            "type": "object",
            "required": [
                "meta"
            ],
            "properties": {
                "meta": {
                    "type": "object",
                    "required": [
                        "code"
                    ],
                    "properties": {
                        "code": {
                            "type": "string",
                            "example": "1234",
                            "description": "Result code from ApiCodes dictionary"
                        },
                        "title": {
                            "type": "string",
                            "example": "Some positive result description",
                            "description": "Result textual explanation"
                        }
                    }
                }
            }
        },
        "DateTime": {
            "type": "object",
            "required": [
                "date",
                "timezone_type",
                "timezone"
            ],
            "properties": {
                "date": {
                    "type": "string",
                    "example": "2000-01-01 00:00:00.000000"
                },
                "timezone_type": {
                    "type": "integer",
                    "example": 99
                },
                "timezone": {
                    "type": "string",
                    "example": "UTC"
                }
            }
        },
        "Pagination": {
            "type": "object",
            "required": [
                "total",
                "count",
                "per_page",
                "current_page",
                "total_pages",
                "links"
            ],
            "properties": {
                "total": {
                    "type": "integer",
                    "example": 100
                },
                "count": {
                    "type": "integer",
                    "example": 25
                },
                "per_page": {
                    "type": "integer",
                    "example": 14
                },
                "current_page": {
                    "type": "integer",
                    "example": 12
                },
                "total_pages": {
                    "type": "integer",
                    "example": 100
                },
                "links": {
                    "type": "object",
                    "properties": {
                        "next": {
                            "type": "string",
                            "example": "http://localhost/api/v1/elements?page=3"
                        },
                        "previous": {
                            "type": "string",
                            "example": "http://localhost/api/v1/elements?page=1"
                        }
                    }
                }
            }
        },
        "Meta": {
            "type": "object",
            "properties": {
                "pagination": {
                    "$ref": "#/definitions/Pagination"
                }
            }
        },
        "ErrorArray": {
            "type": "object",
            "required": [
                "errors"
            ],
            "properties": {
                "errors": {
                    "type": "array",
                    "items": {
                        "$ref": "#/definitions/Error"
                    }
                }
            }
        },
        "Error": {
            "type": "object",
            "required": [
                "code"
            ],
            "properties": {
                "code": {
                    "type": "string"
                },
                "title": {
                    "type": "string"
                },
                "detail": {
                    "type": "string"
                }
            }
        }
    };
    function responses(config) {
        return mixit({}, {
            "200": {
                "description": "",
                "schema": {
                    "title": "",
                    "description": "Json Api Response",
                    "type": "object",
                    "properties": {
                    }
                }
            },
            "404": {
                "description": "Not found",
                "schema": {
                    "$ref": "#/definitions/ErrorArray"
                }
            },
            "500": {
                "description": "Error",
                "schema": {
                    "$ref": "#/definitions/ErrorArray"
                }
            },
            "400": {
                "description": "Invalid call",
                "schema": {
                    "$ref": "#/definitions/ErrorArray"
                }
            },
            "default": {
                "description": "Unexpected error",
                "schema": {
                    "$ref": "#/definitions/ErrorArray"
                }
            }
        }, config);
    }
    models.forEach(function (model) {
        paths["/" + model.plural()] = {
            "get": {
                "tags": Swagger.tags,
                "description": "Returns all " + model.Plural(),
                "operationId": "find" + model.Plural(),
                "parameters": [
                    {
                        "name": "page",
                        "in": "query",
                        "description": "Page Nr to fetch",
                        "required": false,
                        "default": 1,
                        "type": "integer"
                    },
                    {
                        "name": "per_page",
                        "in": "query",
                        "description": "Amount of Items per Page",
                        "required": false,
                        "default": 15,
                        "type": "integer"
                    }
                ],
                "responses": responses({
                    "200": {
                        "description": model.Plural() + " list",
                        "schema": {
                            "title": model.upperCamelCase() + "Collection",
                            "description": "Json Api Response with collection of " + model.name + " in array",
                            "type": "object",
                            "properties": {
                                "data": {
                                    "type": "array",
                                    "items": {
                                        "$ref": "#/definitions/" + model.upperCamelCase()
                                    }
                                },
                                "meta": {
                                    "$ref": "#/definitions/Meta"
                                }
                            }
                        }
                    }
                })
            },
            "post": {
                "tags": Swagger.tags,
                "description": "Creates a new " + model.name,
                "operationId": "add" + model.upperCamelCase(),
                "parameters": [
                    {
                        "name": model.upperCamelCase() + "CreateItem",
                        "in": "body",
                        "description": "JsonApi with the " + model.name + " object to add",
                        "required": true,
                        "schema": {
                            "type": "object",
                            "required": [
                                "data"
                            ],
                            "properties": {
                                "data": {
                                    "$ref": "#/definitions/" + model.upperCamelCase()
                                }
                            }
                        }
                    }
                ],
                "responses": responses({
                    "200": {
                        "description": "Created " + model.upperCamelCase() + " response",
                        "schema": {
                            "type": "object",
                            "title": model.upperCamelCase() + "Item",
                            "required": [
                                "data"
                            ],
                            "properties": {
                                "data": {
                                    "$ref": "#/definitions/" + model.upperCamelCase()
                                }
                            }
                        }
                    }
                })
            },
        };
        paths["/" + model.plural() + "/{id}"] = {
            "get": {
                "tags": Swagger.tags,
                "description": "Returns the " + model.name + " based on a single ID",
                "operationId": "find" + model.upperCamelCase() + "ById",
                "parameters": [
                    {
                        "name": "id",
                        "in": "path",
                        "description": "ID of " + model.upperCamelCase() + " to fetch",
                        "required": true,
                        "type": "string"
                    }
                ],
                "responses": responses({
                    "200": {
                        "description": model.upperCamelCase() + " Item response",
                        "schema": {
                            "type": "object",
                            "required": [
                                "data"
                            ],
                            "properties": {
                                "data": {
                                    "$ref": "#/definitions/" + model.upperCamelCase()
                                }
                            }
                        }
                    }
                })
            },
            "put": {
                "tags": Swagger.tags,
                "description": "Update existing " + model.name,
                "operationId": "update" + model.upperCamelCase(),
                "parameters": [
                    {
                        "name": "id",
                        "in": "path",
                        "description": "ID of " + model.name + " to fetch",
                        "required": true,
                        "type": "string"
                    },
                    {
                        "name": model.upperCamelCase() + "UpdateItem",
                        "in": "body",
                        "description": model.upperCamelCase() + " object to edit",
                        "required": true,
                        "schema": {
                            "type": "object",
                            "required": [
                                "data"
                            ],
                            "properties": {
                                "data": {
                                    "$ref": "#/definitions/" + model.upperCamelCase()
                                }
                            }
                        }
                    }
                ],
                "responses": responses({
                    "200": {
                        "description": "JsonApi response with updated " + model.upperCamelCase() + " object",
                        "schema": {
                            "type": "object",
                            "required": [
                                "data"
                            ],
                            "properties": {
                                "data": {
                                    "$ref": "#/definitions/" + model.upperCamelCase()
                                }
                            }
                        }
                    }
                })
            },
            "delete": {
                "tags": Swagger.tags,
                "description": "Deletes a single item based on the ID supplied",
                "operationId": "delete" + model.upperCamelCase(),
                "parameters": [
                    {
                        "name": "id",
                        "in": "path",
                        "description": "ID of item to delete",
                        "required": true,
                        "type": "string"
                    }
                ],
                "responses": responses({
                    "204": {
                        "description": "Item successfully deleted",
                        "schema": {
                            "$ref": "#/definitions/ResultSuccess"
                        }
                    }
                })
            }
        };
        definitions[model.upperCamelCase()] = {
            "type": "object",
            "required": [
                "type"
            ],
            "properties": {
                "id": {
                    "type": "string",
                    "example": "9d705617-cc29-482a-85ff-7f7292f72b31"
                },
                "type": {
                    "default": "group",
                    "type": "string",
                    "example": "group"
                },
                "attributes": {
                    "required": [
                        "code",
                        "title"
                    ],
                    "type": "object",
                    "properties": {
                        "code": {
                            "type": "string",
                            "example": "GROUP_ADMIN"
                        },
                        "title": {
                            "type": "string",
                            "example": "Goup_Title"
                        },
                        "description": {
                            "type": "string",
                            "example": "Some description"
                        },
                        "status": {
                            "default": "ACTIVE",
                            "type": "string",
                            "enum": [
                                "ACTIVE",
                                "INACTIVE"
                            ],
                            "example": "ACTIVE"
                        },
                        "created_at": {
                            "$ref": "#/definitions/DateTime"
                        },
                        "updated_at": {
                            "$ref": "#/definitions/DateTime"
                        }
                    }
                }
            }
        };
    });

    return {
        "swagger": "2.0",
        "info": {
            "version": version,
            "title": title + " API",
            "description": "An API to access " + title,
            "termsOfService": "http://openbank2.com/terms/",
            "contact": {
                "name": "OpenBank team",
                "email": "davidcallizaya@gmail.com",
                "url": "http://openbank2.com/"
            },
            "license": {
                "name": "MIT",
                "url": "http://opensource.org/licenses/MIT"
            }
        },
        "host": host,
        "basePath": "/api/v1",
        "schemes": [
            "http"
        ],
        "consumes": [
            "application/vnd.api+json"
        ],
        "produces": [
            "application/vnd.api+json"
        ],
        "security": [
            {
                "PasswordGrant": []
            },
            {
                "internalApiKey": []
            }
        ],
        "paths": paths,
        "securityDefinitions": {
            "PasswordGrant": {
                "type": "oauth2",
                "flow": "password",
                "tokenUrl": "/oauth/access_token"
            },
            "internalApiKey": {
                "type": "apiKey",
                "in": "query",
                "name": "access_token"
            }
        },
        "definitions": definitions
    };
}