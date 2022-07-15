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
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<header class="bg-light">
    <div class="container">
        <nav class="navbar navbar-expand-md navbar-light bg-light">
            <a class="navbar-brand" href="/">
                <img alt="urlbit.ru" src="{{ asset('logo_big.png') }}" style="height: 40px">
            </a>
            <button class="navbar-toggler" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <div class="d-flex justify-content-end w-100">
                    <ul class="navbar-nav flex-row flex-md-column">
                        @auth()
                            <li class="nav-item mx-3">
                                <a class="nav-link" href="{{ \Illuminate\Support\Facades\Auth::user()->role == "admin" ? route("admin.url") : route("dashboard") }}">{{ \Illuminate\Support\Facades\Auth::user()->name }}</a>
                            </li>
                        @else
                            <li class="nav-item my-2 my-mb-0 mx-3 mx-md-0">
                                <a class="nav-link btn btn-success text-white px-2" href="{{ route("login") }}">Авторизоваться</a>
                            </li>
                            <li class="nav-item my-2 my-mb-0">
                                <a class="nav-link btn btn-primary text-white px-2" href="{{ route("register") }}">Зарегистрироваться</a>
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
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script>
    $(".navbar-toggler").click(function (){
        $(".navbar-collapse").toggleClass("show");
    })
</script>
<x-alert></x-alert>
<footer class="py-5 mt-2 bg-light">
    <div class="logo text-center">
        <img style="height: 50px" src="{{ asset('logo_big.png') }}">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <div class="menu d-flex justify-content-between pt-5 flex-md-row flex-column align-items-center">
                    <div class="menu_item py-md-0 py-1"><a href="{{ route("index") }}">Shorten URL</a></div>
                    <div class="menu_item py-md-0 py-1"><a href="{{ route("feedback") }}">Feedback</a></div>
                    <div class="menu_item py-md-0 py-1"><a href="{{ route("dashboard.api") }}">Api</a></div>
                    <div class="menu_item py-md-0 py-1"><a href="{{ route("policy") }}">Policy</a></div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="modal fade" id="share-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Поделитесь</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex align-items-center flex-column">
                <div class="input-group mb-3">
                    <input readonly type="text" class="form-control urlInput">
                    <div class="input-group-append">
                        <button class="urlCopyButton input-group-text"><i class="fas fa-copy"></i></button>
                    </div>
                </div>
                <div class="d-flex mb-4">
                    <span data-sharer="vk" class="share-button" style="background-color: #07f"><i class="fab fa-vk"></i></span>
                    <span data-sharer="facebook" class="share-button" style="background-color: #3b5998"><i class="fab fa-facebook-f"></i></span>
                    <span data-sharer="whatsapp" class="share-button" style="background-color: #65bc54"><i class="fab fa-whatsapp"></i></span>
                    <span data-sharer="telegram" class="share-button" style="background-color: #64a9dc"><i class="fab fa-telegram-plane"></i></span>
                    <span data-sharer="skype" class="share-button" style="background-color: #00aff0"><i class="fab fa-skype"></i></span>
                    <span data-sharer="twitter" class="share-button" style="background-color: #00aced"><i class="fab fa-twitter"></i></span>
                    <span data-sharer="okru" class="share-button" style="background-color: #eb722e"><i class="fab fa-odnoklassniki"></i></span>
                </div>
                <div id="qrcode" class="mb-4"></div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
</body>
</html>
