@extends("layouts.admin")

@section("content")
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route("admin.url") }}" method="get" class="container" id="url_filter">
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <div class="form-group w-100 m-0 mb-2">
                                <select name="user_id" class="form-control select2">
                                    <option value="-1" @if($user_id == -1) selected @endif>Все</option>
                                    <option value="0" @if($user_id == 0) selected @endif>Без регистрации</option>
                                    @foreach($users as $user)
                                        <option @if($user->id == $user_id) selected @endif value="{{ $user->id }}">{{ $user->name }} - {{ $user->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group w-100 m-0 mb-2">
                                <input type="text" placeholder="url" value="{{ $url ?? null }}" name="url" class="form-control">
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
                        <div class="col-md-3 col-12">
                            <label for="sort_by_visits">По количеству визитов</label>
                            <input class="form-check-inline" @if($sort_by_visits) checked @endif id="sort_by_visits" type="checkbox" name="sort_by_visits">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card w-100">
            <div class="card-header w-100 d-flex justify-content-between">
                <div class="w-100"><h3 class="card-title">Urls</h3></div>
                <div>
                    <button onclick="showMassDeleteModal()" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline"
                                   aria-describedby="example2_info">
                                <thead>
                                <tr>
                                    <th><input type="checkbox" class="all_check"></th>
                                    <th>#ID</th>
                                    <th>User</th>
                                    <th>Url</th>
                                    <th>Alias</th>
                                    <th>Visits</th>
                                    <th>Created at</th>
                                    <th style="text-align: right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($urls as $url)
                                    <tr>
                                        <td><input type="checkbox" class="del_check" value="{{ $url->alias }}" name="del_check[]"></td>
                                        <td>{{ $url->id }}</td>
                                        <td>
                                            @if($url->user)
                                                <a href="#" onclick="fbu({{ $url->user->id }})">{{ $url->user->name }}</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td style="max-width: 350px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;"><a target="_blank" href="{{ $url->url }}">{{ $url->url }}</a></td>
                                        <td><a target="_blank" href="{{ route("url",$url->alias) }}" >{{ route("url",$url->alias) }}</a></td>
                                        <td><a href="{{ route("admin.url.show",$url->alias) }}">{{ $url->visits }}</a></td>
                                        <td>{{ $url->created_at }}</td>
                                        <td>
                                            <div class="d-flex justify-content-end">
                                                <a data-toggle="tooltip" title="Копировать" data-url="{{ route("url",$url->alias) }}" class="btn btn-outline-warning ml-1 urlCopyButton"><i class="fas fa-copy"></i></a>
                                                <a data-toggle="tooltip" title="Статистика" href="{{ route("admin.url.show",$url->alias) }}" class="btn btn-outline-success ml-1"><i class="fas fa-chart-bar"></i></a>
                                                <a data-toggle="tooltip" title="Пользователь" href="{{ route("admin.user.show",$user->id) }}" class="btn btn-outline-success ml-1"><i class="fas fa-user"></i></a>
                                                <a data-toggle="tooltip" title="Удалить" onclick="showModal('{{ route("dashboard.url.destroy",$url['alias']) }}')" class="btn btn-outline-danger ml-1"><i class="fas fa-trash-alt"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th><input type="checkbox" class="all_check"></th>
                                    <th>#ID</th>
                                    <th>User</th>
                                    <th>Url</th>
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
    <div class="modal fade" id="mass-delete-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Удаление ссылок</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Вы действительно хотите удалить ссылки?</p>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button onclick="massDelete()" type="button" class="btn btn-danger delete_btn">Удалить</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <form method="POST" id="from_mass_delete" action="{{ route("admin.url.mass_delete") }}">
        @csrf
    </form>
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
        document.querySelectorAll(".all_check").forEach(function (e){
            e.addEventListener("change",function (){
                let checked = this.checked;
                document.querySelectorAll(".del_check").forEach(function (e){
                    e.checked = checked;
                })
            });
        })
        function showMassDeleteModal(){
            if(document.querySelectorAll(".del_check:checked").length === 0){
                toastr.error("Не выброно не одной ссылки для массого удоления");
            }else{
                let modal = $("#mass-delete-modal");
                modal.modal();
            }
        }
        function massDelete(){
            let form = document.getElementById("from_mass_delete");
            document.querySelectorAll(".del_check").forEach(function (e){
                if(e.checked){
                    form.appendChild(e.cloneNode(true));
                }
            })
            form.submit();
        }
    </script>
@endsection
