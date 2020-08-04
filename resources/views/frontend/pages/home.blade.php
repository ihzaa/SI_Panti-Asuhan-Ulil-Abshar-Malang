@extends('frontend.all')

@section('JudulHalaman', 'Home')

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
          <h2>Donasi Terkumpul <br><span>Rp</span><strong class="number" data-number="2500000">0</strong></h2>
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

{{-- Toast --}}
<div aria-live="polite" aria-atomic="true" style="position: relative">

  <div class="toast" data-animation="true" data-delay="5000" data-autohide="true" style="position: fixed; z-index: 5; bottom: 25px; right: 25px;">
    <div class="toast-header">
      <span class="rounded mr-2 bg-primary" style="width: 15px;height: 15px"></span>
      <strong class="mr-auto">Notification</strong>
      <small>Just Now</small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      Donasi yang anda lakukan berhasil.
    </div>
  </div>
  
</div>

<!-- Modal Donasi-->
<div class="modal fade" id="donasiModal" tabindex="-1" role="dialog" aria-labelledby="donasiModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="donasiModalLabel">Form Donasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="donasi_form">
          <div class="form-group">
            <label for="name" class="col-form-label col-form-label-sm">Nama Pengirim:</label>
            <input type="text" class="form-control form-control-sm" id="name" required>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label col-form-label-sm">Jumlah:</label>
            <input type="number" class="form-control form-control-sm" id="donasi" required>
          </div>

          <div class="form-group">
            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Bank</label>
            <select class="custom-select my-1 mr-sm-2" id="bank" required>
              <option value="" selected>Choose...</option>
              <option value="BNI">BNI</option>
              <option value="BCA">BCA</option>
              <option value="BRI">BRI</option>
            </select>
            <div class="invalid-feedback">Example invalid custom select feedback</div>
          </div>

          <div class="form-group">
            <label for="exampleFormControlFile1">Bukti Transfer</label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1">
          </div>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" onclick="createPost()">Submit</button>
      </div>
    </form>
    </div>
  </div>
</div>

<section class="services-section py-5 py-md-0">
  <div class="container">
    <div class="row no-gutters d-flex">
      <div class="col-md-6 col-lg-3 d-flex align-self-stretch ftco-animate">
        <div class="media block-6 text-center services d-block">
          <div class="icon"><span class="flaticon-adoption"></span></div>
          <div class="media-body">
            <h3 class="heading mb-3">Anak Panti</h3>
            <p>22</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 d-flex align-self-stretch ftco-animate">
        <div class="media block-6 text-center services active d-block">
          <div class="icon"><span class="flaticon-charity"></span></div>
          <div class="media-body">
            <h3 class="heading mb-3">Donatur Tetap</h3>
            <p>4</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 d-flex align-self-stretch ftco-animate">
        <div class="media block-6 text-center services d-block">
          <div class="icon"><span class="flaticon-volunteer"></span></div>
          <div class="media-body">
            <h3 class="heading mb-3">Pengurus</h3>
            <p>10</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 d-flex align-self-stretch ftco-animate">
        <div class="media block-6 text-center services d-block">
          <div class="icon"><span class="flaticon-open-book"></span></div>
          <div class="media-body">
            <h3 class="heading mb-3">Kamar</h3>
            <p>10</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

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
          <div class="progress" style="height:50px">
            <div class="progress-bar progress-bar-striped" style="width:25%; height:50px"></div>
          </div>
          <div class="text mt-4 d-md-flex">
            <div class="one d-flex">
              <div class="mr-4">
                <h2>25%</h2>
              </div>
              <div class="goal">
                <p class="d-flex"><span>Terkumpul :</span><span>Rp. 2.500.000</span></p>
                <p class="d-flex"><span>Kebutuhan :</span><span>Rp. 10.000.000</span></p>
              </div>
            </div>
            <div class="one text-md-right">
              <p><a href="#" class="btn btn-primary">Donate now</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section ftco-vol img" style="background-image: url(assets/aspiration/images/bg_3.jpg);">
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
</section>

<section class="ftco-section" style="padding-top: 0;">
  <div class="container">
    <div class="row justify-content-center pb-5">
      <div class="col-md-10 heading-section text-center ftco-animate">
        <h2 class="mb-4">Blog Saat Ini</h2>
        
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="blog-entry align-self-stretch ftco-animate">
          <a href="blog-single.html" class="block-20 img" style="background-image: url('assets/aspiration/images/image_1.jpg');">
          </a>
          <div class="text text-2 bg-light">
            <h3 class="heading mb-2"><a href="#">Advocating on behalf of abused and neglected</a></h3>
            <div class="meta mb-2">
              <div><a href="#">Sept. 04, 2019</a></div>
              <div><a href="#">Admin</a></div>
              <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="blog-entry align-self-stretch d-md-flex bg-light p-3 align-items-center d-flex ftco-animate">
          <a href="blog-single.html" class="block-20 thumb" style="background-image: url('assets/aspiration/images/image_2.jpg');">
          </a>
          <div class="text text-thumb d-block pl-2 pl-md-4">
            <h3 class="heading mb-2"><a href="#">Gathering Books for Children</a></h3>
            <div class="meta">
              <div><a href="#">Sept. 04, 2019</a></div>
              <div><a href="#">Admin</a></div>
              <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
            </div>
          </div>
        </div>
        <div class="blog-entry align-self-stretch d-md-flex bg-light p-3 align-items-center d-flex ftco-animate">
          <a href="blog-single.html" class="block-20 thumb" style="background-image: url('assets/aspiration/images/image_3.jpg');">
          </a>
          <div class="text text-thumb d-block pl-2 pl-md-4">
            <h3 class="heading mb-2"><a href="#">Access to Clean Water</a></h3>
            <div class="meta">
              <div><a href="#">Sept. 04, 2019</a></div>
              <div><a href="#">Admin</a></div>
              <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
            </div>
          </div>
        </div>
        <div class="blog-entry align-self-stretch d-md-flex bg-light p-3 align-items-center d-flex ftco-animate">
          <a href="blog-single.html" class="block-20 thumb" style="background-image: url('assets/aspiration/images/image_4.jpg');">
          </a>
          <div class="text text-thumb d-block pl-2 pl-md-4">
            <h3 class="heading mb-2"><a href="#">Super typhoon Haiyan Disaster Relief</a></h3>
            <div class="meta">
              <div><a href="#">Sept. 04, 2019</a></div>
              <div><a href="#">Admin</a></div>
              <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</section>
@endsection

@section('JsTambahanAfter')
  <script>
    $("#donasi_form").submit(function(e) {
      e.preventDefault();
  });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    
    function createPost() {
      var name = $('#name').val();
      var selectedBank = $("#bank option:selected").val();
      var donasi = $('#donasi').val();
  
      let _url     = 'donasi';

        $.ajax({
          url: _url,
          type: "POST",
          data: {
            name: name,
            bank: selectedBank,
            donasi: donasi
          },
          success: function(response) {
            $('#name').val('');
            $("#bank select").val('');
            $("donasi").val('');

            $('.toast').toast('show');
            $('#donasiModal').modal('hide');
          },
          error: function(response) {
            console.log(response.responseJSON.errors)
            $('#nameError').text(response.responseJSON.errors.name);
            if(response.responseJSON.errors.name){
              $('input[type=text]').addClass(' is-invalid')
            }
            // $('#descriptionError').text(response.responseJSON.errors.description);
          }
        });
    }

  </script>
@endsection