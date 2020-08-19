<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container-fluid px-lg-5">
        <a class="navbar-brand" href="{{route('home')}}">{{config('app.name')}}</a>
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
                <li class="nav-item {{request()->is('/') ? "active":""}}"><a href="{{route('home')}}" class="nav-link">Home</a>
                </li>
                <li class="nav-item {{request()->is('about*') ? "active":""}}"><a href="{{route('about')}}" class="nav-link">About us</a></li>
                <li class="nav-item {{request()->is('produk*') ? "active":""}}"><a href="{{route('produk')}}" class="nav-link">Product</a></li>
                <li class="nav-item {{request()->is('profil_anak*') ? "active":""}}"><a href="{{route('profil_anak')}}" class="nav-link">Profil Anak</a></li>
                <li class="nav-item {{request()->is('blog*') ? "active":""}}"><a href="{{route('frontend_blog_index')}}"
                        class="nav-link">Blog</a></li>
                <li class="nav-item {{request()->is('contact*') ? "active":""}}"><a href="{{route('frontend_contact')}}" class="nav-link">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>
