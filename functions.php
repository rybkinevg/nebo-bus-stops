<?php

function get_path($url = false)
{
    if ($url) {

        return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
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
    $scripts['modernizr'] = get_path(true) . "/assets/js/modernizr.min.js";
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
        $scripts['bootstrap-filestyle'] = get_path(true) . "/assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js";
        $scripts['yandex-map'] = get_path(true) . "/assets/js/yandex-map.js";
    } elseif ($page == 'database') {

        $scripts['api-yandex-maps'] = "https://api-maps.yandex.ru/2.1/?lang=ru-RU&apikey=5571489d-8573-4ab6-8f61-558fd0453a57";
        $scripts['bootstrap-filestyle'] = get_path(true) . "/assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js";
        $scripts['database'] = get_path(true) . "/assets/js/database.js";
    } elseif ($page == 'busstops-base') {

        $scripts['dataTables'] = get_path(true) . "/assets/plugins/datatables/jquery.dataTables.min.js";
        $scripts['dataTables-bootstrap'] = get_path(true) . "/assets/plugins/datatables/dataTables.bootstrap4.min.js";
        $scripts['dataTables-buttons'] = get_path(true) . "/assets/plugins/datatables/dataTables.buttons.min.js";
        $scripts['buttons'] = get_path(true) . "/assets/plugins/datatables/buttons.bootstrap4.min.js";
        $scripts['jszip'] = get_path(true) . "/assets/plugins/datatables/jszip.min.js";
        $scripts['pdfmake'] = get_path(true) . "/assets/plugins/datatables/pdfmake.min.js";
        $scripts['vfs_fonts'] = get_path(true) . "/assets/plugins/datatables/vfs_fonts.js";
        $scripts['buttons-html5'] = get_path(true) . "/assets/plugins/datatables/buttons.html5.min.js";
        $scripts['buttons-print'] = get_path(true) . "/assets/plugins/datatables/buttons.print.min.js";
        $scripts['my-dataTables'] = get_path(true) . "/assets/js/my-dataTables.js";
    }

    $scripts['core'] = get_path(true) . "/assets/js/jquery.core.js";
    $scripts['app'] = get_path(true) . "/assets/js/jquery.app.js";

    return $scripts;
}

function enqueue_styles($page)
{
    $styles['bootstrap'] = get_path(true) . "/assets/css/bootstrap.min.css";
    $styles['icons'] = get_path(true) . "/assets/css/icons.css";
    $styles['metismenu'] = get_path(true) . "/assets/css/metismenu.min.css";

    if ($page == 'install') {
    } elseif ($page == 'home') {

        $styles['morris'] = get_path(true) . "/assets/plugins/morris/morris.css";
    } elseif ($page == 'map') {

        $styles['yandex-map'] = get_path(true) . "/assets/css/yandex-map.css";
    } elseif ($page == 'database') {
    } elseif ($page == 'busstops-base') {

        $styles['dataTables'] = get_path(true) . "/assets/plugins/datatables/dataTables.bootstrap4.min.css";
        $styles['buttons'] = get_path(true) . "/assets/plugins/datatables/buttons.bootstrap4.min.css";
        $styles['responsive'] = get_path(true) . "/assets/plugins/datatables/responsive.bootstrap4.min.css";
    }

    $styles['style'] = get_path(true) . "/assets/css/style.css";

    return $styles;
}

function get_favicon($page)
{
    return "<link rel='shortcut icon' href=" . get_path(true) . '/assets/images/favicon.ico' . ">";
}

function check_table(db $db, $tablename)
{

    return (empty($db->check_cols($tablename))) ? false : true;
}

function get_user_info(db $db, $id)
{

    $user = [];

    $check_user = $db->select(USERS_TABLE, false, '*', "`ID` = '{$id}'");

    if ($check_user) {

        $user = $check_user[0];

        return $user;
    }

    return false;
}


function get_user_avatar(array $user_info)
{

    $fname = (!empty($user_info['first_name'])) ? mb_substr($user_info['first_name'], 0, 1) : '';
    $lname = (!empty($user_info['last_name'])) ? mb_substr($user_info['last_name'], 0, 1) : '';

    return $fname . $lname;
}
