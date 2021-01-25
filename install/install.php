<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/db.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/functions.php');

get_header("not-main");

$page = get_page();

$success = false;
$error = false;

if (isset($_POST['install'])) {

    $db = new db(
        $_POST['host'],
        $_POST['user'],
        $_POST['password']
    );

    $db->create_db($_POST['dbname']);

    $file = $_SERVER["DOCUMENT_ROOT"] . '/config.php';

    $current = file_get_contents($file);

    // HOST
    $current .= PHP_EOL . "define('HOST', '" . $_POST['host'] . "');" . PHP_EOL;

    // USER
    $current .= "define('USER', '" . $_POST['user'] . "');" . PHP_EOL;

    // PASS
    $current .= "define('PASSWORD', '" . $_POST['password'] . "');" . PHP_EOL;

    // DBNAME
    $current .= "define('DB_NAME', '" . $_POST['dbname'] . "');" . PHP_EOL;

    // BUSSTOPS TABLE
    $current .= "define('BUSSTOPS_TABLE', '" . $_POST['maintable'] . "');" . PHP_EOL;

    // INSTALLED
    $current .= "define('INSTALLED', 'true');" . PHP_EOL;

    file_put_contents($file, $current);

    $success = true;
}

?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <div class="wrapper-page">

                    <div class="m-t-40 card-box">
                        <div class="text-center">
                            <h2 class="text-uppercase m-t-0 m-b-30">
                                <a href="index.html" class="text-success">
                                    <span><img src="<?= get_path(true) . '/assets/images/logo.png' ?>" alt="" height="30"></span>
                                </a>
                            </h2>
                        </div>
                        <div class="account-content">

                            <?php if ($error) : ?>

                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <?= $error; ?>
                                </div>

                            <?php endif; ?>

                            <?php if (!$success) : ?>

                                <form id="install" class="form-horizontal" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">

                                    <h6 class="m-t-0 m-b-20 header-title font-16"><b>Настройки базы данных</b></h6>

                                    <div class="form-group row">
                                        <label class="col-md-6 col-form-label" for="host">Хост</label>
                                        <div class="col-md">
                                            <input type="text" id="host" name="host" class="form-control" value="localhost" placeholder="localhost">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-6 col-form-label" for="user">Логин</label>
                                        <div class="col-md">
                                            <input type="text" id="user" name="user" class="form-control" value="root" placeholder="root">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-6 col-form-label" for="password">Пароль</label>
                                        <div class="col-md">
                                            <input type="text" id="password" name="password" class="form-control" value="root" placeholder="root">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-6 col-form-label" for="dbname">Название базы данных</label>
                                        <div class="col-md">
                                            <input type="text" id="dbname" name="dbname" class="form-control" value="nebo-busstops-db" placeholder="nebo-busstops-db">
                                        </div>
                                    </div>

                                    <h6 class="m-t-0 m-b-20 header-title font-16"><b>Настройки таблиц</b></h6>

                                    <div class="form-group row">
                                        <label class="col-md-6 col-form-label" for="maintable">Название таблицы остановок</label>
                                        <div class="col-md">
                                            <input type="text" id="maintable" name="maintable" class="form-control" value="busstops" placeholder="busstops">
                                        </div>
                                    </div>

                                    <div class="form-group account-btn text-center m-t-10">
                                        <div class="col-12">
                                            <button class="btn btn-lg btn-primary btn-block" name="install" type="submit">Установить</button>
                                        </div>
                                    </div>

                                </form>

                            <?php else : ?>

                                <h6 class="m-t-0 m-b-20 header-title font-16"><b>Настройки успешно произведены</b></h6>
                                <p>Все необходимые настройки произведены, доступ к страницам сайта восстановлен.</p>
                                <p><a href="/" class="btn btn-primary">На главную страницу</a></p>

                            <?php endif; ?>

                            <div class="clearfix"></div>

                        </div>
                    </div>
                    <!-- end card-box-->

                </div>
                <!-- end wrapper -->

            </div>
        </div>
    </div>
</section>

<?php get_footer("not-main"); ?>