<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/db.php');

$db = new db(HOST, USER, PASSWORD, DB_NAME);

$tablename = BUSSTOPS_TABLE;

$table = $db->select($tablename);

?>

<script id="js-db-points">
    const dbPoints = JSON.parse(`<?= json_encode($table) ?>`);
</script>