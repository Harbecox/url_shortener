@extends("layouts.admin")

@section("content")
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="#" method="get" class="container" id="url_filter">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group w-100 m-0 mb-2">
                                <select name="user_id" class="form-control select2">
                                    <option value="0" @if($user_id == 0) selected @endif>All</option>
                                    @foreach($users as $user)
                                        <option @if($user->id == $user_id) selected @endif value="{{ $user->id }}">{{ $user->name }} - {{ $user->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="form-group w-100 m-0 mb-2">
                                <input type="date" value="{{ $date_start ?? null }}" name="date_start" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="form-group w-100 m-0 mb-2">
                                <input type="date" value="{{ $date_end ?? null }}" name="date_end" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <button class="btn btn-info w-100 mb-2">OK</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Urls</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-6"></div>
                        <div class="col-sm-12 col-md-6"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline"
                                   aria-describedby="example2_info">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>User</th>
                                    <th>Short url</th>
                                    <th>Group</th>
                                    <th>Visits</th>
                                    <th>Created at</th>
                                    <th style="text-align: right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($urls as $url)
                                    <tr>
                                        <td>{{ $url->id }}</td>
                                        <td><a href="#" onclick="fbu({{ $url->user->id }})">{{ $url->user->name }}</a></td>
                                        <td><a target="_blank" href="{{ route("url",$url->alias) }}">{{ route("url",$url->alias) }}</a></td>
                                        <td>{{ $url->group->title ?? " - " }}</td>
                                        <td><a href="{{ route("admin.url.show",$url->alias) }}">{{ $url->visits }}</a></td>
                                        <td>{{ $url->created_at }}</td>
                                        <td>
                                            <div class="d-flex justify-content-end">
                                                <a data-toggle="tooltip" title="Копировать" data-url="{{ route("url",$url->alias) }}" class="btn btn-outline-warning ml-1 urlCopyButton"><i class="fas fa-copy"></i></a>
                                                <a data-toggle="tooltip" title="Статистика" href="{{ route("admin.url.show",$url->alias) }}" class="btn btn-outline-success ml-1"><i class="fas fa-chart-bar"></i></a>
                                                <a data-toggle="tooltip" title="Пользователь" href="{{ $url->user->id }}" class="btn btn-outline-success ml-1"><i class="fas fa-user"></i></a>
                                                <a data-toggle="tooltip" title="Удалить" onclick="showModal('{{ route("dashboard.url.destroy",$url['alias']) }}')" class="btn btn-outline-danger ml-1"><i class="fas fa-trash-alt"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>User</th>
                                    <th>Alias</th>
                                    <th>Group</th>
                                    <th>Visits</th>
                                    <th>Created at</th>
                                    <th style="text-align: right">Actions</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            {{ $urls->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>

    <div class="modal fade" id="delete-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Удаление ссылки</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Вы действительно хотите удалить ссылку?</p>
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

    <div class="modal fade" id="delete-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Удаление ссылки</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Вы действительно хотите удалить ссылку?</p>
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
        function showModal(url){
            let modal = $("#delete-modal");
            modal.find("form").attr("action",url);
            modal.modal();
        }
        $('.select2').select2({
            theme: 'bootstrap4',
        })
        function fbu(id){
            let form = $("#url_filter");
            form.find("select[name=user_id]").find("option[value=" + id + "]").attr("selected","selected");
            form.submit();
        }
    </script>
@endsection
