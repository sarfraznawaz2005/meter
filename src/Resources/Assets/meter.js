$(document).ready(function () {
    init();

    $('.dataTable').on('draw.dt',init);
});

function init() {
    $('[data-toggle="popover"]').popover({
        html: true,
        placement: 'top',
        trigger: 'hover'
    });

    $('[data-toggle="tooltip"]').tooltip();
}
