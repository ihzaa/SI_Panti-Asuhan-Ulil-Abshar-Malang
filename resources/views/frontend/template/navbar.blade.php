<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container-fluid px-lg-5">
        <a class="navbar-brand" href="index.html">{{config('app.name')}}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                {{--
                    method request()->is('url') ini untuk supaya ada efek aktif
                    di navbar sesuai halaman yg sekarang dibuka
                --}}
                <li class="nav-item {{request()->is('/') ? "active":""}}"><a href="index.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item"><a href="about.html" class="nav-link">About us</a></li>
                <li class="nav-item"><a href="services.html" class="nav-link">Services</a></li>
                <li class="nav-item"><a href="causes.html" class="nav-link">Causes</a></li>
                <li class="nav-item {{request()->is('blog*') ? "active":""}}"><a href="{{route('frontend_blog_index')}}"
                        class="nav-link">Blog</a></li>
                <li class="nav-item {{request()->is('contact*') ? "active":""}}"><a href="{{route('frontend_contact')}}" class="nav-link">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>