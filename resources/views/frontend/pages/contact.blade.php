@extends('frontend.all')

@section('JudulHalaman','Kontak')


@section('konten')
@section('foto_bg')
<section class="hero-wrap hero-wrap-2 js-fullheight"
    style="background-image: url({{asset('aspiration/images/bg_blog_contact3.jpg')}});"
    data-stellar-background-ratio="0.5">
    @endsection
    @section('isiHeader')
    <h2 class="mb-3 bread">Kontak</h2>
    <p class="breadcrumbs"><span class="mr-2"><a href="{{route('home')}}">Beranda <i
                    class="ion-ios-arrow-forward"></i></a></span>
        <span>Kontak <i class="ion-ios-arrow-forward"></i></span></p>
    @endsection
    @include('frontend.template.header')

    <section class="contact-section bg-primary">
        <div class="container">
            <div class="row no-gutters d-flex contact-info">
                <div class="col-md-3 d-flex">
                    <div class="align-self-stretch box p-4 py-md-5 text-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="icon-map-signs"></span>
                        </div>
                        <h3>Alamat</h3>
                        <p>Jl. Margo Basuki No.43, Jetis, Mulyoagung, Kec. Dau, Malang, Jawa Timur 65151</p>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="align-self-stretch box p-4 py-md-5 text-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="icon-phone2"></span>
                        </div>
                        <h3>Nomer Kontak</h3>
                        <p>(0341) 464563</p>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="align-self-stretch box p-4 py-md-5 text-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="icon-paper-plane"></span>
                        </div>
                        <h3>Alamat Email</h3>
                        <p><a href="mailto:alfanajizan@gmail.com">alfanajizan@gmail.com</a></p>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="align-self-stretch box p-4 py-md-5 text-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="icon-globe"></span>
                        </div>
                        <h3>Website</h3>
                        <p><a href="{{route('home')}}">panti-ulilabsharmalang.com</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section style="margin-bottom: -10px;">
        {{-- <div class="row"> --}}
        {{-- <div class="col-md-12"> --}}
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5600.245135990453!2d112.58909278417815!3d-7.923200749305565!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e788189c825d8cf%3A0x2bc090a74badbdfe!2sPesantren%20Panti%20Asuhan%20Putra%20Muhammadiyah%20Ulil%20Abshar!5e0!3m2!1sid!2sid!4v1596721049272!5m2!1sid!2sid"
            width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
            tabindex="0"></iframe>
        {{-- </div> --}}
        {{-- </div> --}}

    </section>

    {{--
<section class="ftco-section ftco-no-pt ftco-no-pb contact-section">
    <div class="container-fluid px-0">
        <div class="row no-gutters block-9">
            <div class="col-md-6 order-md-last d-flex">
                <form action="#" class="bg-light p-5 contact-form">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Your Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Your Email">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Subject">
                    </div>
                    <div class="form-group">
                        <textarea name="" id="" cols="30" rows="7" class="form-control"
                            placeholder="Message"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
                    </div>
                </form>

            </div>

            <div class="col-md-6 d-flex">
                <div id="map" class="bg-white"></div>
            </div>
        </div>
    </div>
</section> --}}
    @endsection

    @section('JsTambahanAfter')

    @endsection
