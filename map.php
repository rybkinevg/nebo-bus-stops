<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/functions.php');

get_header();

$file = ($_GET['file']) ? $_GET['file'] : false;

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
                        <form id="upload-form">
                            <div class="form-group">
                                <label class="control-label">Выберите Exel файл для загрузки</label>
                                <input id="upload-file" name="upload-file" type="file" class="filestyle" data-buttontext="Выбрать файл" data-buttonname="btn-primary" id="filestyle-5" tabindex="-1" style="position: absolute; clip: rect(0px, 0px, 0px, 0px);">

                            </div>
                            <div class="form-group text-right m-0">
                                <button id="upload-submit" class="btn btn-primary waves-effect waves-light" type="submit">
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

        <div id="exportModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exportModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exportModalLabel">Экспорт</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <h6>Гиды добавленных остановок</h6>
                        <ul class="download-list">
                            <li>Ничего не найдено</li>
                        </ul>
                        <div class="form-group text-right m-0">
                            <button type="button" class="btn btn-default waves-effect waves-light js-download-update">Обновить данные</button>
                            <button type="button" class="btn btn-primary waves-effect waves-light js-download-download">Подготовить файл</button>
                        </div>
                    </div>
                    <div id="download-footer" class="modal-footer"></div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

        <div class="col-sm-6">
            <div class="card-box">
                <div class="card__info">
                    <h6 class="text-muted font-13 m-t-0 text-uppercase">Импорт точек на карту</h6>
                    <p class="m-0">Добавляет импортированные точки на карту, помечая их другим цветом</p>
                </div>
                <div class="card__btn">
                    <button type="button" class="btn btn-sm btn-primary waves-effect waves-light" data-toggle="modal" data-target="#importModal"><i class="ti-import"></i></button>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card-box">
                <div class="card__info">
                    <h6 class="text-muted font-13 m-t-0 text-uppercase">Экспорт выбранных точек</h6>
                    <p class="m-0">Возможность скачивания выбранных точек, добавленных для выгрузки</p>
                </div>
                <div class="card__btn">
                    <button type="button" class="btn btn-sm btn-primary waves-effect waves-light" data-toggle="modal" data-target="#exportModal"><i class="ti-export"></i></button>
                </div>
            </div>
        </div>

    </div>

    <div class="row map-row">
        <div id="map"></div>
    </div>

    <?php if ($file) include($_SERVER['DOCUMENT_ROOT'] . '/includes/new_points.php'); ?>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/db_points.php'); ?>

</div>

<?php get_footer(); ?>