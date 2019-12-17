$(document).ready(function () {
    meterSetup();

    $('.dataTable').on('draw.dt', meterSetup);
});

function meterSetup() {
    $('[data-toggle="popover"]').popover({
        html: true,
        placement: 'top',
        trigger: 'hover'
    });

    $('[data-toggle="tooltip"]').tooltip();
}

// creates DataTables
function meterTable(tableSelector, url, length, columns, extraOptions) {

    length = length || 10;
    extraOptions = extraOptions || {};

    var options = {
        "serverSide": true,
        "processing": true,
        "responsive": true,
        "autoWidth": true,
        "ordering": false,
        "lengthChange": true,
        "pageLength": length,
        "ajax": {
            "url": url,
            "dataType": "json",
            "type": "GET",
        },
        "columns": columns
    };

    // merge
    options = $.extend({}, options, extraOptions);

    return $(tableSelector).DataTable(options);
}
