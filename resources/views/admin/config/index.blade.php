@extends("layouts.admin")

@section("content")
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Запрещенные слова</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route("admin.config.add_word") }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input required name="word" type="text" class="form-control">
                        <div class="input-group-append">
                            <button class="btn btn-success">Add</button>
                        </div>
                    </div>
                </form>
                <div class="d-flex">
                    @foreach($words as $word)
                        <div class="word_item">
                            <span>{{ $word->word }}</span>
                            <a href="{{ route('admin.config.del_word',$word->id) }}" class="del">x</a>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Преверять ссылку на статус 200</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route("admin.config.check_status") }}" method="post">
                    @csrf
                    <input @if($check_status) checked @endif name="check" value="true" type="checkbox" class="form-check-inline">
                    <button class="btn btn-success">Save</button>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Огроничние АПИ</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route("admin.config.api_save") }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <div class="input-group mb-3">
                                <input value="{{ $api_limit['requests'] }}" placeholder="Количество запросов" required name="requests" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="input-group mb-3">
                                <select required name="date_type" class="form-control">
                                    <option @if($api_limit['date_type'] == "minute") selected @endif value="minute">минуа</option>
                                    <option @if($api_limit['date_type'] == "hour") selected @endif value="hour">час</option>
                                    <option @if($api_limit['date_type'] == "day") selected @endif value="day">день</option>
                                    <option @if($api_limit['date_type'] == "month") selected @endif value="month">месяц</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <button class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Массовое удаление ссылок</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route("admin.config.mass_delete") }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <div class="input-group mb-3">
                                <input type="date" value="{{ \Carbon\Carbon::now()->subDays(30)->toDateString() }}" required name="after" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <button class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Feedback Email</h3>
            </div>
            <div class="card-body">
                <form action="{{ route("admin.config.email") }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <div class="input-group mb-3">
                                <input type="text" value="{{ $feedback_email }}" required name="email" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <button class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Change Admin password</h3>
            </div>
            <div class="card-body">
                <form action="{{ route("admin.config.change_pass") }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <div class="input-group mb-3">
                                <input type="text" required name="password" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="input-group mb-3">
                                <input type="text" required name="re_password" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <button class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Удаление</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Вы действительно хотите удалить информацию?</p>
                </div>
                <div class="modal-footer justify-content-end">
                    <form action="" method="post">
                        @csrf
                        @method("delete")
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        <button type="submit" href="" type="button" class="btn btn-danger delete_btn">Удалить</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section("script")
    <script>
        function showModal(url) {
            let modal = $("#delete-modal");
            modal.find("form").attr("action", url);
            modal.modal();
        }
    </script>
@endsection
