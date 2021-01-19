<?php

$servername = "localhost";
$database   = "nebo-bus-stops";
$username   = "root";
$password   = "root";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
        'primary'  => 'PRIMARY_KEY'
    ],
    'side'         => [
        'name'     => 'Сторона',
        'type'     => 'VARCHAR',
        'length'   => '2',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NOT NULL',
        'index'    => ''
    ],
    'invent_id'    => [
        'name'     => 'Инвентарный номер',
        'type'     => 'VARCHAR',
        'length'   => '30',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NOT NULL',
        'index'    => ''
    ],
    'g_id'    => [
        'name'     => 'Код',
        'type'     => 'VARCHAR',
        'length'   => '30',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NOT NULL',
        'index'    => ''
    ],
    'district'    => [
        'name'     => 'Район',
        'type'     => 'VARCHAR',
        'length'   => '200',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NOT NULL',
        'index'    => ''
    ],
    'area'    => [
        'name'     => 'Округ',
        'type'     => 'VARCHAR',
        'length'   => '10',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NOT NULL',
        'index'    => ''
    ],
    'map_link'    => [
        'name'     => 'Яндекс.Карты',
        'type'     => 'VARCHAR',
        'length'   => '200',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => ''
    ],
    'panorama_link'    => [
        'name'     => 'Панорама',
        'type'     => 'VARCHAR',
        'length'   => '200',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => ''
    ],
    'photo'    => [
        'name'     => 'Фото',
        'type'     => 'VARCHAR',
        'length'   => '200',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => ''
    ],
    'schema'    => [
        'name'     => 'Схема',
        'type'     => 'VARCHAR',
        'length'   => '200',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => ''
    ],
    'GPR'    => [
        'name'     => 'GPR',
        'type'     => 'VARCHAR',
        'length'   => '30',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => ''
    ],
    'OTS'    => [
        'name'     => 'OTS',
        'type'     => 'VARCHAR',
        'length'   => '30',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => ''
    ],
    'espar_id'    => [
        'name'     => 'Код Эспар',
        'type'     => 'VARCHAR',
        'length'   => '30',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => ''
    ],
    'street'    => [
        'name'     => 'Улица',
        'type'     => 'VARCHAR',
        'length'   => '200',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => ''
    ],
    'direction'    => [
        'name'     => 'Направление',
        'type'     => 'VARCHAR',
        'length'   => '10',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => ''
    ],
    'address_near'    => [
        'name'     => 'Ближайший адрес',
        'type'     => 'VARCHAR',
        'length'   => '200',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => ''
    ],
    'busstop_name'    => [
        'name'     => 'Наименование остановки',
        'type'     => 'VARCHAR',
        'length'   => '200',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => ''
    ],
    'latitude'    => [
        'name'     => 'Широта',
        'type'     => 'VARCHAR',
        'length'   => '200',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => '',
        'index'    => ''
    ],
    'longitude'    => [
        'name'     => 'Долгота',
        'type'     => 'VARCHAR',
        'length'   => '200',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => '',
        'index'    => ''
    ],
    'approve_id'    => [
        'name'     => 'Номер разрешения',
        'type'     => 'VARCHAR',
        'length'   => '30',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => ''
    ],
    'type'    => [
        'name'     => 'Тип павильона',
        'type'     => 'VARCHAR',
        'length'   => '30',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => ''
    ],
    'format'    => [
        'name'     => 'Формат',
        'type'     => 'VARCHAR',
        'length'   => '30',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => ''
    ],
    'nds_rate'    => [
        'name'     => 'Тариф с НДС',
        'type'     => 'VARCHAR',
        'length'   => '200',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => ''
    ],
    'choose'    => [
        'name'     => 'Выбор',
        'type'     => 'VARCHAR',
        'length'   => '200',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => ''
    ],
    'rate'    => [
        'name'     => 'Тариф с учетом пакета с НДС',
        'type'     => 'VARCHAR',
        'length'   => '200',
        'default'  => '',
        'encoding' => '',
        'attr'     => '',
        'null'     => 'NULL',
        'index'    => ''
    ]
];

function generate_keys_query($keys)
{
    $output = '';

    foreach ($keys as $key => $value) {

        $output .= $key;

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

            $output .= "|{$type}{$length}{$default}{$encoding}{$attr}{$null}{$index}{$AI}{$primary},";
        }
    }

    return $output;
};

// sql to create table
$sql = "CREATE TABLE busstops (" . generate_keys_query($keys) . ")";

echo ($sql);

// if ($conn->query($sql) === TRUE) {
//     echo "Table MyGuests created successfully";
// } else {
//     echo "Error creating table: " . $conn->error;
// }

$conn->close();
