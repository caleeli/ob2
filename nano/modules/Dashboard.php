<?xml version="1.0" encoding="UTF-8"?>
<root xmlns:vue='http://openbank.com/vue'>
<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h4>Salud</h4>
            <div class="ntScroll">
                <div class="ntImage">
                    <label>Blade el empalador</label>
                </div>
                <div class="ntImage">
                    <label>Revenge of the Sith</label>
                </div>
                <div class="ntImage">
                    <label>DISEÑO de sonrisa</label>
                </div>
                <div class="ntImage">
                    <label>Guf guf</label>
                </div>
            </div>
            <h4>Educación</h4>
            <div class="ntScroll">
                <div class="ntImage">
                    <label>Blade el empalador</label>
                </div>
                <div class="ntImage">
                    <label>Revenge of the Sith</label>
                </div>
                <div class="ntImage">
                    <label>DISEÑO de sonrisa</label>
                </div>
                <div class="ntImage">
                    <label>Guf guf</label>
                </div>
            </div>
            <h4>Hidrocarburos</h4>
            <div class="ntScroll">
                <div class="ntImage">
                    <label>Blade el empalador</label>
                </div>
                <div class="ntImage">
                    <label>Revenge of the Sith</label>
                </div>
                <div class="ntImage">
                    <label>DISEÑO de sonrisa</label>
                </div>
                <div class="ntImage">
                    <label>Guf guf</label>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    var module = new Module({
        "name": "Dashboard",
        "prefix": "dash",
        "title": "Dashboard",
        "icon": "glyphicon glyphicon-home",
        "menu": "main",
        "models": [
        ],
        "views": {
        },
        "data": {
            report: new Module.View.ModelInstance("ReportsFolders.Report"),
        }
    });
</script>
</root>