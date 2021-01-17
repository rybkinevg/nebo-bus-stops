$(document).ready(function () {

    const simpleAuth = () => {

        let password = prompt("Введите пароль");

        let correct = false;

        if (password == '123321') {

            correct = true;

            return;
        } else {

            while (!correct) {
                let password = prompt("Введите пароль");

                if (password == '123321') {
                    correct = true;
                }
            }
        }
    }

    simpleAuth();
})

ymaps.ready(init);

function init() {
    var myMap = new ymaps.Map('map', {
        center: [55.76, 37.64],
        zoom: 10
    }, {
        searchControlProvider: 'yandex#search'
    }),
        objectManager = new ymaps.ObjectManager({
            clusterize: true,
            gridSize: 202,
            clusterDisableClickZoom: false
        });

    const ballonBody = (area, district, street, direction, near_address, place_name, approve_id, type, format, price_nds, latitude, longitude) => {
        return `
            <p><strong>Округ</strong> - ${area}</p>
            <p><strong>Район</strong> - ${district}</p>
            <hr />
            <p><strong>Название улицы</strong> - ${street}</p>
            <p><strong>Направление</strong> - ${direction}</p>
            <p><strong>Ближайший адрес</strong> - ${near_address}</p>
            <p><strong>Название остановки</strong> - ${place_name}</p>
            <hr />
            <p><strong>№ разрешения</strong> - ${approve_id}</p>
            <hr />
            <p><strong>Тип</strong> - ${type}</p>
            <p><strong>Формат</strong> - ${format}</p>
            <p><strong>Цена с НДС</strong> - ${price_nds}</p>
            <hr />
            <p><strong>Координаты (широта, долгота)</strong> - ${latitude}, ${longitude}</p>

        `;
    }

    $.ajax({
        url: "places.json"
    }).done(function (data) {

        const loader = document.querySelector('.loader');

        data.places.forEach(el => {
            if (el.latitude && el.longitude) {
                objectManager.add({
                    type: 'Feature',
                    id: el.id,
                    geometry: {
                        type: 'Point',
                        coordinates: [el.latitude, el.longitude]
                    },
                    properties: {
                        balloonContentHeader: el.address_place,
                        balloonContentBody: ballonBody(el.area, el.district, el.street, el.direction, el.near_address, el.place_name, el.approve_id, el.type, el.format, el.price_nds, el.latitude, el.longitude),
                        balloonContentFooter: `Номер в таблице: ${el.id}`,
                        clusterCaption: `${el.iid} <strong>${el.side}</strong>`,
                        hintContent: el.gid,
                    }
                });
            }
        });

        myMap.geoObjects.add(objectManager);

        loader.classList.add('loaded');
    });

    objectManager.objects.options.set('preset', 'islands#violetDotIcon');
    objectManager.clusters.options.set('preset', 'islands#invertedVioletClusterIcons');
}