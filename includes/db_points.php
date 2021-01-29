<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/db.php');

$tablename = BUSSTOPS_TABLE;

$connection = new mysqli(HOST, USER, PASSWORD, DB_NAME);

function get_items($date = false)
{

    $date = ($date) ? $date : date('Y-m');

    // Все стороны за определенный месяц, недоступные стороны помечаются
    $sql = "SELECT bs.`ID`, bs.`invent_id`, bs.`latitude`, bs.`longitude`, bs.`g_id`, bs.`address_near`, bs.`side`, bs.`direction`, st.`advertiser`, st.`g_id` as `statuses_g_id`, st.`brand` FROM `busstops` as bs LEFT JOIN `statuses` as st ON bs.`g_id` = st.`g_id` AND st.`date_sold` = '{$date}'";

    return $sql;
}

$items = (isset($_COOKIE['statuses'])) ? $_COOKIE['statuses'] : false;

$result = $connection->query(get_items($items));

for ($set = []; $row = $result->fetch_assoc(); $set[] = $row);

$result->free();

?>

<script id="js-db-points">
    const dbPoints = JSON.parse(`<?= json_encode($set) ?>`);
</script>