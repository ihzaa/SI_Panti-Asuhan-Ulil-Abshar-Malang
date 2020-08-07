@extends('frontend.all')

@section('JudulHalaman','Tentang kami')

@section('konten')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url({{ asset('aspiration/images/panti.jpg') }});" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate pb-5 text-center">
            <h2 class="mb-3 bread">Tentang kami</h2>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Beranda <i class="ion-ios-arrow-forward"></i></a></span> <span>Tentang kami <i class="ion-ios-arrow-forward"></i></span></p>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb">
    	<div class="container">
    		<div class="row d-flex">
    			<div class="col-md-6 col-lg-5 d-flex">
    				<div class="img d-flex align-self-stretch align-items-center" style="background-image:url({{ asset('aspiration/images/panti.jpg') }});">
    				</div>
    			</div>
    			<div class="col-md-6 col-lg-7 pl-lg-5 py-5">
    				<div class="py-md-5">
	    				<div class="row justify-content-start pb-3">
			          <div class="col-md-12 heading-section ftco-animate">
			          	<span class="subheading">Pesantren Panti Asuhan Putra Muhammadiyah Ulil Abshar</span>
			            <h2 class="mb-4">Sejarah</h2>
			            <!-- <h2 class="mb-4">We Voluntary Help for Almost <span class="number" data-number="100">0</span> Years</h2> -->
                  
			            <p>Didirikan pada tanggal 24 Oktober 1990. Panti asuhan Ulil Abshar merupakan salah satu panti asuhan di bawah naungan PCM (Pimpinan Cabang Muhammadiyah). Panti asuhan ini berada di kecamatan Dau kabupaten Malang.Santri di panti asuhan Ulil Abshar merupakan siswa SD dan SMP.</p>
                  
			          </div>
			        </div>
		        </div>
	        </div>
        </div>
    	</div>
    </section>

    <section class="ftco-mission">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-4 py-4 py-md-5 ftco-animate">
    				<div class="py-md-4 pb-md-5">
	    				<h3>Misi</h3>
	    				<p>Menyelenggarakan pendidikan yang berkarakter religi, wirausaha, dan mandiri.</p>
    				</div>
    			</div>
    			<div class="col-md-4 py-4 py-md-5 ftco-animate">
    				<div class="py-md-4 pb-md-5">
	    				<h3>Visi</h3>
	    				<p>Terwujudnya generasi yang berakhlak mulia dan mandiri.</p>
    				</div>
    			</div>
    			<div class="col-md-4 py-4 py-md-5 img" style="background-image: url({{ asset('aspiration/images/logo.jpg') }});background-size: 220px 320px;"></div>
    		</div>
    	</div>
    </section>

    <section class="ftco-counter ftco-section img" id="section-counter" style="background-image: url(images/bg_2.jpg);">
    	<div class="overlay"></div>
    	<div class="container">
				<div class="row d-md-flex align-items-center">
					<div class="wrapper">
						<div class="row">
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="{{ count($data['orphanages']) }}">0</strong>
		                <span>Anak asuh</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="20">0</strong>
		                <span>Donatur tetap</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="{{ count($data['managers']) }}">0</strong>
		                <span>Pengurus</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="10">0</strong>
		                <span>Kamar</span>
		              </div>
		            </div>
		          </div>
	          </div>
	        </div>
        </div>
    	</div>
    </section>

    <section class="testimony-section bg-light">
      <div class="container">
        <div class="row ftco-animate justify-content-center">
        	<div class="col-md-6 d-flex">
        		<div class="testimony-img" style="background-image: url({{ asset('aspiration/images/testimony-img.jpg') }});"></div>
        	</div>
          <div class="col-md-6 py-5">
          	<div class="heading-section pb-4 pt-md-4 ftco-animate">
		          <h2 class="mb-0">Pengurus Panti Asuhan</h2>
		        </div>
            <div class="carousel-testimony owl-carousel ftco-owl">
              @foreach( $data['managers'] as $d)
              @if($d->position_desc == NULL)
              <div class="item">
                <div class="testimony-wrap">
                  <!-- <div class="text">
                    <p class="mb-4">Ketua panti adalah seorang yang bertanggung jawab atas segala hal yang ada di panti.</p>
                  </div> -->
                  <div class="d-flex align-items-center">
                    <div class="user-img" style="background-image: url({{ asset($d->image) }})">
	                  </div>
	                  <div class="pos ml-3">
	                  	<p class="name">{{ $d->name }}</p>
	                    <span class="position">{{ $d->position }}</span>
	                  </div>
	                </div>
                </div>
              </div>
              @else
              <div class="item">
                <div class="testimony-wrap">
                  <div class="d-flex align-items-center">
                    <div class="user-img" style="background-image: url({{ asset($d->image) }})">
	                  </div>
	                  <div class="pos ml-3">
	                  	<p class="name">{{ $d->name }}</p>
	                    <span class="position">{{ $d->position }}</span>
                    </div>
                  </div>
                  <div class="text">
                    <p class="mb-4">{{ $d->position_desc}}</p>
                  </div>
                </div>
              </div>
              @endif
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </section> <!-- .section -->
@endsection
