<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

        <title>MEKO - Reservation Resto Appp</title>

        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="assets/css/loader.css" rel="stylesheet" type="text/css" />
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->

        <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
        <link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
        {{-- <link rel="stylesheet" type="text/css" href="plugins/table/datatable/custom_dt_zero_config.css"> --}}
        <link rel="stylesheet" type="text/css" href="plugins/table/datatable/custom_dt_customer.css">
        <link href="assets/css/default-dashboard/style.css" rel="stylesheet" type="text/css" />
        <link href="plugins/animate/animate.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/modals/component.css" rel="stylesheet" type="text/css" />
        <script src="plugins/sweetalerts/promise-polyfill.js"></script>
        <link href="plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
        <link href="scss/validation.css" rel="stylesheet"/>
        <link href="plugins/dropzone/dropzone.min.css" rel="stylesheet" type="text/css" />
        <link href="plugins/dropzone/basic.min.css" rel="stylesheet" type="text/css" />
        <link href="plugins/file-upload/file-upload-with-preview.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
        @yield('style')
    </head>
    <body class="antialiased">
        <input type="hidden" value="{{env('APP_URL')}}" name="base_url">
        <!--  BEGIN NAVBAR  -->
        <header class="desktop-nav header navbar fixed-top">
            <div class="nav-logo mr-sm-5 ml-sm-4">
                <a href="javascript:void(0);" class="nav-link sidebarCollapse d-inline-block mr-sm-5" data-placement="bottom">
                    <i class="flaticon-menu-line-3"></i>
                </a>
            </div>

            <ul class="navbar-nav flex-row ml-lg-auto">
                <li class="nav-item dropdown user-profile-dropdown pl-4 pr-lg-0 pr-2 ml-lg-2 mr-lg-4  align-self-center">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user">
                        <div class="user-profile d-lg-block d-none">
                            <img src="assets/img/90x90.jpg" id="logged-pict-nav" alt="admin-profile" class="img-fluid">
                        </div>
                        <i class="flaticon-user-7 d-lg-none d-block"></i>
                    </a>
                </li>
            </ul>
        </header>
        <!--  END NAVBAR  -->

        <!--  BEGIN MAIN CONTAINER  -->
        <div class="main-container" id="container">
            <div class="overlay"></div>
            <div class="ps-overlay"></div>
            <div class="search-overlay"></div>
            <!--  BEGIN MODERN  -->
            <div class="modernSidebar-nav header navbar">
                <div class="">
                    <nav id="modernSidebar">
                        <ul class="menu-categories pl-0 m-0" id="topAccordion">
                            <li class="menu">
                                <a href="/">
                                    <div class="">
                                        <i class="flaticon-computer-6"></i>
                                        <span>Dashboard</span>
                                    </div>
                                </a>
                            </li>

                            <li class="menu">
                                <a href="/menu">
                                    <div class="">
                                        <i class="flaticon-desk-chair"></i>
                                        <span>Table</span>
                                    </div>
                                </a>
                            </li>

                            <li class="menu">
                                <a href="/menu">
                                    <div class="">
                                        <i class="flaticon-cutlery-1"></i>
                                        <span>Menu</span>
                                    </div>
                                </a>
                            </li>

                            <li class="menu">
                                <a href="/employee">
                                    <div class="">
                                        <i class="flaticon-employees"></i>
                                        <span>Employee</span>
                                    </div>
                                </a>
                            </li>

                            <li class="menu">
                                <a href="#pages">
                                    <div class="">
                                        <i class="flaticon-bill"></i>
                                        <span>Order</span>
                                    </div>
                                </a>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
            <!--  END MODERN  -->

            <!--  BEGIN CONTENT PART  -->
            <div id="content" class="main-content">
                <div id="eq-loader">
                    <div class="eq-loader-div">
                        <div class="eq-loading dual-loader mx-auto mb-5"></div>
                    </div>
                </div>
                <div class="container">
                    @yield('content')
                    <div class="md-overlay"></div>
                </div>
            </div>
            <!--  END CONTENT PART  -->

        </div>
        <!-- END MAIN CONTAINER -->

        <!--  BEGIN PROFILE SIDEBAR  -->
        <aside class="profile-sidebar text-center">
            <div class="profile-content profile-content-scroll">
                <div class="usr-profile">
                    <img src="assets/img/90x90.jpg" id="logged-pict" class="img-fluid">
                </div>
                <p class="user-name mt-4 mb-4 text-capitalize" id="logged-name">Vincent Carpenter</p>
                <div class="">
                    <div class="accordion" id="user-stats">
                        <div class="card">
                            <div class="card-header pb-4 mb-4" id="status">
                                <h6 class="mb-0" data-toggle="collapse" data-target="#user-status" aria-expanded="true" aria-controls="user-status"><i class="flaticon-view-3 mr-2"></i> Status <i class="flaticon-down-arrow ml-2"></i> </h6>
                            </div>
                            <div id="user-status" class="collapse show" aria-labelledby="status" data-parent="#user-stats">
                                <div class="card-body text-left">
                                    <ul class="list-unstyled pb-4">
                                        <li class="status-online"><a href="javascript:void(0);">Online</a></li>
                                        <li class="status-away"><a href="javascript:void(0);">Away</a></li>
                                        <li class="status-no-disturb"><a href="javascript:void(0);">Not Disturb</a></li>
                                        <li class="status-invisible"><a href="javascript:void(0);">Invisible</a></li>
                                        <li class="status-offline"><a href="javascript:void(0);">Offline</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="user-links text-left">
                    <ul class="list-unstyled">
                        <li><a href="apps_mailbox.html"><i class="flaticon-mail-22"></i> Inbox</a></li>
                        <li><a href="user_profile.html"><i class="flaticon-user-11"></i> My Profile</a></li>
                        <li><a href="user_login_1.html"><i class="flaticon-power-off"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </aside>
        <!--  BEGIN PROFILE SIDEBAR  -->

        <!--  BEGIN FOOTER  -->
        <footer class="footer-section theme-footer">

            <div class="footer-section-1  sidebar-theme">
                
            </div>

            <div class="footer-section-2 container-fluid">
                <div class="row">
                    <div class="col">
                        <ul class="list-inline mb-0 d-flex justify-content-between">
                            <li class="list-inline-item  mr-3">
                                <p class="bottom-footer">&#xA9; <?php echo date('Y') ?> <a target="_blank" href="https://designreset.com/equation">MEKO</a></p>
                            </li>
                            <li class="list-inline-item align-self-center">
                                <div class="scrollTop"><i class="flaticon-up-arrow-fill-1"></i></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <!--  END FOOTER  -->
    </body>
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="plugins/blockui/jquery.blockUI.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="plugins/table/datatable/datatables.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/default-dashboard/default-custom.js"></script>
    <script src="assets/js/modal/classie.js"></script>
    <script src="assets/js/modal/modalEffects.js"></script>
    <script src="plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="plugins/dropzone/dropzone.min.js"></script>
    <script src="plugins/dropzone/custom-dropzone.js"></script>
    <script src="plugins/file-upload/file-upload-with-preview.js"></script>
    <script>
        let base_url = $('input[name=base_url]').val()
        let profile = JSON.parse(localStorage.getItem('profile'))

        if(profile.name == null){
            document.querySelector('#logged-pict').src = profile.image
            document.querySelector('#logged-pict-nav').src = profile.image
        }else{
            document.querySelector('#logged-pict').src = "assets/img/90x90.jpg"
            document.querySelector('#logged-pict-nav').src = "assets/img/90x90.jpg"
        }
        document.querySelector('#logged-name').innerHTML = profile.name
        
    </script>
    <script src="js/helper.js"></script>
    <script src="assets/js/loader.js"></script>
    @yield('script')
    <!-- END GLOBAL MANDATORY SCRIPTS -->
</html>
