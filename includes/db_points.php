<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/db.php');

$db = new db(HOST, USER, PASSWORD, DB_NAME);

$tablename = "test-import-table-2";

$table = $db->select($tablename);

?>

<script id="js-db-points">
    const dbPoints = JSON.parse(`<?= json_encode($table) ?>`);
</script>