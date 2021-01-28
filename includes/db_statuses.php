<?php

// Подключение необходимых библиотек, настроек и классов
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/db.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/vendor/SimpleXLSX.php');

// Создание подключения к БД
$db = new db(HOST, USER, PASSWORD, DB_NAME);

// Название таблицы
$tablename = STATUSES_TABLE;

$keys = [
    "ID" => [
        "name" => "Номер"
    ],
    "date_sold" => [
        "name" => "Дата"
    ],
    "g_id" => [
        "name" => "Коды сторон"
    ],
    "advertiser" => [
        "name" => "Рекламодатель"
    ],
    "brand" => [
        "name" => "Бренд"
    ],
    "index_rk" => [
        "name" => "Индекс РК"
    ],
    "buyer" => [
        "name" => "Кто купил"
    ],
    "sold" => [
        "name" => "Купленные стороны в Январе 2021"
    ],
];

// Получение название ключей таблицы, как в таблице exel
foreach ($keys as $key) {

    $keys_titles[] = $key['name'];
}

// Загрузка файла
$uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/files/statuses_imports/';

$uploadfile = $uploaddir . basename($_FILES['upload-file']['name']);

if (empty($_FILES['upload-file']['error'])) {

    $uploaded = move_uploaded_file($_FILES['upload-file']['tmp_name'], $uploadfile);

    if ($uploaded && $_POST['action'] === 'import-statuses') {

        $date = $_POST['year'] . '-' . $_POST['month'];

        $file_path = $_SERVER['DOCUMENT_ROOT'] . '/files/statuses_imports/statuses_january_2021.xlsx';

        if ($xlsx = SimpleXLSX::parse($file_path)) {

            $table = $xlsx->rows();

            for ($i = 0; $i < count($table); $i++) {

                if ($i == 0) {

                    $titles = $table[$i];
                } else {

                    $data = '';

                    // TODO: сопоставить порядок ключей, чтобы не произошло такого,
                    // что они перемешаются, например, ключ - side в БД занимает второе место
                    // а в таблице с заголовками будет занимать 5ое место, всё сломается
                    foreach ($titles as $key => $value) {

                        if (in_array($value, $keys_titles)) {

                            if (!empty($table[$i][$key])) {

                                // Для того, чтобы в дальнейшем не иметь проблем с json
                                // меняем все двойные кавычки (") на одинарные (')
                                $clear_str = str_replace('"', "&quot;", $table[$i][$key]);

                                // Для того, чтобы в дальнейшем не иметь проблем с json
                                // меняем все "многопробелы", табуляции, переносы строк на одинарный пробел
                                $clear_str = preg_replace('|\s+|', ' ', $clear_str);

                                $cell = "'{$clear_str}', ";
                            } else {

                                $cell = "'NULL', ";
                            }

                            $data .= $cell;
                        }
                    }

                    $clear_data = mb_substr($data, 0, -2);

                    $db->insert($tablename, "NULL, '$date', {$clear_data}");
                }
            }

            $response = [
                'success' => true,
                'message' => 'Таблица успешно заполнена'
            ];

            header('Content-Type: application/json');

            echo json_encode($response);
        } else {

            echo SimpleXLSX::parseError();
        }
    }
}

// Удаление таблицы
if ($_POST['action'] === 'delete-busstops') {

    $db->drop($tablename);

    $response = [
        'success' => true,
        'message' => 'Таблица успешно удалена'
    ];

    header('Content-Type: application/json');

    echo json_encode($response);
}
