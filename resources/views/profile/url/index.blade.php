@extends("layouts.dashboard")

@section("content")
    <div class="container pb-4">
        <div class="card">
            <div class="card-body">
                <form action="#" method="get" class="container">
                    <div class="row">
                        <div class="col-md-2 col-12">
                            <div class="form-group w-100 m-0 mb-2">
                                <select name="group_id" class="form-control">
                                    <option @if(-1 == $group_id) selected @endif value="-1">Все группы</option>
                                    <option @if(0 == $group_id) selected @endif value="0">Без группы</option>
                                    @foreach($groups as $group)
                                        <option @if($group->id == $group_id) selected @endif value="{{ $group->id }}">{{ $group->title }}</option>
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
                            <div class="form-group w-100 m-0 mb-2">
                                <select name="order_by" class="form-control">
                                    <option @if($order_by == "created_at") selected @endif value="created_at">По дате создания</option>
                                    <option @if($order_by == "visits") selected @endif value="visits">По кликам</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="form-group w-100 m-0 mb-2">
                                <select name="sort" class="form-control">
                                    <option @if($sort == "ASC") selected @endif value="ASC">По возрастанию</option>
                                    <option @if($sort == "DESC") selected @endif value="DESC">По убыванию</option>
                                </select>
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
            <div class="card-body">
                <div class="row mb-2 d-md-flex d-none">
                    <div class="col-md-4 col-sm-12 text-bold">URL</div>
                    <div class="col-md-2 col-sm-12 text-bold">Переходы</div>
                    <div class="col-md-2 col-sm-12 text-bold d-md-none d-lg-block">Дата</div>
                    <div class="col-md-1 col-sm-12 text-bold">Группа</div>
                </div>
                @foreach($urls as $url)
                    <div class="row t-row">
                        <div class="col-md-4">
                            <a target="_blank" href="{{ route("url",$url['alias']) }}">{{ route("url",$url['alias']) }}</a>
                            <div class="text-sm text-ellipsis">{{ $url['url'] }}</div>
                        </div>
                        <div class="col-md-2"><div class="d-inline d-md-none">Переходы: </div> {{ $url['visit'] }}</div>
                        <div class="col-md-2"><div class="d-inline d-md-none">Дата: </div> {{ \Carbon\Carbon::make($url['created_at'])->format("Y-m-d") }}</div>
                        <div class="col-md-1 d-none d-md-block">@if($url['group_title']) {{ $url['group_title'] }} @else <i class="fas fa-minus text-danger"></i> @endif</div>
                        <div class="col-md-3">
                            <div class="d-flex">
                                <a data-toggle="tooltip" title="Копировать" data-url="{{ route("url",$url['alias']) }}" class="btn btn-outline-warning ml-1 urlCopyButton"><i class="fas fa-copy"></i></a>
                                <a data-toggle="tooltip" title="Статистика" href="{{ route("dashboard.show",$url['alias']) }}" class="btn btn-outline-success ml-1"><i class="fas fa-chart-bar"></i></a>
                                <a data-toggle="tooltip" title="Поделиться" onclick="showShareModal('{{ route("url",$url['alias']) }}')" class="btn btn-outline-dark ml-1"><i class="fas fa-share"></i></a>
                                <a data-toggle="tooltip" title="Редактировать" href="{{ route("dashboard.url.edit",$url['alias']) }}" class="btn btn-outline-primary ml-1"><i class="fas fa-pen"></i></a>
                                <a data-toggle="tooltip" title="Удалить" onclick="showModal('{{ route("dashboard.url.destroy",$url['alias']) }}')" class="btn btn-outline-danger ml-1"><i class="fas fa-trash-alt"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="card-footer">
                {{ $urls->links() }}
            </div>
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

@endsection

@section("script")
    <script>
        function showModal(url){
            let modal = $("#delete-modal");
            modal.find("form").attr("action",url);
            modal.modal();
        }
        function showShareModal(url){
            let modal = $("#share-modal");
            document.getElementById("share-modal").querySelector(".urlCopyButton").dataset.url = url;
            document.getElementById("share-modal").querySelector(".urlInput").value = url;
            let qrCodeElem = document.getElementById("qrcode")
            qrCodeElem.innerHTML = "";
            new QRCode(qrCodeElem, url);
            modal.find(".share-button").each(function (i,e){
                $(e).attr("data-url",url);
            })
            modal.modal();
        }
    </script>
@endsection
