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

    $('#detailsModal').on('shown.bs.modal', function () {
        meterHighlightSQL();
        meterHighlightJson();
    });
});

function meterSetup() {
    $('[data-toggle="popover"]').popover({
        html: true,
        placement: 'top',
        trigger: 'hover'
    });

    $('[data-toggle="tooltip"]').tooltip();

    meterHighlightSQL();
}

// creates DataTables
function meterTable(tableSelector, url, length, columns, extraOptions, data) {

    length = length || 10;
    extraOptions = extraOptions || {};
    data = data || {};

    var options = {
        "serverSide": true,
        "processing": true,
        "responsive": true,
        "autoWidth": false,
        "ordering": false,
        "lengthChange": false,
        "pageLength": length,
        "ajax": {
            "url": url,
            "dataType": "json",
            "type": "GET",
            "data": data
        },
        "columns": columns
    };

    // merge
    options = $.extend({}, options, extraOptions);

    return $(tableSelector).DataTable(options);
}

// highlights SQL keywords
function meterHighlightSQL() {
    var sqlReg = /\b(AND|AS|ASC|BETWEEN|BY|CASE|CURRENT_DATE|CURRENT_TIME|DELETE|DESC|DISTINCT|EACH|ELSE|ELSEIF|FALSE|FOR|FROM|GROUP|HAVING|IF|IN|INSERT|INTERVAL|INTO|IS|JOIN|KEY|KEYS|LEFT|LIKE|LIMIT|MATCH|NOT|NULL|ON|OPTION|OR|ORDER|OUT|OUTER|REPLACE|RIGHT|SELECT|SET|TABLE|THEN|TO|TRUE|UPDATE|VALUES|WHEN|WHERE|CREATE|ALTER|ALL|DATABASE|GRANT|PRIVILEGES|IDENTIFIED|FLUSH|INNER|COUNT)(?=[^\w])/ig;

    document.querySelectorAll("td .meter_sql").forEach(function(item) {
        item.innerHTML = item.innerHTML.replace(sqlReg,'<span class="sql_keyword">$1</span>');
    });
}

// highlights JSON keywords
function meterHighlightJson() {
    var reg = /(.+?(?=: ))/g;

    document.querySelectorAll("td pre.json").forEach(function(item) {
        item.innerHTML = item.innerHTML.replace(/({|}|\[|\])/g,'<span class="json_keyword_braces">$1</span>');
        item.innerHTML = item.innerHTML.replace(reg,'<span class="json_keyword">$1</span>');
    });
}
