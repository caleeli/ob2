export default function(uri, id) {
    var self = this;
    var callback = function () {};
    var refreshListCallback = function () {};
    var originalData = {};
    var type = uri.substr(5).split('/').join('.');
    this.$load = function (id1) {
        if (typeof id1 === 'undefined') {
            id1 = id;
        }
        $.ajax({
            method: "GET",
            url: uri + '/' + (!id1 ? 'create' : id1),
            dataType: 'json',
            success: function (data) {
                originalData = data.data;
                Object.assign(self, originalData.attributes);
                id = originalData.id;
                this.id = originalData.id;
                callback(self);
            }
        });
    };
    this.$save = function () {
        var method;
        var url;
        if (!id) {
            method = 'POST';
            url = uri;
        } else {
            method = 'PUT';
            url = uri + '/' + id;
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
            }
        });
    };
    this.$reset = function () {
        Object.assign(self, originalData.attributes);
        id = originalData.id;
        this.id = originalData.id;
        callback(self);
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
    this.$load();
}
