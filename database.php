<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/db.php');

$db = new db(HOST, USER, PASSWORD, DB_NAME);

$user_info = get_user_info($db, $_COOKIE['id']);

get_header();

$monthArr = [
    "01" => "Январь",
    "02" => "Февраль",
    "03" => "Март",
    "04" => "Апрель",
    "05" => "Май",
    "06" => "Июнь",
    "07" => "Июль",
    "08" => "Август",
    "09" => "Сентябрь",
    "10" => "Октябрь",
    "11" => "Ноябрь",
    "12" => "Декабрь"
];

if ($user_info['status'] != '2') {

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Режим просмотра:</strong> управление базой данных доступно только администратору
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Остановки</h3>
                    </div>
                    <?php

                    if (check_table($db, BUSSTOPS_TABLE)) {
                    ?>
                        <div class="panel-body">
                            <p class="text-success">Таблица существует</p>
                            <p>Найдено <strong><?= $db->count(BUSSTOPS_TABLE) ?></strong> строк</p>
                            <?php if ($db->count(BUSSTOPS_TABLE, "*", "`latitude` = 'NULL' AND `longitude` = 'NULL' OR `address_near` = 'NULL'") > 0) : ?>
                                <p>Найдено <strong><?= $db->count(BUSSTOPS_TABLE, "*", "`latitude` = 'NULL' AND `longitude` = 'NULL'") ?></strong> сторон без координат</p>
                                <p>Найдено <strong><?= $db->count(BUSSTOPS_TABLE, "*", "`address_near` = 'NULL'") ?></strong> сторон без ближайших адресов</p>
                            <?php endif; ?>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="panel-body">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                Таблицы не существует!
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Статусы</h3>
                    </div>
                    <?php

                    if (check_table($db, STATUSES_TABLE)) {

                    ?>
                        <div class="panel-body">
                            <p class="text-success">Таблица существует</p>
                            <p>Найдено <strong><?= $db->count(STATUSES_TABLE) ?></strong> строк</p>
                            <?php if ($db->count(STATUSES_TABLE, "*", "`date_sold` = '2021-01'") > 0) : ?>
                                <?php

                                foreach ($monthArr as $key => $value) {

                                    if ($db->count(STATUSES_TABLE, "*", "`date_sold` = '2021-{$key}'")) {

                                        echo "<p>Найдено <strong>" . $db->count(STATUSES_TABLE, "*", "`date_sold` = '2021-{$key}'") . "</strong> купленных сторон за {$value} 2021</p>";
                                    }
                                }

                                ?>
                            <?php endif; ?>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="panel-body">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                Таблицы не существует!
                            </div>
                        </div>
                    <?php

                    }

                    ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Пользователи</h3>
                    </div>
                    <?php

                    if (check_table($db, USERS_TABLE)) {

                    ?>
                        <div class="panel-body">
                            <p class="text-success">Таблица существует</p>
                            <p>Найдено <strong><?= $db->count(USERS_TABLE) ?></strong> строк</p>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="panel-body">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                Таблицы не существует!
                            </div>
                        </div>
                    <?php

                    }

                    ?>
                </div>
            </div>
        </div>
    </div>

<?php

} else {

?>

    <div class="container-fluid">
        <div class="row">

            <div id="importModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="importModalLabel">Импорт</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <form id="upload-form-statuses">
                                <input type="hidden" name="action" value="import-statuses">
                                <div class="form-group">
                                    <label class="control-label">Выберите месяц статусов</label>
                                    <select class="form-control" name="month">
                                        <option value="01">Январь</option>
                                        <option value="02">Февраль</option>
                                        <option value="03">Март</option>
                                        <option value="04">Апрель</option>
                                        <option value="05">Май</option>
                                        <option value="06">Июнь</option>
                                        <option value="07">Июль</option>
                                        <option value="08">Август</option>
                                        <option value="09">Сентябрь</option>
                                        <option value="10">Октябрь</option>
                                        <option value="11">Ноябрь</option>
                                        <option value="12">Декабрь</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Выберите год статусов</label>
                                    <select class="form-control" name="year">
                                        <option value="<?= date('Y'); ?>"><?= date('Y'); ?></option>
                                        <option value="<?= date('Y') + 1; ?>"><?= date('Y') + 1; ?></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Выберите Exel файл для загрузки</label>
                                    <input id="upload-file" name="upload-file" type="file" class="filestyle" data-buttontext="Выбрать файл" data-buttonname="btn-primary" id="filestyle-5" tabindex="-1" style="position: absolute; clip: rect(0px, 0px, 0px, 0px);">
                                </div>
                                <div class="form-group text-right m-0">
                                    <button id="upload-submit-statuses" class="btn btn-primary waves-effect waves-light" type="submit">
                                        Загрузить
                                    </button>
                                    <button type="reset" class="btn btn-default waves-effect m-l-5">
                                        Очистить
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div id="upload-footer" class="modal-footer"></div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>

            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Остановки</h3>
                    </div>
                    <?php

                    if (check_table($db, BUSSTOPS_TABLE)) {
                    ?>
                        <div class="panel-body">
                            <p class="text-success">Таблица существует</p>
                            <p>Найдено <strong><?= $db->count(BUSSTOPS_TABLE) ?></strong> строк</p>
                            <?php if ($db->count(BUSSTOPS_TABLE, "*", "`latitude` = 'NULL' AND `longitude` = 'NULL' OR `address_near` = 'NULL'") > 0) : ?>
                                <p>Найдено <strong><?= $db->count(BUSSTOPS_TABLE, "*", "`latitude` = 'NULL' AND `longitude` = 'NULL'") ?></strong> сторон без координат</p>
                                <p>Найдено <strong><?= $db->count(BUSSTOPS_TABLE, "*", "`address_near` = 'NULL'") ?></strong> сторон без ближайших адресов</p>
                                <button id="js-db-coods-busstops" type="button" class="btn btn-primary m-t-10">Добавить координаты</button>
                            <?php endif; ?>
                            <button id="js-db-import-busstops" type="button" class="btn btn-primary m-t-10">Импортировать</button>
                            <button id="js-db-delete-busstops" type="button" class="btn btn-danger m-t-10">Удалить</button>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="panel-body">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                Таблицы не существует!
                            </div>
                            <p class="p-b-2">Добавить таблицу, в которой будут все остановки по заготовленному шаблону.</p>
                            <button id="js-db-create-busstops" type="button" class="btn btn-primary m-t-10">Создать</button>
                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Статусы</h3>
                    </div>
                    <?php

                    if (check_table($db, STATUSES_TABLE)) {

                    ?>
                        <div class="panel-body">
                            <p class="text-success">Таблица существует</p>
                            <p>Найдено <strong><?= $db->count(STATUSES_TABLE) ?></strong> строк</p>
                            <?php if ($db->count(STATUSES_TABLE, "*", "`date_sold` = '2021-01'") > 0) : ?>
                                <?php

                                foreach ($monthArr as $key => $value) {

                                    if ($db->count(STATUSES_TABLE, "*", "`date_sold` = '2021-{$key}'")) {

                                        echo "<p>Найдено <strong>" . $db->count(STATUSES_TABLE, "*", "`date_sold` = '2021-{$key}'") . "</strong> купленных сторон за {$value} 2021</p>";
                                    }
                                }

                                ?>
                            <?php endif; ?>
                            <button type="button" class="btn btn-primary m-t-10" data-toggle="modal" data-target="#importModal">Импортировать</button>
                            <button id="js-db-delete-statuses" type="button" class="btn btn-danger m-t-10">Удалить</button>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="panel-body">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                Таблицы не существует!
                            </div>
                            <p class="p-b-2">Добавить таблицу, в которой будут все статусы по доступности остановок по заготовленному шаблону.</p>
                            <button id="js-db-create-statuses" type="button" class="btn btn-primary m-t-10">Создать</button>
                        </div>
                    <?php

                    }

                    ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Пользователи</h3>
                    </div>
                    <?php

                    if (check_table($db, USERS_TABLE)) {

                    ?>
                        <div class="panel-body">
                            <p class="text-success">Таблица существует</p>
                            <p>Найдено <strong><?= $db->count(USERS_TABLE) ?></strong> строк</p>
                            <button id="js-db-delete-users" type="button" class="btn btn-danger m-t-10">Удалить</button>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="panel-body">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                Таблицы не существует!
                            </div>
                            <p class="p-b-2">Добавить таблицу, в которой будут все пользователи по заготовленному шаблону.</p>
                            <button id="js-db-create-users" type="button" class="btn btn-primary m-t-10">Создать</button>
                        </div>
                    <?php

                    }

                    ?>
                </div>
            </div>
        </div>
    </div>

<?php

}

get_footer(); ?>