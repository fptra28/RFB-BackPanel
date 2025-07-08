<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Rifan Financindo Berjangka">
    <meta name="author" content="Muhammad Faturrahman Putra">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('namaPage') - Rifan Financindo Berjangka</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/cover-login.png') }}" rel="icon" type="image/png">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion z-200" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('img/logo-rfb.png') }}" alt="Logo RFB" class="img-fluid"
                        style="width: 30px; height: auto;">
                </div>
                <div class="sidebar-brand-text mx-3">
                    <div class="d-flex flex-column">
                        <span>Rifan</span>
                        <span>Financindo</span>
                    </div>
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Nav::isRoute('home') }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>{{ __('Dashboard') }}</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('Menu') }}
            </div>

            <!-- Nav Item - Produk Collapse Menu -->
            <li class="nav-item {{ Nav::isRoute('jfx.*') || Nav::isRoute('spa.*') ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduk"
                    aria-expanded="{{ Nav::isRoute('jfx.*') || Nav::isRoute('spa.*') ? 'true' : 'false' }}"
                    aria-controls="collapseProduk">
                    <i class="fas fa-box-open"></i>
                    <span>Produk</span>
                </a>
                <div id="collapseProduk" class="collapse" aria-labelledby="headingProduk"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Manajemen Produk:</h6>
                        <a class="collapse-item {{ Nav::isRoute('jfx.*') ? 'active' : '' }}"
                            href="{{ route('jfx.index') }}">
                            Produk Multilateral JFX
                        </a>
                        <a class="collapse-item {{ Nav::isRoute('spa.*') ? 'active' : '' }}"
                            href="{{ route('spa.index') }}">
                            Produk Bilateral (SPA)
                        </a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Profile -->
            <li class="nav-item {{ Nav::isRoute('berita.*') }}">
                <a class="nav-link" href="{{ route('berita.index') }}">
                    <i class="fa-solid fa-newspaper"></i>
                    <span>{{ __('Berita') }}</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('Pengaturan') }}
            </div>

            <!-- Nav Item - Profile -->
            <li class="nav-item {{ Nav::isRoute('profileWeb.*') }}">
                <a class="nav-link" href="{{route('profileWeb.index')}}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>{{ __('Profile') }}</span>
                </a>
            </li>

            <!-- Nav Item - About -->
            <li class="nav-item {{ Nav::isRoute('kategori-wakil.*') }}">
                <a class="nav-link" href="{{route('kategori-wakil.index')}}">
                    <i class="fas fa-fw fa-hands-helping"></i>
                    <span>{{ __('Wakil Pialang') }}</span>
                </a>
            </li>

            <!-- Nav Item - About -->
            <li class="nav-item {{ Nav::isRoute('banner.*') }}">
                <a class="nav-link" href="{{route('banner.index')}}">
                    <i class="fa-solid fa-images"></i>
                    <span>{{ __('Banner') }}</span>
                </a>
            </li>

            <!-- Nav Item - About -->
            <li class="nav-item {{ Nav::isRoute('galeri.*') }}">
                <a class="nav-link" href="">
                    <i class="fa-solid fa-image"></i>
                    <span>{{ __('Galeri') }}</span>
                </a>
            </li>

            <!-- Nav Item - About -->
            <li class="nav-item {{ Nav::isRoute('file.*') }}">
                <a class="nav-link" href="">
                    <i class="fa-solid fa-file"></i>
                    <span>{{ __('File Unduhan') }}</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('Manajemen Pengguna') }}
            </div>

            <!-- Nav Item - Profile -->
            <li class="nav-item {{ Nav::isRoute('user.*') }}">
                <a class="nav-link" href="">
                    <i class="fas fa-fw fa-user"></i>
                    <span>{{ __('User') }}</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column ">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name
                                    }}</span>
                                <figure class="img-profile rounded-circle avatar font-weight-bold"
                                    data-initial="{{ Auth::user()->name[0] }}"></figure>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Profile') }}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('main-content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Ready to Leave?') }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <a class="btn btn-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{
                        __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</body>

</html>