<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
                <div class="sidebar-brand-text mx-3">Tshirt SHOP</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Nav Item -->
            @can('viewAny', App\Models\Cliente::class)
                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <li class="nav-item {{ Route::currentRouteName() == 'clientes' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('clientes') }}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Clientes</span></a>
                </li>
            @endcan

            <!-- Nav Item -->
            @can('viewAny', App\Models\User::class)
                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <li class="nav-item {{ Route::currentRouteName() == 'funcionarios' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('funcionarios') }}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Funcion??rios</span></a>
                @endcan
                <!-- Nav Item -->
            <li class="nav-item {{ Route::currentRouteName() == 'estampas' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('estampas') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Estampas</span></a>
            </li>
            @can('clientes', App\Models\Encomenda::class)
                <li class="nav-item {{ Route::currentRouteName() == 'historico.encomendas.cliente' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('historico.encomendas.cliente') }}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Encomendas</span></a>
                </li>
            @endcan
            @can('funcionarios', App\Models\Encomenda::class)
                <li class="nav-item {{ Route::currentRouteName() == 'encomendas.funcionario' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('encomendas.funcionario') }}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Encomendas</span></a>
                </li>
            @endcan
            @can('administradores', App\Models\Encomenda::class)
                <li class="nav-item {{ Route::currentRouteName() == 'encomendas.administrador' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('encomendas.administrador') }}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Encomendas</span></a>
                </li>
            @endcan
            @can('administradores', App\Models\Encomenda::class)
                <li class="nav-item {{ Route::currentRouteName() == 'estatisticas' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('estatisticas') }}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Estatisticas</span></a>
                </li>
            @endcan

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">


            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li class="shoppingCart">
                                <a href="{{ route('estampas.shoppingCart') }}" class="iconCart"><i
                                        class="fa fa-shopping-cart" aria-hidden="true"></i> Shopping
                                    Cart
                                    <span
                                        class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQuantidade : '' }}
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            @if (Auth::user()->tipo == 'C')
                                <li class="shoppingCart">
                                    <a href="{{ route('estampas.shoppingCart') }}" class="iconCart"><i
                                            class="fa fa-shopping-cart" aria-hidden="true"></i> Shopping
                                        Cart
                                        <span
                                            class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQuantidade : '' }}
                                        </span>
                                    </a>
                                </li>
                            @endif
                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span
                                        class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                    <img class="img-profile rounded-circle"
                                        src="{{ Auth::user()->foto_url ? asset('storage/fotos/' . Auth::user()->foto_url) : asset('img/default_img.png') }}">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item"
                                        href="{{ auth()->user()->tipo == 'C' ? route('clientes.edit', auth()->user()->id) : 'clientes.create', auth()->user()->id }}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Perfil
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @if (session('alert-msg'))
                        @include('partials.message')
                    @endif
                    @if ($errors->any())
                        @include('partials.errors-message')
                    @endif

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col">
                            @yield('content')
                        </div>

                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Tshirt shop 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

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
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">??</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>

</html>
