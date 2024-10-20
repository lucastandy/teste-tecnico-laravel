<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Teste admin</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-nav">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="#">SGV</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Perfil</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#">Sair</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-five" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <a @class(['nav-link', 'active' => isset($menu) && $menu == 'dashboard']) href="{{ route('dashboard') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>

                        <a @class(['nav-link', 'active' => isset($menu) && $menu == 'users']) href="{{ route('user.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                            Usuários
                        </a>

                        <a @class(['nav-link', 'active' => isset($menu) && $menu == 'customers']) href="{{ route('customer.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-people-roof"></i></div>
                            Clientes
                        </a>

                        <a @class(['nav-link', 'active' => isset($menu) && $menu == 'coupon']) href="{{ route('coupon.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-ticket"></i></div>
                            Cupons
                        </a>

                        <a @class(['nav-link', 'active' => isset($menu) && $menu == 'category']) href="{{ route('category.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-layer-group"></i></div>
                            Categorias
                        </a>

                        <a @class(['nav-link', 'active' => isset($menu) && $menu == 'products']) href="{{ route('product.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-headphones"></i></div>
                            Produtos
                        </a>

                        <a @class(['nav-link', 'active' => isset($menu) && $menu == 'sales']) href="{{ route('sale.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-list-check"></i></div>
                            Vendas
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a class="nav-link" :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                style="cursor: pointer;">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-arrow-right-from-bracket"></i></div>
                                Sair
                            </a>
                        </form>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logado:
                        @if (auth()->check())
                            {{ auth()->user()->name }}
                        @endif
                    </div>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">

            <main>
                {{ $slot }}
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Celke {{ date('Y') }}</div>
                        <div>
                            <a href="#" class="text-decoration-none">Política de Privacidade</a>
                            &middot;
                            <a href="#" class="text-decoration-none">Termos de Uso</a>
                        </div>
                    </div>
                </div>
            </footer>

        </div>

    </div>

</body>

</html>
