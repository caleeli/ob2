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
//moveContentIntoDiv();
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
            if (typeof window.autoSave==='string') {
                window[window.autoSave]();
            }
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
        editable: function () {
            return this.$parent.editMode;
        },
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
            if (typeof window.autoSave==='string') {
                window[window.autoSave]();
            }
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
        editable: function () {
            return this.$parent.editMode;
        }
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
            if (typeof window.autoSave==='string') {
                window[window.autoSave]();
            }
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
        editable: function () {
            return this.$parent.editMode;
        },
        rotarCheck: function () {
            if (this.editable()) {
                var index = this.data.indexOf(this.innerValue);
                index = (index + 1) % this.data.length;
                this.innerValue = this.data[index];
            }
        },
        fixEmpty: function (value) {
            return value ? value : '&nbsp;';
        }
    }
});

Vue.component('enlace', {
    template: '#enlace',
    props: {
        "value": String,
        "data": {}
    },
    watch: {
        'value': {
            handler: function (str) {
                if (!str) return;
                var value = JSON.parse(str);
                var self = this;
                self.innerValue.text = value.text;
                self.innerValue.file = value.file;
                self.innerValue.marks.splice(0);
                value.marks.forEach(function (mark) {
                    self.innerValue.marks.push(mark);
                });
                if (typeof window.autoSave==='string') {
                    window[window.autoSave]();
                }
            },
            deep: true
        },
        'innerValue': {
            handler: function (value) {
                this.$emit('input', JSON.stringify(value));
            },
            deep: true
        }
    },
    data: function () {
        var value = this.value ? JSON.parse(this.value) : {
            text: '',
            file: '',
            marks: []
        };
        return {
            innerValue: value
        };
    },
    methods: {
        editable: function () {
            return this.$parent.editMode;
        },
        editarEnlace: function () {
            this.abrirEnlace();
            this.$parent.pdfEditMode = true;
        },
        setFile: function (file) {
            this.innerValue.file = file;
        },
        setMarks: function (marks) {
            var self = this;
            self.innerValue.marks.splice(0);
            marks.forEach(function (mark) {
                self.innerValue.marks.push(mark);
            });
        },
        setText: function (text) {
            this.innerValue.text = text;
        }
    }
});

Vue.component('upload', {
    template: '#upload',
    props: {
        "value": String,
        "type": String,
        "small": Boolean,
        "disk": String
    },
    data() {
        return {
            uploading: false,
            progress: 0
        };
    },
    methods: {
        changeFile: function (event, multiple) {
            var self = this;
            var data = new FormData();
            for (var i = 0, l = event.target.files.length; i < l; i++) {
                data.append('file' + (multiple ? '[]' : ''), event.target.files[i]);
            }
            self.uploading = true;
            self.progress = 0;
            $.ajax({
                url: API_SERVER + "/api/uploaddocument/" + self.disk,
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (json) {
                    self.$emit('input', JSON.stringify(json));
                    self.$emit('uploaded', json);
                    self.uploading = false;
                },
                error: function () {
                    self.uploading = false;
                },
                cache: false,
                contentType: false,
                processData: false
            }).uploadProgress(function (data) {
                if (data.lengthComputable) {
                    self.progress = parseInt(((data.loaded / data.total) * 100), 10);
                }
            });
        },
        file: function (json, multiple) {
            var name = '', url = false, mime = '';
            json = typeof json === 'string' && json ? JSON.parse(json) : json;
            url = json && typeof json.url !== 'undefined' ? json.url : false;
            mime = json && typeof json.mime !== 'undefined' ? json.mime : '';
            if (multiple && json && typeof json.forEach === 'function') {
                json.forEach(function (j) {
                    name += j.name + ' | ';
                });
            } else {
                name = json && typeof json.name !== 'undefined' ? json.name : '';
            }
            return {name: name, url: url, mime: mime};
        }
    }
});

