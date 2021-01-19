<?php

require('SimpleXLSXGen.php');

function changeCharset($array)
{
    array_walk_recursive($array, function (&$item) {
        $item = iconv("UTF-8", "ISO-8859-1", $item);
    });

    return $array;
}

$ids = explode(",", $_GET['ids']);

$json = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/places.json');
//$array = json_decode($json, TRUE);

echo json_encode(mb_convert_encoding($json, 'windows-1252', 'UTF-8'));
