<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');

if (!defined('INSTALLED')) header('Location: /install/install.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/functions.php');

$page = get_page();

?>

<!DOCTYPE html>
<html lang="ru-RU">

<head>
    <meta charset="utf-8" />
    <title>Главная | Интерактивный помощник</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <?php

    echo get_favicon($page);

    $styles = enqueue_styles($page);

    foreach ($styles as $key => $value) {

        echo "<link rel='stylesheet' id='css-{$key}' href='{$value}'>";
    }

    ?>

</head>


<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="index.html" class="logo">
                    <span>
                        <img src="assets/images/logo.png" alt="">
                    </span>
                    <i>
                        <img src="assets/images/logo_sm.png" alt="">
                    </i>
                </a>
            </div>

            <nav class="navbar-custom">

                <ul class="list-unstyled topbar-right-menu float-right mb-0">

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="mdi mdi-bell noti-icon"></i>
                            <span class="badge badge-danger badge-pill noti-icon-badge">4</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h6 class="m-0"><span class="float-right">
                                        <a href="" class="text-dark">
                                            <small>Clear All</small>
                                        </a>
                                    </span>Notification
                                </h6>
                            </div>

                            <div class="slimscroll" style="max-height: 190px;">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-success"><i class="mdi mdi-comment-account-outline"></i>
                                    </div>
                                    <p class="notify-details">Caleb Flakelar commented on Admin<small class="text-muted">1 min ago</small></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-info"><i class="mdi mdi-account-plus"></i></div>
                                    <p class="notify-details">New user registered.<small class="text-muted">5 hours
                                            ago</small></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-danger"><i class="mdi mdi-heart"></i></div>
                                    <p class="notify-details">Carlos Crouch liked <b>Admin</b><small class="text-muted">3 days ago</small></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-warning"><i class="mdi mdi-comment-account-outline"></i>
                                    </div>
                                    <p class="notify-details">Caleb Flakelar commented on Admin<small class="text-muted">4 days ago</small></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-custom"><i class="mdi mdi-heart"></i></div>
                                    <p class="notify-details">Carlos Crouch liked <b>Admin</b><small class="text-muted">13 days ago</small></p>
                                </a>
                            </div>

                            <!-- All-->
                            <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                View all <i class="fi-arrow-right"></i>
                            </a>

                        </div>
                    </li>

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="assets/images/users/avatar-1.jpg" alt="user" class="rounded-circle"> <span class="ml-1">Гость <i class="mdi mdi-chevron-down"></i> </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <!-- item-->
                            <!-- <div class="dropdown-item noti-title">
                                <h6 class="text-overflow m-0">Welcome !</h6>
                            </div> -->

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ti-user"></i> <span>Профиль</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ti-settings"></i> <span>Настройки</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ti-lock"></i> <span>Lock Screen</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ti-power-off"></i> <span>Выйти</span>
                            </a>

                        </div>
                    </li>

                </ul>

                <ul class="list-inline menu-left mb-0">
                    <li class="float-left">
                        <button class="button-menu-mobile open-left waves-light waves-effect">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </li>
                    <!-- <li class="hide-phone app-search">
                        <form role="search" class="">
                            <input type="text" placeholder="Search..." class="form-control">
                            <a href=""><i class="fa fa-search"></i></a>
                        </form>
                    </li> -->
                </ul>

            </nav>

        </div>
        <!-- Top Bar End -->


        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <div class="user-details">
                <div class="pull-left">
                    <img src="assets/images/users/avatar-1.jpg" alt="" class="thumb-md rounded-circle">
                </div>
                <div class="user-info">
                    <a href="#">Гость</a>
                    <p class="text-muted m-0">Сотрудник</p>
                </div>
            </div>

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu" id="side-menu">
                    <li class="menu-title">Навигация</li>
                    <li>
                        <a href="/">
                            <i class="ti-home"></i><span> Консоль </span>
                        </a>
                    </li>

                    <li>
                        <a href="map.php">
                            <i class="ti-location-pin"></i><span> Открыть карту </span>
                        </a>
                    </li>

                    <li>
                        <a href="statuses.php">
                            <i class="ti-stats-up"></i><span> Статусы </span>
                        </a>
                    </li>

                    <li>
                        <a href="busstops-base.php">
                            <i class="ti-map-alt"></i><span> База остановок </span>
                        </a>
                    </li>

                    <li>
                        <a href="faq.php">
                            <i class="ti-help-alt"></i><span> Инструкция </span>
                        </a>
                    </li>

                    <li>
                        <a href="database.php">
                            <i class="ti-server"></i><span> База данных </span>
                        </a>
                    </li>

                </ul>

            </div>
            <!-- Sidebar -->
            <div class="clearfix"></div>

        </div>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content <?= 'page__' . $page ?>">