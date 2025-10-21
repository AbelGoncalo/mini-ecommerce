<!DOCTYPE html>
<html lang="pt-ao">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Ecommerce')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Mini-Ecommerce">
    <meta name="description" content="AgCode">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('site/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('site/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('site/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('site/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('site/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/showrating.css') }}" rel="stylesheet">

    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
        integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Livewire Styles --}}
    @livewireStyles
</head>

<body>
    <div class="container-fluid bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border" style="width: 3rem; height: 3rem; color:#cdb81a" role="status">
                <span class="sr-only" style="color:#cdb81a;">Processando...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar & Hero Start -->
        <div class="container-fluid position-relative p-0">
            @include('livewire.site.pages.nav')
            @yield('content')

            <a href="#" class="btn btn-lg btn-lg-square back-to-top text-light" style="background-color: #cdb81a;">
                <i class="bi bi-arrow-up"></i>
            </a>

            <!-- Footer Start -->
            <footer class="bg-dark text-light pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
                <div class="container pb-4">
                    <div class="row g-5">
                        <!-- Loja -->
                        <div class="col-lg-3 col-md-6">
                            <h5 class="text-uppercase mb-4" style="color:#f1c40f;">Loja Online</h5>
                            <ul class="list-unstyled">
                                <li><a class="text-light text-decoration-none" href="{{ route('site.about') }}">Sobre Nós</a></li>
                                <li><a class="text-light text-decoration-none" href="#">Novidades</a></li>
                                <li><a class="text-light text-decoration-none" href="#">Ofertas Especiais</a></li>
                                <li><a class="text-light text-decoration-none" href="#">Blog</a></li>
                            </ul>
                        </div>
                        <!-- Ajuda -->
                        <div class="col-lg-3 col-md-6">
                            <h5 class="text-uppercase mb-4" style="color:#f1c40f;">Suporte</h5>
                            <ul class="list-unstyled">
                                <li><a class="text-light text-decoration-none" href="#">Como Comprar</a></li>
                                <li><a class="text-light text-decoration-none" href="#">Envios & Entregas</a></li>
                                <li><a class="text-light text-decoration-none" href="#">Política de Devoluções</a></li>
                                <li><a class="text-light text-decoration-none" href="#">Termos e Condições</a></li>
                            </ul>
                        </div>
                        <!-- Contactos -->
                        <div class="col-lg-3 col-md-6">
                            <h5 class="text-uppercase mb-4" style="color:#f1c40f;">Contacte-nos</h5>
                            <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Talatona, Luanda</p>
                            <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+244 928 121 231</p>
                            <p class="mb-2"><i class="fa fa-envelope me-3"></i>suporte@fortcodedev.com</p>
                            <div class="d-flex pt-2">
                                <a class="btn btn-outline-light btn-social me-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-light btn-social me-2" href="#"><i class="fab fa-instagram"></i></a>
                                <a class="btn btn-outline-light btn-social me-2" href="#"><i class="fab fa-whatsapp"></i></a>
                                <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                        <!-- Newsletter -->
                        <div class="col-lg-3 col-md-6">
                            <h5 class="text-uppercase mb-4" style="color:#f1c40f;">Receba Novidades</h5>
                            <p class="small">Subscreva para receber promoções exclusivas e novos produtos.</p>
                            <form action="#" method="POST" class="d-flex">
                                <input type="email" class="form-control border-0 me-2" placeholder="Seu e-mail" required>
                                <button class="btn" type="submit" style="background-color:#f1c40f; color:#000;">OK</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="container-fluid border-top border-secondary py-3 mt-4">
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center text-md-start">
                            <p class="mb-0 small">&copy; <a class="text-warning text-decoration-none" href="#">FortCode</a> - Todos os direitos reservados.</p>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu small">
                                <a href="#" class="text-light text-decoration-none me-3">Início</a>
                                <a href="#" class="text-light text-decoration-none me-3">Política de Privacidade</a>
                                <a href="#" class="text-light text-decoration-none me-3">Ajuda</a>
                                <a href="#" class="text-light text-decoration-none">FAQs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <x-livewire-alert::scripts />
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('site/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('site/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('site/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('site/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('site/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('site/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('site/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('site/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- SweetAlert2 (já vem com Livewire Alert, mas mantém para compatibilidade) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('site/js/main.js') }}"></script>

    <!-- Livewire Scripts -->
    @livewireScripts
    @livewireAlerts

    @stack('select2')
    @stack('search-company')
    @stack('search-company-reserve')
    @stack('rating-show-comment')

    {{-- Sessões de Alerta --}}
    @if(session('empt-cart'))
        <script>
            Swal.fire({
                title: "AVISO",
                text: "{!! session('empt-cart') !!}",
                icon: "warning",
                timer: 1500,
                timerProgressBar: true,
                showConfirmButton: false,
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                title: "ERRO",
                text: "{!! session('error') !!}",
                icon: "error",
                timer: 1000,
                timerProgressBar: true,
                showConfirmButton: false,
            });
        </script>
    @endif
</body>
</html>
