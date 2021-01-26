<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/db.php');

$db = new db(HOST, USER, PASSWORD, DB_NAME);

$user_info = get_user_info($db, $_COOKIE['id']);

get_header();


if ($user_info['status'] != '2') {

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Ошибка доступа!</strong>
                    Управление базой данных доступно только администратору
                </div>
            </div>
        </div>
    </div>

<?php

} else {

?>

    <div class="container-fluid">
        <div class="row">
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
        </div>
    </div>

<?php

}

get_footer(); ?>