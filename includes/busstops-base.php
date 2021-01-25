<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');

// DB table to use
$table = BUSSTOPS_TABLE;

// Table's primary key
$primaryKey = 'ID';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes

$keys = [
    'ID',
    'side',
    'invent_id',
    'g_id',
    'district',
    'area',
    'map_link',
    'panorama_link',
    'photo',
    'map_schema',
    'GRP',
    'OTS',
    'espar_id',
    'street',
    'direction',
    'address_near',
    'busstop_name',
    'latitude',
    'longitude',
    'approve_id',
    'type',
    'format',
    'nds_rate',
    'choose',
    'rate'
];

for ($i = 0; $i < count($keys); $i++) {

    $columns[] = [
        'db' => $keys[$i],
        'dt' => $i
    ];
}

// SQL server connection information
$sql_details = array(
    'user' => USER,
    'pass' => PASSWORD,
    'db'   => DB_NAME,
    'host' => HOST
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/vendor/ssp.class.php');

echo json_encode(
    SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
);
