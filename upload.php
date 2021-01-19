<?php

require('./includes/SimpleXLSX.php');

$file = './files/stat.xlsx';

if ($xlsx = SimpleXLSX::parse($file)) {
    echo '<pre>';
    var_dump($xlsx->rows());
    echo '</pre>';

    echo SimpleXLSX::parse($file)->toHTML();
} else {
    echo SimpleXLSX::parseError();
}
