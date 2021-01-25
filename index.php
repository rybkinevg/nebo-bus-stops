<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/db.php');

$db = new db(HOST, USER, PASSWORD, DB_NAME);

get_header();

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
                                <b>7841</b>
                            </h3>
                            <p class="text-muted">Всего купленных сотановок</p>
                        </div>
                    </div>

                    <div class="col-lg col-sm-6">
                        <div class="widget-inline-box text-center">
                            <h3 class="m-t-10">
                                <i class="text-info ti-user"></i>
                                <b>6521</b>
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
                                <th style="min-width: 95px;">
                                    <div class="checkbox checkbox-primary checkbox-single m-r-15">
                                        <input id="action-checkbox" type="checkbox">
                                        <label for="action-checkbox"></label>
                                    </div>
                                </th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Products</th>
                                <th>Start Date</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    <div class="checkbox checkbox-primary m-r-15">
                                        <input id="checkbox2" type="checkbox">
                                        <label for="checkbox2"></label>
                                    </div>

                                    <img src="assets/images/users/avatar-2.jpg" alt="contact-img" title="contact-img" class="rounded-circle thumb-sm" />
                                </td>

                                <td>
                                    Tomaslau
                                </td>

                                <td>
                                    <a href="#" class="text-muted">tomaslau@dummy.com</a>
                                </td>

                                <td>
                                    <b><a href="" class="text-dark"><b>356</b></a> </b>
                                </td>

                                <td>
                                    01/11/2003
                                </td>

                            </tr>

                            <tr>
                                <td>
                                    <div class="checkbox checkbox-primary m-r-15">
                                        <input id="checkbox1" type="checkbox">
                                        <label for="checkbox1"></label>
                                    </div>

                                    <img src="assets/images/users/avatar-1.jpg" alt="contact-img" title="contact-img" class="rounded-circle thumb-sm" />
                                </td>

                                <td>
                                    Chadengle
                                </td>

                                <td>
                                    <a href="#" class="text-muted">chadengle@dummy.com</a>
                                </td>

                                <td>
                                    <b><a href="" class="text-dark"><b>568</b></a> </b>
                                </td>

                                <td>
                                    01/11/2003
                                </td>

                            </tr>

                            <tr>
                                <td>
                                    <div class="checkbox checkbox-primary m-r-15">
                                        <input id="checkbox3" type="checkbox">
                                        <label for="checkbox3"></label>
                                    </div>

                                    <img src="assets/images/users/avatar-3.jpg" alt="contact-img" title="contact-img" class="rounded-circle thumb-sm" />
                                </td>

                                <td>
                                    Stillnotdavid
                                </td>

                                <td>
                                    <a href="#" class="text-muted">stillnotdavid@dummy.com</a>
                                </td>
                                <td>
                                    <b><a href="" class="text-dark"><b>201</b></a> </b>
                                </td>

                                <td>
                                    12/11/2003
                                </td>

                            </tr>

                            <tr>
                                <td>
                                    <div class="checkbox checkbox-primary m-r-15">
                                        <input id="checkbox4" type="checkbox">
                                        <label for="checkbox4"></label>
                                    </div>

                                    <img src="assets/images/users/avatar-4.jpg" alt="contact-img" title="contact-img" class="rounded-circle thumb-sm" />
                                </td>

                                <td>
                                    Kurafire
                                </td>

                                <td>
                                    <a href="#" class="text-muted">kurafire@dummy.com</a>
                                </td>

                                <td>
                                    <b><a href="" class="text-dark"><b>56</b></a> </b>
                                </td>

                                <td>
                                    14/11/2003
                                </td>

                            </tr>

                            <tr>
                                <td>
                                    <div class="checkbox checkbox-primary m-r-15">
                                        <input id="checkbox5" type="checkbox">
                                        <label for="checkbox5"></label>
                                    </div>

                                    <img src="assets/images/users/avatar-5.jpg" alt="contact-img" title="contact-img" class="rounded-circle thumb-sm" />
                                </td>

                                <td>
                                    Shahedk
                                </td>

                                <td>
                                    <a href="#" class="text-muted">shahedk@dummy.com</a>
                                </td>

                                <td>
                                    <b><a href="" class="text-dark"><b>356</b></a> </b>
                                </td>

                                <td>
                                    20/11/2003
                                </td>

                            </tr>

                            <tr>
                                <td>
                                    <div class="checkbox checkbox-primary m-r-15">
                                        <input id="checkbox6" type="checkbox">
                                        <label for="checkbox6"></label>
                                    </div>

                                    <img src="assets/images/users/avatar-6.jpg" alt="contact-img" title="contact-img" class="rounded-circle thumb-sm" />
                                </td>

                                <td>
                                    Adhamdannaway
                                </td>

                                <td>
                                    <a href="#" class="text-muted">adhamdannaway@dummy.com</a>
                                </td>

                                <td>
                                    <b><a href="" class="text-dark"><b>956</b></a> </b>
                                </td>

                                <td>
                                    24/11/2003
                                </td>

                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<?php get_footer(); ?>