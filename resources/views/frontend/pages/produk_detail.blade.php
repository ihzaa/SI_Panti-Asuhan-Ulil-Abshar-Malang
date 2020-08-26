@extends('frontend.all')


@section('judul_halaman','produk')

@section('konten')


<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url({{asset('aspiration/images/susu1.jpg')}});" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
        <h2 class="mb-3 bread">Produk Detail</h2>
        <a class="btn btn-success btn-xl js-scroll-trigger" href="#detail">Lihat produk</a>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section ">
  <div class="container" id="detail">
    <div class="row d-flex">
      <div class="col-md-6 col-lg-5 ">

        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="img d-flex align-self-stretch align-items-center " src="{{asset($data['produk']->image)}}" alt="First slide" height="500px">
            </div>
            @foreach ($data['gambar'] as $d)
            <div class="carousel-item">
              <img class="img d-flex align-self-stretch align-items-center  " src="{{asset($d->image)}}" alt="Second slide" height="500px">
            </div>
            @endforeach
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>

      </div>
      <div class="col-md-6 col-lg-7 pl-lg-5 py-5">
        <div class="py-md-5">
          <div class="row justify-content-start pb-3">
            <div class="col-md-12 heading-section ftco-animate">

              <h2 class="mb-4" style="color='"><u>{{$data['produk']->name}}</u></h2>
              <h3>Deskirpsi :</h3>
              <p>{{$data['produk']->desc}}</p>

              <h3>harga :</h3>
              <h4>RP.{{$data['produk']->price}}</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>





@endsection

@section('JsTambahanAfter')
<script src="{{asset('aspiration/js/buttonscroll.js')}}"></script>
@endsection