@extends("layouts.admin")

@section("content")
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Users</h3>
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Registred at</th>
                                    <th>Urls</th>
                                    <th>Visits</th>
                                    <th style="text-align: right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->urls['url_count'] }}</td>
                                        <td>{{ $user->urls['visits_count'] }}</td>
                                        <td>
                                            <div class="d-flex justify-content-end">
                                                @if(!$user->blocked)
                                                    <a data-toggle="tooltip" title="Заблокировать" href="{{ route("admin.user.block",$user->id) }}" class="btn btn-outline-warning ml-1"><i class="fas fa-lock"></i></a>
                                                @else
                                                    <a data-toggle="tooltip" title="Разблокировать" href="{{ route("admin.user.unblock",$user->id) }}" class="btn btn-outline-info ml-1"><i class="fas fa-unlock"></i></a>
                                                @endif
                                                <a data-toggle="tooltip" title="Пользователь" href="{{ route("admin.user.show",$user->id) }}" class="btn btn-outline-success ml-1"><i class="fas fa-user"></i></a>
                                                <a data-toggle="tooltip" title="Удалить" onclick="showModal('{{ route("admin.user.delete",$user->id) }}')" class="btn btn-outline-danger ml-1"><i class="fas fa-trash-alt"></i></a>
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
                            {{ $users->links() }}
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
                    <h4 class="modal-title">Удаление пользователя</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Вы действительно хотите Удалить пользователя и все его ссылки?</p>
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
