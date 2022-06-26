<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ request()->get("meta")['title'] ?? "UrlBit" }}</title>
    <meta name="description" content="{{ request()->get("meta")['title'] ?? 'Shorten the long link absolutely free. Using the link shortening service, you can conveniently shorten a long url' }}">


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="/plugins/toastr/toastr.css">
    <link rel="stylesheet" href="/css/lib.css">
    <link rel="stylesheet" href="/css/app.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="/logo_small.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false">
                    {{ \Illuminate\Support\Facades\Auth::user()->name }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                    <li><a class="dropdown-item" href="{{ route("dashboard") }}">Dashboard</a></li>
                    <li>
                        <a href="#" onclick="document.getElementById('logout_form').submit()" class="dropdown-item">
                            Выйти
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route("dashboard") }}" style="min-height: 57px;" class="brand-link bg-white lb">
            <img src="/logo_big.png"class="brand-image"
                 style="opacity: .8">
            <span class="brand-text font-weight-light d-block"></span>
        </a>
        <a href="{{ route("dashboard") }}" style="min-height: 57px;" class="brand-link bg-white ls">
            <img src="/logo_small.png"class="brand-image"
                 style="opacity: .8">
            <span class="brand-text font-weight-light d-block"></span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route("dashboard") }}" class="nav-link @if(Route::is('dashboard')) active @endif">
                            <i class="fas fa-chart-line pr-1"></i>
                            <p>Статистика</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("dashboard.url.create") }}" class="nav-link @if(Route::is('dashboard.url.create')) active @endif">
                            <i class="fas fa-plus-circle pr-1"></i>
                            <p>Сократить</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("dashboard.url.index") }}" class="nav-link @if(Route::is('dashboard.url*') && !Route::is('dashboard.url.create')) active @endif">
                            <i class="fas fa-link pr-1"></i>
                            <p>Мои ссылки</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("dashboard.group.index") }}" class="nav-link @if(Route::is('dashboard.group*')) active @endif">
                            <i class="fas fa-folder pr-1"></i>
                            <p>Группы</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("dashboard.api") }}" class="nav-link @if(Route::is('dashboard.api')) active @endif">
                            <i class="fas fa-database pr-1"></i>
                            <p>API</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" onclick="document.getElementById('logout_form').submit()" class="nav-link">
                            <i class="fas fa-sign-out-alt pr-1"></i>
                            <p>Выйти</p>
                        </a>
                        <form method="post" id="logout_form" action="{{ route("logout") }}">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper pt-3">
        <!-- Content Header (Page header) -->
{{--        <div class="content-header">--}}
{{--            <div class="container-fluid">--}}
{{--                <div class="row mb-2">--}}
{{--                    <div class="col-sm-6">--}}
{{--                        <h1 class="m-0">Dashboard</h1>--}}
{{--                    </div><!-- /.col -->--}}
{{--                    <div class="col-sm-6">--}}
{{--                        <ol class="breadcrumb float-sm-right">--}}
{{--                            <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
{{--                            <li class="breadcrumb-item active">Dashboard v1</li>--}}
{{--                        </ol>--}}
{{--                    </div><!-- /.col -->--}}
{{--                </div><!-- /.row -->--}}
{{--            </div><!-- /.container-fluid -->--}}
{{--        </div>--}}
        <!-- /.content-header -->

        <!-- Main content -->
    @yield("content")
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2022 <a href="{{ route("dashboard") }}">Urlbit.ru</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">

        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
@yield("script")
<script>
    document.querySelectorAll(".urlCopyButton").forEach(function (btn){
        btn.addEventListener("click",function (){
            let copyText = this.dataset.url;
            navigator.clipboard.writeText(copyText);
            toastr.success('Ссылка скопирована  в буфер обмена')
        })
    })
</script>
<!-- jQuery Knob Chart -->
<script src="/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/plugins/moment/moment.min.js"></script>
<script src="/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/dist/js/pages/dashboard.js"></script>
<script src="/plugins/toastr/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sharer.js@latest/sharer.min.js"></script>
<script src="/js/qrcode.min.js"></script>
<x-alert></x-alert>
</body>
</html>
