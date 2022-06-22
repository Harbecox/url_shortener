@extends("layouts.dashboard")

@section("content")
    <div class="container">
        <div class="card">
            <div class="card-body">
                <a class="btn btn-outline-info mb-2" href="{{ route("dashboard.group.create") }}"><i class="fas fa-plus"></i></a>
                <div class="row d-none d-md-flex">
                    <div class="col-md-2 col-sm-12 text-bold">Название</div>
                    <div class="col-md-2 col-sm-12 text-bold">Ссылки</div>
                    <div class="col-md-2 col-sm-12 text-bold">Переходы</div>
                    <div class="col-md-2 col-sm-12 text-bold">Активность</div>
                    <div class="col-md-2 col-sm-12 text-bold">Ротация</div>
                    <div class="col-md-2 col-sm-12 text-bold"></div>
                </div>
                @foreach($groups as $group)
                    <div class="row t-row">
                        <div class="col-md-2"><a target="_blank" href="{{ route("url",$group->alias->alias) }}">{{ $group->title }}</a></div>
                        <div class="col-md-2"><div class="d-inline d-md-none">Ссылки: </div>{{ $group->urls()->count() }}</div>
                        <div class="col-md-2"><div class="d-inline d-md-none">Переходы: </div>{{ $group->alias->visits()->count() }}</div>
                        <div class="col-md-2"><div class="d-inline d-md-none">Активность: </div>@if($group->is_active) <i class="fas fa-check text-success"></i> @else <i class="fas fa-minus text-danger"></i> @endif</div>
                        <div class="col-md-2"><div class="d-inline d-md-none">Ротация: </div>@if($group->is_rotation) <i class="fas fa-check text-success"></i> @else <i class="fas fa-minus text-danger"></i> @endif</div>
                        <div class="col-md-2">
                            <div class="d-flex">
                                <a href="{{ route("dashboard.group.edit",$group->id) }}" class="btn btn-outline-primary ml-1"><i class="fas fa-pen"></i></a>
                                <a href="{{ route("dashboard.show",$group->alias->alias) }}" class="btn btn-outline-success ml-1"><i class="fas fa-chart-bar"></i></a>
                                <a onclick="showModal('{{ route("dashboard.group.destroy",$group->id) }}')" class="btn btn-outline-danger ml-1"><i class="fas fa-trash-alt"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Удаление группы</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Вы уверены, что хотите удалить группу? Все ссылки, входящие в группу не будут удалены.</p>
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

    </script>
@endsection
