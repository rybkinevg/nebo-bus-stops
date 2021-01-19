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
            if ($.inArray($(this).data("id"), listToAdd) == -1) {
                listToAdd.push($(this).data("id"));
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
                        balloonContentHeader: el.gid,
                        balloonContentBody: el.address,
                        index: index,
                    },
                    options: {
                        preset: "islands#violetDotIcon"
                    }
                });
            }
        });

        if (typeof uploadedPoints !== 'undefined') {
            uploadedPoints.forEach((el) => {
                if (el.latitude && el.longitude) {
                    objectManager.add({
                        type: 'Feature',
                        id: el.id,
                        geometry: {
                            type: 'Point',
                            coordinates: [el.latitude, el.longitude]
                        },
                        properties: {
                            balloonContentHeader: '12333',
                            balloonContentBody: 'dsad'
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
}