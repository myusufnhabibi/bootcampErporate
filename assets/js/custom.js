function loadTable(src, tableName) {
    var path = window.location.pathname;
    var host = window.location.hostname;
    var table = $('#' + tableName).DataTable({
        "responsive": true,
        "searchDelay": 1000,
        "language": {
            "url": location.protocol + "//" + location.hostname + "/erporate/assets/vendors/datatables.net/js/indonesia.json",
            "sEmptyTable": "Tidads"
        },

        "processing": true,
        "serverSide": true,
        "deferRender": true,
        "order": [],

        "ajax": {
            "url": src,
            "type": "POST"
        },


        "columnDefs": [{
            "targets": [0],
            "orderable": false,
        },
        {
            "targets": [1],
            "orderable": false,
        },
        ],
    });
}