var API_SERVER = '';
var app = new Vue({
    el: '#app',
    data: function () {
        var selectedLink = opener && opener.linksSelected ? opener.linksSelected[window.name] : null;
        return Object.assign({
            message: 'Hello Vue2!',
            empresas: [],
            files: [],
            selectedFile: window.selectedFile,
            selectedLink: '',
            marks: window.marks,
            showPDF: false,
            pdfEditMode: true,
            highlightMode: false,
            selectedLinkName: selectedLink ? selectedLink.getText() : '',
            editMode: true,
            storagePath: 'tareas/24',
            uploadAux: ''
        }, window.variables);
    },
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
        },
        loadPDFList: function (callback) {
            var self = this;
            $.ajax({
                url: '/pdfhl/list/' + self.storagePath,
                method: 'get',
                dataType: 'json',
                success: function (res) {
                    self.files.splice(0);
                    res.forEach(function (row) {
                        self.files.push(row);
                    });
                    if (typeof callback === 'function') {
                        callback();
                    }
                }
            });
        },
        loadPDF: function (url) {
            var self = this;
            self.selectedFile = url;
            document.getElementById("container").innerHTML = '';
            if (!url) {
                return;
            }
            // Asynchronous download PDF
            PDFJS.getDocument(url)
                .then(function (pdf) {

                    // Get div#container and cache it for later use
                    var container = document.getElementById("container");
                    var firstMark = true;

                    // Loop from 1 to total_number_of_pages in PDF document
                    for (var i = 1; i <= pdf.numPages; i++) {

                        // Get desired page
                        pdf.getPage(i).then(function (page) {

                            var scale = 1.25;
                            var viewport = page.getViewport(scale);
                            var div = document.createElement("div");

                            // Set id attribute with page-#{pdf_page_number} format
                            div.setAttribute("id", "page-" + (page.pageIndex + 1));

                            // This will keep positions of child elements as per our needs
                            div.setAttribute("style", "position: relative");

                            // Append div within div#container
                            container.appendChild(div);

                            // Create a new Canvas element
                            var canvas = document.createElement("canvas");

                            // Append Canvas within div#page-#{pdf_page_number}
                            div.appendChild(canvas);

                            var context = canvas.getContext('2d');
                            canvas.height = viewport.height;
                            canvas.width = viewport.width;

                            var renderContext = {
                                canvasContext: context,
                                viewport: viewport
                            };

                            // Render PDF page
                            page.render(renderContext)
                                .then(function () {
                                    // Get text-fragments
                                    return page.getTextContent();
                                })
                                .then(function (textContent) {
                                    // Create div which will hold text-fragments
                                    var textLayerDiv = document.createElement("div");

                                    // Set it's class to textLayer which have required CSS styles
                                    textLayerDiv.setAttribute("class", "textLayer");

                                    // Append newly created div in `div#page-#{pdf_page_number}`
                                    div.appendChild(textLayerDiv);

                                    // Create new instance of TextLayerBuilder class
                                    var textLayer = new TextLayerBuilder({
                                        textLayerDiv: textLayerDiv,
                                        pageIndex: page.pageIndex,
                                        viewport: viewport
                                    });

                                    // Set text-fragments
                                    textLayer.setTextContent(textContent);

                                    // Render text-fragments
                                    textLayer.render();
                                    // Highligth saved marks
                                    setTimeout(function () {
                                        self.marks.forEach(function (mark) {
                                            if (firstMark) {
                                                $(mark)[0].scrollIntoView();
                                                firstMark = false;
                                            }
                                            $(mark).addClass('pdfselect');
                                        });
                                    }, 1);
                                });
                        });
                    }
                });
        },
        modoResaltar: function () {
            $("#container").toggleClass('highlight');
            this.highlightMode = $("#container").hasClass('highlight');
        },
        marcarSeleccion2: function () {
            var self = this;
            var range = window.getSelection().getRangeAt(0);
            var newNode = document.createElement("div");
            newNode.setAttribute(
               "class",
               "pdfmark"
            );
            range.surroundContents(newNode);
            $(".pdfmark").each(function() {
                this.parentNode.className = 'pdfselect';
                this.parentNode.insertBefore(this.firstChild, this);
            });
            $(".pdfmark").remove();
            var baseLength = $("#container").getPath().length;
            $(".pdfselect").each(function() {
                self.marks.push('#container' + $(this).getPath().substr(baseLength));
            });
        },
        completarSeleccion: function () {
            var self = this;
            var selectedLink = opener.linksSelected[window.name];
            $.ajax({
                method: 'put',
                data: JSON.stringify(self.marks),
                dataType: 'json',
                url: '/pdfhl/mark/' + self.selectedFile.substr(window.selectedFileBase.length),
                success: function () {
                    selectedLink.setFile(self.selectedFile);
                    selectedLink.setMarks(self.marks);
                    selectedLink.setText(self.selectedLinkName);
                    self.cerrarPDF();
                }
            });
        },
        cerrarPDF: function () {
            window.close();
        },
        marcarDiv: function (div) {
            var self = this;
            if (self.markActive && $(div.parentNode).hasClass('textLayer') && !$(div).hasClass('endOfContent')) {
                if (self.unmarkMode) {
                    $(div).removeClass('pdfselect');
                } else {
                    $(div).addClass('pdfselect');
                }
            }
        },
        iniMarcarDiv: function (div) {
            var self = this;
            if ($("#container").hasClass('highlight') && $(div.parentNode).hasClass('textLayer') && !$(div).hasClass('endOfContent')) {
                self.markActive = true;
                self.unmarkMode = $(div).hasClass('pdfselect');
                $(div).toggleClass('pdfselect');
            }
        },
        endMarcarDiv: function (div) {
            var self = this;
            if (!self.markActive) return;
            if ($("#container").hasClass('highlight') && $(div.parentNode).hasClass('textLayer') && !$(div).hasClass('endOfContent')) {
                if (self.unmarkMode) {
                    $(div).removeClass('pdfselect');
                } else {
                    $(div).addClass('pdfselect');
                }
            }
            self.markActive = false;
            var baseLength = $("#container").getPath().length;
            self.marks.splice(0);
            $("#container .pdfselect").each(function () {
                self.marks.push('#container' + $(this).getPath().substr(baseLength));
            });
        },
        fileUploaded: function (file) {
            var self = this;
            self.loadPDFList(function () {
                self.selectedFile = file.url;
                self.loadPDF(self.selectedFile);
            });
        }
    },
    watch: {
    },
    mounted: function () {
        var self = this;
        self.loadList('/api/UserAdministration/empresas', 'nombre_empresa', self.empresas);
        self.loadPDFList();
        self.loadPDF(window.selectedFile);
        $("#container").mousedown(function (event) {
            self.iniMarcarDiv(event.target);
        });
        $("#container").mouseup(function (event) {
            self.endMarcarDiv(event.target);
        });
        $("#container").mousemove(function (event) {
            self.marcarDiv(event.target);
        });
    }
});
window.guardarHoja = function (callback) {
    for (var a in variables) {
        variables[a] = app[a];
    }
    callback(variables);
}
PDFJS.workerSrc = "/js/pdf.worker.js";

jQuery.fn.extend({
    getPath: function() {
        var pathes = [];

        this.each(function(index, element) {
            var path, $node = jQuery(element);

            while ($node.length) {
                var realNode = $node.get(0), name = realNode.localName;
                if (!name) { break; }

                name = name.toLowerCase();
                var parent = $node.parent();
                var sameTagSiblings = parent.children(name);

                if (sameTagSiblings.length > 1)
                {
                    allSiblings = parent.children();
                    var index = allSiblings.index(realNode) +1;
                    if (index > 0) {
                        name += ':nth-child(' + index + ')';
                    }
                }

                path = name + (path ? ' > ' + path : '');
                $node = parent;
            }

            pathes.push(path);
        });

        return pathes.join(',');
    }
});
