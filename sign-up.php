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

                                <div class="form-group row">
                                    <label class="col-md-12 col-form-label" for="user_login">Придумайте логин</label>
                                    <div class="col-md">
                                        <input required="" type="text" id="user_login" name="user_login" class="form-control" value="" placeholder="Логин">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-12 col-form-label" for="user_password">Придумайте пароль</label>
                                    <div class="col-md">
                                        <input required="" type="text" id="user_password" name="user_password" class="form-control" value="" placeholder="Пароль">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-12 col-form-label" for="user_first_name">Ваше имя</label>
                                    <div class="col-md">
                                        <input required="" type="text" id="user_first_name" name="user_first_name" class="form-control" value="" placeholder="Имя">
                                    </div>
                                </div>

                                <div class="form-group row m-b-20">
                                    <label class="col-md-12 col-form-label" for="user_last_name">Ваша фамилия</label>
                                    <div class="col-md">
                                        <input required="" type="text" id="user_last_name" name="user_last_name" class="form-control" value="" placeholder="Фамилия">
                                    </div>
                                </div>

                                <div class="form-group account-btn text-center m-t-10">
                                    <div class="col-12">
                                        <button class="btn btn-lg btn-primary btn-block" name="sign-up" type="submit">Зарегистрироваться</button>
                                    </div>
                                </div>

                            </form>

                            <div class="clearfix"></div>

                        </div>
                    </div>
                    <!-- end card-box-->


                    <div class="row m-t-50">
                        <div class="col-sm-12 text-center">
                            <p class="text-muted">У вас есть аккаунт? <a href="/sign-in.php" class="text-dark m-l-5">Войти</a></p>
                        </div>
                    </div>

                </div>
                <!-- end wrapper -->

            </div>
        </div>
    </div>
</section>

<?php get_footer("not-main"); ?>