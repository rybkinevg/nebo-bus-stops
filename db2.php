<?php

class db
{
    private $servername = "localhost";
    private $dbname   = "test-db";
    private $username   = "root";
    private $password   = "root";
    private $connection;

    public function __construct($host, $user, $pass, $dbname)
    {
        $connection = new mysqli($host, $user, $pass, $dbname);

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        $this->connection = $connection;
    }
}

$servername = "localhost";
$dbname   = "test-db";
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
        'name'     => 'Яндекс.Карты',
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
    'GPR'    => [
        'name'     => 'GPR',
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
        'name'     => 'Ближайший адрес',
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
        'name'     => 'Номер разрешения',
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

$tablename = "busstopssssssadsad";

// sql to know how mutch cols in table
// if ($result = $conn->query("SELECT * FROM `{$tablename}` ORDER BY ID LIMIT 1")) {

//     /* определяем количество стобцов в результирующей таблице */
//     $field_cnt = $result->field_count;

//     printf("Результат содержит %d полей.\n", $field_cnt);

//     /* закрываем результирующий набор */
//     $result->close();
// }

//sql to insert table
// $sql = "INSERT INTO `{$tablename}` VALUES(NULL, 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B')";
// if ($conn->query($sql) === TRUE) {
//     echo "Таблица {$tablename} успешно обновлена";
// } else {
//     echo "Ошибка при обновлении таблицы: " . $conn->error;
// }

$conn->close();
