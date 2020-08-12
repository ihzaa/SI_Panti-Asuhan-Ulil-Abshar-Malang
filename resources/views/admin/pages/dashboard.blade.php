@extends('admin.template.all')

@section('judul_halaman',"Dashboard")

@section('breadcrumb')
<li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('konten')
<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$data['pengurus']}}</h3>

                    <p>Pengurus</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$data['anak']}}</h3>

                    <p>Anak Asuh</p>
                </div>
                <div class="icon">
                    <i class="fas fa-child"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{$data['produk']}}</h3>

                    <p>Produk</p>
                </div>
                <div class="icon">
                    <i class="fas fa-box-open"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{$data['blog']}}</h3>

                    <p>Blog</p>
                </div>
                <div class="icon">
                    <i class="fas fa-blog"></i>
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>000</h3>

                    <p>Kamar</p>
                </div>
                <div class="icon">
                    <i class="fas fa-house-user"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>000</h3>

                    <p>Donatur Tetap</p>
                </div>
                <div class="icon">
                    <i class="fas fa-handshake"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$data['pengurus']}}</h3>

                    <p>Donasi Masuk</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$data['anak']}}</h3>

                    <p>Donasi</p>
                </div>
                <div class="icon">
                    <i class="fas fa-child"></i>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Donasi tahun {{date("Y")}}</h3>
                        {{-- <a href="javascript:void(0);">View Report</a> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg">Rp. 820</span>
                            <span>Total Donasi Diterima</span>
                        </p>
                        {{-- <p class="ml-auto d-flex flex-column text-right">
                            <span class="text-success">
                                <i class="fas fa-arrow-up"></i> 12.5%
                            </span>
                            <span class="text-muted">Since last week</span>
                        </p> --}}
                    </div>
                    <!-- /.d-flex -->

                    <div class="position-relative mb-4">
                        <canvas id="chart_donasi" height="150"></canvas>
                    </div>

                    {{-- <div class="d-flex flex-row justify-content-end">
                        <span class="mr-2">
                            <i class="fas fa-square text-primary"></i> This Week
                        </span>

                        <span>
                            <i class="fas fa-square text-gray"></i> Last Week
                        </span>
                    </div> --}}
                </div>
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-4">
            <!-- Info Boxes Style 2 -->
            <div class="info-box mb-3 bg-primary">
                <span class="info-box-icon"><i class="fas fa-hand-holding-heart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Donasi Masuk</span>
                <span class="info-box-number">{{$data['donasi_masuk']}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-success">
                <span class="info-box-icon"><i class="fas fa-check-circle"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Donasi yang Belum Dikonfirmasi</span>
                <span class="info-box-number">{{$data['donasi_belum']}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-danger">
                <span class="info-box-icon"><i class="fas fa-handshake"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Donatur Tetap</span>
                    <span class="info-box-number">114,381</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-info">
                <span class="info-box-icon"><i class="fas fa-house-user"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Kamar</span>
                    <span class="info-box-number">163,921</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>
</div>

@endsection

@section('JsTambahanAfter')
<script src="{{asset('admin/plugins/chart.js/Chart.min.js')}}"></script>
<script>
    var ctx = document.getElementById('chart_donasi').getContext('2d');
    var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli','Agustus','September','Oktober','November','Desember'],
        datasets: [{
            label: 'Total donasi',
            data: [12, 19, 3, 5, 2, 3],
            borderWidth: 1,
            fill: false,
            borderColor: 'rgba(15, 255, 135, 1)'
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
@endsection
