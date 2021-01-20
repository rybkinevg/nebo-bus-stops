<?php

require('./includes/SimpleXLSX.php');

$file_path = 'd.xlsx';

if ($xlsx = SimpleXLSX::parse($file_path)) {
    echo '<pre>';
    var_dump($xlsx->rows()[0], $xlsx->rows()[1]);
    echo '</pre>';
    //echo SimpleXLSX::parse($file_path)->toHTML();
} else {
    echo SimpleXLSX::parseError();
}
