<?php

require('./includes/vendor/SimpleXLSX.php');

$file_path = './files/' . $file;

function json_encode_advanced(array $arr, $sequential_keys = false, $quotes = false, $beautiful_json = false)
{

    $output = "{";
    $count = 0;
    foreach ($arr as $key => $value) {

        if (isAssoc($arr) || (!isAssoc($arr) && $sequential_keys == true)) {
            $output .= ($quotes ? '"' : '') . $key . ($quotes ? '"' : '') .
                ' : ';
        }

        if (is_array($value)) {
            $output .= json_encode_advanced($value, $sequential_keys, $quotes, $beautiful_json);
        } else if (is_bool($value)) {
            $output .= ($value ? 'true' : 'false');
        } else if (is_numeric($value)) {
            $output .= $value;
        } else {
            $output .= ($quotes || $beautiful_json ? '"' : '') . $value . ($quotes || $beautiful_json ? '"' : '');
        }

        if (++$count < count($arr)) {
            $output .= ', ';
        }
    }

    $output .= "}";

    return $output;
}

function isAssoc(array $arr)
{
    if (array() === $arr) return false;
    return array_keys($arr) !== range(0, count($arr) - 1);
}

if ($xlsx = SimpleXLSX::parse($file_path)) {

    $table = json_encode_advanced($xlsx->rows());
    //$table = $xlsx->rows();
} else {
    echo SimpleXLSX::parseError();
}
