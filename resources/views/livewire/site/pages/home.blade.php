@extends('layouts.site.app')

@section('content')

<!-- Services Start -->
<div class="container-fluid py-5" id="about">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item rounded pt-3 text-center shadow-sm">
                    <div class="p-4">
                        <i class="fa fa-3x fa-box-open mb-4" style="color: var(--primary);"></i>
                        <h5>Produtos de Qualidade</h5>
                        <p>Trabalhamos apenas com marcas de confiança para garantir o melhor para si.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item rounded pt-3 text-center shadow-sm">
                    <div class="p-4">
                        <i class="fa fa-3x fa-truck mb-4" style="color: var(--primary);"></i>
                        <h5>Entrega Rápida</h5>
                        <p>Receba as suas encomendas de forma segura e no menor tempo possível.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item rounded pt-3 text-center shadow-sm">
                    <div class="p-4">
                        <i class="fa fa-3x fa-credit-card mb-4" style="color: var(--primary);"></i>
                        <h5>Pagamentos Seguros</h5>
                        <p>Utilizamos plataformas de pagamento certificadas e seguras.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="service-item rounded pt-3 text-center shadow-sm">
                    <div class="p-4">
                        <i class="fa fa-3x fa-headset mb-4" style="color: var(--primary);"></i>
                        <h5>Suporte 24/7</h5>
                        <p>Estamos disponíveis a qualquer hora para o ajudar na sua compra.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Services End -->


<!-- About Start -->
<div class="container-fluid py-5 bg-light">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-6 text-start">
                        <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.1s"
                             src="{{ asset('site/img/store-1.jpg') }}">
                    </div>
                    <div class="col-6 text-start">
                        <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.3s"
                             src="{{ asset('site/img/store-2.jpg') }}" style="margin-top: 25%;">
                    </div>
                    <div class="col-6 text-end">
                        <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.5s"
                             src="{{ asset('site/img/store-3.jpg') }}">
                    </div>
                    <div class="col-6 text-end">
                        <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.7s"
                             src="{{ asset('site/img/store-4.jpg') }}">
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <h5 class="section-title ff-secondary text-start fw-normal" style="color: var(--primary);">Sobre Nós</h5>
                <h1 class="mb-4">Bem-vindo à <i class="fa fa-shopping-bag me-2" style="color: var(--primary);"></i>MINISHOP</h1>

                <p class="mb-4">A MINISHOP é um marketplace moderno que conecta vendedores e compradores de forma
                    prática e segura. Oferecemos uma vasta gama de produtos, desde eletrónicos até moda e beleza.</p>

                <p class="mb-4">Nosso objetivo é simplificar a sua experiência de compra online, garantindo preços
                    competitivos e entregas rápidas.</p>

                <div class="row g-4 mb-4">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center border-start border-5 border-secondary px-3">
                            <h1 class="flex-shrink-0 display-5 mb-0" data-toggle="counter-up">{{ $companies }}</h1>
                            <div class="ps-4">
                                @if ($companies > 1)
                                    <p class="mb-0">Lojas Parceiras</p>
                                @else
                                    <p class="mb-0">Loja Parceira</p>
                                @endif
                                <h6 class="text-uppercase mb-0">em nosso marketplace</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <a class="btn py-3 px-5 mt-2 text-light" style="background-color: var(--primary);" href="{{ route('site.about') }}">
                    Saber Mais
                </a>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

@endsection
