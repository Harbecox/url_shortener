<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UrlBit</title>

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
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
<header class="my-2">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <a class="navbar-brand" href="/">
                <img src="/logo_big.png" style="height: 40px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="d-flex">
                    <ul class="navbar-nav">
                        @auth()
                            <li class="nav-item mx-3">
                                <a class="nav-link" href="{{ route("dashboard") }}">{{ \Illuminate\Support\Facades\Auth::user()->name }}</a>
                            </li>
                        @else
                            <li class="nav-item mx-3">
                                <a class="nav-link btn btn-success text-white" href="{{ route("login") }}">Авторизоваться</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-primary text-white" href="{{ route("register") }}">Зарегистрироваться</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
@yield("content")


@yield("script")

<x-alert></x-alert>
</body>
</html>
