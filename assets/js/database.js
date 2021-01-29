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

    // statuses table

    const stUpload = $('#upload-submit-statuses');
    const stDelete = $('#js-db-delete-statuses');

    stUpload.on('click', function (e) {

        e.preventDefault();

        $(this).text('Ожидайте...');

        $.ajax({
            url: './includes/db_statuses.php',
            type: 'POST',
            contentType: false,
            processData: false,
            data: new FormData(document.getElementById('upload-form-statuses')),
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

    stDelete.on('click', function () {

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

    // Обновление координат

    const updateCoords = $("#js-db-coods-busstops");

    ymaps.ready(init);

    function init() {

        updateCoords.on('click', function () {

            //$(this).text('Ожидайте...');
            $(this).text('Пока не работает...');

            //Геокодер

            // $.getJSON('https://geocode-maps.yandex.ru/1.x/?', {
            //     format: 'json',
            //     apikey: '5571489d-8573-4ab6-8f61-558fd0453a57',
            //     geocode: 'Россия, Москва, улица Барышиха, 30'
            // }).done(
            //     function (data) {
            //         console.log(data.response.GeoObjectCollection.featureMember[0].GeoObject.Point.pos);
            //     }
            // );

            // $.ajax({
            //     url: './includes/db_busstops.php',
            //     type: 'POST',
            //     data: {
            //         action: 'delete-busstops'
            //     },
            //     success: function (respond, status, jqXHR) {
            //         if (respond.success) {

            //             $(this).text('Удалить');

            //             location.reload();
            //         } else {

            //             let message = respond.message ?? respond;

            //             console.log(message);
            //         }
            //     },
            //     error: function (jqXHR, status, errorThrown) {
            //         console.log('Ошибка AJAX запроса: ' + status);
            //     }
            // });
        });
    };
})(jQuery)