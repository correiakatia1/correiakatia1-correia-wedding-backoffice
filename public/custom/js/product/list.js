$(function () {
    $("#product-table").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["pdf"]
    }).buttons().container().appendTo('#product-table_wrapper .col-md-6:eq(0)');
});
