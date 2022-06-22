@extends("layouts.dashboard")

@section("content")
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ $action }}" method="POST">
                    @csrf
                    @method($method)
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="input_title">Длинная ссылка<a href="#" class="ml-1" data-toggle="tooltip"
                                                                    title="Введенная ссылка будет сокращена до максимально короткого URL адреса"><i
                                            class="fas fa-question-circle"></i></a></label>
                                <input @if($method == "put")
                                       disabled
                                       @else
                                       required
                                       @endif  name="url" value="{{ $url->url ?? old("url") ?? "" }}" type="text" class="form-control @error('url') is-invalid @enderror" id="input_title"
                                       placeholder="Введите длинную ссылку">
                                @error('url')
                                    <div class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="input_alias">Алиас<a href="#" class="ml-1" data-toggle="tooltip"
                                                                 title="Алиас ссылки для группы. Например, {{ url('/') }}/new_group"><i
                                            class="fas fa-question-circle"></i></a></label>
                                <div class="d-flex align-items-center">{{ url('/') }}/<input name="alias"
                                                                                             value="{{ $url->alias ?? old("alias") }}"
                                                                                             type="text"
                                                                                             class="form-control @error('alias') is-invalid @enderror"
                                                                                             @if($method == "put")
                                                                                                 disabled
                                                                                             @endif
                                                                                             id="input_alias"
                                                                                             placeholder="Введите название группы">
                                    @error('alias')
                                        <div class="error invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="input_alias">Группа <a href="#" class="ml-1" data-toggle="tooltip"
                                                                 title="Группируйте ссылки, для того, чтобы: смотреть статистику по всем ссылкам в группе, управлять всеми ссылками в группе, делиться всемы ссылками из группы и другие функции."><i
                                            class="fas fa-question-circle"></i></a></label>
                                <select name="group_id" class="form-control">
                                    <option value="0" class="@error('group_id') is-invalid @enderror">Без группы</option>
                                    @foreach($groups as $group)
                                        <option @if($url->group_id == $group->id) selected @endif value="{{ $group->id }}">{{ $group->title }}</option>
                                    @endforeach
                                </select>
                                @error('group_id')
                                    <div class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                    </div>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
