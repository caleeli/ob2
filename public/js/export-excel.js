var exportToExcel = (function () {
    var content = 'data:application/vnd.ms-excel;base64,'
    var template = '<html xmlns="http://www.w3.org/TR/REC-html40" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns:o="urn:schemas-microsoft-com:office:office">\n\
        <head>\n\
            <!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]-->\n\
            <meta http-equiv="content-type" content="text/plain; charset=UTF-8"/>\n\
        </head>\n\
        <body>\n\
            <table>{table}</table>\n\
        </body>\n\
    </html>';
    function format(s, c) {
        return s.replace(/{(\w+)}/g, function (m, p) {
            return c[p];
        })
    }
    return function (table, name) {
        if (!table.nodeType) {
            table = document.getElementById(table);
        }
        var ctx = {worksheet: name || 'Hoja', table: table.innerHTML};
        window.location.href = content + window.btoa(unescape(encodeURIComponent(format(template, ctx))));
    }
})();
