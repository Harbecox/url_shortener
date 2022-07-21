@extends("layouts.app")

@section("content")
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 col-12 offset-md-3">
                <h1 class="text-center">Поддержка, обратная связь</h1>
                <h3 class="text-center">Есть вопрос? Мы будем рады помочь Вам.</h3>
                <form method="POST" class="py-5">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="name">Ваше имя *</label>
                                <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="email">Эл.адрес *</label>
                                <input type="text" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email" id="email" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="subject">Тема сообщения *</label>
                                <input type="text" value="{{ old('subject') }}" class="form-control @error('subject') is-invalid @enderror" name="subject" id="subject" required>
                                @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="msg">Сообщение *</label>
                                <textarea type="text" class="form-control @error('msg') is-invalid @enderror" name="msg" id="msg" required>{{ old('msg') }}</textarea>
                                @error('msg')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-success">Послать</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
