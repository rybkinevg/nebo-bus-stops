ymaps.ready(init);

function init() {
    let myMap = new ymaps.Map(
        'map',
        {
            center: [55.76, 37.64],
            zoom: 10
        },
        {
            searchControlProvider: 'yandex#search'
        }
    );

    let listToAdd = [];

    let customItemContentLayout = ymaps.templateLayoutFactory.createClass(
        // Флаг "raw" означает, что данные вставляют "как есть" без экранирования html.
        '<h2 class=ballon_header>{{ properties.balloonContentHeader|raw }}</h2>' +
        '<div class=ballon_body>{{ properties.balloonContentBody|raw }}</div>' +
        '<div class=ballon_footer><button class="btn-add" data-id="{{ properties.index }}">Добавить</button></div>', {

        // Переопределяем функцию build, чтобы при создании макета начинать
        // слушать событие click на кнопке-счетчике.
        build: function () {
            // Сначала вызываем метод build родительского класса.
            customItemContentLayout.superclass.build.call(this);
            // А затем выполняем дополнительные действия.
            $('.btn-add').bind('click', this.onCounterClick);
        },

        // Аналогично переопределяем функцию clear, чтобы снять
        // прослушивание клика при удалении макета с карты.
        clear: function () {
            // Выполняем действия в обратном порядке - сначала снимаем слушателя,
            // а потом вызываем метод clear родительского класса.
            $('.btn-add').unbind('click', this.onCounterClick);
            customItemContentLayout.superclass.clear.call(this);
        },

        onCounterClick: function () {

            let id = $(this).data("id");

            if ($.inArray(id++, listToAdd) == -1 && id != 'none') {
                listToAdd.push(id++);
            }
            console.log(listToAdd);
        }
    });

    let objectManager = new ymaps.ObjectManager(
        {
            clusterize: true,
            gridSize: 100,
            clusterDisableClickZoom: false,
            clusterOpenBalloonOnClick: true,
            clusterIconLayout: 'default#pieChart',
            // Устанавливаем режим открытия балуна.
            // В данном примере балун никогда не будет открываться в режиме панели.
            clusterBalloonPanelMaxMapArea: 0,
            // Устанавливаем размер макета контента балуна (в пикселях).
            clusterBalloonContentLayoutWidth: 550,
            // Устанавливаем собственный макет.
            clusterBalloonItemContentLayout: customItemContentLayout,
            // Устанавливаем ширину левой колонки, в которой располагается список всех геообъектов кластера.
            clusterBalloonLeftColumnWidth: 100
        }
    );

    $.ajax({
        url: "places.json"
    }).done(function (data) {

        const loader = document.querySelector('.loader');

        data.places.forEach((el, index) => {
            if (el.latitude && el.longitude) {
                objectManager.add({
                    type: 'Feature',
                    id: el.id,
                    geometry: {
                        type: 'Point',
                        coordinates: [el.latitude, el.longitude]
                    },
                    properties: {
                        balloonContentHeader: `Остановка ${el.iid} ${el.side}`,
                        balloonContentBody: `<p>ГИД: ${el.gid}</p><p>Адрес: ${(el.near_address) ? el.near_address : 'Не указан'}</p><p>Сторона: ${el.side}</p><p>Прайс (с НДС): ${el.price_nds}</p>`,
                        index: index,
                        clusterCaption: `Сторона ${el.side}`
                    },
                    options: {
                        preset: "islands#violetDotIcon"
                    }
                });
            }
        });

        if (typeof uploadedPoints !== 'undefined') {
            uploadedPoints.forEach((el) => {
                console.log(el);
                if (el.latitude && el.longitude) {
                    objectManager.add({
                        type: 'Feature',
                        id: el.id,
                        geometry: {
                            type: 'Point',
                            coordinates: [el.latitude, el.longitude]
                        },
                        properties: {
                            balloonContentHeader: 'Импортированная остановка',
                            balloonContentBody: 'Данная остановка была импортирована через "Добавить метки", кнопка "Добавить" внутри этой карточки не будет добавлять остановку в очередь.',
                            index: 'none',
                            clusterCaption: 'Остановка'
                        },
                        options: {
                            preset: "islands#blueDotIcon"
                        }
                    });
                }
            });
        }

        myMap.geoObjects.add(objectManager);

        loader.classList.add('loaded');
    });


    // Модалки

    const btnModal = $('.js-modal-trigger');
    const btnModalclose = $('.js-modal-close');

    btnModal.on('click', function () {

        let modalID = $(this).data('modal');
        let modals = $('.modal');

        modals.each(function (el) {

            if ($(modals[el]).hasClass(`modal-${modalID}`)) {
                $(modals[el]).addClass('--open');
                $('.modals').addClass('--open');
            }
        });
    });

    btnModalclose.on('click', function () {

        $(this).parent().parent().removeClass('--open').parent().removeClass('--open');
    });

    // Форма загрузки

    const uploadForm = $('#upload-form');
    const uploadFile = $('#upload-file');
    const uploadBtn = $('#upload-submit');

    $(uploadFile).change(function () {
        if ($(this).val()) {
            $(uploadBtn).removeAttr('disabled');
        }
        else {
            $(uploadBtn).attr('disabled', true);
        }
    });

    $(uploadForm).on('submit', function (event) {

        event.preventDefault();

        $(uploadBtn).attr('disabled', true);
        //jQuery(importButtonLoader).removeClass('disabled');

        $.ajax({
            url: './includes/upload.php',
            type: 'POST',
            contentType: false,
            processData: false,
            data: new FormData(document.getElementById('upload-form')),
            success: function (respond, status, jqXHR) {
                if (respond) {

                    $(uploadFile).attr('disabled', true);

                    //jQuery(importButtonLoader).addClass('disabled');

                    $(uploadForm).parent().append(`<div class="upload-response"><a href=${respond}>Обновить карту</a></div>`);
                }
            },
            error: function (jqXHR, status, errorThrown) {
                console.log('Ошибка AJAX запроса: ' + status);
            }
        });
    });

    // Форма скачивания

    const btnUpdate = $('.js-download-update');
    const btnDownload = $('.js-download-submit');
    const downloadList = $('.download-list');

    function appendListItems(list) {
        let output = '';

        list.forEach((el) => {
            output += `<li>${el}</li>`;
        });

        return output;
    }

    btnUpdate.on('click', function () {
        if (listToAdd.length > 0) {
            $(downloadList).html(appendListItems(listToAdd));
            $(btnDownload).removeAttr('disabled');
        }
    });

    $(btnDownload).on('click', function () {

        $(btnDownload).attr('disabled', true);
        //jQuery(importButtonLoader).removeClass('disabled');

        $.ajax({
            url: './includes/download.php',
            type: 'GET',
            contentType: false,
            processData: false,
            data: 'ids=' + listToAdd,
            success: function (respond, status, jqXHR) {
                if (respond) {

                    console.log('respond', respond);

                    //jQuery(importButtonLoader).addClass('disabled');

                    //$(downloadForm).parent().append(`<div class="upload-response"><a href=${respond}>Обновить карту</a></div>`);
                }
            },
            error: function (jqXHR, status, errorThrown) {
                console.log('Ошибка AJAX запроса: ' + status);
            }
        });
    });
}