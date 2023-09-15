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

    <!-- clockpicker -->
    <link href="<?php echo base_url('assets/clockpicker/dist/bootstrap-clockpicker.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/clockpicker/dist/bootstrap-clockpicker.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/clockpicker/dist/jquery-clockpicker.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/clockpicker/dist/jquery-clockpicker.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/clockpicker/src/standalone.css') ?>" rel="stylesheet" type="text/css" />

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
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none">
                                    <span class="user-name text-bold-600"><?= str_replace('2', '', $username); ?> </span>
                                    <span class="user-status"><?= !empty($this->session->userdata('logged_in')['akses_sambupedia']) ? $levelusernm : $jabnm; ?></span>
                                </div>
                                <span><img class="round" src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/images/portrait/small/user.jpeg" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <?php if (empty($this->session->userdata('logged_in')['akses_sambupedia'])) { ?>
                                    <a class="dropdown-item" href="<?= base_url('master/C_changepsw') ?>"><i class="feather icon-edit-1"></i> Change Password</a>
                                <?php } ?>
                                <a class="dropdown-item" href="<?= base_url('master/C_tandatangan/sign/' . $this->session->userdata('logged_in')['userid']) ?>"><i class="feather icon-check"></i> Change TandaTangan</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('C_home/logout') ?>"><i class="feather icon-power"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="horizontal-menu-wrapper">
        <div class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-dark navbar-without-dd-arrow navbar-shadow menu-border" role="navigation" data-menu="menu-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mr-auto"><a class="navbar-brand" href="<?= base_url(); ?>">
                            <!-- <div class="brand-logo"></div> -->
                            <h2 class="brand-text mb-0"><?= $this->config->item("nama_app"); ?></h2>
                        </a></li>
                    <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
                </ul>
            </div>
            <!-- Horizontal menu content-->
            <div class="navbar-container main-menu-content" data-menu="menu-container">
                <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
                    <li <?php if (isset($Titel)) {
                            if ('Home' == trim($Titel)) echo 'class="active"';
                        } ?>><a href="<?= base_url(); ?>C_home"><i class="feather icon-home"></i><span data-i18n="Dashboard">Dashboard</span></a></li>

                    <?php $icon_sementara = 'circle';
                    foreach ($menus as $menu) {
                        if (isset($menu->children)) { ?>
                            <li class="dropdown nav-item <?php if (isset($Titel)) {
                                                                if (trim(strtoupper(explode(' - ', $Titel)[0])) == trim(strtoupper($menu->menunm))) {
                                                                    echo 'active';
                                                                }
                                                            } ?>" data-menu="dropdown">
                                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="feather icon-<?= $menu->menufaicon ?>"></i><span data-i18n="Menu Level 1"><?= $menu->menunm ?></span></a>
                                <ul class="dropdown-menu">

                                    <?php foreach ($menu->children as $child) {
                                        if (isset($child->children2)) { ?>
                                            <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu">
                                                <a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown" data-i18n="Menu Level 2"><?= $child->submenunm ?></a>
                                                <ul class="dropdown-menu">

                                                    <?php foreach ($child->children2 as $child2) {
                                                        if (isset($child2->children3)) { ?>
                                                            <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown" data-i18n="Menu Level 3"><?= $child2->submenu2nm ?></a>
                                                                <ul class="dropdown-menu">

                                                                    <?php foreach ($child2->children3 as $child3) { ?>
                                                                        <li data-menu=""><a class="dropdown-item" href="<?= base_url("$child3->submenu3link") ?>" data-toggle="dropdown" data-i18n="Menu Level 4"><?= $child3->submenu3nm ?></a></li>
                                                                    <?php } ?>
                                                                </ul>
                                                            </li>

                                                        <?php } else { ?>
                                                            <li data-menu=""><a class="dropdown-item" href="<?= base_url("$child2->submenu2link") ?>" data-toggle="dropdown" data-i18n="Menu Level 3"><?= $child2->submenu2nm ?></a></li>
                                                    <?php }
                                                    } ?>
                                                </ul>
                                            </li>

                                        <?php } else { ?>
                                            <li data-menu=""><a class="dropdown-item" href="<?= base_url("$child->submenulink") ?>" data-toggle="dropdown" data-i18n="Menu Level 2"><?= $child->submenunm ?></a></li>
                                    <?php }
                                    } ?>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <li data-menu=""><a class="dropdown-item" href="<?= base_url("$menu->menulink") ?>" data-toggle="dropdown" data-i18n="Menu Level 1"><i class="feather icon-<?= $menu->menufaicon ?>"></i><span data-i18n="Menu Level 1"><?= $menu->menunm ?></span></a></li>
                    <?php }
                    } ?>
                </ul>
            </div>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">