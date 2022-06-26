@extends("layouts.app")

@section("content")
    <div class="bg-primary">
        <div class="container">
            <form method="post" action="{{ route("create") }}" class="d-flex justify-content-between px-2 py-4">
                @csrf
                <input required name="url" class="form-control mx-2">
                <button class="btn btn-success mx-2">Сократить</button>
            </form>
        </div>
    </div>
    @if(count($urls) > 0)
        <div class="container">
            <div class="card my-4">
                <div class="card-header bg-light">
                    <h3 class="card-title">Ваши ссылки</h3>
                </div>
                <div class="card-body">
                    @foreach($urls as $url)
                        <div class="border-bottom py-3">
                            <div class="row">
                                <div class="col-md-6">
                                    {{ $url['url'] }}
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route("url",$url['alias']) }}" target="_blank">{{ route("url",$url['alias']) }}</a>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-flex justify-content-end">
                                        <button  data-url="{{ route("url",$url['alias']) }}" class="btn btn-info mx-2 urlCopyButton">Копировать</button>
                                        <button onclick="showShareModal('{{ route("url",$url['alias']) }}')" class="btn btn-warning">Поделиться</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <div class="container my-3">
        <div class="row">
            <div class="col-md-10 col-12 offset-md-1">
                <h1 class="text-center text-bold">Средство для сокращения ссылок, поддерживающее ваш бренд</h1>
                <p class="mb-4 text-center">Ваш бренд был создан не для того, чтобы его скрывали. Выделите его с помощью фирменных ссылок, которые могут привлечь больше посетителей на сайт.</p>
            </div>
            <div class="col-md-4 col-12">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column align-items-center justify-content-start">
                        <div class="d-flex justify-content-center align-items-center bg-light p-3 mb-2" style="border-radius: 50%">
                            <i class="fa fa-link" aria-hidden="true"></i>
                        </div>
                        <h4 class="text-bold">Сокращение URL и ссылок</h4>
                        <p class="text-center">Бесплатный настраиваемый- Сокращение URL и ссылок-с множеством функций, который дает вам лучшее качества для сокращения ссылок. Сокращенные URL-адреса никогда не истекают. Мы не показываем рекламуво время прямого перенаправления на исходный URL.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column align-items-center justify-content-start">
                        <div class="d-flex justify-content-center align-items-center bg-light p-3 mb-2" style="border-radius: 50%">
                            <i class="fa fa-address-book" aria-hidden="true"></i>
                        </div>
                        <h4 class="text-bold">Link Analytics Platform</h4>
                        <p class="text-center">Отслеживать каждую сокращенную ссылку в реальном времени и измерять ее производительность, чтобы понять ее. Подробная аналитика предоставляет информацию о кликах, кликах социальных сетей, реферрерах страниц, устройствах, браузерах, системах, географическом местоположении.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column align-items-center justify-content-start">
                        <div class="d-flex justify-content-center align-items-center bg-light p-3 mb-2" style="border-radius: 50%">
                            <i class="fa fa-code" aria-hidden="true"></i>
                        </div>
                        <h4 class="text-bold">API</h4>
                        <p class="text-center">Отслеживать каждую сокращенную ссылку в реальном времени и измерять ее производительность, чтобы понять ее. Подробная аналитика предоставляет информацию о кликах, кликах социальных сетей, реферерерах страниц, устройствах, браузерах, системах, географическом местоположении.</p>
                    </div>
                </div>
            </div>
        </div>
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
    <script src="/plugins/jquery/jquery.min.js"></script>
    <script src="/plugins/toastr/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sharer.js@latest/sharer.min.js"></script>
    <script src="/js/qrcode.min.js"></script>
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    @error("url")
        <script>toastr.warning("{{ $message }}")</script>
    @enderror
    <script>
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
        document.querySelectorAll(".urlCopyButton").forEach(function (btn){
            btn.addEventListener("click",function (){
                let copyText = this.dataset.url;
                navigator.clipboard.writeText(copyText);
                toastr.success('Ссылка скопирована  в буфер обмена')
            })
        })
    </script>
@endsection
