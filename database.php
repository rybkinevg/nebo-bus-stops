<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/db.php');

$db = new db(HOST, USER, PASSWORD, DB_NAME);

get_header();

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Остановки</h3>
                </div>
                <?php

                // if (check_table($db, 'busstops')) {
                if (check_table($db, BUSSTOPS_TABLE)) {
                ?>
                    <div class="panel-body">
                        <p>Таблица существует</p>
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
                <div class="panel-body">
                    <p>Добавить таблицу, в которой будут все статусы по доступности остановок по заготовленному шаблону.</p>
                    <button id="db-create-statuses" type="button" class="btn btn-primary">Добавить</button>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Пользователи</h3>
                </div>
                <div class="panel-body">
                    <p>Добавить таблицу, в которой будут все пользователи по заготовленному шаблону.</p>
                    <button id="db-create-users" type="button" class="btn btn-primary">Добавить</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>