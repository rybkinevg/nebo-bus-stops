<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/db.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/declofnum.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/vendor/SimpleXLSX.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/vendor/SimpleXLSXGen.php');

$tablename = BUSSTOPS_TABLE;

$db = new db(HOST, USER, PASSWORD, DB_NAME);

$ids = explode(",", $_GET['ids']);

$sql = '';

foreach ($ids as $id) {

    $sql .= "`ID` = '{$id}' OR ";
}

$clear_str = mb_substr($sql, 0, -4);

$data = $db->select($tablename, false, '*', $clear_str);

$keys = [
    'ID'         => [
        'name'     => 'Номер',
        'type'     => 'INT',
        'length'   => '',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NOT NULL',
        'index'    => '',
        'AI'       => 'AUTO_INCREMENT',
        'primary'  => 'PRIMARY KEY'
    ],
    'side'         => [
        'name'     => 'Сторона',
        'type'     => 'VARCHAR',
        'length'   => '2',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NOT NULL',
        'index'    => '',
        'AI'       => '',
        'primary'  => ''
    ],
    'invent_id'    => [
        'name'     => 'Инвентарный номер',
        'type'     => 'VARCHAR',
        'length'   => '30',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NOT NULL',
        'index'    => '',
        'AI'       => '',
        'primary'  => ''
    ],
    'g_id'    => [
        'name'     => 'Код',
        'type'     => 'VARCHAR',
        'length'   => '30',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NOT NULL',
        'index'    => '',
        'AI'       => '',
        'primary'  => ''
    ],
    'district'    => [
        'name'     => 'Район',
        'type'     => 'VARCHAR',
        'length'   => '200',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NOT NULL',
        'index'    => '',
        'AI'       => '',
        'primary'  => ''
    ],
    'area'    => [
        'name'     => 'Округ',
        'type'     => 'VARCHAR',
        'length'   => '10',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NOT NULL',
        'index'    => '',
        'AI'       => '',
        'primary'  => ''
    ],
    'map_link'    => [
        'name'     => 'Яндекс.Карта',
        'type'     => 'VARCHAR',
        'length'   => '200',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => '',
        'AI'       => '',
        'primary'  => ''
    ],
    'panorama_link'    => [
        'name'     => 'Панорама',
        'type'     => 'VARCHAR',
        'length'   => '200',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => '',
        'AI'       => '',
        'primary'  => ''
    ],
    'photo'    => [
        'name'     => 'Фото',
        'type'     => 'VARCHAR',
        'length'   => '200',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => '',
        'AI'       => '',
        'primary'  => ''
    ],
    'map_schema'    => [
        'name'     => 'Схема',
        'type'     => 'VARCHAR',
        'length'   => '200',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => '',
        'AI'       => '',
        'primary'  => ''
    ],
    'GRP'    => [
        'name'     => 'GRP',
        'type'     => 'VARCHAR',
        'length'   => '30',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => '',
        'AI'       => '',
        'primary'  => ''
    ],
    'OTS'    => [
        'name'     => 'OTS',
        'type'     => 'VARCHAR',
        'length'   => '30',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => '',
        'AI'       => '',
        'primary'  => ''
    ],
    'espar_id'    => [
        'name'     => 'Код Эспар',
        'type'     => 'VARCHAR',
        'length'   => '30',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => '',
        'AI'       => '',
        'primary'  => ''
    ],
    'street'    => [
        'name'     => 'Улица',
        'type'     => 'VARCHAR',
        'length'   => '200',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => '',
        'AI'       => '',
        'primary'  => ''
    ],
    'direction'    => [
        'name'     => 'Направление',
        'type'     => 'VARCHAR',
        'length'   => '10',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => '',
        'AI'       => '',
        'primary'  => ''
    ],
    'address_near'    => [
        'name'     => 'Адрес ближайшего строения',
        'type'     => 'VARCHAR',
        'length'   => '200',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => '',
        'AI'       => '',
        'primary'  => ''
    ],
    'busstop_name'    => [
        'name'     => 'Наименование остановки',
        'type'     => 'VARCHAR',
        'length'   => '200',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => '',
        'AI'       => '',
        'primary'  => ''
    ],
    'latitude'    => [
        'name'     => 'Широта',
        'type'     => 'VARCHAR',
        'length'   => '200',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => '',
        'index'    => '',
        'AI'       => '',
        'primary'  => ''
    ],
    'longitude'    => [
        'name'     => 'Долгота',
        'type'     => 'VARCHAR',
        'length'   => '200',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => '',
        'index'    => '',
        'AI'       => '',
        'primary'  => ''
    ],
    'approve_id'    => [
        'name'     => '№ разрешения',
        'type'     => 'VARCHAR',
        'length'   => '100',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => '',
        'AI'       => '',
        'primary'  => ''
    ],
    'type'    => [
        'name'     => 'Тип павильона',
        'type'     => 'VARCHAR',
        'length'   => '30',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => '',
        'AI'       => '',
        'primary'  => ''
    ],
    'format'    => [
        'name'     => 'Формат',
        'type'     => 'VARCHAR',
        'length'   => '30',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => '',
        'AI'       => '',
        'primary'  => ''
    ],
    'nds_rate'    => [
        'name'     => 'Тариф с НДС',
        'type'     => 'VARCHAR',
        'length'   => '200',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => '',
        'AI'       => '',
        'primary'  => ''
    ],
    'choose'    => [
        'name'     => 'Выбор',
        'type'     => 'VARCHAR',
        'length'   => '200',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => '',
        'AI'       => '',
        'primary'  => ''
    ],
    'rate'    => [
        'name'     => 'Тариф с учетом пакета с НДС',
        'type'     => 'VARCHAR',
        'length'   => '200',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => '',
        'AI'       => '',
        'primary'  => ''
    ]
];

foreach ($data[0] as $key => $value) {
    $data_keys[] = $key;
}

foreach ($data_keys as $key => $value) {

    $data_keys[$key] = $keys[$value]['name'];
}

$data_result[] = $data_keys;

// TODO: сделать очистку от &qoute; которые добавлял из-за конфликта с json
foreach ($data as $key => $value) {
    $data_result[] = $value;
}

$xlsx = SimpleXLSXGen::fromArray($data_result);

$file = date("d-m-Y_h-i") . ".xlsx";

$path = $_SERVER['DOCUMENT_ROOT'] . "/files/map_downloads/";

if (!file_exists($path)) {

    mkdir($path, 0775, true);
}

$xlsx->saveAs($path . $file);

echo '<a class="btn btn-default" href="/files/map_downloads/' . $file . '">Скачать <span class="badge badge-primary badge-pill">' . declOfNum(count($data), ['%d остановку', '%d остановки', '%d остановок']) . '</span></a>';
