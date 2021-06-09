<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title Page-->
    <title>Панель управления</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Fontfaces CSS-->
    <link href="{{ asset('tmp/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('tmp/css/tooo.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('tmp/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('tmp/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('tmp/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('tmp/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('tmp/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('tmp/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('tmp/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('tmp/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('tmp/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('tmp/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('tmp/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('tmp/css/theme.css') }}" rel="stylesheet" media="all">

</head>

<body class="animsition">
<div class="page-wrapper">
    <!-- MENU SIDEBAR-->
    <aside class="menu-sidebar2">
        <div class="logo">
            <a href="#">
                <h2 style="color:white;padding-left: 25px;">APEC TC</h2>
            </a>
        </div>
        <div class="menu-sidebar2__content js-scrollbar1">
            <div class="account2">
                <div class="image img-cir img-120">
                    <img src="https://img2.freepng.ru/20180521/ocp/kisspng-computer-icons-user-profile-avatar-french-people-5b0365e4f1ce65.9760504415269493489905.jpg" alt="John Doe" />
                </div>
                <h4 class="name">@if(\Illuminate\Support\Facades\Auth::user()->role == 'admin') Admin @else {{ \Illuminate\Support\Facades\Auth::user()->name  }} @endif</h4>
                <a href="{{ url('/logout') }}">Выйти</a>
            </div>
            <nav class="navbar-sidebar2">
               @if(Auth::user()->role == 'admin')
                    @include('layouts.admin_menu')
               @elseif(Auth::user()->role == 'company')
                    @include('layouts.company_menu')
               @endif
            </nav>
        </div>
    </aside>
    <!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container2">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop2">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="header-wrap2">
                        <div class="logo d-block d-lg-none">
                            <a href="#">
                                <h2 style="color:white;padding-left: 25px;">APEC TC</h2>
                            </a>
                        </div>
                        <div class="header-button2">

                            <div class="header-button-item mr-0 js-sidebar-btn">
                                <i class="zmdi zmdi-menu"></i>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </header>
        <aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
            <div class="logo">
                <a href="#">
                    <h2 style="color:white;padding-left: 25px;">APEC TC</h2>
                </a>
            </div>
            <div class="menu-sidebar2__content js-scrollbar2">
                <div class="account2">
                    <div class="image img-cir img-120">
                        <img src="https://img2.freepng.ru/20180521/ocp/kisspng-computer-icons-user-profile-avatar-french-people-5b0365e4f1ce65.9760504415269493489905.jpg" alt="John Doe" />
                    </div>
                    <h4 class="name">@if(\Illuminate\Support\Facades\Auth::user()->role == 'admin') Admin @else @endif</h4>
                    <a href="{{ url('/logout') }}">Выйти</a>
                </div>
                <nav class="navbar-sidebar2">
                    @if(Auth::user()->role == 'admin')
                        @include('layouts.admin_menu')
                    @elseif(Auth::user()->role == 'company')
                        @include('layouts.company_menu')
                    @endif
                </nav>
            </div>
        </aside>
        <!-- END HEADER DESKTOP-->

        <!-- BREADCRUMB-->

        <!-- END BREADCRUMB-->

        <!-- STATISTIC-->
