<?php

if (isset($_POST['month']) && isset($_POST['year'])) {

    echo json_encode("?statuses={$_POST['year']}-{$_POST['month']}");
}
