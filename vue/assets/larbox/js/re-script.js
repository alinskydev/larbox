document.addEventListener('DOMContentLoaded', function () {
    // Toastr

    toastr.options = {
        'closeButton': false,
        'debug': false,
        'newestOnTop': false,
        'progressBar': true,
        'positionClass': 'toast-bottom-right',
        'preventDuplicates': false,
        'onclick': null,
        'showDuration': 400,
        'hideDuration': 400,
        'timeOut': 3000,
        'extendedTimeOut': 1000,
        'showEasing': 'swing',
        'hideEasing': 'linear',
        'showMethod': 'fadeIn',
        'hideMethod': 'fadeOut',
    };

    // Disabling inputs autocomplete

    $(document).on('focus', 'input, textarea', function () {
        $(this).attr('autocomplete', 'off');
    });

    // Toggle user control while AJAX requests

    window.fetch = new Proxy(window.fetch, {
        apply(fetch, that, args) {
            $('#no-interaction-mask').removeClass('d-none');

            let result = fetch.apply(that, args);

            result.then((response) => {
                $('#no-interaction-mask').addClass('d-none');
            });

            return result;
        },
    });
});
