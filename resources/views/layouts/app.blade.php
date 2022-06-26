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
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
<header class="bg-light">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
<div style="min-height: calc(100vh - 350px)">
    @yield("content")
</div>


@yield("script")
<script src="/plugins/jquery/jquery.min.js"></script>
<script src="/plugins/toastr/toastr.min.js"></script>
<x-alert></x-alert>
<footer class="py-5 mt-2 bg-light">
    <div class="logo text-center">
        <img style="height: 50px" src="/logo_big.png">
    </div>
    <div class="row">
        <div class="col-12 col-md-6 offset-3">
            <div class="menu d-flex justify-content-between pt-5">
                <div class="menu_item"><a href="{{ route("index") }}">Shorten URL</a></div>
                <div class="menu_item"><a href="{{ route("feedback") }}">Feedback</a></div>
                <div class="menu_item"><a href="{{ route("dashboard.api") }}">Api</a></div>
                <div class="menu_item"><a href="{{ route("policy") }}">Policy</a></div>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
