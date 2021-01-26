(function ($) {

    'use strict';

    // busstops-db

    const bsCreate = $('#js-db-create-busstops');
    const bsImport = $('#js-db-import-busstops');
    const bsDelete = $('#js-db-delete-busstops');

    bsCreate.on('click', function () {

        $(this).text('Ожидайте...');

        $.ajax({
            url: './includes/db_busstops.php',
            type: 'POST',
            data: {
                action: 'create-busstops'
            },
            success: function (respond, status, jqXHR) {
                if (respond.success) {

                    location.reload();
                } else {

                    let message = respond.message ?? respond;

                    console.log(message);
                }
            },
            error: function (jqXHR, status, errorThrown) {
                console.log('Ошибка AJAX запроса: ' + status);
            }
        });
    });

    bsImport.on('click', function () {

        $(this).text('Ожидайте...');

        $.ajax({
            url: './includes/db_busstops.php',
            type: 'POST',
            data: {
                action: 'import-busstops'
            },
            success: function (respond, status, jqXHR) {
                if (respond.success) {

                    $(this).text('Импортировать');

                    location.reload();
                } else {

                    let message = respond.message ?? respond;

                    console.log(message);
                }
            },
            error: function (jqXHR, status, errorThrown) {
                console.log('Ошибка AJAX запроса: ' + status);
            }
        });
    });

    bsDelete.on('click', function () {

        $(this).text('Ожидайте...');

        $.ajax({
            url: './includes/db_busstops.php',
            type: 'POST',
            data: {
                action: 'delete-busstops'
            },
            success: function (respond, status, jqXHR) {
                if (respond.success) {

                    $(this).text('Удалить');

                    location.reload();
                } else {

                    let message = respond.message ?? respond;

                    console.log(message);
                }
            },
            error: function (jqXHR, status, errorThrown) {
                console.log('Ошибка AJAX запроса: ' + status);
            }
        });
    });

})(jQuery)