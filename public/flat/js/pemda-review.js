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
        { data: 'jenis', width: 20,editor:false },
        { data: 'kegiatan.subbidang.bidang.nama', width: 40,editor:false },
        { data: 'kegiatan.subbidang.nama', width: 40,editor:false },
        { data: 'kegiatan.kegiatan', width: 220,editor:false },
        { data: 'output', width: 20,editor:false },
        { data: 'satuan', width: 20,editor:false },
        { data: 'dana', width: 20,editor:false },
        { data: 'bidang_id', width: 20 ,editor:false},
    ],
    nestedHeaders: [
        // [
        //     '-', {
        //         label: 'Asal',
        //         colspan: 2
        //     }, {
        //         label: 'Penilaian KL',
        //         colspan: 3
        //     }, {
        //         label: 'Input Pemda',
        //         colspan: 5
        //     },
        //     '-'
        // ],
        [
            'Tipe',
            'Bidang',
            'Sub-bidang',
            'Kegiatan',
            'Output',
            'Satuan',
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
        url: '/pemda/review',
        dataType: 'json',
        type: 'get',
        success: function(res) {
            // console.log(res);
            hot.loadData(res);
            // $("#example6grid").handsontable("loadData", res.data);
        }
    });
})
