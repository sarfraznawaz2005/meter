$('[data-toggle="popover"]').popover({
    html: true,
    placement: 'top',
    trigger: 'hover'
});

$('[data-toggle="tooltip"]').tooltip();

// refresh all checks
$('#btnRefresh').click(function () {
    $('body').loading({
        theme: 'dark',
        message: 'Running, please wait...',
        stoppable: false
    });

    $.get(window.ServerMonitorRefreshAllUrl, function () {
        window.location.reload();
    });
});

// refresh single check
$('.refresh').click(function () {
    $('body').loading({
        theme: 'dark',
        message: 'Running, please wait...',
        stoppable: false
    });

    $.get(window.ServerMonitorRefreshUrl, {check: $(this).data('checker')}, function (result) {
        $('body').loading('stop');

        if (result.status) {
            swal("Passed", "Check Passed Successfully!", "success");
        }
        else {
            swal("Failed", result.error, "error");
        }
    });
});