<?php

function get_path($url = false)
{
    if ($url) {

        return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'];
    }
}

function get_header($custom = false)
{

    if ($custom) {

        require_once($_SERVER['DOCUMENT_ROOT'] . '/template-parts/header-not-main.php');
    } else {

        require_once($_SERVER['DOCUMENT_ROOT'] . '/template-parts/header.php');
    }
}

function get_footer($custom = false)
{

    if ($custom) {

        require_once($_SERVER['DOCUMENT_ROOT'] . '/template-parts/footer-not-main.php');
    } else {

        require_once($_SERVER['DOCUMENT_ROOT'] . '/template-parts/footer.php');
    }
}

function get_page()
{
    $url = $_SERVER['REQUEST_URI'];

    $url = explode('?', $url);

    $url = $url[0];

    if ($url != '/') {

        $page = basename(mb_substr($url, 0, -4));
        //$page = mb_substr($url, 0, -4);
        //$page = str_replace("/", "", $page);
    } else {

        $page = "home";
    }

    return $page;
}

function enqueue_scripts($page)
{
    $scripts['jquery'] = get_path(true) . "/assets/js/jquery.min.js";
    $scripts['popper'] = get_path(true) . "/assets/js/popper.min.js";
    $scripts['bootstrap'] = get_path(true) . "/assets/js/bootstrap.min.js";
    $scripts['metisMenu'] = get_path(true) . "/assets/js/metisMenu.min.js";
    $scripts['waves'] = get_path(true) . "/assets/js/waves.js";
    $scripts['slimscroll'] = get_path(true) . "/assets/js/jquery.slimscroll.js";

    if ($page == 'install') {
    } elseif ($page == 'home') {

        $scripts['morris'] = get_path(true) . "/assets/plugins/morris/morris.min.js";
        $scripts['raphael'] = get_path(true) . "/assets/plugins/raphael/raphael-min.js";
        $scripts['dashboard'] = get_path(true) . "/assets/pages/jquery.dashboard.js";
    } elseif ($page == 'map') {

        $scripts['api-yandex-maps'] = "https://api-maps.yandex.ru/2.1/?lang=ru-RU&apikey=5571489d-8573-4ab6-8f61-558fd0453a57";
        $scripts['bootstrap-filestyle'] = get_path(true) . "assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js";
        $scripts['yandex-map'] = get_path(true) . "/assets/js/yandex-map.js";
    } elseif ($page == 'database') {

        //$scripts['sweet-alert2'] = get_path(true) . "/assets/plugins/sweet-alert2/sweetalert2.min.js";
        //$scripts['sweet-alert-init'] = get_path(true) . "/assets/pages/jquery.sweet-alert.init.js";
        $scripts['database'] = get_path(true) . "/assets/js/database.js";
    }

    $scripts['core'] = get_path(true) . "/assets/js/jquery.core.js";
    $scripts['app'] = get_path(true) . "/assets/js/jquery.app.js";

    return $scripts;
}

function check_table(db $db, $tablename)
{

    return (empty($db->check_cols($tablename))) ? false : true;
}
