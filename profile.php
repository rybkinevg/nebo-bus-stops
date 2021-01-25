<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/functions.php');

get_header();

?>

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <div class="p-0 text-center">
                <div class="member-card">
                    <div class="thumb-xl member-thumb m-b-10 center-page">
                        <img src="assets/images/users/avatar-3.jpg" class="rounded-circle img-thumbnail" alt="profile-image">
                        <i class="mdi mdi-star-circle member-star text-success" title="verified user"></i>
                    </div>

                    <div class="">
                        <h5 class="m-b-5 mt-3">Mark A. McKnight</h5>
                        <p class="text-muted">@webdesigner</p>
                    </div>

                    <p class="text-muted m-t-10">
                        Hi I'm Johnathn Deo,has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.
                    </p>


                    <button type="button" class="btn btn-primary m-t-10">Follow</button>
                    <button type="button" class="btn btn-custom m-t-10">Message</button>

                </div>

            </div> <!-- end card-box -->

        </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="m-t-30">
        <ul class="nav nav-tabs tabs-bordered">
            <li class="nav-item">
                <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                    Profile
                </a>
            </li>
            <li class="nav-item">
                <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link">
                    Settings
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="home-b1">
                <div class="row">
                    <div class="col-md-4">
                        <!-- Personal-Information -->
                        <div class="panel panel-default panel-fill">
                            <div class="panel-heading">
                                <h3 class="panel-title">Personal Information</h3>
                            </div>
                            <div class="panel-body">
                                <div class="m-b-20">
                                    <strong>Full Name</strong>
                                    <br>
                                    <p class="text-muted">Johnathan Deo</p>
                                </div>
                                <div class="m-b-20">
                                    <strong>Mobile</strong>
                                    <br>
                                    <p class="text-muted">(123) 123 1234</p>
                                </div>
                                <div class="m-b-20">
                                    <strong>Email</strong>
                                    <br>
                                    <p class="text-muted">johnath@domain.com</p>
                                </div>
                                <div class="about-info-p m-b-0">
                                    <strong>Location</strong>
                                    <br>
                                    <p class="text-muted">USA</p>
                                </div>
                            </div>
                        </div>
                        <!-- Personal-Information -->

                        <!-- Social -->
                        <div class="panel panel-default panel-fill">
                            <div class="panel-heading">
                                <h3 class="panel-title">Social</h3>
                            </div>
                            <div class="panel-body">
                                <ul class="social-links list-inline mb-0">
                                    <li class="list-inline-item">
                                        <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Skype"><i class="fa fa-skype"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Social -->
                    </div>


                    <div class="col-md-8">
                        <!-- Personal-Information -->
                        <div class="panel panel-default panel-fill">
                            <div class="panel-heading">
                                <h3 class="panel-title">Biography</h3>
                            </div>
                            <div class="panel-body">
                                <h5 class="font-14 mb-3 text-uppercase">About</h5>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                    industry. Lorem Ipsum has been the industry's standard dummy
                                    text ever since the 1500s, when an unknown printer took a galley
                                    of type and scrambled it to make a type specimen book. It has
                                    survived not only five centuries, but also the leap into
                                    electronic typesetting, remaining essentially unchanged.</p>

                                <p><strong>But also the leap into electronic typesetting, remaining
                                        essentially unchanged.</strong></p>

                                <p>It was popularised in the 1960s with the release of Letraset
                                    sheets containing Lorem Ipsum passages, and more recently with
                                    desktop publishing software like Aldus PageMaker including
                                    versions of Lorem Ipsum.</p>

                                <div class="">

                                    <h5 class="font-14 mb-3 text-uppercase m-t-30 m-b-20">Skills</h5>

                                    <div class="m-b-15">
                                        <h5 class="font-14">Angular Js <span class="pull-right">60%</span></h5>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                                <span class="sr-only">60% Complete</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="m-b-15">
                                        <h5 class="font-14">Javascript <span class="pull-right">90%</span></h5>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
                                                <span class="sr-only">90% Complete</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="m-b-15">
                                        <h5 class="font-14">Wordpress <span class="pull-right">80%</span></h5>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                <span class="sr-only">80% Complete</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="m-b-0">
                                        <h5 class="font-14">HTML5 &amp; CSS3 <span class="pull-right">95%</span>
                                        </h5>
                                        <div class="progress m-b-0">
                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%">
                                                <span class="sr-only">95% Complete</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Personal-Information -->

                    </div>

                </div>
            </div>
            <div class="tab-pane" id="profile-b1">
                <!-- Personal-Information -->
                <div class="panel panel-default panel-fill">
                    <div class="panel-heading">
                        <h3 class="panel-title">Edit Profile</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <div class="form-group">
                                <label for="FullName">Full Name</label>
                                <input type="text" value="John Doe" id="FullName" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="Email">Email</label>
                                <input type="email" value="first.last@example.com" id="Email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="Username">Username</label>
                                <input type="text" value="john" id="Username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="Password">Password</label>
                                <input type="password" placeholder="6 - 15 Characters" id="Password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="RePassword">Re-Password</label>
                                <input type="password" placeholder="6 - 15 Characters" id="RePassword" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="AboutMe">About Me</label>
                                <textarea style="height: 125px" id="AboutMe" class="form-control">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</textarea>
                            </div>
                            <button class="btn btn-primary waves-effect waves-light w-md" type="submit">Save</button>
                        </form>

                    </div>
                </div>
                <!-- Personal-Information -->
            </div>
        </div>
    </div>

</div>

<?php get_footer(); ?>