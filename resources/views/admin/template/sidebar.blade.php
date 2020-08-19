<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->nama}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('admin_dashboard')}}" class="nav-link {{request()->is('adm1n') ? "active":""}}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin_pages_donasi_index')}}"
                        class="nav-link {{request()->is('*adm1n/donasi*') ? 'active': ''}}">
                        <i class="fas fa-people-carry nav-icon"></i>
                        <p>
                            Donasi
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin_produk')}}" class="nav-link {{request()->is('*adm1n/produk*') ? 'active': ''}}">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>
                            Produk
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin_pages_blog_index')}}"
                        class="nav-link {{request()->is('*adm1n/pages/blog*') ? 'active': ''}}">
                        <i class=" fas fa-copy nav-icon"></i>
                        <p>Blog</p>
                    </a>
                </li>
                {{-- <li class="nav-item has-treeview {{request()->is('*adm1n/pages*') ? 'menu-open' : ''}}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Halaman
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="../layout/boxed.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Product</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin_pages_blog_index')}}"
                            class="nav-link {{request()->is('*adm1n/pages/blog*') ? 'active': ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Blog</p>
                        </a>
                    </li>
                </ul>
                </li> --}}
                <li class="nav-header">Data Panti Asuhan</li>
                <li class="nav-item">
                    <a href="{{route('admin_profil_anak')}}"
                        class="nav-link {{request()->is('*adm1n/profil_anak*') ? 'active': ''}}">
                        <i class="nav-icon fas fa-child"></i>
                        <p>
                            Profil Anak
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin_manager')}}"
                        class="nav-link {{request()->is('*adm1n/manager*') ? 'active': ''}}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Pengurus
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin_fasilitas')}}"
                        class="nav-link {{request()->is('*adm1n/fasilitas*') ? 'active': ''}}">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                            Sarana Prasarana
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!--
 /.sidebar -->
</aside>
