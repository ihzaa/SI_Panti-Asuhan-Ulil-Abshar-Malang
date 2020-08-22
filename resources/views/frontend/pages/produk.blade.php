@extends('frontend.all')


@section('judul_halaman','produk')

@section('konten')


<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url({{asset('aspiration/images/susu1.jpg')}});" data-stellar-background-ratio="0.5">
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

    <section class="ftco-section ftco-causes" >
    	<div class="container" id="produk" >
        <div class="row">
        @if ($data->count() > 0)
        @foreach ($data as $d)
        	<div class="col-md-4">
        		<div class="causes causes-2 text-left ftco-animate">
        			<div class="img" style="background-image: url({{asset($d->image)}});"></div>
        			<h2>{{$d->name}}</h2>
        			
              <div class="causes causes-2 text-right ftco-animate">
              <p><a href="{{route('produk_detail',['id'=>$d->id])}}"class="btn btn-primary py-2 px-3">Read more</a></p>
            
              </div>
            </div>
           
          </div>
         
          
          @endforeach
        </div>
        @else
        
        <h1 style="color:var(--teal);">produk tidak ada</h1>
        
        @endif
        

       
        <div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">   
              <ul>
                <li class="">{{ $data->links() }}</li>
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