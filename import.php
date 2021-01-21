<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/db.php');

$db = new db(HOST, USER, PASSWORD, DB_NAME);

$tablename   = "test-import-table";

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

foreach ($keys as $key) {

    $keys_titles[] = $key['name'];
}

function generate_keys_query($keys)
{
    $output = '';

    foreach ($keys as $key => $value) {

        $output .= $key . ' ';

        foreach ($value as $k => $v) {

            switch ($k) {
                case 'type':

                    $type = ($v) ? $v : '';
                    break;
                case 'length':

                    $length = ($v) ? "({$v})" : '';
                    break;
                case 'default':

                    $default = ($v) ? "DEFAULT {$v}" : '';
                    break;
                case 'encoding':

                    $encoding = ($v) ? $v : '';
                    break;
                case 'attr':

                    $attr = ($v) ? $v : '';
                    break;
                case 'null':

                    $null = ($v) ? $v : "NOT NULL";
                    break;
                case 'index':

                    $index = ($v) ? $v : '';
                    break;
                case 'AI':

                    $AI = ($v) ? $v : '';
                    break;
                case 'primary':

                    $primary = ($v) ? $v : '';
                    break;
            }
        }

        $output .= trim("{$type}{$length} {$default} {$encoding} {$attr} {$null} {$index} {$AI} {$primary}") . ', ';
    }

    return mb_substr($output, 0, -2);
};

$db->create($tablename, generate_keys_query($keys));

$db->check_cols($tablename);

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/vendor/SimpleXLSX.php');

$file_path = './files/db_imports/database.xlsx';

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

            $db->insert($tablename, "NULL, {$clear_data}");
        }
    }
} else {

    echo SimpleXLSX::parseError();
}
