@extends('frontend.all')

@section('JudulHalaman', 'Profil Anak')

@section('CssTambahanAfter')
<link rel="stylesheet" href="{{asset('aspiration/css/style_profil_anak.css')}}">
@endsection

@section('konten')
@section('foto_bg')
<section class="hero-wrap hero-wrap-2 js-fullheight"
    style="background-image: url({{asset('aspiration/images/bg_profil_anak.jpg')}});" data-stellar-background-ratio="0.5">
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
