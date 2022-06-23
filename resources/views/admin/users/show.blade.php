@extends("layouts.admin")

@section("content")
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="card-title d-flex justify-content-between w-100">
                        <div>#{{ $user->id }}</div>
                        <div class="d-flex">
                            @if($user->blocked)
                                <a href="{{ route("admin.user.unblock",$user->id) }}" class="btn btn-success mx-2">Разблокировать</a>
                            @else
                                <a href="{{ route("admin.user.block",$user->id) }}" class="btn btn-danger mx-2">Заблокировать</a>
                            @endif
                            <form action="{{ route("admin.user.delete",$user->id) }}" method="post">
                                @csrf
                                @method("delete")
                                <button type="submit" href="" type="button" class="mx-2 btn btn-danger delete_btn">Удалить</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul>
                        <li>Name:{{ $user->name }}</li>
                        <li>Email:{{ $user->email }}</li>
                        <li>Register at:{{ $user->created_at }}</li>
                    </ul>
                </div>
            </div>
            <!-- Small boxes (Stat box) -->
            <div class="row">
                @if($is_single)
                    @isset($url)
                        <div class="col-md-6 col-12">
                            <div class="input-group mb-3">
                                <input readonly type="text" class="form-control urlInput" value="{{ $url['url'] }}">
                                <div class="input-group-append">
                                    <button data-url="{{ $url['url'] }}" class="urlCopyButton input-group-text"><i class="fas fa-copy"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="input-group mb-3">
                                <input readonly type="text" class="form-control urlInput" value="{{ route("url",$url['alias']) }}">
                                <div class="input-group-append">
                                    <button data-url="{{ route("url",$url['alias']) }}" class="urlCopyButton input-group-text"><i class="fas fa-copy"></i></button>
                                </div>
                            </div>
                        </div>
                    @endisset
                @else
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $urls_count }}</h3>

                                <p>Количество ссылок</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-link"></i>
                            </div>
                        </div>
                    </div>
            @endif
            <!-- ./col -->
                <div class="@if($is_single) col-lg-4 col-6 @else col-lg-3 col-6 @endif">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $visits_today }}</h3>
                            <p>Переходы сегодня</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="@if($is_single) col-lg-4 col-6 @else col-lg-3 col-6 @endif">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $visits_month }}</h3>
                            <p>Переходы за месяц</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="@if($is_single) col-lg-4 col-6 @else col-lg-3 col-6 @endif">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $visits_count }}</h3>
                            <p>Всего переходов</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-bullseye"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-6">
                    <!-- Map card -->
                    <div class="card">
                        <div class="card-header border-0 bg-gradient-primary">
                            <h3 class="card-title">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                Страны
                            </h3>
                        </div>
                        <div class="card-body">
                            <div id="world-map" style="height: 250px; width: 100%;"></div>
                        </div>
                    </div>
                    <!-- /.card -->
                </section>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-gradient-primary">
                            <h3 class="card-title">Устройства</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="chart_devises"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-gradient-primary">
                            <h3 class="card-title">OS</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="chart_os"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-gradient-primary">
                            <h3 class="card-title">Браузеры</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="chart_browser"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-gradient-primary">
                            <h3 class="card-title">Источник</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="chart_referer"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section("script")
    <script src="/plugins/chart.js/Chart.min.js"></script>
    <script src="/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <script>
        let countries = @json($countries);
        setTimeout(function () {

            let counts = [];
            for (let code in countries) {
                if (parseInt(countries[code].count)) {
                    counts.push(parseInt(countries[code].count));
                }
            }
            let min = Math.min.apply(Math, counts);
            let max = Math.max.apply(Math, counts);
            console.log(min,max);
            for (let code in countries) {
                let count = countries[code].count;
                let k = 100 / (max - min);
                let color = 100 - parseInt((count - min) * k);
                if(!count){
                    color = "ee";
                }else{
                    color = color.toString(16);
                }
                //console.log(count," - ",color);
                color = "#" + color + color + color;
                let elem = document.getElementById("jqvmap1_" + code);
                if(elem){
                    elem.setAttribute("fill", color);
                }
            }
        }, 1000);

        let colors = ['#39cccc', '#605ca8', '#6610f2', '#3c8dbc', '#3d9970', '#001f3f', '#e83e8c', '#d81b60', '#ff851b', '#01ff70']

        let data_devises = {labels: [], datasets: [{data: [], backgroundColor: []}]}
        let data_os = {labels: [], datasets: [{data: [], backgroundColor: []}]}
        let data_referer = {labels: [], datasets: [{data: [], backgroundColor: []}]}
        let data_browser = {labels: [], datasets: [{data: [], backgroundColor: []}]}

        let i = 0;
        @foreach($devices as $device => $count)
        data_devises.labels.push("{{ $device }}");
        data_devises.datasets[0].data.push({{ $count }});
        data_devises.datasets[0].backgroundColor.push(colors[i]);
        i++;
        @endforeach

            i = 0;
        @foreach($os as $os => $count)
        data_os.labels.push("{{ $os }}");
        data_os.datasets[0].data.push({{ $count }});
        data_os.datasets[0].backgroundColor.push(colors[i]);
        i++;
        @endforeach

            i = 0;
        @foreach($browser as $br => $count)
        data_browser.labels.push("{{ $br }}");
        data_browser.datasets[0].data.push({{ $count }});
        data_browser.datasets[0].backgroundColor.push(colors[i]);
        i++;
        @endforeach

            i = 0;
        @foreach($referer as $rf => $count)
        data_referer.labels.push("{{ $rf }}");
        data_referer.datasets[0].data.push({{ $count }});
        data_referer.datasets[0].backgroundColor.push(colors[i]);
        i++;
        @endforeach

        drawPie("#chart_devises", data_devises);
        drawPie("#chart_os", data_os);
        drawPie("#chart_browser", data_browser);
        drawPie("#chart_referer", data_referer);


        function drawPie(elem, data) {
            Chart.defaults.global.legend.position = "left";
            var pieChartCanvas = $(elem).get(0).getContext('2d')
            var pieData = data;
            var pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })
        }

    </script>
    <script src="/plugins/jqvmap/maps/jquery.vmap.world.js"></script>
@endsection
