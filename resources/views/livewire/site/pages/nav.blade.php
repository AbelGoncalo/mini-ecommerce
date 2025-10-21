<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top px-4 px-lg-5 py-3 py-lg-0"
    style="{{ in_array(Route::currentRouteName(), ['site.companies', 'site.company', 'site.about', 'site.cart']) ? 'background-color: var(--primary); margin-bottom:5rem !important' : '' }}">
    <a href="{{ route('site.home') }}" class="navbar-brand p-0 d-flex align-items-center">
        <i class="fa fa-shopping-bag fa-2x me-2" style="color:#f1c40f;"></i>
        <h1 class="text-light m-0 fw-bold">MINI<span class="text-warning">SHOP</span></h1>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0 pe-4 text-uppercase">
            <a href="{{ route('site.home') }}"
                class="nav-item nav-link {{ Route::is('site.home') ? 'active text-warning' : '' }}">Início</a>
            <a href="{{ route('site.itens') }}"
                class="nav-item nav-link {{ Route::is('site.itens') ? 'active text-warning' : '' }}">Produtos</a>
            <a href="{{ route('site.about') }}"
                class="nav-item nav-link {{ Route::is('site.about') ? 'active text-warning' : '' }}">Sobre</a>


            <a href="{{ route('site.cart') }}" class="nav-item nav-link">
                <i class="fa fa-shopping-cart"></i>
                @livewire('site.cart-count')
            </a>

            @guest
            <a href="{{ route('auth.login') }}" class="nav-item nav-link fw-bold">
                Entrar
            </a>
            @endguest


            @auth
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle fw-bold" id="userDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end custom-dropdown" aria-labelledby="userDropdown">

                        <li><a class="dropdown-item" href="#">Painel</a></li>
                        <li><a class="dropdown-item" href="#">perfil</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            @livewire('auth.logout')
                        </li>
                    </ul>
                </div>
            @endauth
        </div>
    </div>
</nav>

{{-- =================== HERO =================== --}}
@if (Route::is('site.home'))
<div class="container-fluid py-5 bg-dark hero-header mb-5">
    <div class="container my-5 py-5">
        <div class="row g-5 mt-3">
            <div class="col-lg-12 text-center text-light">
                <h1 class="display-2 fw-bold mb-3"><i class="fa fa-shopping-bag me-2"
                        style="color:#f1c40f;"></i>Bem-vindo à MiniShop</h1>
                <p class="lead mb-4">Compre produtos de qualidade com entrega rápida e segura.</p>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('site.itens') }}"
                        class="btn btn-warning text-dark fw-bold py-sm-3 px-sm-5 me-2">Ver Produtos</a>
                    <a href="{{ route('site.about') }}" class="btn btn-outline-light py-sm-3 px-sm-5">Sobre Nós</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
