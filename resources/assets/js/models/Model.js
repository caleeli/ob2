export default function(uri0, id, type) {
    var self = this;
    var callback = function () {};
    var refreshListCallback = function () {};
    var originalData = {};
    var uri;
    if(typeof uri0!=='function') {
        uri = function() {
            return uri0 ? uri0 : this.$defaultUrl;
        }
    } else {
        uri = uri0;
    }
    if(!type) {
        type = uri().substr(5).split('/').join('.');
    }
    this.$url = uri;
    this.$load = function (id1, loadCallback) {
        try {
            if (typeof id1 === 'undefined') {
                id1 = id;
            }
            $.ajax({
                method: "GET",
                url: this.$url() + '/' + (!id1 ? 'create' : id1),
                dataType: 'json',
                success: function (data) {
                    originalData = data.data;
                    Object.assign(self, originalData.attributes);
                    id = originalData.id;
                    this.id = originalData.id;
                    callback(self);
                    if(typeof loadCallback==='function'){
                        loadCallback(self);
                    }
                }
            });
        }catch(err) {
            console.log(err);
        }
    };
    this.$save = function (childrenAssociation, saveCallback) {
        var method;
        var url;
        if(typeof childrenAssociation==='undefined') {
            childrenAssociation = '';
        }
        if (!id) {
            method = 'POST';
            url = this.$url() + childrenAssociation;
        } else {
            method = 'PUT';
            url = this.$url() + '/' + childrenAssociation + id;
        }
        $.ajax({
            method: method,
            url: url,
            dataType: 'json',
            data: JSON.stringify({
                data: {
                    type: type,
                    attributes: self
                }
            }),
            success: function (data) {
                if (data.success) {
                    id = data.result.data.id;
                    this.id = data.result.data.id;
                    originalData = data.result.data.attributes;
                }
                callback(self);
                if(typeof saveCallback==='function'){
                    saveCallback(self);
                }
            }
        });
    };
    this.$call = function (methodName, params, childrenAssociation, methodCallback) {
        var method;
        var url;
        if(typeof childrenAssociation==='undefined') {
            childrenAssociation = '';
        }
        if (!id) {
            method = 'POST';
            url = this.$url() + childrenAssociation;
        } else {
            method = 'PUT';
            url = this.$url() + '/' + childrenAssociation + id;
        }
        $.ajax({
            method: method,
            url: url,
            dataType: 'json',
            data: JSON.stringify({
                call: {
                    "method": methodName,
                    "arguments": params
                }
            }),
            success: function (response) {
                if (response.success) {
                    if(typeof methodCallback==='function'){
                        methodCallback(response.response);
                    }
                } else {
                    throw new Exception(response.error);
                }
            }
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
    };
    this.$select = function (loadCallback) {
        try {
            $.ajax({
                method: "GET",
                url: this.$url(),
                dataType: 'json',
                success: function (data) {
                    if(typeof loadCallback==='function'){
                        loadCallback(data);
                    }
                }
            });
        }catch(err) {
            console.log(err);
        }
    };
    this.$domain = function(field, callback) {
        var domain = [];
        domain.refresh = function() {
            domain.length = 0;
            if(typeof field.enum==='object' && typeof field.enum.forEach==='function') {
                field.enum.forEach(function(item){
                    var attributes = {};
                    attributes[field.textField] = item;
                    domain.push({
                        id: item,
                        attributes: attributes
                    });
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
                });
            }
        }
        domain.refresh();
        return domain;
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
    //this.$load();
}
