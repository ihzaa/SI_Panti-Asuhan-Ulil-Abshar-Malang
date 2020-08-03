@extends('frontend.all')

@section('judul_halaman','About Us')

@section('konten')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url({{ asset('aspiration/images/panti.jpg') }});" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate pb-5 text-center">
            <h2 class="mb-3 bread">About Us</h2>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>About us <i class="ion-ios-arrow-forward"></i></span></p>
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
			            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
			            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
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
	    				<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
    				</div>
    			</div>
    			<div class="col-md-4 py-4 py-md-5 ftco-animate">
    				<div class="py-md-4 pb-md-5">
	    				<h3>Visi</h3>
	    				<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
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
		                <strong class="number" data-number="20">0</strong>
		                <span>Pengurus</span>
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
		                <strong class="number" data-number="24">0</strong>
		                <span>Anak asuh</span>
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
        		<div class="testimony-img" style="background-image: url(images/testimony-img.jpg);"></div>
        	</div>
          <div class="col-md-6 py-5">
          	<div class="heading-section pb-4 pt-md-4 ftco-animate">
		          <h2 class="mb-0">Pengurus Panti Asuhan</h2>
		        </div>
            <div class="carousel-testimony owl-carousel ftco-owl">
              <div class="item">
                <div class="testimony-wrap">
                  <!-- <div class="text">
                    <p class="mb-4">Ketua panti adalah seorang yang bertanggung jawab atas segala hal yang ada di panti.</p>
                  </div> -->
                  <div class="d-flex align-items-center">
                    <div class="user-img" style="background-image: url({{ asset('aspiration/images/person_1.jpg') }})">
	                  </div>
	                  <div class="pos ml-3">
	                  	<p class="name">Bapak panti</p>
	                    <span class="position">Ketua Pengurus Panti Asuhan</span>
	                  </div>
	                </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap">
                  <!-- <div class="text">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                  </div> -->
                  <div class="d-flex align-items-center">
	                  <div class="user-img" style="background-image: url(images/person_1.jpg)">
	                  </div>
	                  <div class="pos ml-3">
	                  	<p class="name">Ibu Panti</p>
	                    <span class="position">Istri Ketua Pengurus</span>
	                  </div>
	                </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap">
                  <div class="text">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                  </div>
                  <div class="d-flex align-items-center">
	                  <div class="user-img" style="background-image: url(images/person_1.jpg)">
	                  </div>
	                  <div class="pos ml-3">
	                  	<p class="name">Henry Ford</p>
	                    <span class="position">Businessman</span>
	                  </div>
	                </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap">
                  <div class="text">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                  </div>
                  <div class="d-flex align-items-center">
	                  <div class="user-img" style="background-image: url(images/person_1.jpg)">
	                  </div>
	                  <div class="pos ml-3">
	                  	<p class="name">Jeff Chan</p>
	                    <span class="position">Businessman</span>
	                  </div>
	                </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap">
                  <div class="text">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                  </div>
                  <div class="d-flex align-items-center">
	                  <div class="user-img" style="background-image: url(images/person_1.jpg)">
	                  </div>
	                  <div class="pos ml-3">
	                  	<p class="name">Michael Bubble</p>
	                    <span class="position">Businessman</span>
	                  </div>
	                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> <!-- .section -->
@endsection
