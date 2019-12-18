$(document).ready(function () {

    meterSetup();

    $('.dataTable').on('draw.dt', meterSetup);

    // details modal
    $(document).on('click', '.btnDetails', function () {
        var details = '<table cellpadding="5" style="font-size: .85rem;">';
        var detailsObject = $(this).data('details');
        var $modal = $('#detailsModal');

        for (var key in detailsObject) {
            if (detailsObject.hasOwnProperty(key) && key !== 'Details') {
                details += '<tr><td width="100"><strong>' + key + '</strong></td><td>' + detailsObject[key] + '</td></tr>';
            }
        }

        details += '</table>';

        $modal.find('.modal-body').html(details);
        $modal.modal('show');

        return false;
    });
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

