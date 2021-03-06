@extends('admin.template.all')

@section('judul_halaman',"Dashboard")
@section('CssTambahanAfter')
<link rel="stylesheet" href="{{asset('css/loading.min.css')}}">
@endsection
@section('breadcrumb')
<li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('konten')
<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-3 col-6">
            <a href="{{route('admin_pages_donasi_index')}}">
                <div class="small-box bg-danger ld ld-breath">
                    <div class="inner">
                        <h3>{{$data['donasi_belum']}}</h3>
                        <p>Donasi yang Belum Dikonfirmasi</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-6">
            <a href="{{route('admin_pages_donasi_index')}}">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$data['donasi_masuk']}}</h3>

                        <p>Donasi Masuk</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <a href="{{route('admin_produk')}}">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{$data['produk']}}</h3>

                        <p>Produk</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-box-open"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <a href="{{route('admin_pages_blog_index')}}">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{$data['blog']}}</h3>
                        <p>Blog</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-blog"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="info-box mb-3" id="card_recap">
                <div class="overlay dark" id="loading_recap">
                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                </div>
                <div class="info-box-content">
                    <span class="info-box-text mb-2"><strong>Rekapitulas Donasi</strong></span>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="tahun">Tahun</label>
                        </div>
                        <select class="custom-select" id="tahun">
                            <option selected value="xx">Pilih tahun...</option>
                        </select>
                        <div class="input-group-append">
                            <a class="btn btn-success disabled" href="#" id="btn_unduh_tahun" target="_blank">Unduh</a>
                        </div>
                    </div>
                    <fieldset disabled id="form_bulan">
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="bulan">Bulan</label>
                            </div>
                            <select class="custom-select" id="bulan">
                                <option selected value="xx">Pilih bulan...</option>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-success disabled" href="#" id="btn_unduh_bulan"
                                    target="_blank">Unduh</a>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <!-- /.info-box-content -->
            </div>

            <div class="info-box mb-3" id="card_recap">
                <div class="info-box-content">
                    <span class="info-box-text mb-2"><strong>Rekapitulas Keuangan</strong></span>


                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="tahun1">Tahun</label>
                        </div>
                        <select class="custom-select" id="tahun1">
                            <option selected value="xx">Pilih tahun...</option>
                        </select>
                        <div class="input-group-append">
                            <a class="btn btn-success disabled" href="#" id="btn_unduh_tahun1" target="_blank">Unduh</a>
                        </div>
                    </div>


                    <fieldset disabled id="form_bulan1">
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="bulan1">Bulan</label>
                            </div>
                            <select class="custom-select" id="bulan1">
                                <option selected value="xx">Pilih bulan...</option>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-success disabled" href="#" id="btn_unduh_bulan1"
                                    target="_blank">Unduh</a>
                            </div>
                        </div>
                    </fieldset>





                </div>
                <!-- /.info-box-content -->
            </div>

            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title"><strong>Donasi tahun {{date("Y")}}</strong></h3>
                        {{-- <a href="javascript:void(0);">View Report</a> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg">Rp.
                                {{number_format($data['total_donasi'], 0, '.', '.')}}</span>
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
            <a href="{{route('admin_manager')}}">
                <div class="info-box mb-3 bg-success">
                    <span class="info-box-icon"><i class="fas fa-user"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Pengurus</span>
                        <span class="info-box-number">{{$data['pengurus']}}</span>
                    </div>
                </div>
            </a>
            <a href="{{route('admin_profil_anak')}}">
                <div class="info-box mb-3 bg-primary">
                    <span class="info-box-icon"><i class="fas fa-child"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Anak Asuh</span>
                        <span class="info-box-number">{{$data['anak']}}</span>
                    </div>
                </div>
            </a>
            <br>
            <a href="{{route('admin_pengeluaran')}}">
                <div class="info-box mb-3 bg-secondary">
                    <span class="info-box-icon"><i class="fas fa-cart-arrow-down"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Pengeluaran Bulan
                            {{\Carbon\Carbon::now()->translatedFormat("F")}}</span>
                        <span class="info-box-number">Rp.
                            {{number_format($data['total_pengeluaran_bulan'], 0, '.', '.')}} untuk
                            {{$data['total_pengeluaran_bulan_cnt']}} pengeluaran</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </a>
            <a href="{{route('admin_pengeluaran')}}">
                <div class="info-box mb-3 bg-dark">
                    <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Pengeluaran Tahun {{date("Y")}}</span>
                        <span class="info-box-number">Rp.
                            {{number_format($data['total_pengeluaran_tahun'], 0, '.', '.')}} untuk
                            {{$data['total_pengeluaran_tahun_cnt']}} pengeluaran</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </a>
            <br>
            <a href="{{route('admin_setting')}}">
                <div class="info-box mb-3 bg-success">
                    <span class="info-box-icon"><i class="fas fa-book"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Rekening</span>
                        <span class="info-box-number">{{$data['rekening']}}</span>
                    </div>
                </div>
            </a>
            <a href="{{route('admin_fasilitas')}}">
                <div class="info-box mb-3 bg-info">
                    <span class="info-box-icon"><i class="fas fa-tools"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Fasilitas</span>
                        <span class="info-box-number">{{$data['fasil']}}</span>
                    </div>
                </div>
            </a>
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
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            datasets: [{
                label: 'Total donasi',
                data: {!!json_encode($data['donasi']) !!},
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

    $(document).ready(function() {
        var myHeaders = new Headers();
        myHeaders.append('pragma', 'no-cache');
        myHeaders.append('cache-control', 'no-cache');
        var myInit = {
            headers: myHeaders,
        };
        fetch("{{route('all_user_get_tahun_donasi')}}",myInit)
            .then(response => response.json())
            .then(data => {
                for (let i = 0; i < data.length; i++) {
                    $('#tahun').append(`
            <option value="${data[i].year}">${data[i].year}</option>
            `);
                }
                $('#loading_recap').hide();
            });
        const bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $('#tahun').on('change', function() {
            let val = $('#tahun').val();
            if (val != "xx") {
                $('#loading_recap').show();
                let download_tahun_url = "{{route('admin_downlaod_donasi_tahun',['_tahunnn_'])}}";
                download_tahun_url = download_tahun_url.replace('_tahunnn_', val);
                $('#btn_unduh_tahun').attr('href', download_tahun_url);
                $('#bulan').html('');
                $('#bulan').append(`<option value="xx">Pilih bulan...</option>`);
                let url = "{{route('all_user_get_bulan_donasi_per_tahun',['_year_'])}}"
                url = url.replace('_year_', val);
                fetch(url,myInit)
                    .then(response => response.json())
                    .then(data => {
                        for (let i = 0; i < data.length; i++) {
                            $('#bulan').append(`
                    <option value="${data[i].month}">${bulan[data[i].month]}</option>
                    `);
                        }
                        $('#btn_unduh_bulan').addClass('disabled');
                        $('#btn_unduh_tahun').removeClass('disabled');
                        $('#form_bulan').removeAttr('disabled');
                        $('#loading_recap').hide();
                    });
            } else {
                $('#btn_unduh_bulan').addClass('disabled');
                $('#btn_unduh_tahun').addClass('disabled');
                $('#btn_unduh_tahun').attr('href', '#');
                $('#form_bulan').attr('disabled', '');
            }
        });

        $('#bulan').on('change', function() {
            $('#loading_recap').show();
            let year = $('#tahun').val();
            let val = $('#bulan').val();
            if (val != "xx") {
                let url_bln = "{{route('admin_downlaod_donasi_bulan',['month'=>'__bulan','year'=>'_tahunnn_'])}}";
                url_bln = url_bln.replace('__bulan', val);
                url_bln = url_bln.replace('_tahunnn_', year);
                $('#btn_unduh_bulan').attr('href', url_bln);
                $('#btn_unduh_bulan').removeClass('disabled');
            } else {
                $('#btn_unduh_bulan').attr('href', "#");
                $('#btn_unduh_bulan').addClass('disabled');
            }
            $('#loading_recap').hide();
        });
    });
</script>
<!-- keuangan -->
<script>
    var myHeaders = new Headers();
        myHeaders.append('pragma', 'no-cache');
        myHeaders.append('cache-control', 'no-cache');
        var myInit = {
            headers: myHeaders,
        };
    document.addEventListener("DOMContentLoaded", function(event) {
        fetch("{{route('all_user_get_tahun_Pengeluaran')}}",myInit)
            .then(response => response.json())
            .then(data => {
                for (let i = 0; i < data.length; i++) {
                    $('#tahun1').append(`
            <option value="${data[i].year}">${data[i].year}</option>
            `);
                }
            });
        const bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $('#tahun1').on('change', function() {
            let val = $('#tahun1').val();
            if (val != "xx") {
                $('#ftco-loader1').addClass('show');
                let download_tahun_url = "{{route('all_user_download_Pengeluaran_tahun',['_tahunnn_'])}}";
                download_tahun_url = download_tahun_url.replace('_tahunnn_', val);
                $('#btn_unduh_tahun1').attr('href', download_tahun_url);
                $('#bulan1').html('');
                $('#bulan1').append(`<option value="xx">Pilih bulan...</option>`);
                let url = "{{route('all_user_get_bulan_Pengeluaran_per_tahun',['_year_'])}}"
                url = url.replace('_year_', val);
                fetch(url,myInit)
                    .then(response => response.json())
                    .then(data => {
                        for (let i = 0; i < data.length; i++) {
                            $('#bulan1').append(`
                    <option value="${data[i].month}">${bulan[data[i].month]}</option>
                    `);
                        }
                        $('#btn_unduh_bulan1').addClass('disabled');
                        $('#btn_unduh_tahun1').removeClass('disabled');
                        $('#form_bulan1').removeAttr('disabled');
                        $('#ftco-loader1').removeClass('show');
                    });
            } else {
                $('#btn_unduh_bulan1').addClass('disabled');
                $('#btn_unduh_tahun1').addClass('disabled');
                $('#btn_unduh_tahun1').attr('href', '#');
                $('#form_bulan1').attr('disabled', '');
            }
        });

        $('#bulan1').on('change', function() {
            let year = $('#tahun1').val();
            let val = $('#bulan1').val();
            if (val != "xx") {
                let url_bln = "{{route('all_user_download_Pengeluaran_bulan',['month'=>'__bulan','year'=>'_tahunnn_'])}}";
                url_bln = url_bln.replace('__bulan', val);
                url_bln = url_bln.replace('_tahunnn_', year);
                $('#btn_unduh_bulan1').attr('href', url_bln);
                $('#btn_unduh_bulan1').removeClass('disabled');
            } else {
                $('#btn_unduh_bulan1').attr('href', "#");
                $('#btn_unduh_bulan1').addClass('disabled');
            }
        });
    });
</script>
@endsection
