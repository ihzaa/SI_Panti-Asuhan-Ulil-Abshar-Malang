@extends('frontend.all')

@section('JudulHalaman', 'Home')

@section('CssTambahanAfter')
<link rel="stylesheet" href="{{asset('admin/plugins/ion-rangeslider/css/ion.rangeSlider.min.css')}}">
  <!-- bootstrap slider -->
<link rel="stylesheet" href="{{asset('admin/plugins/bootstrap-slider/css/bootstrap-slider.min.css')}}">

<style>
::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
  color: #666666 !important;
  font-size: 0.8rem;
  opacity: 0.1; /* Firefox */
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
  color: #343a40 !important;
  font-size: 0.8rem;
  opacity: 0.7;
}

::-ms-input-placeholder { /* Microsoft Edge */
  color: #343a40 !important;
  font-size: 0.8rem;
  opacity: 0.7;
}
</style>
@endsection


@section('konten')
<!--  -->
<div class="hero-wrap" style="background-image: url('assets/aspiration/images/bg_4.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center"
      data-scrollax-parent="true">
      <div class="col-md-12 text ftco-animate mt-5 text-center" data-scrollax=" properties: { translateY: '70%' }">
        {{-- <div class="play-video d-flex align-items-center justify-content-center"><a href="https://vimeo.com/45830194"
            class="popup-vimeo"><span class="icon"><i class="ion-ios-play "></i></span></a></div> --}}
        <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Ulurkan tanganmu untuk membuat dunia lebih baik</h1>
      </div>
    </div>
  </div>
</div>

<section class="ftco-section ftco-no-pt ftco-no-pb ftco-volunteer">
  <div class="container-fluid px-md-0">
    <div class="row no-gutters">
      <div class="col-md-6 img-volunteer" style="background-image: url(assets/aspiration/images/baca_quran.jpg);">
        <div class="row no-gutters justify-content-end">
          <div class="col-lg-7">
            <div class="text py-5 pl-md-4 pr-md-3">
              <p style="font-size: 12px;">(Berinfaqlah) kepada orang-orang fakir yang terikat (oleh jihad) di jalan Allah; mereka tidak dapat (berusaha) di bumi; orang yang tidak tahu menyangka mereka orang kaya karena memelihara diri dari minta-minta. Kamu kenal mereka dengan melihat sifat-sifatnya, mereka tidak meminta kepada orang secara mendesak. Dan apa saja harta yang baik yang kamu nafkahkan (di jalan Allah), maka sesungguhnya Allah Maha Mengatahui.</p>
              <h5>Quran Surat Al-Baqarah Ayat 273</h5>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 d-flex align-items-center bg-primary">
        <div class="about-text px-3 py-5 pl-md-5 pr-md-5">
          <h2>Donasi Terkumpul <br><span>Rp</span>
            @if ($donasi)
              <strong class="number" data-number="{{$donasi->sum}}">0</strong>
            @else
              <strong class="number">0</strong>
            @endif
          </h2>
          <p>Donasi yang terkumpulkan merupakan donasi bulan ini yang di butuhkan anak-anak panti setiap bulan mulai dari sekolah, pakaian, uang jajan dan kebutuhan lainnya.
            </p>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-black py-3 px-4" data-toggle="modal" data-target="#donasiModal">
            Donasi Sekarang
          </button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal Donasi-->
@include('frontend.pages.Home.Components.modal_donasi')

@include('frontend.pages.Home.Components.info_statistik')

@include('frontend.pages.Home.Components.donasi_now')

<section class="ftco-section ftco-causes">
    <div class="container">
        {{-- {{$last_3month}} --}}
      <div class="row">
        @foreach ($last_3month as $item)
          <div class="col-md-{{$jml_last_3month}}">
            <div class="causes causes-2 text-center ftco-animate">
            <h2>Donasi Bulan {{$item->month}}</h2>
              <div class="goal">
                <p><span>Rp <span class="number" data-number="{{$item->sum}}">0</span></span> terkumpul</p>
                <div class="progress" style="height:20px">
                  <div class="progress-bar progress-bar-striped" style="width:100%; height:20px">Selesai</div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

{{-- <section class="ftco-section ftco-vol img" style="background-image: url(assets/aspiration/images/bg_3.jpg);">
  <div class="overlay"></div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 heading-section text-center ftco-animate">
        <h2 class="mb-0"><a target="_blank" href="https://api.whatsapp.com/send?phone=6287759721950">Menjadi Donatur</a></h2>
        <p style="color: white;">Menjadi donatur tetap yang memberikan bantuan ke panti setiap bulan.</p>
      </div>
    </div>
  </div>
</section>


<section class="ftco-section ftco-causes">
  <div class="container">
    <div class="row justify-content-center pb-4">
      <div class="col-md-10 heading-section text-center ftco-animate">
        <h2 class="mb-4">Progam Donasi</h2>
        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="causes causes-2 text-center ftco-animate">
          <div class="img" style="background-image: url(assets/aspiration/images/zakat_fitrah.jpg);"></div>
          <h2>Zakat Fitrah</h2>
          <p>Untuk melakukan zakat fitrah bisa langsung datang langsung ke alamat panti asuhan atau bisa menghubungi contact person terlebih dahulu.</p>

        </div>
      </div>
      <div class="col-md-4">
        <div class="causes causes-2 text-center ftco-animate">
          <div class="img" style="background-image: url(assets/aspiration/images/zakat_mal.jpg);"></div>
          <h2>Zakat Mal</h2>
          <p>Untuk melakukan zakat mal bisa langsung datang langsung ke alamat panti asuhan atau bisa menghubungi contact person terlebih dahulu.</p>
          
        </div>
      </div>
      <div class="col-md-4">
        <div class="causes causes-2 text-center ftco-animate">
          <div class="img" style="background-image: url(assets/aspiration/images/sedekah.png);"></div>
          <h2>Infaq/Sedekah</h2>
          <p>Infaq / Sedekah bisa dilakukan oleh setiap orang hanya dengan menekan tombol donasi tanpa minimum uang.</p>
          
        </div>
      </div>
    </div>
    
  </div>
</section> --}}

@include('frontend.pages.Home.Components.recent_blog')

@endsection

@section('JsTambahanAfter')
<script src="{{asset('admin/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
  <!-- Bootstrap slider -->
<script src="{{asset('admin/plugins/bootstrap-slider/bootstrap-slider.min.js')}}"></script>

<script src="{{asset('admin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>

<script src="{{asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script src="{{asset('js/sweetalert2.all.min.js')}}"></script>

<script src="{{asset('aspiration/js/main_home.js')}}"></script>

@endsection