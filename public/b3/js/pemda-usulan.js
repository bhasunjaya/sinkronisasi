var data = [];

function labelRenderer(instance, td, row, col, prop, value, cellProperties) {
    Handsontable.renderers.TextRenderer.apply(this, arguments);
    td.className = 'level-' + value.level;

    td.removeChild(td.firstChild);
    var textNode = document.createTextNode(value.label === null ? '' : value.label);
    td.appendChild(textNode);

}
Handsontable.renderers.registerRenderer('labelRenderer', labelRenderer);

var container = document.getElementById('tabledata');
var hot = new Handsontable(container, {
    data: data,
    stretchH: 'all',
    autoWrapRow: true,
    rowHeaders: true,
    colHeaders: true,
    // width: 700,
    height: 500,
    manualColumnResize: true,
    columns: [
        { data: 'label', renderer: labelRenderer, width: 140 },
        { data: 'output', width: 20 },
        { data: 'dana', width: 20 },
        { data: 'kl_output', width: 20 },
        { data: 'kl_target', width: 120 },
        { data: 'kl_lokasi', width: 120 },
    ],
    nestedHeaders: [
        [
            '-', {
                label: 'Asal',
                colspan: 2
            }, {
                label: 'Penilaian KL',
                colspan: 3
            }, {
                label: 'Input Pemda',
                colspan: 5
            },
            '-'
        ],
        [
            'Label',
            'Output',
            'Usulan Dana',
            'Output',
            'Target',
            'Lokasi',
            'Output',
            'Unit Price',
            'Target',
            'Lokasi',
            'Prioritas',
            'Change'
        ],
    ],
});
$(document).ready(function() {
    $.ajax({
        url: '/pemda/usulan',
        dataType: 'json',
        type: 'post',
        success: function(res) {
            // console.log(res);
            hot.loadData(res);
            // $("#example6grid").handsontable("loadData", res.data);
        }
    });
})
