<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/functions.php');

get_header();

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/db.php');

$db = new db(HOST, USER, PASSWORD, DB_NAME);

?>

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <h4 class="header-title m-t-0 m-b-20">Welcome !</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box widget-inline">
                <div class="row">
                    <div class="col-lg col-sm-6">
                        <div class="widget-inline-box text-center">
                            <h3 class="m-t-10">
                                <i class="text-primary ti-location-pin"></i>
                                <b><?= $db->count(BUSSTOPS_TABLE) ?></b>
                            </h3>
                            <p class="text-muted">Всего остановок в базе</p>
                        </div>
                    </div>

                    <div class="col-lg col-sm-6">
                        <div class="widget-inline-box text-center">
                            <h3 class="m-t-10">
                                <i class="text-custom ti-shopping-cart"></i>
                                <b>???</b>
                            </h3>
                            <p class="text-muted">Всего купленных остановок</p>
                        </div>
                    </div>

                    <div class="col-lg col-sm-6">
                        <div class="widget-inline-box text-center">
                            <h3 class="m-t-10">
                                <i class="text-info ti-user"></i>
                                <b><?= $db->count(USERS_TABLE) ?></b>
                            </h3>
                            <p class="text-muted">Всего пользователей</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--end row -->

    <div class="row">
        <div class="col-lg-6">
            <div class="card-box">
                <h6 class="m-t-0">Купленные остановки в этом году</h6>
                <div class="text-center">
                    <ul class="list-inline chart-detail-list">
                        <li class="list-inline-item">
                            <p class="font-normal"><i class="fa fa-circle m-r-10 text-primary"></i>Нынешний</p>
                        </li>
                        <li class="list-inline-item">
                            <p class="font-normal"><i class="fa fa-circle m-r-10 text-muted"></i>Прошлый</p>
                        </li>
                    </ul>
                </div>
                <div id="dashboard-bar-stacked" class="morris-chart" style="height: 300px;"></div>
            </div>
        </div> <!-- end col -->

        <div class="col-lg-6">
            <div class="card-box">
                <h6 class="m-t-0">Купленные остановки за все года</h6>
                <div class="text-center">
                    <ul class="list-inline chart-detail-list">
                        <li class="list-inline-item">
                            <p class="font-weight-bold"><i class="fa fa-circle m-r-10 text-primary"></i>Год</p>
                        </li>
                    </ul>
                </div>
                <div id="dashboard-line-chart" class="morris-chart" style="height: 300px;"></div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <h6 class="m-t-0">Пользователи</h6>
                <div class="table-responsive">
                    <table class="table table-hover mails m-0 table table-actions-bar">
                        <thead>
                            <tr>
                                <th>Имя</th>
                                <th>Дата регистрации</th>
                                <th>Должность</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php

                            $users = $db->select(USERS_TABLE, false, '*');

                            foreach ($users as $user) {

                            ?>

                                <tr>

                                    <td>
                                        <?= $user['first_name'] . ' ' . $user['last_name'] ?>
                                    </td>

                                    <td>
                                        <?= $user['registered'] ?>
                                    </td>

                                    <td>
                                        <?= $user['position'] ?>
                                    </td>

                                </tr>

                            <?php

                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<?php get_footer(); ?>