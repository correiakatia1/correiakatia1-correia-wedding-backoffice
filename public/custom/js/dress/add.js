$(function () {
    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    });

    bsCustomFileInput.init();

    $(document).on('click', '[data-toggle="lightbox"]', function (event) {
        event.preventDefault();
        $(this).ekkoLightbox({
            alwaysShowClose: true
        });
    });

    $('.show-confirm-delete-image').click(function (event) {
        const option = confirm("Tens a certeza que queres eliminar?");

        if (option) {
            const currentForm = $(this).find('.delete-form');
            currentForm.submit();
        }

        event.stopPropagation()
    });
})
