<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/vendor/SimpleXLSX.php');

$file_path = './files/map_imports/' . $file;

if ($xlsx = SimpleXLSX::parse($file_path)) {

    $table = $xlsx->rows();

    $table_titles = $table[0];

    $eng_table_titles = [];

    foreach ($table_titles as $title) {

        switch ($title) {
            case 'Идентификатор':

                $eng_table_titles[] = 'id';
                break;
            case 'Широта':

                $eng_table_titles[] = 'latitude';
                break;
            case 'Долгота':

                $eng_table_titles[] = 'longitude';
                break;
        }
    }

    $new_array = [];

    for ($i = 1; $i != count($table); $i++) {

        for ($k = 0; $k < count($eng_table_titles); $k++) {

            $array[$eng_table_titles[$k]] = $table[$i][$k];
        }

        $new_array[] = $array;
    }

    $table_to_js = $new_array;
} else {

    echo SimpleXLSX::parseError();
}

?>

<script id="js-new-points">
    const uploadedPoints = JSON.parse(`<?= json_encode($table_to_js) ?>`);
</script>