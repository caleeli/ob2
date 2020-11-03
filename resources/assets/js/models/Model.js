export default function(uri0, id, type) {
    var self = this;
    var callback = function () {};
    var refreshListCallback = function () {};
    var originalData = {};
    var events = {
        "load": [],
        "save": [],
        "delete": [],
        "call": [],
        "select": [],
        "reset": [],
    };
    var uri;
    //var owner = arguments.callee.caller.owner;
    if(typeof uri0!=='function') {
        uri = function() {
            return API_SERVER + (uri0 ? uri0 : this.$defaultUrl);
        }
    } else {
        uri = uri0;
    }
    if(!type) {
        type = uri().substr(5).split('/').join('.');
    }
    this.id = null;
    this.$url = uri;
    this.$emptyUrl = '/api/empty';
    function makeUrl(url, query) {
        var q = {};
		for(var name in query) {
			if (query[name]!==undefined) {
				q[name] = query[name];
			}
		}
		var params = $.param(q);
		return url + (params ? '?' + params : '');
	};
    function loadFromData(data) {
        originalData = data.data;
        for (var a in originalData.attributes) {
            self[a] = originalData.attributes[a];
        }
        id = originalData.id;
        self.id = originalData.id;
        if(typeof originalData.relationships==="object") {
            for(var a in originalData.relationships) {
                self[a] = originalData.relationships[a];
                if(self[a] && typeof self[a].forEach==='function') {
                    self[a].get = function(id){
                        var res;
                        self[a].forEach(function(item) {
                            if (item.id===id) {
                                res = item;
                            }
                        });
                        return res;
                    }
                }
            }
        }
    }
    this.$load = function (id1, loadCallback) {
        try {
            if (typeof id1 === 'undefined') {
                id1 = id;
            }
            var include = [];
            self.$fields().forEach(function(field) {
                if (field.isAssociation) {
                    include.push(field.name);
                }
            });
            $.ajax({
                method: "GET",
                url: this.$url() + '/' + (!id1 ? 'create' : id1)+ (include.length>0 ? '?include='+include.join(',') : ''),
                dataType: 'json',
                success: function (data) {
                    loadFromData(data);
                    callback(self);
                    if(typeof loadCallback==='function'){
                        loadCallback(self);
                    }
                    events.load.forEach(function(evn){
                        evn[0].call(env[1], self);
                    });
                }
            });
        }catch(err) {
            console.log(err);
        }
    };
    this.$create = function (loadCallback) {
        return this.$load(0, loadCallback);
    };
    this.$save = function (childrenAssociation, saveCallback, doNotRefreshData) {
        var method;
        var url;
        var attributes = {}, relationships = {};
        var self = this;
        if(typeof childrenAssociation==='undefined') {
            childrenAssociation = '';
        }
        if (!id) {
            method = 'POST';
            url = this.$url() + childrenAssociation;
        } else {
            method = 'PUT';
            url = this.$url() + childrenAssociation + '/' + id;
        }
        this.$fields().forEach(function(field) {
            if (field.isAssociation && field.isMultiple) {
                //only update the relationship (id, not the rest of attributes)
                if (typeof self[field.name]==='string') {
                    relationships[field.name] = {data:[]};
                    self[field.name].split(",").forEach(function(id) {
                        relationships[field.name].data.push({id:id});
                    });
                } else {
                    relationships[field.name] = {data:self[field.name]};
                }
            } else if (field.isAssociation && !field.isMultiple) {
                var val = typeof self[field.name]==='object' && self[field.name] && typeof self[field.name].id!=='undefined' ? self[field.name].id : self[field.name];
                relationships[field.name] = {data:{id:val}};
            } else {
                attributes[field.name] = self[field.name];
            }
        });
        $.ajax({
            method: method,
            url: url,
            contentType: "application/json;charset=utf-8",
            dataType: 'json',
            data: JSON.stringify({
                data: {
                    type: type,
                    attributes: attributes,
                    relationships: relationships,
                }
            }),
            success: function (data) {
                if (data.data && !doNotRefreshData) {
                    loadFromData(data);
                }
                callback(self);
                if(typeof saveCallback==='function'){
                    saveCallback(self);
                }
                events.save.forEach(function(evn){
                    evn[0].call(env[1], self);
                });
            }
        });
    };
    this.$delete = function (childrenAssociation, saveCallback) {
        var method;
        var url;
        var self = this;
        if(typeof childrenAssociation==='undefined') {
            childrenAssociation = '';
        }
        method = 'DELETE';
        if (!id) {
            throw "model does not have id";
        } else {
            url = this.$url() + childrenAssociation + '/' + id;
        }
        $.ajax({
            method: method,
            url: url,
            contentType: "application/json;charset=utf-8",
            dataType: 'json',
            success: function (data) {
                callback(self);
                if(typeof saveCallback==='function') {
                    saveCallback(self);
                }
                events.delete.forEach(function(evn){
                    evn[0].call(env[1], self);
                });
            }
        });
    };
    this.$call = function (methodName, params, childrenAssociation, methodCallback) {
        var url;
        if(typeof childrenAssociation==='undefined') {
            childrenAssociation = '';
        }
        if (!id) {
            url = this.$url() + childrenAssociation;
        } else {
            url = this.$url() + '/' + childrenAssociation + id;
        }
        $.ajax({
            method: 'POST',
            url: url,
            dataType: 'json',
            contentType: "application/json;charset=utf-8",
            data: JSON.stringify({
                call: {
                    "method": methodName,
                    "arguments": params
                }
            }),
            success: function (response) {
                if (response.success) {
                    if(typeof methodCallback==='function') {
                        methodCallback(response.response);
                    } else if(typeof methodCallback==='object' && typeof methodCallback.success==='function') {
                        methodCallback.success(response.response);
                    }
                    events.call.forEach(function(evn){
                        evn[0].call(env[1], response.response);
                    });
                } else {
                    throw new Exception(response.error);
                }
            },
            error: function (response) {
                if(typeof methodCallback==='object' && typeof methodCallback.error==='function') {
                    methodCallback.error(response);
                } else {
                    throw new Exception(response);
                }
            },
        });
    };
    this.$selectFrom = function (methodName, params, childrenAssociation) {
        return {
            $select: function (loadCallback) {
                self.$call(methodName, params, childrenAssociation, loadCallback);
            }
        }
    }
    this.$reset = function () {
        Object.assign(self, originalData.attributes);
        id = originalData.id;
        this.id = originalData.id;
        callback(self);
        events.reset.forEach(function(evn){
            evn[0].call(env[1], self);
        });
    };
    this.$select = function (loadCallback, params) {
        try {
            var include = [];
            self.$fields().forEach(function(field) {
                if (field.isAssociation) {
                    include.push(field.name);
                }
            });
            var queryParams = $.extend(
                {
                    include:include.length>0 ? include.join(',') : undefined,
                },
                params
            );
            $.ajax({
                method: "GET",
                url: makeUrl(this.$url(), queryParams),
                dataType: 'json',
                success: function (data) {
                    if(typeof loadCallback==='function'){
                        loadCallback(data);
                    }
                    events.select.forEach(function(evn){
                        evn[0].call(env[1], self);
                    });
                }
            });
        }catch(err) {
            console.log(err);
        }
    };
    this.$ = {};
    this.$domain = function(field, callback) {
        if (typeof this.$[field.name].domain==='undefined') {
            this.$[field.name].domain = [];
        }
        var domain = this.$[field.name].domain;
        domain.refresh = function(callback2) {
            domain.length = 0;
            if(typeof field.enum==='object' && typeof field.enum.forEach==='function') {
                field.enum.forEach(function(item){
                    if (item instanceof Object && item.attributes instanceof Object) {
                        domain.push(item);
                    } else {
                        var attributes = {};
                        attributes[field.textField] = item;
                        domain.push({
                            id: item,
                            attributes: attributes
                        });
                    }
                });
            }
            var source;
            if(typeof field.source==='object' && typeof field.source.$select==='function') {
                source = field.source;
            } else if(typeof field.source==='function') {
                source = field.source();
            }
            if(typeof source==='object' && source && typeof source.$select==='function') {
                source.$select(function(data){
                    data.data.forEach(function(row){
                        domain.push(row);
                    });
                    if(typeof callback==='function') {
                        callback(domain);
                    }
                    if(typeof callback2==='function') {
                        callback2(domain);
                    }
                });
            }
        }
        domain.get = function(id){
            var res;
            this.forEach(function(item) {
                if (item.id===id) {
                    res = item;
                }
            });
            return res;
        };
        domain.refresh();
        return domain;
    };
    this.object2array = function (object, ev) {
        var a = [];
        for (var key in object) {
            var item = object[key];
            a.push(eval(ev))
        }
        return a;
    };
    this.setCallback = function (cb) {
        callback = cb;
    };
    this.$callback = function () {
        callback(self);
    };
    this.$fields = function () {
        var fields = [];
        for (var a in this) {
            if (typeof this[a] !== 'function') {
                fields.push({
                    name: a,
                    label: a,
                    type: 'text',
                    value: a,
                });
            }
        }
        return fields;
    };
    this.setRefreshListCallback = function (cb) {
        refreshListCallback = cb;
    };
    this.$refreshList = function () {
        refreshListCallback(self);
    };
    this.$getData = function () {
        var data = {};
        for(var a in this) {
            if(a.substr(0,1)!=='$' && typeof this[a]!=='function') {
                data[a] = this[a];
            }
        }
        return data;
    }
    this.$initFields = function () {
        this.$fields().forEach(function(field){
            if(typeof self[field.name]==='undefined') {
                self[field.name]=null;
            }
        });
    }
    this.$on = function (event, callback, owner) {
        if (events[event].findIndex(function(a){
            return a[0]===callback && a[1]===owner
        })===-1) {
            events[event].push([callback, owner]);
        }
    };
    //this.$load();
};
