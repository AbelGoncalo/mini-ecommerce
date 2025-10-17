@extends('layouts.site.app')
@section('title', 'Sobre Nós')
@section('content')

<!-- About Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5 align-items-center">

            <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.2s">
                <img src="{{ asset('site/img/store-1.jpg') }}" alt="Sobre Nós" class="img-fluid rounded shadow">
            </div>

            <div class="col-lg-6" style="margin-top: 4rem">
                <h5 class="section-title ff-secondary text-start fw-bold" style="color: var(--dark-blue);">Quem Somos</h5>
                <p class="mb-4 fw-bold" style="color: #000;">
                    A <strong>MiniShop</strong> é uma loja online criada para oferecer a melhor experiência de compra digital, com uma seleção exclusiva de produtos de alta qualidade e preços acessíveis. Nosso compromisso é tornar o processo de compra simples, rápido e seguro, valorizando o seu tempo e satisfação.
                </p>
                <p class="mb-4 fw-bold" style="color: #000;">
                    Trabalhamos com as melhores marcas do mercado, oferecendo desde eletrônicos, moda e acessórios até produtos para o lar. Acreditamos que cada cliente merece o melhor atendimento e, por isso, garantimos entregas rápidas e suporte dedicado em todas as etapas da compra.
                </p>
                <p class="mb-4 fw-bold" style="color: #000;">
                    Na <strong>MiniShop</strong>, a inovação e a confiança caminham juntas. Queremos ser o seu destino preferido de compras online — um lugar onde qualidade, praticidade e economia se encontram.
                </p>
            </div>

        </div>
    </div>
</div>
<!-- About End -->

<!-- Team / Valores Start -->
<div class="container-fluid py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h5 class="section-title ff-secondary fw-bold" style="color: var(--dark-blue);">Nossos Valores</h5>
            <h2 class="fw-bold text-dark">O que nos move todos os dias</h2>
        </div>

        <div class="row g-4">
            <div class="col-md-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="card border-0 shadow-sm text-center p-4 h-100">
                    <i class="fa fa-star fa-3x text-warning mb-3"></i>
                    <h5 class="fw-bold">Qualidade e Confiança</h5>
                    <p class="text-muted">Trabalhamos apenas com produtos originais e fornecedores verificados, garantindo excelência em cada compra.</p>
                </div>
            </div>
            <div class="col-md-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="card border-0 shadow-sm text-center p-4 h-100">
                    <i class="fa fa-truck fa-3x text-warning mb-3"></i>
                    <h5 class="fw-bold">Entrega Rápida</h5>
                    <p class="text-muted">Temos uma logística eficiente para que o seu pedido chegue no menor tempo possível, com segurança e rastreamento em tempo real.</p>
                </div>
            </div>
            <div class="col-md-4 wow fadeInUp" data-wow-delay="0.5s">
                <div class="card border-0 shadow-sm text-center p-4 h-100">
                    <i class="fa fa-headset fa-3x text-warning mb-3"></i>
                    <h5 class="fw-bold">Atendimento Personalizado</h5>
                    <p class="text-muted">Nossa equipe está sempre disponível para ajudar antes, durante e depois da compra — porque cada cliente é especial.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team / Valores End -->

@endsection
