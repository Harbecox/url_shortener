@extends("layouts.app")

@section("content")
    <div class="bg-primary">
        <div class="container">
            <div class="text-center py-5">
                <h1 class="text-bold">{{ $group->title }}</h1>
                <h4 class="text-bold">{{ $group->description }}</h4>
            </div>
        </div>
    </div>
    <div class="py-5">
        @if(count($group['urls']) > 0)
            <div class="container">
                <div class="card my-4">
                    <div class="card-header bg-light">
                        <h3 class="card-title">Ваши ссылки</h3>
                    </div>
                    <div class="card-body">
                        @foreach($group['urls'] as $url)
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
