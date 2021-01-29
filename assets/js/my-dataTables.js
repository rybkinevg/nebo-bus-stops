$(document).ready(function () {

    const table = $('#busstops-table').DataTable({
        processing: true,
        dom: '<"row"<"col-md"B><"col-md"l><"col-md"f>><"row"<"col-md-12 overflow-auto m-b-20"rt>><"row"<"col-md"i><"col-md"p>>',
        buttons: {
            buttons: ['copy', 'csv', 'excel']
        },
        lengthMenu: [[5, 10, 20, -1], [10, 25, 50, "Все"]],
        serverSide: true,
        ajax: "includes/busstops-base.php",
        language: {
            "decimal": "",
            "emptyTable": "Нет данных для отображения",
            "info": "Показаны остановки с _START_ до _END_ из _TOTAL_ остановок",
            "infoEmpty": "Показано с 0 до 0 из 0 строк",
            "infoFiltered": "(filtered from _MAX_ total entries)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Показывать _MENU_ строк на странице",
            "loadingRecords": "Загрузка...",
            "processing": "Загрузка...",
            "search": "Поиск:",
            "zeroRecords": "Ничего не найдено",
            "paginate": {
                "first": "Первая",
                "last": "Последняя",
                "next": "Следующая",
                "previous": "Предыдущая"
            },
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            }
        }
    });

    $('a.toggle-vis').on('click', function (e) {

        e.preventDefault();

        const column = table.column($(this).attr('data-column'));

        column.visible(!column.visible());
    });
});