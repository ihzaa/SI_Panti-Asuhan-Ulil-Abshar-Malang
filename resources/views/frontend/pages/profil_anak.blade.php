@extends('frontend.all')

@section('JudulHalaman', 'Profil Anak')

@section('CssTambahanAfter')
<link rel="stylesheet" href="{{asset('aspiration/css/style_profil_anak.css')}}">
@endsection

@section('konten')
@section('foto_bg')
<section class="hero-wrap hero-wrap-2 js-fullheight"
    style="background-image: url({{asset('aspiration/images/blog.jpg')}});" data-stellar-background-ratio="0.5">
    @endsection
    @section('isiHeader')
    <h2 class="mb-3 bread">Profil Anak</h2>
    <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span>
        <span>Profil Anak <i class="ion-ios-arrow-forward"></i></span></p>
    @endsection
    @include('frontend.template.header')

    <section class="ftco-section ftco-causes">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <div class="container">
            @if (count($data_anak) > 0)
            <div class="data_anak">
                @include('frontend.pages.pagination')
            </div>
            @else
            <h1>Data anak asuh tidak tersedia</h1>
            @endif
        </div>

        {{-- <div class="container">
    <div class="row">
      <div class="col-md-4 col-lg-3">
        <div class="causes causes-2 text-center ftco-animate">
          <div class="img" style="background-image: url({{asset('aspiration/images/causes-1.jpg')}});"></div>
        <h2>Clean water for South Sudan</h2>
        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the
            blind texts.</p>
        <div class="goal">
            <p><span>$3,800</span> to go</p>
            <div class="progress" style="height:20px">
                <div class="progress-bar progress-bar-striped" style="width:70%; height:20px">70%</div>
            </div>
        </div>
        </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="causes causes-2 text-center ftco-animate">
                <div class="img" style="background-image: url({{asset('aspiration/images/causes-2.jpg')}});"></div>
                <h2>Home for Asias Child</h2>
                <!-- <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the
            blind texts.</p> -->
                <div class="goal">
                    <p><span>$3,800</span> to go</p>
                    <div class="progress" style="height:20px">
                        <div class="progress-bar progress-bar-striped" style="width:75%; height:20px">75%</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="causes causes-2 text-center ftco-animate">
                <div class="img" style="background-image: url({{asset('aspiration/images/causes-3.jpg')}});"></div>
                <h2>Education for Asian School</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live
                    the
                    blind texts.</p>
                <div class="goal">
                    <p><span>$3,800</span> to go</p>
                    <div class="progress" style="height:20px">
                        <div class="progress-bar progress-bar-striped" style="width:40%; height:20px">40%</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="causes causes-2 text-center ftco-animate">
                <div class="img" style="background-image: url({{asset('aspiration/images/causes-4.jpg')}});"></div>
                <h2>Clean water for South Sudan</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live
                    the
                    blind texts.</p>
                <div class="goal">
                    <p><span>$3,800</span> to go</p>
                    <div class="progress" style="height:20px">
                        <div class="progress-bar progress-bar-striped" style="width:70%; height:20px">70%</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="causes causes-2 text-center ftco-animate">
                <div class="img" style="background-image: url(images/causes-5.jpg);"></div>
                <h2>Home for Asias Child</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live
                    the
                    blind texts.</p>
                <div class="goal">
                    <p><span>$3,800</span> to go</p>
                    <div class="progress" style="height:20px">
                        <div class="progress-bar progress-bar-striped" style="width:75%; height:20px">75%</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="causes causes-2 text-center ftco-animate">
                <div class="img" style="background-image: url(images/causes-6.jpg);"></div>
                <h2>Education for Asian School</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live
                    the
                    blind texts.</p>
                <div class="goal">
                    <p><span>$3,800</span> to go</p>
                    <div class="progress" style="height:20px">
                        <div class="progress-bar progress-bar-striped" style="width:40%; height:20px">40%</div>
                    </div>
                </div>
            </div>
        </div>
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
        </div> --}}
    </section>

    @endsection

    @section('JsTambahanAfter')
    <script>
        $(function() {
    $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();

        var url = $(this).attr('href');
        getArticles(url);
        window.history.pushState("", "", url);
    });

    function getArticles(url) {
        $.ajax({
            url : url
        }).done(function (data) {
            $('.data_anak').html(data);
        }).fail(function () {
            alert('Data anak could not be loaded.');
        });
    }
});
    </script>
    @endsection
