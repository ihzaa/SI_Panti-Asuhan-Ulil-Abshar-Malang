<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{config('app.name')}} | @yield('judul_halaman')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,500,600,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('aspiration/css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('aspiration/css/animate.css')}}">

    <link rel="stylesheet" href="{{asset('aspiration/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('aspiration/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('aspiration/css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{asset('aspiration/css/aos.css')}}">

    <link rel="stylesheet" href="{{asset('aspiration/css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{asset('aspiration/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('aspiration/css/jquery.timepicker.css')}}">


    <link rel="stylesheet" href="{{asset('aspiration/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('aspiration/css/icomoon.css')}}">
    <link rel="stylesheet" href="{{asset('aspiration/css/style.css')}}">
</head>

<body>
    @include('frontend.template.navbar')
    <!-- END nav -->

    @yield('konten')

    @include('frontend.template.footer')

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" /></svg></div>


    <script src="{{asset('aspiration/js/jquery.min.js')}}"></script>
    <script src="{{asset('aspiration/js/jquery-migrate-3.0.1.min.js')}}"></script>
    <script src="{{asset('aspiration/js/popper.min.js')}}"></script>
    <script src="{{asset('aspiration/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('aspiration/js/jquery.easing.1.3.js')}}"></script>
    <script src="{{asset('aspiration/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('aspiration/js/jquery.stellar.min.js')}}"></script>
    <script src="{{asset('aspiration/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('aspiration/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('aspiration/js/aos.js')}}"></script>
    <script src="{{asset('aspiration/js/jquery.animateNumber.min.js')}}"></script>
    <script src="{{asset('aspiration/js/scrollax.min.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false">
    </script>
    <script src="{{asset('aspiration/js/google-map.j')}}s"></script>
    <script src="{{asset('aspiration/js/main.js')}}"></script>

</body>

</html>
