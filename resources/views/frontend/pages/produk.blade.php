@extends('frontend.all')


@section('judul_halaman','produk')

@section('konten')


<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url({{asset('aspiration/images/image_1.jpg')}});" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center" >
          <div class="col-md-9 ftco-animate pb-5 text-center">
            <h2 class="mb-3 bread">Produk</h2>
            <p class="">Untuk membantu dalam pengembangan pantiasuhan anda dapat juga membeli produk dari panti kami</p>
            <a class="btn btn-success btn-xl js-scroll-trigger" href="#produk">Lihat produk</a>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section ftco-causes">
    	<div class="container" id="produk">
        <div class="row">
        @foreach ($data['produk'] as $d)
        	<div class="col-md-4">
        		<div class="causes causes-2 text-center ftco-animate">
        			<div class="img" style="background-image: url({{asset($d->image)}});"></div>
        			<h2>{{$d->name}}</h2>
        			<p>{{$d->desc}}</p>
        			<div class="goal">
        				<p><span>Rp.{{$d->price}}</span></p>	
							</div>
        		</div>
          </div>
          @endforeach
        

        </div>
        <div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
              <ul>
                <li><a href="#" class="ion-ios-arrow-back"></a></li>
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#" class="ion-ios-arrow-forward"></a></li>
              </ul>
            </div>
          </div>
        </div>
    	</div>
    </section>
  

    @endsection

    @section('JsTambahanAfter')
    <script src="{{asset('aspiration/js/buttonscroll.js')}}"></script>
    @endsection