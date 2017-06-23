var data = [];
var container = document.getElementById('tabledata');
var hot = new Handsontable(container, {
    data: data,
    stretchH: 'all',
    // width: 806,
    autoWrapRow: true,
    height: 441,
    maxRows: 22,
    rowHeaders: true,
    colWidths: [55],
    manualColumnResize: true,
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
            'Outpu',
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
            console.log(res);
            hot.loadData(res);
            // $("#example6grid").handsontable("loadData", res.data);
        }
    });
})
