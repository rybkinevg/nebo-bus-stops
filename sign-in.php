<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/db.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/functions.php');

get_header("not-main");

$page = get_page();

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
                                    <span><img src="assets/images/logo.png" alt="" height="30"></span>
                                </a>
                            </h2>
                        </div>
                        <div class="account-content">
                            <form class="form-horizontal" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">

                                <div class="form-group m-b-20">
                                    <div class="col-12">
                                        <label for="login">Логин</label>
                                        <input value="<?= ($_GET['login']) ? $_GET['login'] : ''; ?>" class="form-control" type="text" name="login" id="login" required="" placeholder="Введите логин">
                                    </div>
                                </div>

                                <div class="form-group m-b-20">
                                    <div class="col-12">
                                        <label for="password">Пароль</label>
                                        <input value="<?= ($_GET['pass']) ? $_GET['pass'] : ''; ?>" class="form-control" type="password" required="" name="password" id="password" placeholder="Введите пароль">
                                    </div>
                                </div>

                                <div class="form-group account-btn text-center m-t-10">
                                    <div class="col-12">
                                        <button class="btn btn-lg btn-primary btn-block" name="sign-in" type="submit">Войти</button>
                                    </div>
                                </div>

                            </form>

                            <div class="clearfix"></div>

                        </div>
                    </div>
                    <!-- end card-box-->


                    <div class="row m-t-50">
                        <div class="col-sm-12 text-center">
                            <p class="text-muted">У вас нет аккаунта? <a href="/sign-up.php" class="text-dark m-l-5">Зарегистироваться</a></p>
                        </div>
                    </div>

                </div>
                <!-- end wrapper -->

            </div>
        </div>
    </div>
</section>


<?php get_footer("not-main"); ?>