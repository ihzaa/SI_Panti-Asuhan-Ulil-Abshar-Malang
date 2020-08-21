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
              {{-- <div class="progress-bar progress-bar-striped" style="width:{{(0/$kebutuhan)*100}}%; height:50px"></div> --}}
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
                <div class="col-md-4">
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
    </div>
  </div>
</section>