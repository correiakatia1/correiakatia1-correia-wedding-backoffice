$(function () {
    $("#accessory-table").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["pdf"]
    }).buttons().container().appendTo('#dress-table_wrapper .col-md-6:eq(0)');

    $('.show-confirm-delete').click(function (event) {
        const option = confirm("Tens a certeza que queres eliminar?");

        if (option) {
            const currentForm = $(this).find('.delete-form');
            currentForm.submit();
        }

        event.stopPropagation()
    });
});
