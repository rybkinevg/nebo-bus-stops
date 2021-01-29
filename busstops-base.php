<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/functions.php');

get_header();

$keys = [
    'ID',
    'Сторона',
    'Инвентарный номер',
    'ГИД',
    'Район',
    'Округ',
    'Ссылка Яндекс.Карты',
    'Ссылка Яндекс.Панораммы',
    'Ссылка фото',
    'Ссылка схема',
    'GRP',
    'OTS',
    'Код Эспар',
    'Улица',
    'Направление',
    'Ближайший адрес',
    'Название остановки',
    'Широта',
    'Долгота',
    '№ Разрешения',
    'Тип',
    'Формат',
    'Прайс с НДС',
    'Выбор',
    'Прайс с учётом пакета НДС'
];

function generate_keys_to_table($keys)
{

    $output = '';

    foreach ($keys as $key) {

        $output .= "<th>{$key}</th>";
    }

    return $output;
}

function generate_keys_to_hide_links($keys)
{

    $output = '';

    for ($i = 0; $i < count($keys); $i++) {

        $output .= "<a class='toggle-vis' data-column='{$i}'>{$keys[$i]}</a> - ";
    }

    return $output;
}

?>

<div class="container-fluid">
    <h1 class="m-b-20">База остановок</h1>
    <div class="row">
        <div class="col-sm-12">
            <div class="m-b-20">
                <?= generate_keys_to_hide_links($keys) ?>
            </div>
            <table id="busstops-table" class="table table-striped table-bordered dataTable">
                <thead>
                    <tr>
                        <?= generate_keys_to_table($keys) ?>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <?= generate_keys_to_table($keys) ?>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<?php get_footer(); ?>