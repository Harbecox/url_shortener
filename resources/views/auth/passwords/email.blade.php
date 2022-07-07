@extends('layouts.auth')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 col-10 mt-4">
            <div class="mb-2 bt-2 text-center">
                <img class="animation__shake" src="/logo_small.png" alt="AdminLTELogo" height="100" width="100">
            </div>
            <h1 class="text-center">Восстановление пароля</h1>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                        <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                </div>
                <button class="btn btn-success w-100">Отправить ссылку для сброса пароля</button>
            </form>
            <div class="mt-4"><hr></div>
            <div class="mt-4 text-center">
                <a href="{{ route("login") }}">Войти</a>
                |
                <a href="{{ route("register") }}">Зарегистрироваться</a>
            </div>
        </div>
    </div>
</div>
@endsection
