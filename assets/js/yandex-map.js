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

    let listToAdd = {
        ids: [],
        gid: []
    };

    let customItemContentLayout = ymaps.templateLayoutFactory.createClass(
        // Флаг "raw" означает, что данные вставляют "как есть" без экранирования html.
        '<h2 class=ballon_header>{{ properties.balloonContentHeader|raw }}</h2>' +
        '<div class=ballon_body>{{ properties.balloonContentBody|raw }}</div>' +
        '<div class=ballon_footer><button class="btn btn-default btn-add" data-gid="{{ properties.g_id }}" data-id="{{ properties.index }}" {{ properties.disabled }}>Добавить в выгрузку</button></div>', {

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
            let gid = $(this).data("gid");

            if ($.inArray(id, listToAdd) == -1 && id != 'none') {

                listToAdd['ids'].push(id);
                listToAdd['gid'].push(gid);
            }

            $(this).attr('disabled', true);
            $(this).text('Добавлено');

            console.log('Добавленные точки', listToAdd);
        }
    });

    let objectManager = new ymaps.ObjectManager(
        {
            clusterize: true,
            gridSize: 100,
            clusterDisableClickZoom: true,
            clusterOpenBalloonOnClick: true,
            clusterIconLayout: 'default#pieChart',
            // Устанавливаем режим открытия балуна.
            // В данном примере балун никогда не будет открываться в режиме панели.
            clusterBalloonPanelMaxMapArea: 0,
            // Устанавливаем размер макета контента балуна (в пикселях).
            clusterBalloonContentLayoutWidth: 550,
            clusterBalloonMaxHeight: 600,
            // Устанавливаем собственный макет.
            clusterBalloonItemContentLayout: customItemContentLayout,
            // Устанавливаем ширину левой колонки, в которой располагается список всех геообъектов кластера.
            clusterBalloonLeftColumnWidth: 130
        }
    );

    dbPoints.forEach((el) => {

        if (el.latitude != 'NULL' && el.longitude != 'NULL') {

            objectManager.add(
                {
                    type: 'Feature',
                    id: el.ID,
                    geometry: {
                        type: 'Point',
                        coordinates: [el.latitude, el.longitude]
                    },
                    properties: {
                        balloonContentHeader: `Остановка ${el.invent_id} <b>${el.side}</b>`,
                        balloonContentBody: `<p>ГИД: ${el.g_id}</p><p>Адрес: ${(el.address_near != 'NULL') ? el.address_near : 'Не указан'}</p><p>Сторона: ${el.side}</p><p>Направление: ${el.direction}</p><p>Прайс (с НДС): ${el.nds_rate}</p>`,
                        index: el.ID,
                        g_id: el.g_id,
                        disabled: '',
                        clusterCaption: `${el.invent_id} <b>${el.side}</b>`
                    },
                    options: {
                        preset: "islands#violetDotIcon"
                    }
                }
            );
        }
    });

    if (typeof uploadedPoints !== 'undefined') {

        uploadedPoints.forEach((el) => {

            if (el.latitude && el.longitude) {

                objectManager.add(
                    {
                        type: 'Feature',
                        id: el.id,
                        geometry: {
                            type: 'Point',
                            coordinates: [el.latitude, el.longitude]
                        },
                        properties: {
                            balloonContentHeader: 'Импортированная остановка',
                            balloonContentBody: `<p>Адрес: ${(el.address) ? el.address : 'Не указан'}</p><p>Координаты: ${(el.latitude && el.longitude) ? el.latitude + ', ' + el.longitude : 'Не указаны'}</p><p>Данная остановка была импортирована через "Добавить метки", кнопка "Добавить в выгрузку" внутри этой карточки не будет добавлять остановку в очередь.</p>`,
                            index: 'none',
                            disabled: 'disabled',
                            clusterCaption: 'Остановка'
                        },
                        options: {
                            preset: "islands#blueDotIcon"
                        }
                    }
                );
            } else {

                if (el.address) {

                    $.getJSON(
                        'https://geocode-maps.yandex.ru/1.x/?',
                        {
                            format: 'json',
                            apikey: '5571489d-8573-4ab6-8f61-558fd0453a57',
                            geocode: el.address
                        }
                    ).done(function (data) {

                        const coords = data.response.GeoObjectCollection.featureMember[0].GeoObject.Point.pos.split(' ');
                        console.log(data.response);
                        console.log(el.address);
                        console.log(coords);

                        objectManager.add(
                            {
                                type: 'Feature',
                                id: el.id,
                                geometry: {
                                    type: 'Point',
                                    coordinates: [coords[1], coords[0]]
                                },
                                properties: {
                                    balloonContentHeader: 'Импортированная остановка',
                                    balloonContentBody: `<p> Адрес: ${(el.address) ? el.address : 'Не указан'}</p><p>Координаты: ${coords}</p><p>Данная остановка была импортирована через "Добавить метки", кнопка "Добавить в выгрузку" внутри этой карточки не будет добавлять остановку в очередь.</p>`,
                                    index: 'none',
                                    disabled: 'disabled',
                                    clusterCaption: 'Остановка'
                                },
                                options: {
                                    preset: "islands#blueDotIcon"
                                }
                            }
                        );
                    }
                    );
                }
            }
        });
    }

    myMap.geoObjects.add(objectManager);

    // Геокодер

    // $.getJSON('https://geocode-maps.yandex.ru/1.x/?', {
    //     format: 'json',
    //     apikey: '5571489d-8573-4ab6-8f61-558fd0453a57',
    //     geocode: 'Россия, Москва, улица Барышиха, 30'
    // }).done(
    //     function (data) {
    //         console.log(data.response.GeoObjectCollection.featureMember[0].GeoObject.Point.pos);
    //     }
    // );

    // Форма загрузки

    const uploadForm = $('#upload-form');
    const uploadFile = $('#upload-file');
    const uploadBtn = $('#upload-submit');
    const uploadMessage = $('#upload-footer');

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

        $.ajax({
            url: './includes/upload.php',
            type: 'POST',
            contentType: false,
            processData: false,
            data: new FormData(document.getElementById('upload-form')),
            success: function (respond, status, jqXHR) {
                if (respond) {

                    $(uploadFile).attr('disabled', true);

                    $(uploadMessage).append(`< p > Выбранный файл успешно загружен, нажмите на кнопку "Обновить карту", чтобы изменения вступили в силу</ > <a class="btn btn-default" href=${respond}>Обновить карту</a>`);
                }
            },
            error: function (jqXHR, status, errorThrown) {
                console.log('Ошибка AJAX запроса: ' + status);
            }
        });
    });

    // Форма скачивания

    const btnUpdate = $('.js-download-update');
    const downloadList = $('.download-list');
    const downloadMessage = $('#download-footer');

    function appendListItems(list) {
        let output = '';

        list.forEach((el) => {
            output += `< li > ${el}</ > `;
        });

        return output;
    }

    console.log(listToAdd.gid);

    btnUpdate.on('click', function () {
        if (listToAdd.ids.length > 0) {

            $(downloadList).html(appendListItems(listToAdd.gid));

            $.ajax({
                url: './includes/download.php',
                type: 'GET',
                contentType: false,
                processData: false,
                data: 'ids=' + listToAdd.ids,
                success: function (respond, status, jqXHR) {
                    if (respond) {

                        $(downloadMessage).append(`< p > Файл успешно сформирован и готов к выгрузке, нажмите на кнопку "Скачать"</ > ${respond} `);
                    }
                },
                error: function (jqXHR, status, errorThrown) {
                    console.log('Ошибка AJAX запроса: ' + status);
                }
            });
        }
    });
}