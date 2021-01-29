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
        '{% if properties.canDownload %}<div class=ballon_footer><button class="btn btn-primary btn-add" data-gid="{{ properties.g_id }}" data-id="{{ properties.index }}" {{ properties.disabled|"" }}>{{ properties.btnText }}</button></div>{% endif %}',
        {
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

                    // Сначала напрямую меняем кнопку, чтобы сразу отобразить изменения
                    $(this).attr('disabled', true);
                    $(this).text('Добавлено');

                    // Изменение отображения на карте
                    objectManager.objects.setObjectOptions(id, {
                        preset: 'islands#yellowIcon'
                    });

                    // Изменение свойств объекта, чтобы сохранить состояние, так как, меняя напрямую, состояние не сохраняется
                    objectManager.objects.setObjectProperties(id, {
                        disabled: 'disabled',
                        btnText: 'Добавлено',
                        status: 'Выбранные стороны'
                    });
                }

                // Получение объекта по айди
                // object = objectManager.objects.getById(id);

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
            // Устанавливаем собственный макет.
            clusterBalloonItemContentLayout: customItemContentLayout,
            // Устанавливаем ширину левой колонки, в которой располагается список всех геообъектов кластера.
            clusterBalloonLeftColumnWidth: 130,
            // Устанавливаем высоту панели
            clusterBalloonContentLayoutHeight: 350,
        }
    );

    // Создадим 5 пунктов выпадающего списка.
    var listBoxItems = ['Свободные стороны', 'Проданные стороны', 'Импортированные стороны', 'Выбранные стороны']
        .map(function (title) {
            return new ymaps.control.ListBoxItem({
                data: {
                    content: title
                },
                state: {
                    selected: true
                }
            })
        }),
        reducer = function (filters, filter) {
            filters[filter.data.get('content')] = filter.isSelected();
            return filters;
        },
        // Теперь создадим список, содержащий 5 пунктов.
        listBoxControl = new ymaps.control.ListBox({
            data: {
                content: 'Фильтр',
                title: 'Фильтр'
            },
            items: listBoxItems,
            state: {
                // Признак, развернут ли список.
                expanded: true,
                filters: listBoxItems.reduce(reducer, {})
            }
        });

    myMap.controls.add(listBoxControl);

    // Добавим отслеживание изменения признака, выбран ли пункт списка.
    listBoxControl.events.add(['select', 'deselect'], function (e) {
        var listBoxItem = e.get('target');
        var filters = ymaps.util.extend({}, listBoxControl.state.get('filters'));
        filters[listBoxItem.data.get('content')] = listBoxItem.isSelected();
        listBoxControl.state.set('filters', filters);
    });

    var filterMonitor = new ymaps.Monitor(listBoxControl.state);
    filterMonitor.add('filters', function (filters) {
        // Применим фильтр.
        objectManager.setFilter(getFilterFunction(filters));
    });

    function getFilterFunction(categories) {
        return function (obj) {
            var content = obj.properties.status;
            return categories[content]
        }
    }

    dbPoints.forEach((el) => {

        if (el.latitude != 'NULL' && el.longitude != 'NULL') {

            let color = (el.statuses_g_id == null) ? "islands#darkGreenIcon" : "islands#redIcon";

            let dotColor = (el.statuses_g_id == null) ? "green" : "red";

            let status = (el.statuses_g_id == null) ? "Свободные стороны" : "Проданные стороны";

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
                        balloonContentBody: `<p>ГИД: ${el.g_id}</p><p>Адрес: ${(el.address_near != 'NULL') ? el.address_near : 'Не указан'}</p><p>Сторона: ${el.side}</p><p>Направление: ${el.direction}</p><p>Рекламодатель: ${(el.advertiser && el.advertiser !== 'NULL') ? el.advertiser : 'Не указано'}</p><p>Бренд: ${(el.brand && el.brand !== 'NULL') ? el.brand : 'Не указано'}</p>`,
                        index: el.ID,
                        g_id: el.g_id,
                        canDownload: true,
                        status: status,
                        btnText: 'Добавить в выгрузку',
                        clusterCaption: `<div class="yandex-map-left-col-list-item"><span class="title">${el.invent_id} <b>${el.side}</b></span><span class="dot dot-${dotColor}"></span></div>`
                    },
                    options: {
                        preset: color
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
                            balloonContentBody: `<p>Адрес: ${(el.address) ? el.address : 'Не указан'}</p><p>Координаты: ${(el.latitude && el.longitude) ? el.latitude + ', ' + el.longitude : 'Не указаны'}</p><p>Данная остановка была импортирована через "Добавить метки"</p>`,
                            index: 'none',
                            canDownload: false,
                            clusterCaption: 'Остановка',
                            status: 'Импортированные стороны'
                        },
                        options: {
                            preset: "islands#nightIcon"
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

                    $(uploadMessage).append(`<p> Выбранный файл успешно загружен, нажмите на кнопку "Обновить карту", чтобы изменения вступили в силу</p> <a class="btn btn-default" href=${respond}>Обновить карту</a>`);
                }
            },
            error: function (jqXHR, status, errorThrown) {
                console.log('Ошибка AJAX запроса: ' + status);
            }
        });
    });

    // Форма скачивания

    const btnUpdate = $('.js-download-update');
    const btnDownload = $('.js-download-download');
    const downloadList = $('.download-list');
    const downloadMessage = $('#download-footer');
    const loadStatusesMessage = $('#load-statuses-footer');
    const btnLoadStatuses = $('.js-load-statuses');

    function appendListItems(list) {

        if (list.length > 0) {

            let output = '';

            list.forEach((el) => {
                output += `<li> ${el}</li> `;
            });

            return output;
        }
    }

    btnUpdate.on('click', function () {

        $(downloadList).html(appendListItems(listToAdd.gid));
    });

    btnDownload.on('click', function () {

        if (listToAdd.ids.length > 0) {

            $.ajax({
                url: './includes/download.php',
                type: 'GET',
                contentType: false,
                processData: false,
                data: 'ids=' + listToAdd.ids,
                success: function (respond, status, jqXHR) {
                    if (respond) {

                        $(downloadMessage).html(`<p> Файл успешно сформирован и готов к выгрузке, нажмите на кнопку "Скачать"</p> ${respond}`);
                    }
                },
                error: function (jqXHR, status, errorThrown) {
                    console.log('Ошибка AJAX запроса: ' + status);
                }
            });
        }
    });

    // Форма статусов
    btnLoadStatuses.on('click', function (e) {

        e.preventDefault();

        $.ajax({
            url: './includes/load_statuses.php',
            type: 'POST',
            contentType: false,
            processData: false,
            data: new FormData(document.getElementById('load_statuses_form')),
            success: function (respond, status, jqXHR) {
                if (respond) {

                    $(loadStatusesMessage).html(`<p> Выбранные статусы готовы, нажмите на кнопку "Обновить карту", чтобы изменения вступили в силу, если статусы не изменились, обновите страницу ещё раз.</p> <a class="btn btn-default" href=${respond}>Обновить карту</a>`);
                }
            },
            error: function (jqXHR, status, errorThrown) {
                console.log('Ошибка AJAX запроса: ' + status);
            }
        });
    });
}