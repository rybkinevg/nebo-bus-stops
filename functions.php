<?php

function get_header()
{

    require_once($_SERVER['DOCUMENT_ROOT'] . '/template-parts/header.php');
}

function get_footer()
{

    require_once($_SERVER['DOCUMENT_ROOT'] . '/template-parts/footer.php');
}

function get_page()
{
    $url = $_SERVER['REQUEST_URI'];

    $url = explode('?', $url);

    $url = $url[0];

    if ($url != '/') {

        $page = mb_substr($url, 0, -4);
        $page = str_replace("/", "", $page);
    } else {

        $page = "home";
    }

    return $page;
}

function enqueue_scripts($page)
{
    $scripts['jquery'] = "./assets/js/jquery.min.js";
    $scripts['popper'] = "./assets/js/popper.min.js";
    $scripts['bootstrap'] = "./assets/js/bootstrap.min.js";
    $scripts['metisMenu'] = "./assets/js/metisMenu.min.js";
    $scripts['waves'] = "./assets/js/waves.js";
    $scripts['slimscroll'] = "./assets/js/jquery.slimscroll.js";

    if ($page == 'home') {

        $scripts['morris'] = "./assets/plugins/morris/morris.min.js";
        $scripts['raphael'] = "./assets/plugins/raphael/raphael-min.js";
        $scripts['dashboard'] = "./assets/pages/jquery.dashboard.js";
    } elseif ($page == 'map') {

        $scripts['api-yandex-maps'] = "https://api-maps.yandex.ru/2.1/?lang=ru-RU&apikey=5571489d-8573-4ab6-8f61-558fd0453a57";
        $scripts['bootstrap-filestyle'] = "assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js";
        $scripts['yandex-map'] = "./assets/js/yandex-map.js";
    }

    $scripts['core'] = "./assets/js/jquery.core.js";
    $scripts['app'] = "./assets/js/jquery.app.js";

    return $scripts;
}
