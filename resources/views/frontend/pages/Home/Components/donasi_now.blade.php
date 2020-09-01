<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center pb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                {{-- <span class="subheading">Foundation Grants Projects</span> --}}
                <h2 class="mb-4">Donasi Bulan Ini</h2>
                {{-- <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p> --}}
            </div>
        </div>
        <div class="row justify-content-center ftco-animate">
            <div class="col-md-8">
                <div class="featured-causes">
                    <div class="progress" style="height:50px; flex-direction: column; justify-content: center;">
                        <p style="position: absolute;
              margin-left: auto;
              margin-right: auto;
              left: 0;
              right: 0;
              text-align: center;
              "> {{$jml_hari-$day_now}} Hari Lagi</p>
                        @if ($donasi)
                        <div class="progress-bar progress-bar-striped" style="width:{{($day_now/$jml_hari)*100}}%; height:50px"></div>
                        @else
                        {{-- <div class="progress-bar progress-bar-striped" style="width:{{(0/$kebutuhan)*100}}%;
                        height:50px">
                    </div> --}}
                    @endif
                </div>
                <div class="text mt-4 d-md-flex">
                    <div class="one d-flex">
                        <div class="mr-4">
                            @if ($donasi)
                            <h2>Rp <span class="number" data-number="{{$donasi->sum}}"></span> terkumpul</h2>
                            @else
                            {{-- <h2>{{intval((0/$kebutuhan)*100)}}%</h2> --}}
                            @endif
                        </div>
                    </div>
                    <div class="one text-md-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#donasiModal">
                            Donasi Sekarang
                        </button>
                        {{-- <p><a href="#" class="btn btn-primary">Donate now</a></p> --}}
                    </div>
                </div>
            </div>
        </div>
        @if (count($donatur_terbaru) >= 1)
        <div class="col-md-8" style="padding: 15px;
        margin: 15px;">
            <h1 style="font-size: 20px;">Donasi Terbaru</h1>
            <div class="row">
                @if (count($donatur_terbaru) >= 1)
                @foreach ($donatur_terbaru as $item)
                <div class="col-md-4 mb-2">
                    <div style="background: #fff;
                  text-align: center;
                  line-height: 7px;
                  padding: 17px;
                  border-radius: 10px;
                  background: #81e2c7;
                  color: #636363;">
                        <p style="font-weight: bold;">{{$item->nama_donatur}}</p>
                        <p>Rp. {{number_format($item->total_donasi)}}</p>
                        <p>{{date('d F Y', strtotime($item->created_at))}}</p>
                    </div>
                </div>
                @endforeach
                @else
                <div class="col-md-12" style="text-align: center">
                    <p style="font-size: 1.1rem">Belum ada donasi saat ini.</p>
                </div>
                @endif
            </div>
        </div>
        @endif
        <div class="col-md-8" style="padding: 15px;margin: 15px;">
            <div class="info-box mb-3" id="card_recap">
                <div class="info-box-content">
                    <span class="info-box-text mb-2"><strong>Rekapitulas Donasi</strong></span>
                    <div class="row">
                        <div class="col-md-6 mb-2">
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
                        </div>
                        <div class="col-md-6">
                            <fieldset disabled id="form_bulan">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="bulan">Bulan</label>
                                    </div>
                                    <select class="custom-select" id="bulan">
                                        <option selected value="xx">Pilih bulan...</option>
                                    </select>
                                    <div class="input-group-append">
                                        <a class="btn btn-success disabled" href="#" id="btn_unduh_bulan" target="_blank">Unduh</a>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                    </div>


                </div>
                <!-- /.info-box-content -->
            </div>
        </div>

        <div class="col-md-8" style="padding: 15px;margin: 15px;">
            <div class="info-box mb-3" id="card_recap">
                <div class="info-box-content">
                    <span class="info-box-text mb-2"><strong>Rekapitulas pengeluaran</strong></span>
                    <div class="row">
                        <div class="col-md-6 mb-2">
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
                        </div>
                        <div class="col-md-6">
                            <fieldset disabled id="form_bulan1">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="bulan1">Bulan</label>
                                    </div>
                                    <select class="custom-select" id="bulan1">
                                        <option selected value="xx">Pilih bulan...</option>
                                    </select>
                                    <div class="input-group-append">
                                        <a class="btn btn-success disabled" href="#" id="btn_unduh_bulan1" target="_blank">Unduh</a>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                    </div>


                </div>
                <!-- /.info-box-content -->
            </div>
        </div>

    </div>
    </div>
</section>
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        fetch("{{route('all_user_get_tahun_donasi')}}")
            .then(response => response.json())
            .then(data => {
                for (let i = 0; i < data.length; i++) {
                    $('#tahun').append(`
            <option value="${data[i].year}">${data[i].year}</option>
            `);
                }
            });
        const bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $('#tahun').on('change', function() {
            let val = $('#tahun').val();
            if (val != "xx") {
                $('#ftco-loader').addClass('show');
                let download_tahun_url = "{{route('all_user_downlaod_donasi_tahun',['_tahunnn_'])}}";
                download_tahun_url = download_tahun_url.replace('_tahunnn_', val);
                $('#btn_unduh_tahun').attr('href', download_tahun_url);
                $('#bulan').html('');
                $('#bulan').append(`<option value="xx">Pilih bulan...</option>`);
                let url = "{{route('all_user_get_bulan_donasi_per_tahun',['_year_'])}}"
                url = url.replace('_year_', val);
                fetch(url)
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
                        $('#ftco-loader').removeClass('show');
                    });
            } else {
                $('#btn_unduh_bulan').addClass('disabled');
                $('#btn_unduh_tahun').addClass('disabled');
                $('#btn_unduh_tahun').attr('href', '#');
                $('#form_bulan').attr('disabled', '');
            }
        });

        $('#bulan').on('change', function() {
            let year = $('#tahun').val();
            let val = $('#bulan').val();
            if (val != "xx") {
                let url_bln = "{{route('all_user_downlaod_donasi_bulan',['month'=>'__bulan','year'=>'_tahunnn_'])}}";
                url_bln = url_bln.replace('__bulan', val);
                url_bln = url_bln.replace('_tahunnn_', year);
                $('#btn_unduh_bulan').attr('href', url_bln);
                $('#btn_unduh_bulan').removeClass('disabled');
            } else {
                $('#btn_unduh_bulan').attr('href', "#");
                $('#btn_unduh_bulan').addClass('disabled');
            }
        });
    });
</script>
<!-- pengeluaran -->
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        fetch("{{route('all_user_get_tahun_Pengeluaran')}}")
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
                let download_tahun_url = "{{route('cek_downlaod_Pengeluaran_tahun',['_tahunnn_'])}}";
                download_tahun_url = download_tahun_url.replace('_tahunnn_', val);
                $('#btn_unduh_tahun1').attr('href', download_tahun_url);
                $('#bulan1').html('');
                $('#bulan1').append(`<option value="xx">Pilih bulan...</option>`);
                let url = "{{route('all_user_get_bulan_Pengeluaran_per_tahun',['_year_'])}}"
                url = url.replace('_year_', val);
                fetch(url)
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
                let url_bln = "{{route('cek_downlaod_Pengeluaran_bulan',['month'=>'__bulan','year'=>'_tahunnn_'])}}";
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
