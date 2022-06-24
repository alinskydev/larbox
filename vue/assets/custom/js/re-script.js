document.addEventListener('DOMContentLoaded', function () {

    // Toastr

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": 400,
        "hideDuration": 400,
        "timeOut": 3000,
        "extendedTimeOut": 1000,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    //      Disabling inputs autocomplete

    $(document).on('focus', 'input, textarea', function () {
        $(this).attr('autocomplete', 'off');
    });
});