<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title><?= $this->config->item("nama_app"); ?></title>
    <link rel="apple-touch-icon" href="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/images/logo/favicon_2.png">
    <!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet"> -->

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/css/extensions/toastr.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/css/extensions/dragula.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/datepicker/dist/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/clockpicker/dist/bootstrap-clockpicker.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/css/pages/dashboard-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/css/pages/card-analytics.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/css/pages/data-list-view.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/css/pages/app-todo.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/css/plugins/extensions/drag-and-drop.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/css/plugins/extensions/toastr.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu 2-columns  navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
    <!-- <body class="horizontal-layout horizontal-menu dark-layout 2-columns  navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns" data-layout="dark-layout"> -->

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-fixed navbar-shadow navbar-brand-center">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item"><a class="navbar-brand" href="<?= base_url(); ?>C_home">
                        <strong><?= $this->config->item("nama_app"); ?></strong>
                        <!-- <h1><?= $this->config->item("nama_app"); ?></h1> -->
                    </a></li>
            </ul>
        </div>
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon feather icon-menu"></i></a></li>
                        </ul>
                        <ul class="nav navbar-nav bookmark-icons">
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="#" data-toggle="tooltip" data-placement="top" title="Chat"><i class="ficon feather icon-message-square"></i></a></li>
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="#" data-toggle="tooltip" data-placement="top" title="Email"><i class="ficon feather icon-mail"></i></a></li>
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="#" data-toggle="tooltip" data-placement="top" title="Calendar"><i class="ficon feather icon-calendar"></i></a></li>
                        </ul>
                    </div>
                    <ul class="nav navbar-nav float-right">
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon feather icon-maximize"></i></a></li>
                        <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon feather icon-search"></i></a>
                            <div class="search-input">
                                <div class="search-input-icon"><i class="feather icon-search primary"></i></div>
                                <input class="input" type="text" placeholder="Explore e-form..." tabindex="-1" data-search="template-list">
                                <div class="search-input-close"><i class="feather icon-x"></i></div>
                                <ul class="search-list search-list-main"></ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    </body>

    <div class="content-wrapper">
        <div class="content-body">
            <section id="basic-examples">
                <div class="row match-height">
                    <div class="col-12 float-center text-center">
                        <div class="card" style="height: 500px;">
                            <div class="card-content">
                                <div class="card-body">
                                    <hr class="my-5">
                                    <div class="login-logo">
                                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/PSG_logo_2022.png" align="center" width="100" alt="" /></a>
                                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/LOGO_eForm.png" align="center" width="290" alt="" /></a>
                                    </div><!-- /.login-logo -->
                                    <hr class="my-5">
                                    <div class="alert bg-gradient-info mt-1 p-1">
                                    <h1 class="white"> <b>"MAAF, FORM YANG ANDA CARI TIDAK DITEMUKAN"</b></h1> <br> <h4 class="white">Hal ini bisa dikarenakan anda belum memiliki akses ke eform tersebut atau kode form beserta versi tersebut tidak ditemukan di eform</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    
