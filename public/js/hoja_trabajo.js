function moveContentIntoDiv() {
    var div = document.createElement("div");
    var ch;
    div.setAttribute('id', 'app');
    div.setAttribute('style', 'width: 765px;');
    var i = 0;
    while (ch = document.body.childNodes.item(i)) {
        if (ch.nodeName === 'SCRIPT' || ch.nodeName === 'STYLE') {
            i++;
            continue;
        }
        div.appendChild(ch);
    }
    document.body.insertBefore(div, document.body.firstChild);
}
moveContentIntoDiv();
//Lista de seleccion
Vue.component('gtemplate', {
    props: {
        "template": String,
    },
    data: function () {
        return {
            templateRender: null
        };
    },
    render: function (h) {
        return this.templateRender();
    },
    watch: {
        template: {
            immediate: true,
            handler() {
                var template = '<div>' + (!this.template ? '' : this.template) + '<div>';
                var res = Vue.compile(template);
                this.templateRender = res.render;
                this.$options.staticRenderFns = []
                this._staticTrees = []
                for (var i in res.staticRenderFns) {
                    this.$options.staticRenderFns.push(res.staticRenderFns[i])
                }
            }
        }
    }
});

Vue.component('lista', {
    template: '#lista',
    props: {
        "value": {},
        "data": Array
    },
    watch: {
        'value': function (value) {
            this.innerValue = value;
        },
        'innerValue': function (value) {
            this.$emit('input', value);
        }
    },
    data: function () {
        return {
            innerValue: this.value
        };
    },
    methods: {
        text: function (id) {
            var item = this.data.find(function (item) {
                return item.id === id;
            });
            return item ? item.text : '';
        }
    }
});

Vue.component('texto', {
    template: '#texto',
    props: {
        "value": String
    },
    watch: {
        'value': function (value) {
            this.innerValue = value;
        },
        'innerValue': function (value) {
            this.$emit('input', value);
        }
    },
    data: function () {
        return {
            innerValue: this.value
        };
    },
    methods: {
    }
});

Vue.component('check', {
    template: '#check',
    props: {
        "value": String,
        "data": {}
    },
    watch: {
        'value': function (value) {
            this.innerValue = value;
        },
        'innerValue': function (value) {
            this.$emit('input', value);
        }
    },
    data: function () {
        return {
            innerValue: this.value
        };
    },
    methods: {
        rotarCheck: function () {
            var index = this.data.indexOf(this.innerValue);
            index = (index + 1) % this.data.length;
            this.innerValue = this.data[index];
        },
        fixEmpty: function (value) {
            return value ? value : '&nbsp;';
        }
    }
});

var app = new Vue({
    el: '#app',
    data: Object.assign(window.variables, {
        message: 'Hello Vue2!',
        empresas: [],
    }),
    methods: {
        loadList: function (url, text, bind) {
            $.ajax({
                url: url,
                method: 'get',
                dataType: 'json',
                success: function (res) {
                    bind.splice(0);
                    res.data.forEach(function (row) {
                        bind.push({id: row.id, text: row.attributes[text]});
                    });
                }
            });
        }
    },
    mounted: function () {
        var self = this;
        self.loadList('/api/UserAdministration/empresas', 'nombre_empresa', self.empresas);
        //self.loadList('/api/UserAdministration/users', 'nombre_completo', self.usuarios);
    }
});
