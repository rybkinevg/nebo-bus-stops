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
                            <div class="text-center m-b-20">
                                <img src="assets/images/cancel.svg" title="invite.svg" height="80" class="m-t-10">
                                <h3 class="expired-title mb-4 mt-2">Страница не найдена</h3>
                                <p class="text-muted m-t-20 line-h-24">
                                    Страница, которую вы ищите, удалена или не существует.
                                </p>
                            </div>

                            <div class="row m-t-30">
                                <div class="col-12">
                                    <a href="/" class="btn btn-lg btn-primary btn-block">Вернуться на главную</a>
                                </div>
                            </div>

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

<?php get_footer('not-main'); ?>