@extends('layouts.backend.main') @section('title') Dashboard @endsection
@section('breadcrumb') @parent
<li class="breadcrumb-item active">Dashboard</li>
@endsection @section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $statistik["produk"] }}</h3>

                <p>Produk</p>
            </div>
            <div class="icon">
                <i class="fa fa-cube"></i>
            </div>
            <a href="{{ route('produk.index') }}" class="small-box-footer"
                >More info <i class="fas fa-arrow-circle-right"></i
            ></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $statistik["kategori"] }}</h3>

                <p>Kategori</p>
            </div>
            <div class="icon">
                <i class="fa fa-cubes"></i>
            </div>
            <a href="{{ route('kategori.index') }}" class="small-box-footer"
                >More info <i class="fas fa-arrow-circle-right"></i
            ></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $statistik["member"] }}</h3>

                <p>Member</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('member.index') }}" class="small-box-footer"
                >More info <i class="fas fa-arrow-circle-right"></i
            ></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $statistik["supplier"] }}</h3>

                <p>Suppliers</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('supplier.index') }}" class="small-box-footer"
                >More info <i class="fas fa-arrow-circle-right"></i
            ></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Pendapatan</h3>
            </div>
            <div class="card-body">
                <div class="chart">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas
                        id="barChart"
                        style="
                            min-height: 250px;
                            height: 250px;
                            max-height: 250px;
                            max-width: 100%;
                            display: block;
                            width: 331px;
                        "
                        width="331"
                        height="250"
                        class="chartjs-render-monitor"
                    ></canvas>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Pengeluaran</h3>
            </div>
            <div class="card-body">
                <div class="chart">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas
                        id="barChartPengeluaran"
                        style="
                            min-height: 250px;
                            height: 250px;
                            max-height: 250px;
                            max-width: 100%;
                            display: block;
                            width: 331px;
                        "
                        width="331"
                        height="250"
                        class="chartjs-render-monitor"
                    ></canvas>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Pembelian</h3>
            </div>
            <div class="card-body">
                <div class="chart">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas
                        id="barChartPembelian"
                        style="
                            min-height: 250px;
                            height: 250px;
                            max-height: 250px;
                            max-width: 100%;
                            display: block;
                            width: 331px;
                        "
                        width="331"
                        height="250"
                        class="chartjs-render-monitor"
                    ></canvas>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Penjualan</h3>
            </div>
            <div class="card-body">
                <div class="chart">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas
                        id="barChartPenjualan"
                        style="
                            min-height: 250px;
                            height: 250px;
                            max-height: 250px;
                            max-width: 100%;
                            display: block;
                            width: 331px;
                        "
                        width="331"
                        height="250"
                        class="chartjs-render-monitor"
                    ></canvas>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection @push('js')
<script>
    var data_bar_pendapatan = `{!! json_encode($data_bar_pendapatan) !!}`;
    var data_bar_pengeluaran = `{!! json_encode($data_bar_pengeluaran) !!}`;
    var data_bar_pembelian = `{!! json_encode($data_bar_pembelian) !!}`;
    var data_bar_penjualan = `{!! json_encode($data_bar_penjualan) !!}`;

    //-------------
    //- BAR CHART - PENDAPATAN
    //-------------

    var areaChartDataPendapatan = {
        labels: [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember",
        ],
        datasets: JSON.parse(data_bar_pendapatan),
    };

    var barChartCanvasPendapatan = $("#barChart").get(0).getContext("2d");
    var barChartDataPendapatan = $.extend(true, {}, areaChartDataPendapatan);

    var barChartOptionsPendapatan = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false,
    };

    var barChart = new Chart(barChartCanvasPendapatan, {
        type: "bar",
        data: barChartDataPendapatan,
        options: barChartOptionsPendapatan,
    });

    //-------------
    //- BAR CHART - PENGELUARAN
    //-------------

    var areaChartDataPengeluaran = {
        labels: [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember",
        ],
        datasets: JSON.parse(data_bar_pengeluaran),
    };

    var barChartCanvasPengeluaran = $("#barChartPengeluaran")
        .get(0)
        .getContext("2d");
    var barChartDataPengeluaran = $.extend(true, {}, areaChartDataPengeluaran);

    var barChartOptionsPengeluaran = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false,
    };

    var barChart = new Chart(barChartCanvasPengeluaran, {
        type: "bar",
        data: barChartDataPengeluaran,
        options: barChartOptionsPengeluaran,
    });

    //-------------
    //- BAR CHART - Pembelian
    //-------------

    var areaChartDataPembelian = {
        labels: [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember",
        ],
        datasets: JSON.parse(data_bar_pembelian),
    };

    var barChartCanvasPembelian = $("#barChartPembelian")
        .get(0)
        .getContext("2d");
    var barChartDataPembelian = $.extend(true, {}, areaChartDataPembelian);

    var barChartOptionsPembelian = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false,
    };

    var barChart = new Chart(barChartCanvasPembelian, {
        type: "bar",
        data: barChartDataPembelian,
        options: barChartOptionsPembelian,
    });


    //-------------
    //- BAR CHART - Penjualan
    //-------------

    var areaChartDataPenjualan = {
        labels: [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember",
        ],
        datasets: JSON.parse(data_bar_penjualan),
    };

    var barChartCanvasPenjualan = $("#barChartPenjualan")
        .get(0)
        .getContext("2d");
    var barChartDataPenjualan = $.extend(true, {}, areaChartDataPenjualan);

    var barChartOptionsPenjualan = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false,
    };

    var barChart = new Chart(barChartCanvasPenjualan, {
        type: "bar",
        data: barChartDataPenjualan,
        options: barChartOptionsPenjualan,
    });

    

</script>
@endpush
