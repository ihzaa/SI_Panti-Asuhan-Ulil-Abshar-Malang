@extends('frontend.all')

@section('JudulHalaman','Tentang kami')

@section('CssTambahanBefore')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection

@section('CssTambahanAfter')
<style>
  @media (max-width: 767px) {
    .ftco-mission .container .row .img{
      display:none;
    }
  }
</style>
@endsection

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
			            <h2 class="mb-4">Sejarah Singkat</h2>
			            <!-- <h2 class="mb-4">We Voluntary Help for Almost <span class="number" data-number="100">0</span> Years</h2> -->
                  
			            <p>Pada tahun 1995 panti asuhan Ulil Abshar didirikan. Dan pada tahun 2014, Panti asuhan Ulil Abshar menjadi salah satu panti asuhan di bawah naungan PCM (Pimpinan Cabang Muhammadiyah). Panti asuhan ini berada di kecamatan Dau kabupaten Malang. yang menjadi sasaran pelayanan dari panti asuhan Ulil Abshar yaitu yatim, yatim piatu, piatu, dan dhuafa. Santri di panti asuhan Ulil Abshar merupakan siswa SD dan SMP.</p>
                  
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

    <section class="ftco-counter ftco-section img" id="section-counter" style="background-color:var(--teal);">
    	<div class="overlay"></div>
    	<div class="container">
				<div class="row d-md-flex align-items-center">
					<div class="wrapper">
						<div class="row justify-content-around">
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
		                <strong class="number" data-number="{{ count($data['managers']) }}">0</strong>
		                <span>Pengurus</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="4">0</strong>
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
        		<div class="testimony-img" style="background-image: url({{ asset('aspiration/images/pengurus.png') }});"></div>
        	</div>
          <div class="col-md-6 py-5">
          	<div class="heading-section pb-4 pt-md-4 ftco-animate">
		          <h2 class="mb-0">Pengurus Panti Asuhan</h2>
		        </div>
            <div class="carousel-testimony owl-carousel ftco-owl">
            @if($data['managers']->isEmpty())
               <div class="item">
                <div class="testimony-wrap">
                  <div class="text">
                    <p class="mb-4 mt-4">Data pengurus belum tersedia</p>
                  </div>
                </div>
              </div>
            @endif  
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

    <section class="testimony-section bg-light">
      <div class="container">
        <div class="row ftco-animate justify-content-center">
        	
          <div class="col-md-6 py-5">
          	<div class="heading-section pb-4 pt-md-4 ftco-animate">
		          <h2 class="mb-0">Fasilitas Panti Asuhan</h2>
            </div>
            
            <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th class="th-sm" style="width: 70%">Nama Fasilitas</th>
                  <th class="th-sm" style="width: 30%">Jumlah</th>
                </tr>
              </thead>
              <tbody>
              @foreach( $data['sarana'] as $d)
                <tr>
                  <td>{{$d->name}}</td>
                  <td>{{$d->total}}</td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>Nama Fasilitas
                  </th>
                  <th>Jumlah
                  </th>
                </tr>
              </tfoot>
            </table>
          
          </div>
          <div class="col-md-6 d-flex">
        		<!-- <div class="testimony-img" style="background-image: url({{ asset('aspiration/images/testimony-img.jpg') }});"></div> -->
            <div id="carouselExampleFade" class="carousel slide carousel-fade my-auto" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item my-auto active" style="height:370px;overflow:hidden">
                  <img src="{{ asset('aspiration/images/bg_blog_contact3.jpg') }}" style="height:370px;" class="my-auto d-block w-100"  alt="foto fasilitas">
                  <!-- <div class="carousel-caption d-none d-md-block">
                    <h4 style="font-weight:700; color:white;background-color:var(--teal);border:1px solid white"></h4>
                  </div> -->
                </div>
              @foreach($data['sarana'] as $d)
                @if($d->image != NULL)
                <div class="carousel-item" style="height:370px;overflow:hidden">
                  <img src="{{ asset($d->image) }}" class="d-block w-100" style="height:370px;" alt="foto fasilitas">
                  <div class="carousel-caption d-none d-md-block">
                    <h4 style="margin: 0 auto;font-size:16px;width:fit-content;padding:0px 20px;font-weight:700; color:white;background-color:var(--teal);border:1px solid white">{{ $d->name }}</h4>
                  </div>
                </div>
                @endif
              @endforeach
              @if(!$data['sarana']->isEmpty())
              <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
              @endif
            </div>
        	</div>
          
          </div>
        </div>
      </div>
    </section> <!-- .section -->
@endsection

@section('JsTambahanAfter')
  <script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <script>
  $('#dtBasicExample').DataTable({
    // "fnDrawCallback": function (oSettings) { 
    //                 if ($('#dtBasicExample tr').length < 5) {
    //                     $('.dataTables_paginate').hide();
    //                 }
    //             },
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "responsive": true,
      "iDisplayLength": 5,
    });
  </script>
@endsection