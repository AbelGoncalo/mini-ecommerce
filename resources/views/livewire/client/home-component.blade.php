@section('title','Painel Cliente')
<div>
    <div class="welcome-page">
        <h3>SEJA BEM-VINDO A CIPRIMAD</h3>
        <p>Data: {{date('d-m-Y')}} | Hora:{{date('H:m')}}</p>
    </div>
    <div class="col-md-12 d-flex justify-content-center algin-items-center flex-wrap ">
        <div class="col-md-8">

                <div class="text-center">
                    <h4 class="text-center fw-bold text-muted">Senhor(a),   {{ auth()->user()->name?? ''}}</h4>
                </div>

            <div class="card shadow rounded " id="card-welcome">
                <div class="card-header">
                    <h6 class="text-center text-uppercase">
                        <i class="fa-solid fa-clipboard-list"></i>
                        Adicione as Informações a baixo, para fazer seu pedido

                    </h6>
                </div>
                <div class="card-body">

                    <a  href="{{route('site.itens')}}" class="w-100 btn btn-md btn-primary-welcome-client">Ir para loja <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>


        </div>
    </div>
</div>
