@extends("layouts.dashboard")

@section("content")
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ $action }}" method="POST">
                    @csrf
                    @method($method)
                    <div class="row">
                        <div class="col-md-8 col-12">
                            <div class="form-group">
                                <label for="input_title">Название<a href="#" class="ml-1" data-toggle="tooltip"
                                                                    title="Название группы"><i
                                            class="fas fa-question-circle"></i></a></label>
                                <input required name="title" value="{{ $group->title ?? old("title") ?? "" }}" type="text" class="form-control" id="input_title"
                                       placeholder="Введите название группы">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="input_alias">Алиас<a href="#" class="ml-1" data-toggle="tooltip"
                                                                 title="Алиас ссылки для группы. Например, {{ url('/') }}/new_group"><i
                                            class="fas fa-question-circle"></i></a></label>
                                <div class="d-flex align-items-center">{{ url('/') }}/<input required name="alias"
                                                                                             value="{{ $group->alias->alias ?? old("alias") ?? $alias }}"
                                                                                             type="text"
                                                                                             class="form-control"
                                                                                             id="input_alias"
                                                                                             placeholder="Введите название группы">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="input_description">Описание<a href="#" class="ml-1" data-toggle="tooltip"
                                                                          title="Описание группы"><i
                                            class="fas fa-question-circle"></i></a></label>
                                <input value="{{ $group->description ?? old("description") ?? "" }}" name="description" class="form-control" id="input_description"
                                       placeholder="Описание группы">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check mb-2">
                                <input @if($group->is_active || Route::is('dashboard.group.create')) checked @endif name="is_active" type="checkbox" class="form-check-input"
                                       id="check_is_active">
                                <label class="form-check-label" for="check_is_active">Активна</label>
                                <a href="#" class="ml-1" data-toggle="tooltip"
                                   title="Доступна ли эта группа ссылок для общего просмотра."><i
                                        class="fas fa-question-circle"></i></a>
                            </div>
                            <div class="form-check mb-2">
                                <input @if($group->is_rotation) checked @endif name="is_rotation" type="checkbox" class="form-check-input"
                                       id="check_is_rotation">
                                <label class="form-check-label" for="check_is_rotation">Ротация</label>
                                <a href="#" class="ml-1" data-toggle="tooltip"
                                   title="Если этот параметр установлен, указанный выше URL-адрес будет перенаправлять на случайную ссылку из группы, вместо того, чтобы отображать все ссылки, принадлежащие группе."><i
                                        class="fas fa-question-circle"></i></a>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
