<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/db.php');

$db = new db(HOST, USER, PASSWORD, DB_NAME);

$table = $db->select(TABLE_NAME);

?>

<script id="db_points">
    const dbPoints = JSON.parse(`<?= json_encode($table) ?>`);
</script>